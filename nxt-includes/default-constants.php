<?php
/**
 * Defines constants and global variables that can be overridden, generally in nxt-config.php.
 *
 * @package NXTClass
 */

/**
 * Defines initial NXTClass constants
 *
 * @see nxt_debug_mode()
 *
 * @since 3.0.0
 */
function nxt_initial_constants( ) {
	global $blog_id;

	// set memory limits
	if ( !defined('nxt_MEMORY_LIMIT') ) {
		if( is_multisite() ) {
			define('nxt_MEMORY_LIMIT', '64M');
		} else {
			define('nxt_MEMORY_LIMIT', '32M');
		}
	}

	if ( ! defined( 'nxt_MAX_MEMORY_LIMIT' ) ) {
		define( 'nxt_MAX_MEMORY_LIMIT', '256M' );
	}

	/**
	 * The $blog_id global, which you can change in the config allows you to create a simple
	 * multiple blog installation using just one NXTClass and changing $blog_id around.
	 *
	 * @global int $blog_id
	 * @since 2.0.0
	 */
	if ( ! isset($blog_id) )
		$blog_id = 1;

	// set memory limits.
	if ( function_exists('memory_get_usage') && ( (int) @ini_get('memory_limit') < abs(intval(nxt_MEMORY_LIMIT)) ) )
		@ini_set('memory_limit', nxt_MEMORY_LIMIT);

	if ( !defined('nxt_CONTENT_DIR') )
		define( 'nxt_CONTENT_DIR', ABSPATH . 'nxt-content' ); // no trailing slash, full paths only - nxt_CONTENT_URL is defined further down

	// Add define('nxt_DEBUG', true); to nxt-config.php to enable display of notices during development.
	if ( !defined('nxt_DEBUG') )
		define( 'nxt_DEBUG', false );

	// Add define('nxt_DEBUG_DISPLAY', null); to nxt-config.php use the globally configured setting for
	// display_errors and not force errors to be displayed. Use false to force display_errors off.
	if ( !defined('nxt_DEBUG_DISPLAY') )
		define( 'nxt_DEBUG_DISPLAY', true );

	// Add define('nxt_DEBUG_LOG', true); to enable error logging to nxt-content/debug.log.
	if ( !defined('nxt_DEBUG_LOG') )
		define('nxt_DEBUG_LOG', false);

	if ( !defined('nxt_CACHE') )
		define('nxt_CACHE', false);

	/**
	 * Private
	 */
	if ( !defined('MEDIA_TRASH') )
		define('MEDIA_TRASH', false);

	if ( !defined('SHORTINIT') )
		define('SHORTINIT', false);
}

/**
 * Defines plugin directory NXTClass constants
 *
 * Defines must-use plugin directory constants, which may be overridden in the sunrise.php drop-in
 *
 * @since 3.0.0
 */
function nxt_plugin_directory_constants( ) {
	if ( !defined('nxt_CONTENT_URL') )
		define( 'nxt_CONTENT_URL', get_option('siteurl') . '/nxt-content'); // full url - nxt_CONTENT_DIR is defined further up

	/**
	 * Allows for the plugins directory to be moved from the default location.
	 *
	 * @since 2.6.0
	 */
	if ( !defined('nxt_PLUGIN_DIR') )
		define( 'nxt_PLUGIN_DIR', nxt_CONTENT_DIR . '/plugins' ); // full path, no trailing slash

	/**
	 * Allows for the plugins directory to be moved from the default location.
	 *
	 * @since 2.6.0
	 */
	if ( !defined('nxt_PLUGIN_URL') )
		define( 'nxt_PLUGIN_URL', nxt_CONTENT_URL . '/plugins' ); // full url, no trailing slash

	/**
	 * Allows for the plugins directory to be moved from the default location.
	 *
	 * @since 2.1.0
	 * @deprecated
	 */
	if ( !defined('PLUGINDIR') )
		define( 'PLUGINDIR', 'nxt-content/plugins' ); // Relative to ABSPATH.  For back compat.

	/**
	 * Allows for the mu-plugins directory to be moved from the default location.
	 *
	 * @since 2.8.0
	 */
	if ( !defined('nxtMU_PLUGIN_DIR') )
		define( 'nxtMU_PLUGIN_DIR', nxt_CONTENT_DIR . '/mu-plugins' ); // full path, no trailing slash

	/**
	 * Allows for the mu-plugins directory to be moved from the default location.
	 *
	 * @since 2.8.0
	 */
	if ( !defined('nxtMU_PLUGIN_URL') )
		define( 'nxtMU_PLUGIN_URL', nxt_CONTENT_URL . '/mu-plugins' ); // full url, no trailing slash

	/**
	 * Allows for the mu-plugins directory to be moved from the default location.
	 *
	 * @since 2.8.0
	 * @deprecated
	 */
	if ( !defined( 'MUPLUGINDIR' ) )
		define( 'MUPLUGINDIR', 'nxt-content/mu-plugins' ); // Relative to ABSPATH.  For back compat.
}

/**
 * Defines cookie related NXTClass constants
 *
 * Defines constants after multisite is loaded. Cookie-related constants may be overridden in ms_network_cookies().
 * @since 3.0.0
 */
function nxt_cookie_constants( ) {
	global $nxt_default_secret_key;

	/**
	 * Used to guarantee unique hash cookies
	 * @since 1.5
	 */
	if ( !defined( 'COOKIEHASH' ) ) {
		$siteurl = get_site_option( 'siteurl' );
		if ( $siteurl )
			define( 'COOKIEHASH', md5( $siteurl ) );
		else
			define( 'COOKIEHASH', '' );
	}

	/**
	 * Should be exactly the same as the default value of SECRET_KEY in nxt-config-sample.php
	 * @since 2.5.0
	 */
	$nxt_default_secret_key = 'put your unique phrase here';

	/**
	 * @since 2.0.0
	 */
	if ( !defined('USER_COOKIE') )
		define('USER_COOKIE', 'nxtclassuser_' . COOKIEHASH);

	/**
	 * @since 2.0.0
	 */
	if ( !defined('PASS_COOKIE') )
		define('PASS_COOKIE', 'nxtclasspass_' . COOKIEHASH);

	/**
	 * @since 2.5.0
	 */
	if ( !defined('AUTH_COOKIE') )
		define('AUTH_COOKIE', 'nxtclass_' . COOKIEHASH);

	/**
	 * @since 2.6.0
	 */
	if ( !defined('SECURE_AUTH_COOKIE') )
		define('SECURE_AUTH_COOKIE', 'nxtclass_sec_' . COOKIEHASH);

	/**
	 * @since 2.6.0
	 */
	if ( !defined('LOGGED_IN_COOKIE') )
		define('LOGGED_IN_COOKIE', 'nxtclass_logged_in_' . COOKIEHASH);

	/**
	 * @since 2.3.0
	 */
	if ( !defined('TEST_COOKIE') )
		define('TEST_COOKIE', 'nxtclass_test_cookie');

	/**
	 * @since 1.2.0
	 */
	if ( !defined('COOKIEPATH') )
		define('COOKIEPATH', preg_replace('|https?://[^/]+|i', '', get_option('home') . '/' ) );

	/**
	 * @since 1.5.0
	 */
	if ( !defined('SITECOOKIEPATH') )
		define('SITECOOKIEPATH', preg_replace('|https?://[^/]+|i', '', get_option('siteurl') . '/' ) );

	/**
	 * @since 2.6.0
	 */
	if ( !defined('ADMIN_COOKIE_PATH') )
		define( 'ADMIN_COOKIE_PATH', SITECOOKIEPATH . 'nxt-admin' );

	/**
	 * @since 2.6.0
	 */
	if ( !defined('PLUGINS_COOKIE_PATH') )
		define( 'PLUGINS_COOKIE_PATH', preg_replace('|https?://[^/]+|i', '', nxt_PLUGIN_URL)  );

	/**
	 * @since 2.0.0
	 */
	if ( !defined('COOKIE_DOMAIN') )
		define('COOKIE_DOMAIN', false);
}

/**
 * Defines cookie related NXTClass constants
 *
 * @since 3.0.0
 */
function nxt_ssl_constants( ) {
	/**
	 * @since 2.6.0
	 */
	if ( !defined('FORCE_SSL_ADMIN') )
		define('FORCE_SSL_ADMIN', false);
	force_ssl_admin(FORCE_SSL_ADMIN);

	/**
	 * @since 2.6.0
	 */
	if ( !defined('FORCE_SSL_LOGIN') )
		define('FORCE_SSL_LOGIN', false);
	force_ssl_login(FORCE_SSL_LOGIN);
}

/**
 * Defines functionality related NXTClass constants
 *
 * @since 3.0.0
 */
function nxt_functionality_constants( ) {
	/**
	 * @since 2.5.0
	 */
	if ( !defined( 'AUTOSAVE_INTERVAL' ) )
		define( 'AUTOSAVE_INTERVAL', 60 );

	/**
	 * @since 2.9.0
	 */
	if ( !defined( 'EMPTY_TRASH_DAYS' ) )
		define( 'EMPTY_TRASH_DAYS', 30 );

	if ( !defined('nxt_POST_REVISIONS') )
		define('nxt_POST_REVISIONS', true);

	/**
	 * @since 3.3.0
	 */
	if ( !defined( 'nxt_CRON_LOCK_TIMEOUT' ) )
		define('nxt_CRON_LOCK_TIMEOUT', 60);  // In seconds
}

/**
 * Defines templating related NXTClass constants
 *
 * @since 3.0.0
 */
function nxt_templating_constants( ) {
	/**
	 * Filesystem path to the current active template directory
	 * @since 1.5.0
	 */
	define('TEMPLATEPATH', get_template_directory());

	/**
	 * Filesystem path to the current active template stylesheet directory
	 * @since 2.1.0
	 */
	define('STYLESHEETPATH', get_stylesheet_directory());

	/**
	 * Slug of the default theme for this install.
	 * Used as the default theme when installing new sites.
	 * Will be used as the fallback if the current theme doesn't exist.
	 * @since 3.0.0
	 */
	if ( !defined('nxt_DEFAULT_THEME') )
		define( 'nxt_DEFAULT_THEME', 'twentyeleven' );

}

?>
