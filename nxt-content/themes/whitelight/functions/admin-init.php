<?php
/*-----------------------------------------------------------------------------------*/
/* lokThemes Framework Version & Theme Version */
/*-----------------------------------------------------------------------------------*/
function lok_version_init() {

    $lok_framework_version = '5.1.4';

    if ( get_option( 'lok_framework_version' ) != $lok_framework_version ) {
    	update_option( 'lok_framework_version', $lok_framework_version );
    }

}

add_action( 'init', 'lok_version_init', 10 );

function lok_version(){

    $theme_data = get_theme_data( get_template_directory() . '/style.css' );
    $theme_version = $theme_data['Version'];
    $lok_framework_version = get_option( 'lok_framework_version' );

	echo "\n<!-- Theme version -->\n";
    echo '<meta name="generator" content="'. esc_attr( get_option( 'lok_themename' ) ) . ' ' . $theme_version . '" />' ."\n";
    echo '<meta name="generator" content="lokFramework '. esc_attr( $lok_framework_version ) .'" />' ."\n";

}
// Add or remove Generator meta tags
if ( get_option( 'framework_lok_disable_generator' ) == 'true' ) {
	remove_action( 'nxt_head',  'nxt_generator' );
} else {
	add_action( 'nxt_head', 'lok_version', 10 );
}
/*-----------------------------------------------------------------------------------*/
/* Load the required Framework Files */
/*-----------------------------------------------------------------------------------*/

$functions_path = get_template_directory() . '/functions/';

require_once ( $functions_path . 'admin-functions.php' );				// Custom functions and plugins
require_once ( $functions_path . 'admin-setup.php' );					// Options panel variables and functions
require_once ( $functions_path . 'admin-custom.php' );					// Custom fields
require_once ( $functions_path . 'admin-interface.php' );				// Admin Interfaces (options,framework, seo)
require_once ( $functions_path . 'admin-framework-settings.php' );		// Framework Settings
require_once ( $functions_path . 'admin-seo.php' );						// Framework SEO controls
require_once ( $functions_path . 'admin-sbm.php' ); 					// Framework Sidebar Manager
require_once ( $functions_path . 'admin-medialibrary-uploader.php' ); 	// Framework Media Library Uploader Functions // 2010-11-05.
require_once ( $functions_path . 'admin-hooks.php' );					// Definition of lokHooks
if ( get_option( 'framework_lok_loknav' ) == 'true' ) {
	require_once ( $functions_path . 'admin-custom-nav.php' );			// lok Custom Navigation
}
require_once ( $functions_path . 'admin-shortcodes.php' );				// lok Shortcodes
require_once ( $functions_path . 'admin-shortcode-generator.php' ); 	// Framework Shortcode generator // 2011-01-21.
require_once ( $functions_path . 'admin-backup.php' ); 					// Theme Options Backup // 2011-08-26.
?>