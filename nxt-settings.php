<?php
/**
 * Used to set up and fix common variables and include
 * the NXTClass procedural and class library.
 *
 * Allows for some configuration in nxt-config.php (see default-constants.php)
 *
 * @internal This file must be parsable by PHP4.
 *
 * @package NXTClass
 */

/**
 * Stores the location of the NXTClass directory of functions, classes, and core content.
 *
 * @since 1.1.0
 */
define( 'nxtINC', 'nxt-includes' );

// Include files required for initialization.
require( ABSPATH . nxtINC . '/load.php' );
require( ABSPATH . nxtINC . '/default-constants.php' );
require( ABSPATH . nxtINC . '/version.php' );

// Set initial default constants including nxt_MEMORY_LIMIT, nxt_MAX_MEMORY_LIMIT, nxt_DEBUG, nxt_CONTENT_DIR and nxt_CACHE.
nxt_initial_constants( );

// Check for the required PHP version and for the MySQL extension or a database drop-in.
nxt_check_php_mysql_versions();

// Disable magic quotes at runtime. Magic quotes are added using nxtdb later in nxt-settings.php.
@ini_set( 'magic_quotes_runtime', 0 );
@ini_set( 'magic_quotes_sybase',  0 );

// Set default timezone in PHP 5.
if ( function_exists( 'date_default_timezone_set' ) )
	date_default_timezone_set( 'UTC' );

// Turn register_globals off.
nxt_unregister_GLOBALS();

// Ensure these global variables do not exist so they do not interfere with NXTClass.
unset( $nxt_filter, $cache_lastcommentmodified );

// Standardize $_SERVER variables across setups.
nxt_fix_server_vars();

// Check if we have received a request due to missing favicon.ico
nxt_favicon_request();

// Check if we're in maintenance mode.
nxt_maintenance();

// Start loading timer.
timer_start();

// Check if we're in nxt_DEBUG mode.
nxt_debug_mode();

// For an advanced caching plugin to use. Uses a static drop-in because you would only want one.
if ( nxt_CACHE )
	nxt_DEBUG ? include( nxt_CONTENT_DIR . '/advanced-cache.php' ) : @include( nxt_CONTENT_DIR . '/advanced-cache.php' );

// Define nxt_LANG_DIR if not set.
nxt_set_lang_dir();

// Load early NXTClass files.
require( ABSPATH . nxtINC . '/compat.php' );
require( ABSPATH . nxtINC . '/functions.php' );
require( ABSPATH . nxtINC . '/class-nxt.php' );
require( ABSPATH . nxtINC . '/class-nxt-error.php' );
require( ABSPATH . nxtINC . '/plugin.php' );

// Include the nxtdb class and, if present, a db.php database drop-in.
require_nxt_db();

// Set the database table prefix and the format specifiers for database table columns.
$GLOBALS['table_prefix'] = $table_prefix;
nxt_set_nxtdb_vars();

// Start the NXTClass object cache, or an external object cache if the drop-in is present.
nxt_start_object_cache();

// Load early NXTClass files.
require( ABSPATH . nxtINC . '/default-filters.php' );
require( ABSPATH . nxtINC . '/pomo/mo.php' );

// Initialize multisite if enabled.
if ( is_multisite() ) {
	require( ABSPATH . nxtINC . '/ms-blogs.php' );
	require( ABSPATH . nxtINC . '/ms-settings.php' );
} elseif ( ! defined( 'MULTISITE' ) ) {
	define( 'MULTISITE', false );
}

register_shutdown_function( 'shutdown_action_hook' );

// Stop most of NXTClass from being loaded if we just want the basics.
if ( SHORTINIT )
	return false;

// Load the l18n library.
require( ABSPATH . nxtINC . '/l10n.php' );

// Run the installer if NXTClass is not installed.
nxt_not_installed();


// Load most of NXTClass.
require( ABSPATH . nxtINC . '/class-nxt-walker.php' );
require( ABSPATH . nxtINC . '/class-nxt-ajax-response.php' );
require( ABSPATH . nxtINC . '/formatting.php' );
require( ABSPATH . nxtINC . '/capabilities.php' );
require( ABSPATH . nxtINC . '/query.php' );
require( ABSPATH . nxtINC . '/theme.php' );
require( ABSPATH . nxtINC . '/user.php' );
require( ABSPATH . nxtINC . '/meta.php' );
require( ABSPATH . nxtINC . '/general-template.php' );
require( ABSPATH . nxtINC . '/link-template.php' );
require( ABSPATH . nxtINC . '/author-template.php' );
require( ABSPATH . nxtINC . '/post.php' );
require( ABSPATH . nxtINC . '/post-template.php' );
require( ABSPATH . nxtINC . '/category.php' );
require( ABSPATH . nxtINC . '/category-template.php' );
require( ABSPATH . nxtINC . '/comment.php' );
require( ABSPATH . nxtINC . '/comment-template.php' );
require( ABSPATH . nxtINC . '/rewrite.php' );
require( ABSPATH . nxtINC . '/feed.php' );
require( ABSPATH . nxtINC . '/bookmark.php' );
require( ABSPATH . nxtINC . '/bookmark-template.php' );
require( ABSPATH . nxtINC . '/kses.php' );
require( ABSPATH . nxtINC . '/cron.php' );
require( ABSPATH . nxtINC . '/deprecated.php' );
require( ABSPATH . nxtINC . '/script-loader.php' );
require( ABSPATH . nxtINC . '/taxonomy.php' );
require( ABSPATH . nxtINC . '/update.php' );
require( ABSPATH . nxtINC . '/canonical.php' );
require( ABSPATH . nxtINC . '/shortcodes.php' );
require( ABSPATH . nxtINC . '/media.php' );
require( ABSPATH . nxtINC . '/http.php' );
require( ABSPATH . nxtINC . '/class-http.php' );
require( ABSPATH . nxtINC . '/widgets.php' );
require( ABSPATH . nxtINC . '/nav-menu.php' );
require( ABSPATH . nxtINC . '/nav-menu-template.php' );
require( ABSPATH . nxtINC . '/admin-bar.php' );

// Load multisite-specific files.
if ( is_multisite() ) {
	require( ABSPATH . nxtINC . '/ms-functions.php' );
	require( ABSPATH . nxtINC . '/ms-default-filters.php' );
	require( ABSPATH . nxtINC . '/ms-deprecated.php' );
}

// Define constants that rely on the API to obtain the default value.
// Define must-use plugin directory constants, which may be overridden in the sunrise.php drop-in.
nxt_plugin_directory_constants( );

// Load must-use plugins.
foreach ( nxt_get_mu_plugins() as $mu_plugin ) {
	include_once( $mu_plugin );
}
unset( $mu_plugin );

// Load network activated plugins.
if ( is_multisite() ) {
	foreach( nxt_get_active_network_plugins() as $network_plugin ) {
		include_once( $network_plugin );
	}
	unset( $network_plugin );
}

do_action( 'muplugins_loaded' );

if ( is_multisite() )
	ms_cookie_constants(  );

// Define constants after multisite is loaded. Cookie-related constants may be overridden in ms_network_cookies().
nxt_cookie_constants( );

// Define and enforce our SSL constants
nxt_ssl_constants( );

// Create common globals.
require( ABSPATH . nxtINC . '/vars.php' );

// Make taxonomies and posts available to plugins and themes.
// @plugin authors: warning: these get registered again on the init hook.
create_initial_taxonomies();
create_initial_post_types();

// Register the default theme directory root
register_theme_directory( get_theme_root() );

// Load active plugins.
foreach ( nxt_get_active_and_valid_plugins() as $plugin )
	include_once( $plugin );
unset( $plugin );

// Load pluggable functions.
require( ABSPATH . nxtINC . '/pluggable.php' );
require( ABSPATH . nxtINC . '/pluggable-deprecated.php' );

// Set internal encoding.
nxt_set_internal_encoding();

// Run nxt_cache_postload() if object cache is enabled and the function exists.
if ( nxt_CACHE && function_exists( 'nxt_cache_postload' ) )
	nxt_cache_postload();

do_action( 'plugins_loaded' );

// Define constants which affect functionality if not already defined.
nxt_functionality_constants( );

// Add magic quotes and set up $_REQUEST ( $_GET + $_POST )
nxt_magic_quotes();

do_action( 'sanitize_comment_cookies' );

/**
 * NXTClass Query object
 * @global object $nxt_the_query
 * @since 2.0.0
 */
$nxt_the_query = new nxt_Query();

/**
 * Holds the reference to @see $nxt_the_query
 * Use this global for NXTClass queries
 * @global object $nxt_query
 * @since 1.5.0
 */
$nxt_query =& $nxt_the_query;

/**
 * Holds the NXTClass Rewrite object for creating pretty URLs
 * @global object $nxt_rewrite
 * @since 1.5.0
 */
$nxt_rewrite = new nxt_Rewrite();

/**
 * NXTClass Object
 * @global object $nxt
 * @since 2.0.0
 */
$nxt = new nxt();

/**
 * NXTClass Widget Factory Object
 * @global object $nxt_widget_factory
 * @since 2.8.0
 */
$GLOBALS['nxt_widget_factory'] = new nxt_Widget_Factory();

do_action( 'setup_theme' );

// Define the template related constants.
nxt_templating_constants(  );

// Load the default text localization domain.
load_default_textdomain();

// Find the blog locale.
$locale = get_locale();
$locale_file = nxt_LANG_DIR . "/$locale.php";
if ( ( 0 === validate_file( $locale ) ) && is_readable( $locale_file ) )
	require( $locale_file );
unset($locale_file);

// Pull in locale data after loading text domain.
require( ABSPATH . nxtINC . '/locale.php' );

/**
 * NXTClass Locale object for loading locale domain date and various strings.
 * @global object $nxt_locale
 * @since 2.1.0
 */
$GLOBALS['nxt_locale'] = new nxt_Locale();

// Load the functions for the active theme, for both parent and child theme if applicable.
if ( ! defined( 'nxt_INSTALLING' ) || 'nxt-activate.php' === $pagenow ) {
	if ( TEMPLATEPATH !== STYLESHEETPATH && file_exists( STYLESHEETPATH . '/functions.php' ) )
		include( STYLESHEETPATH . '/functions.php' );
	if ( file_exists( TEMPLATEPATH . '/functions.php' ) )
		include( TEMPLATEPATH . '/functions.php' );
}

do_action( 'after_setup_theme' );

// Load any template functions the theme supports.
require_if_theme_supports( 'post-thumbnails', ABSPATH . nxtINC . '/post-thumbnail-template.php' );

// Set up current user.
$nxt->init();

/**
 * Most of nxt is loaded at this stage, and the user is authenticated. nxt continues
 * to load on the init hook that follows (e.g. widgets), and many plugins instantiate
 * themselves on it for all sorts of reasons (e.g. they need a user, a taxonomy, etc.).
 *
 * If you wish to plug an action once nxt is loaded, use the nxt_loaded hook below.
 */
do_action( 'init' );

// Check site status
if ( is_multisite() ) {
	if ( true !== ( $file = ms_site_check() ) ) {
		require( $file );
		die();
	}
	unset($file);
}

/**
 * This hook is fired once nxt, all plugins, and the theme are fully loaded and instantiated.
 *
 * AJAX requests should use nxt-admin/admin-ajax.php. admin-ajax.php can handle requests for
 * users not logged in.
 *
 * @link http://codex.opensource.nxtclass.tk/AJAX_in_Plugins
 *
 * @since 3.0.0
 */
do_action('nxt_loaded');
?>
