<?php
/**
 * Used to set up and fix common variables and include
 * the Multisite procedural and class library.
 *
 * Allows for some configuration in nxt-config.php (see ms-default-constants.php)
 *
 * @package NXTClass
 * @subpackage Multisite
 * @since 3.0.0
 */

/** Include Multisite initialization functions */
require( ABSPATH . nxtINC . '/ms-load.php' );
require( ABSPATH . nxtINC . '/ms-default-constants.php' );

if ( defined( 'SUNRISE' ) )
	include_once( nxt_CONTENT_DIR . '/sunrise.php' );

/** Check for and define SUBDOMAIN_INSTALL and the deprecated VHOST constant. */
ms_subdomain_constants();

if ( !isset( $current_site ) || !isset( $current_blog ) ) {

	$domain = addslashes( $_SERVER['HTTP_HOST'] );
	if ( false !== strpos( $domain, ':' ) ) {
		if ( substr( $domain, -3 ) == ':80' ) {
			$domain = substr( $domain, 0, -3 );
			$_SERVER['HTTP_HOST'] = substr( $_SERVER['HTTP_HOST'], 0, -3 );
		} elseif ( substr( $domain, -4 ) == ':443' ) {
			$domain = substr( $domain, 0, -4 );
			$_SERVER['HTTP_HOST'] = substr( $_SERVER['HTTP_HOST'], 0, -4 );
		} else {
			nxt_die( /*nxt_I18N_NO_PORT_NUMBER*/'Multisite only works without the port number in the URL.'/*/nxt_I18N_NO_PORT_NUMBER*/ );
		}
	}

	$domain = rtrim( $domain, '.' );
	$cookie_domain = $domain;
	if ( substr( $cookie_domain, 0, 4 ) == 'www.' )
		$cookie_domain = substr( $cookie_domain, 4 );

	$path = preg_replace( '|([a-z0-9-]+.php.*)|', '', $_SERVER['REQUEST_URI'] );
	$path = str_replace ( '/nxt-admin/', '/', $path );
	$path = preg_replace( '|(/[a-z0-9-]+?/).*|', '$1', $path );

	$current_site = nxtmu_current_site();
	if ( ! isset( $current_site->blog_id ) )
		$current_site->blog_id = $nxtdb->get_var( $nxtdb->prepare( "SELECT blog_id FROM $nxtdb->blogs WHERE domain = %s AND path = %s", $current_site->domain, $current_site->path ) );

	if ( is_subdomain_install() ) {
		$current_blog = nxt_cache_get( 'current_blog_' . $domain, 'site-options' );
		if ( !$current_blog ) {
			$current_blog = get_blog_details( array( 'domain' => $domain ), false );
			if ( $current_blog )
				nxt_cache_set( 'current_blog_' . $domain, $current_blog, 'site-options' );
		}
		if ( $current_blog && $current_blog->site_id != $current_site->id ) {
			$current_site = $nxtdb->get_row( $nxtdb->prepare( "SELECT * FROM $nxtdb->site WHERE id = %d", $current_blog->site_id ) );
			if ( ! isset( $current_site->blog_id ) )
				$current_site->blog_id = $nxtdb->get_var( $nxtdb->prepare( "SELECT blog_id FROM $nxtdb->blogs WHERE domain = %s AND path = %s", $current_site->domain, $current_site->path ) );
		} else
			$blogname = substr( $domain, 0, strpos( $domain, '.' ) );
	} else {
		$blogname = htmlspecialchars( substr( $_SERVER[ 'REQUEST_URI' ], strlen( $path ) ) );
		if ( false !== strpos( $blogname, '/' ) )
			$blogname = substr( $blogname, 0, strpos( $blogname, '/' ) );
		if ( false !== strpos( $blogname, '?' ) )
			$blogname = substr( $blogname, 0, strpos( $blogname, '?' ) );
		$reserved_blognames = array( 'page', 'comments', 'blog', 'nxt-admin', 'nxt-includes', 'nxt-content', 'files', 'feed' );
		if ( $blogname != '' && ! in_array( $blogname, $reserved_blognames ) && ! is_file( $blogname ) )
			$path .= $blogname . '/';
		$current_blog = nxt_cache_get( 'current_blog_' . $domain . $path, 'site-options' );
		if ( ! $current_blog ) {
			$current_blog = get_blog_details( array( 'domain' => $domain, 'path' => $path ), false );
			if ( $current_blog )
				nxt_cache_set( 'current_blog_' . $domain . $path, $current_blog, 'site-options' );
		}
		unset($reserved_blognames);
	}

	if ( ! defined( 'nxt_INSTALLING' ) && is_subdomain_install() && ! is_object( $current_blog ) ) {
		if ( defined( 'NOBLOGREDIRECT' ) ) {
			$destination = NOBLOGREDIRECT;
			if ( '%siteurl%' == $destination )
				$destination = "http://" . $current_site->domain . $current_site->path;
		} else {
			$destination = 'http://' . $current_site->domain . $current_site->path . 'nxt-signup.php?new=' . str_replace( '.' . $current_site->domain, '', $domain );
		}
		header( 'Location: ' . $destination );
		die();
	}

	if ( ! defined( 'nxt_INSTALLING' ) ) {
		if ( $current_site && ! $current_blog ) {
			if ( $current_site->domain != $_SERVER[ 'HTTP_HOST' ] ) {
				header( 'Location: http://' . $current_site->domain . $current_site->path );
				exit;
			}
			$current_blog = get_blog_details( array( 'domain' => $current_site->domain, 'path' => $current_site->path ), false );
		}
		if ( ! $current_blog || ! $current_site )
			ms_not_installed();
	}

	$blog_id = $current_blog->blog_id;
	$public  = $current_blog->public;

	if ( empty( $current_blog->site_id ) )
		$current_blog->site_id = 1;
	$site_id = $current_blog->site_id;

	$current_site = get_current_site_name( $current_site );

	if ( ! $blog_id ) {
		if ( defined( 'nxt_INSTALLING' ) ) {
			$current_blog->blog_id = $blog_id = 1;
		} else {
			$msg = ! $nxtdb->get_var( "SHOW TABLES LIKE '$nxtdb->site'" ) ? ' ' . /*nxt_I18N_TABLES_MISSING*/'Database tables are missing.'/*/nxt_I18N_TABLES_MISSING*/ : '';
			nxt_die( /*nxt_I18N_NO_BLOG*/'No site by that name on this system.'/*/nxt_I18N_NO_BLOG*/ . $msg );
		}
	}
}
$nxtdb->set_prefix( $table_prefix, false ); // $table_prefix can be set in sunrise.php
$nxtdb->set_blog_id( $current_blog->blog_id, $current_blog->site_id );
$table_prefix = $nxtdb->get_blog_prefix();

// need to init cache again after blog_id is set
nxt_start_object_cache();

// Define upload directory constants
ms_upload_constants();
