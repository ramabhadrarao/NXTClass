<?php
if ( !defined( 'SUNRISE_LOADED' ) )
	define( 'SUNRISE_LOADED', 1 );

if ( defined( 'COOKIE_DOMAIN' ) ) {
	die( 'The constant "COOKIE_DOMAIN" is defined (probably in nxt-config.php). Please remove or comment out that define() line.' );
}

// let the site admin page catch the VHOST == 'no'
$nxtdb->dmtable = $nxtdb->base_prefix . 'domain_mapping';
$dm_domain = $nxtdb->escape( $_SERVER[ 'HTTP_HOST' ] );

if( ( $nowww = preg_replace( '|^www\.|', '', $dm_domain ) ) != $dm_domain )
	$where = $nxtdb->prepare( 'domain IN (%s,%s)', $dm_domain, $nowww );
else
	$where = $nxtdb->prepare( 'domain = %s', $dm_domain );

$nxtdb->suppress_errors();
$domain_mapping_id = $nxtdb->get_var( "SELECT blog_id FROM {$nxtdb->dmtable} WHERE {$where} ORDER BY CHAR_LENGTH(domain) DESC LIMIT 1" );
$nxtdb->suppress_errors( false );
if( $domain_mapping_id ) {
	$current_blog = $nxtdb->get_row("SELECT * FROM {$nxtdb->blogs} WHERE blog_id = '$domain_mapping_id' LIMIT 1");
	$current_blog->domain = $_SERVER[ 'HTTP_HOST' ];
	$current_blog->path = '/';
	$blog_id = $domain_mapping_id;
	$site_id = $current_blog->site_id;

	define( 'COOKIE_DOMAIN', $_SERVER[ 'HTTP_HOST' ] );

	$current_site = $nxtdb->get_row( "SELECT * from {$nxtdb->site} WHERE id = '{$current_blog->site_id}' LIMIT 0,1" );
	$current_site->blog_id = $nxtdb->get_var( "SELECT blog_id FROM {$nxtdb->blogs} WHERE domain='{$current_site->domain}' AND path='{$current_site->path}'" );
	if( function_exists( 'get_current_site_name' ) )
		$current_site = get_current_site_name( $current_site );

	define( 'DOMAIN_MAPPING', 1 );
}
?>
