<?php
/**
 * BuddyPress Core Admin Bar
 *
 * Handles the core functions related to the NXTClass Admin Bar
 *
 * @package BuddyPress
 * @subpackage Core
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( !bp_use_nxt_admin_bar() || defined( 'DOING_AJAX' ) )
	return;

/**
 * Adjust the admin bar menus based on which NXTClass version this is
 *
 * @since BuddyPress (1.5.2)
 */
function bp_core_admin_bar_version_check() {
	if ( '3.2' == bp_get_major_nxt_version() ) {
		add_action( 'bp_setup_admin_bar', 'bp_admin_bar_root_site',       3 );
		add_action( 'bp_setup_admin_bar', 'bp_admin_bar_comments_menu',   3 );
		add_action( 'bp_setup_admin_bar', 'bp_admin_bar_appearance_menu', 3 );
		add_action( 'bp_setup_admin_bar', 'bp_admin_bar_updates_menu',    3 );
	}
}
add_action( 'admin_bar_menu', 'bp_core_admin_bar_version_check', 4 );

/**
 * Unhook the NXTClass core menus.
 *
 * @since BuddyPress (r4151)
 *
 * @uses remove_action
 * @uses is_network_admin()
 * @uses is_user_admin()
 */
function bp_admin_bar_remove_nxt_menus() {

	if ( '3.2' == bp_get_major_nxt_version() ) {
		remove_action( 'admin_bar_menu', 'nxt_admin_bar_my_account_menu', 10 );
		remove_action( 'admin_bar_menu', 'nxt_admin_bar_my_sites_menu', 20 );
		remove_action( 'admin_bar_menu', 'nxt_admin_bar_dashboard_view_site_menu', 25 );

		// Don't show the 'Edit Page' menu on BP pages
		if ( !bp_is_blog_page() )
			remove_action( 'admin_bar_menu', 'nxt_admin_bar_edit_menu', 30 );

		remove_action( 'admin_bar_menu', 'nxt_admin_bar_shortlink_menu', 80 );
		remove_action( 'admin_bar_menu', 'nxt_admin_bar_updates_menu', 70 );

		if ( !is_network_admin() && !is_user_admin() ) {
			remove_action( 'admin_bar_menu', 'nxt_admin_bar_comments_menu', 50 );
			remove_action( 'admin_bar_menu', 'nxt_admin_bar_appearance_menu', 60 );
		}

		remove_action( 'admin_bar_menu', 'nxt_admin_bar_updates_menu', 70 );
	}
}
add_action( 'bp_init', 'bp_admin_bar_remove_nxt_menus', 2 );

/**
 * Add a menu for the root site of this BuddyPress network
 *
 * @global type $nxt_admin_bar
 * @return If in ajax
 */
function bp_admin_bar_root_site() {
	global $nxt_admin_bar;

	// Create the root blog menu
	$nxt_admin_bar->add_menu( array(
		'id'    => 'bp-root-blog',
		'title' => get_blog_option( bp_get_root_blog_id(), 'blogname' ),
		'href'  => bp_get_root_domain()
	) );

	// Logged in user
	if ( is_user_logged_in() ) {

		// Dashboard links
		if ( is_super_admin() ) {

			// Add site admin link
			$nxt_admin_bar->add_menu( array(
				'id' => 'dashboard',
				'parent' => 'bp-root-blog',
				'title' => __( 'Admin Dashboard', 'buddypress' ),
				'href' => get_admin_url( bp_get_root_blog_id() )
			) );

			// Add network admin link
			if ( is_multisite() ) {

				// Link to the network admin dashboard
				$nxt_admin_bar->add_menu( array(
					'id' => 'network-dashboard',
					'parent' => 'bp-root-blog',
					'title' => __( 'Network Dashboard', 'buddypress' ),
					'href' => network_admin_url()
				) );
			}
		}
	}
}

/**
 * Add the "My Sites/[Site Name]" menu and all submenus.
 */
function bp_admin_bar_my_sites_menu() {
	global $nxt_admin_bar;

	/* Add the 'My Sites' menu if the user has more than one site. */
	if ( count( $nxt_admin_bar->user->blogs ) <= 1 )
		return;

	$nxt_admin_bar->add_menu( array( 'id' => 'my-blogs', 'title' => __( 'My Sites' ), 'href' => admin_url( 'my-sites.php' ) ) );

	$default = includes_url( 'images/nxtmini-blue.png' );

	foreach ( (array)$nxt_admin_bar->user->blogs as $blog ) {
		// @todo Replace with some favicon lookup.
		//$blavatar = '<img src="' . esc_url( blavatar_url( blavatar_domain( $blog->siteurl ), 'img', 16, $default ) ) . '" alt="Blavatar" width="16" height="16" />';
		$blavatar = '<img src="' . esc_url( $default ) . '" alt="' . esc_attr__( 'Blavatar' ) . '" width="16" height="16" class="blavatar"/>';

		$blogname = empty( $blog->blogname ) ? $blog->domain : $blog->blogname;

		$nxt_admin_bar->add_menu( array( 'parent' => 'my-blogs', 'id' => 'blog-' . $blog->userblog_id, 'title' => $blavatar . $blogname, 'href' => get_admin_url( $blog->userblog_id ) ) );
		$nxt_admin_bar->add_menu( array( 'parent' => 'blog-' . $blog->userblog_id, 'id' => 'blog-' . $blog->userblog_id . '-d', 'title' => __( 'Dashboard' ), 'href' => get_admin_url( $blog->userblog_id ) ) );

		if ( current_user_can_for_blog( $blog->userblog_id, 'edit_posts' ) ) {
			$nxt_admin_bar->add_menu( array( 'parent' => 'blog-' . $blog->userblog_id, 'id' => 'blog-' . $blog->userblog_id . '-n', 'title' => __( 'New Post' ), 'href' => get_admin_url( $blog->userblog_id, 'post-new.php' ) ) );
			$nxt_admin_bar->add_menu( array( 'parent' => 'blog-' . $blog->userblog_id, 'id' => 'blog-' . $blog->userblog_id . '-c', 'title' => __( 'Manage Comments' ), 'href' => get_admin_url( $blog->userblog_id, 'edit-comments.php' ) ) );
		}

		$nxt_admin_bar->add_menu( array( 'parent' => 'blog-' . $blog->userblog_id, 'id' => 'blog-' . $blog->userblog_id . '-v', 'title' => __( 'Visit Site' ), 'href' => get_home_url( $blog->userblog_id ) ) );
	}
}

/**
 * Add edit comments link with awaiting moderation count bubble
 */
function bp_admin_bar_comments_menu( $nxt_admin_bar ) {
	global $nxt_admin_bar;

	if ( !current_user_can( 'edit_posts' ) )
		return;

	$awaiting_mod = nxt_count_comments();
	$awaiting_mod = $awaiting_mod->moderated;

	$awaiting_mod = $awaiting_mod ? "<span id='ab-awaiting-mod' class='pending-count'>" . number_format_i18n( $awaiting_mod ) . "</span>" : '';
	$nxt_admin_bar->add_menu( array( 'parent' => 'dashboard', 'id' => 'comments', 'title' => sprintf( __( 'Comments %s' ), $awaiting_mod ), 'href' => admin_url( 'edit-comments.php' ) ) );
}

/**
 * Add "Appearance" menu with widget and nav menu submenu
 */
function bp_admin_bar_appearance_menu() {
	global $nxt_admin_bar;

	// You can have edit_theme_options but not switch_themes.
	if ( !current_user_can( 'switch_themes' ) && !current_user_can( 'edit_theme_options' ) )
		return;

	$nxt_admin_bar->add_menu( array( 'parent' => 'dashboard', 'id' => 'appearance', 'title' => __( 'Appearance' ), 'href' => admin_url( 'themes.php' ) ) );

	if ( !current_user_can( 'edit_theme_options' ) )
		return;

	if ( current_user_can( 'switch_themes' ) )
		$nxt_admin_bar->add_menu( array( 'parent' => 'appearance', 'id' => 'themes', 'title' => __( 'Themes' ), 'href' => admin_url( 'themes.php' ) ) );

	if ( current_theme_supports( 'widgets' ) )
		$nxt_admin_bar->add_menu( array( 'parent' => 'appearance', 'id' => 'widgets', 'title' => __( 'Widgets' ), 'href' => admin_url( 'widgets.php' ) ) );

	if ( current_theme_supports( 'menus' ) || current_theme_supports( 'widgets' ) )
		$nxt_admin_bar->add_menu( array( 'parent' => 'appearance', 'id' => 'menus', 'title' => __( 'Menus' ), 'href' => admin_url( 'nav-menus.php' ) ) );

	if ( current_theme_supports( 'custom-background' ) )
		$nxt_admin_bar->add_menu( array( 'parent' => 'appearance', 'id' => 'background', 'title' => __( 'Background' ), 'href' => admin_url( 'themes.php?page=custom-background' ) ) );

	if ( current_theme_supports( 'custom-header' ) )
		$nxt_admin_bar->add_menu( array( 'parent' => 'appearance', 'id' => 'header', 'title' => __( 'Header' ), 'href' => admin_url( 'themes.php?page=custom-header' ) ) );
}

/**
 * Provide an update link if theme/plugin/core updates are available
 */
function bp_admin_bar_updates_menu() {
	global $nxt_admin_bar;

	if ( !current_user_can( 'install_plugins' ) )
		return;

	$plugin_update_count = $theme_update_count = $nxtclass_update_count = 0;
	$update_plugins = get_site_transient( 'update_plugins' );
	if ( !empty( $update_plugins->response ) )
		$plugin_update_count = count( $update_plugins->response );
	$update_themes = get_site_transient( 'update_themes' );
	if ( !empty( $update_themes->response ) )
		$theme_update_count = count( $update_themes->response );
	/* @todo get_core_updates() is only available on admin page loads
	  $update_nxtclass = get_core_updates( array('dismissed' => false) );
	  if ( !empty($update_nxtclass) && !in_array( $update_nxtclass[0]->response, array('development', 'latest') ) )
	  $nxtclass_update_count = 1;
	 */

	$update_count = $plugin_update_count + $theme_update_count + $nxtclass_update_count;

	if ( !$update_count )
		return;

	$update_title = array( );
	if ( !empty( $nxtclass_update_count ) )
		$update_title[] = sprintf( __( '%d NXTClass Update' ), $nxtclass_update_count );
	if ( $plugin_update_count )
		$update_title[] = sprintf( _n( '%d Plugin Update', '%d Plugin Updates', $plugin_update_count ), $plugin_update_count );
	if ( $theme_update_count )
		$update_title[] = sprintf( _n( '%d Theme Update', '%d Theme Updates', $theme_update_count ), $theme_update_count );

	$update_title = !empty( $update_title ) ? esc_attr( implode( ', ', $update_title ) ) : '';

	$update_title = "<span title='$update_title'>";
	$update_title .= sprintf( __( 'Updates %s' ), "<span id='ab-updates' class='update-count'>" . number_format_i18n( $update_count ) . '</span>' );
	$update_title .= '</span>';

	$nxt_admin_bar->add_menu( array( 'parent' => 'dashboard', 'id' => 'updates', 'title' => $update_title, 'href' => network_admin_url( 'update-core.php' ) ) );
}

/**
 * Handle the Admin Bar CSS
 */
function bp_core_load_admin_bar_css() {

	if ( !bp_use_nxt_admin_bar() )
		return;

	// Admin bar styles
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
		$stylesheet = BP_PLUGIN_URL . '/bp-core/css/admin-bar.dev.css';
	else
		$stylesheet = BP_PLUGIN_URL . '/bp-core/css/admin-bar.css';

	nxt_enqueue_style( 'bp-admin-bar', apply_filters( 'bp_core_admin_bar_css', $stylesheet ), array( 'admin-bar' ), '20110723' );

	if ( !is_rtl() )
		return;

	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
		$stylesheet = BP_PLUGIN_URL . '/bp-core/css/admin-bar-rtl.dev.css';
	else
		$stylesheet = BP_PLUGIN_URL . '/bp-core/css/admin-bar-rtl.css';

	nxt_enqueue_style( 'bp-admin-bar-rtl', apply_filters( 'bp_core_admin_bar_rtl_css', $stylesheet ), array( 'bp-admin-bar' ), '20110723' );
}
add_action( 'bp_init', 'bp_core_load_admin_bar_css' );

?>
