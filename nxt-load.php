<?php
/**
 * Bootstrap file for setting the ABSPATH constant
 * and loading the nxt-config.php file. The nxt-config.php
 * file will then load the nxt-settings.php file, which
 * will then set up the NXTClass environment.
 *
 * If the nxt-config.php file is not found then an error
 * will be displayed asking the visitor to set up the
 * nxt-config.php file.
 *
 * Will also search for nxt-config.php in NXTClass' parent
 * directory to allow the NXTClass directory to remain
 * untouched.
 *
 * @internal This file must be parsable by PHP4.
 *
 * @package NXTClass
 */

/** Define ABSPATH as this files directory */
define( 'ABSPATH', dirname(__FILE__) . '/' );

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );

if ( file_exists( ABSPATH . 'nxt-config.php') ) {

	/** The config file resides in ABSPATH */
	require_once( ABSPATH . 'nxt-config.php' );

} elseif ( file_exists( dirname(ABSPATH) . '/nxt-config.php' ) && ! file_exists( dirname(ABSPATH) . '/nxt-settings.php' ) ) {

	/** The config file resides one level above ABSPATH but is not part of another install*/
	require_once( dirname(ABSPATH) . '/nxt-config.php' );

} else {

	// A config file doesn't exist

	// Set a path for the link to the installer
	if ( strpos($_SERVER['PHP_SELF'], 'nxt-admin') !== false )
		$path = '';
	else
		$path = 'nxt-admin/';

	require_once( ABSPATH . '/nxt-includes/load.php' );
	require_once( ABSPATH . '/nxt-includes/version.php' );
	define( 'nxt_CONTENT_DIR', ABSPATH . 'nxt-content' );
	nxt_check_php_mysql_versions();

	// Die with an error message
	require_once( ABSPATH . '/nxt-includes/class-nxt-error.php' );
	require_once( ABSPATH . '/nxt-includes/functions.php' );
	require_once( ABSPATH . '/nxt-includes/plugin.php' );
	$text_direction = /*nxt_I18N_TEXT_DIRECTION*/'ltr'/*/nxt_I18N_TEXT_DIRECTION*/;
	nxt_die(sprintf(/*nxt_I18N_NO_CONFIG*/"<p>There doesn't seem to be a <code>nxt-config.php</code> file. I need this before we can get started.</p> <p>Need more help? <a href='http://codex.opensource.nxtclass.tk/Editing_nxt-config.php'>We got it</a>.</p> <p>You can create a <code>nxt-config.php</code> file through a web interface, but this doesn't work for all server setups. The safest way is to manually create the file.</p><p><a href='%ssetup-config.php' class='button'>Create a Configuration File</a></p>"/*/nxt_I18N_NO_CONFIG*/, $path), /*nxt_I18N_ERROR_TITLE*/'NXTClass &rsaquo; Error'/*/nxt_I18N_ERROR_TITLE*/, array('text_direction' => $text_direction));

}

?>