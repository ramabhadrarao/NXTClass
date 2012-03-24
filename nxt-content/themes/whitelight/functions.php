<?php

/*-----------------------------------------------------------------------------------*/
/* Start lokThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to lokFramework and theme specific functions
$functions_path = get_template_directory() . '/functions/';
$includes_path = get_template_directory() . '/includes/';

// Define the theme-specific key to be sent to PressTrends.
define( 'lok_PRESSTRENDS_THEMEKEY', 'rnxr6w508pu2gkfm21fltpa1r4l53vpm0' );

// lokFramework
require_once ($functions_path . 'admin-init.php' );			// Framework Init

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 			// Options panel settings and custom settings
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks
				'includes/theme-comments.php', 			// Custom comments/pingback loop
				'includes/theme-js.php', 				// Load JavaScript via nxt_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php',			// Theme widgets
				'includes/theme-install.php',			// Theme Installation
				'includes/theme-lokcommerce.php'		// lokCommerce overrides
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'lok_includes', $includes );
				
foreach ( $includes as $i ) {
	locate_template( $i, true );
}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/


/**
 * Display the Login/Logout link.
 */ 
add_filter('nxt_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
        ob_start();
        nxt_loginout('index.php');
        $loginoutlink = ob_get_contents();
        ob_end_clean();
        $items .= '<li>'. $loginoutlink .'</li>';
    return $items;
	}
/**
 * Display the Registration or Admin link.
 */
add_filter('nxt_nav_menu_items', 'add_register_link', 10, 2);
	function add_register_link($items, $args) {
        ob_start();
        nxt_register('');
        $registerlink = ob_get_contents();
        ob_end_clean();
        $items .= '<li>'. $registerlink .'</li>';
    return $items;
	}

/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>