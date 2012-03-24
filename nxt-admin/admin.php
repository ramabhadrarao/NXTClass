<?php
/**
 * NXTClass Administration Bootstrap
 *
 * @package NXTClass
 * @subpackage Administration
 */

/**
 * In NXTClass Administration Screens
 *
 * @since 2.3.2
 */
if ( ! defined('nxt_ADMIN') )
	define('nxt_ADMIN', TRUE);

if ( ! defined('nxt_NETWORK_ADMIN') )
	define('nxt_NETWORK_ADMIN', FALSE);

if ( ! defined('nxt_USER_ADMIN') )
	define('nxt_USER_ADMIN', FALSE);

if ( ! nxt_NETWORK_ADMIN && ! nxt_USER_ADMIN ) {
	define('nxt_BLOG_ADMIN', TRUE);
}

if ( isset($_GET['import']) && !defined('nxt_LOAD_IMPORTERS') )
	define('nxt_LOAD_IMPORTERS', true);

require_once(dirname(dirname(__FILE__)) . '/nxt-load.php');

if ( get_option('db_upgraded') ) {
	$nxt_rewrite->flush_rules();
	update_option( 'db_upgraded',  false );

	/**
	 * Runs on the next page load after successful upgrade
	 *
	 * @since 2.8
	 */
	do_action('after_db_upgrade');
} elseif ( get_option('db_version') != $nxt_db_version && empty($_POST) ) {
	if ( !is_multisite() ) {
		nxt_redirect(admin_url('upgrade.php?_nxt_http_referer=' . urlencode(stripslashes($_SERVER['REQUEST_URI']))));
		exit;
	} elseif ( apply_filters( 'do_mu_upgrade', true ) ) {
		/**
		 * On really small MU installs run the upgrader every time,
		 * else run it less often to reduce load.
		 *
		 * @since 2.8.4b
		 */
		$c = get_blog_count();
		if ( $c <= 50 || ( $c > 50 && mt_rand( 0, (int)( $c / 50 ) ) == 1 ) ) {
			require_once( ABSPATH . nxtINC . '/http.php' );
			$response = nxt_remote_get( admin_url( 'upgrade.php?step=1' ), array( 'timeout' => 120, 'httpversion' => '1.1' ) );
			do_action( 'after_mu_upgrade', $response );
			unset($response);
		}
		unset($c);
	}
}

require_once(ABSPATH . 'nxt-admin/includes/admin.php');

auth_redirect();

nocache_headers();

// Schedule trash collection
if ( !nxt_next_scheduled('nxt_scheduled_delete') && !defined('nxt_INSTALLING') )
	nxt_schedule_event(time(), 'daily', 'nxt_scheduled_delete');

set_screen_options();

$date_format = get_option('date_format');
$time_format = get_option('time_format');

nxt_reset_vars(array('profile', 'redirect', 'redirect_url', 'a', 'text', 'trackback', 'pingback'));

nxt_enqueue_script( 'common' );
nxt_enqueue_script( 'jquery-color' );

$editing = false;

if ( isset($_GET['page']) ) {
	$plugin_page = stripslashes($_GET['page']);
	$plugin_page = plugin_basename($plugin_page);
}

if ( isset( $_REQUEST['post_type'] ) && post_type_exists( $_REQUEST['post_type'] ) )
	$typenow = $_REQUEST['post_type'];
else
	$typenow = '';

if ( isset( $_REQUEST['taxonomy'] ) && taxonomy_exists( $_REQUEST['taxonomy'] ) )
	$taxnow = $_REQUEST['taxonomy'];
else
	$taxnow = '';

if ( nxt_NETWORK_ADMIN )
	require(ABSPATH . 'nxt-admin/network/menu.php');
elseif ( nxt_USER_ADMIN )
	require(ABSPATH . 'nxt-admin/user/menu.php');
else
	require(ABSPATH . 'nxt-admin/menu.php');

if ( current_user_can( 'manage_options' ) )
	@ini_set( 'memory_limit', apply_filters( 'admin_memory_limit', nxt_MAX_MEMORY_LIMIT ) );

do_action('admin_init');

if ( isset($plugin_page) ) {
	if ( !empty($typenow) )
		$the_parent = $pagenow . '?post_type=' . $typenow;
	else
		$the_parent = $pagenow;
	if ( ! $page_hook = get_plugin_page_hook($plugin_page, $the_parent) ) {
		$page_hook = get_plugin_page_hook($plugin_page, $plugin_page);
		// backwards compatibility for plugins using add_management_page
		if ( empty( $page_hook ) && 'edit.php' == $pagenow && '' != get_plugin_page_hook($plugin_page, 'tools.php') ) {
			// There could be plugin specific params on the URL, so we need the whole query string
			if ( !empty($_SERVER[ 'QUERY_STRING' ]) )
				$query_string = $_SERVER[ 'QUERY_STRING' ];
			else
				$query_string = 'page=' . $plugin_page;
			nxt_redirect( admin_url('tools.php?' . $query_string) );
			exit;
		}
	}
	unset($the_parent);
}

$hook_suffix = '';
if ( isset($page_hook) )
	$hook_suffix = $page_hook;
else if ( isset($plugin_page) )
	$hook_suffix = $plugin_page;
else if ( isset($pagenow) )
	$hook_suffix = $pagenow;

set_current_screen();

// Handle plugin admin pages.
if ( isset($plugin_page) ) {
	if ( $page_hook ) {
		do_action('load-' . $page_hook);
		if (! isset($_GET['noheader']))
			require_once(ABSPATH . 'nxt-admin/admin-header.php');

		do_action($page_hook);
	} else {
		if ( validate_file($plugin_page) )
			nxt_die(__('Invalid plugin page'));


		if ( !( file_exists(nxt_PLUGIN_DIR . "/$plugin_page") && is_file(nxt_PLUGIN_DIR . "/$plugin_page") ) && !( file_exists(nxtMU_PLUGIN_DIR . "/$plugin_page") && is_file(nxtMU_PLUGIN_DIR . "/$plugin_page") ) )
			nxt_die(sprintf(__('Cannot load %s.'), htmlentities($plugin_page)));

		do_action('load-' . $plugin_page);

		if ( !isset($_GET['noheader']))
			require_once(ABSPATH . 'nxt-admin/admin-header.php');

		if ( file_exists(nxtMU_PLUGIN_DIR . "/$plugin_page") )
			include(nxtMU_PLUGIN_DIR . "/$plugin_page");
		else
			include(nxt_PLUGIN_DIR . "/$plugin_page");
	}

	include(ABSPATH . 'nxt-admin/admin-footer.php');

	exit();
} else if (isset($_GET['import'])) {

	$importer = $_GET['import'];

	if ( ! current_user_can('import') )
		nxt_die(__('You are not allowed to import.'));

	if ( validate_file($importer) ) {
		nxt_redirect( admin_url( 'import.php?invalid=' . $importer ) );
		exit;
	}

	if ( ! isset($nxt_importers[$importer]) || ! is_callable($nxt_importers[$importer][2]) ) {
		nxt_redirect( admin_url( 'import.php?invalid=' . $importer ) );
		exit;
	}

	$parent_file = 'tools.php';
	$submenu_file = 'import.php';
	$title = __('Import');

	if (! isset($_GET['noheader']))
		require_once(ABSPATH . 'nxt-admin/admin-header.php');

	require_once(ABSPATH . 'nxt-admin/includes/upgrade.php');

	define('nxt_IMPORTING', true);

	if ( apply_filters( 'force_filtered_html_on_import', false ) )
		kses_init_filters();  // Always filter imported data with kses on multisite.

	call_user_func($nxt_importers[$importer][2]);

	include(ABSPATH . 'nxt-admin/admin-footer.php');

	// Make sure rules are flushed
	flush_rewrite_rules(false);

	exit();
} else {
	do_action("load-$pagenow");
	// Backwards compatibility with old load-page-new.php, load-page.php,
	// and load-categories.php actions.
	if ( $typenow == 'page' ) {
		if ( $pagenow == 'post-new.php' )
			do_action( 'load-page-new.php' );
		elseif ( $pagenow == 'post.php' )
			do_action( 'load-page.php' );
	}  elseif ( $pagenow == 'edit-tags.php' ) {
		if ( $taxnow == 'category' )
			do_action( 'load-categories.php' );
		elseif ( $taxnow == 'link_category' )
			do_action( 'load-edit-link-categories.php' );
	}
}

if ( !empty($_REQUEST['action']) )
	do_action('admin_action_' . $_REQUEST['action']);

?>
