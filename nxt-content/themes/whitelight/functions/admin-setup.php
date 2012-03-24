<?php

/*-------------------------------------------------------------------------------------

TABLE OF CONTENTS

- Redirect to "Theme Options" screen (hooked onto lok_theme_activate at 10).
- Flush rewrite rules to refresh permalinks for custom post types, etc.
- Show Options Panel after activate
- Admin Backend
	- Setup Custom Navigation
- Output HEAD - lokthemes_nxt_head()
	- Output alternative stylesheet
	- Output custom favicon
	- Load textdomains
	- Output CSS from standarized styling options
	- Output shortcodes stylesheet
	- Output custom.css
- Post Images from WP2.9+ integration
- Enqueue comment reply script

-------------------------------------------------------------------------------------*/

define( 'THEME_FRAMEWORK', 'lokthemes' );

/*-----------------------------------------------------------------------------------*/
/* Redirect to "Theme Options" screen (hooked onto lok_theme_activate at 10). */
/*-----------------------------------------------------------------------------------*/
add_action( 'lok_theme_activate', 'lok_themeoptions_redirect', 10 );

function lok_themeoptions_redirect () {
	// Do redirect
	header( 'Location: ' . admin_url() . 'admin.php?page=lokthemes' );
} // End lok_themeoptions_redirect()

/*-----------------------------------------------------------------------------------*/
/* Flush rewrite rules to refresh permalinks for custom post types, etc. */
/*-----------------------------------------------------------------------------------*/

function lok_flush_rewriterules () {
	flush_rewrite_rules();
} // End lok_flush_rewriterules()

/*-----------------------------------------------------------------------------------*/
/* Add default options and show Options Panel after activate  */
/*-----------------------------------------------------------------------------------*/
global $pagenow;

if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	// Call action that sets.
	add_action( 'admin_head','lok_option_setup' );
	
	// Flush rewrite rules.
	add_action( 'admin_head', 'lok_flush_rewriterules', 9 );
	
	// Custom action for theme-setup (redirect is at priority 10).
	do_action( 'lok_theme_activate' );
}


if ( ! function_exists( 'lok_option_setup' ) ) {
	function lok_option_setup(){

		//Update EMPTY options
		$lok_array = array();
		add_option( 'lok_options', $lok_array );

		$template = get_option( 'lok_template' );
		$saved_options = get_option( 'lok_options' );

		foreach ( (array) $template as $option ) {
			if ($option['type'] != 'heading'){
				$id = $option['id'];
				$std = isset( $option['std'] ) ? $option['std'] : NULL;
				$db_option = get_option($id);
				if (empty($db_option)){
					if (is_array($option['type'])) {
						foreach ($option['type'] as $child){
							$c_id = $child['id'];
							$c_std = $child['std'];
							$db_option = get_option($c_id);
							if (!empty($db_option)){
								update_option($c_id,$db_option);
								$lok_array[$id] = $db_option;
							} else {
								$lok_array[$c_id] = $c_std;
							}
						}
					} else {
						update_option($id,$std);
						$lok_array[$id] = $std;
					}
				} else { //So just store the old values over again.
					$lok_array[$id] = $db_option;
				}
			}
		}
		
		// Allow child themes/plugins to filter here.
		$lok_array = apply_filters( 'lok_options_array', $lok_array );
		
		update_option( 'lok_options', $lok_array );
	}
}

/*-----------------------------------------------------------------------------------*/
/* Admin Backend */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'lokthemes_admin_head' ) ) {
	function lokthemes_admin_head() {
	    //Setup Custom Navigation Menu
		if ( function_exists( 'lok_custom_navigation_setup' ) ) {
			lok_custom_navigation_setup();
		}
	}
}
add_action( 'admin_head', 'lokthemes_admin_head', 10 );


/*-----------------------------------------------------------------------------------*/
/* Output HEAD - lokthemes_nxt_head */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'lokthemes_nxt_head' ) ) {
	function lokthemes_nxt_head() {

		do_action( 'lokthemes_nxt_head_before' );

		// Output alternative stylesheet
		if ( function_exists( 'lok_output_alt_stylesheet' ) )
			lok_output_alt_stylesheet();

		// Output custom favicon
		if ( function_exists( 'lok_output_custom_favicon' ) )
			lok_output_custom_favicon();

		// Output CSS from standarized styling options
		if ( function_exists( 'lok_head_css' ) )
			lok_head_css();

		// Output shortcodes stylesheet
		if ( function_exists( 'lok_shortcode_stylesheet' ) )
			lok_shortcode_stylesheet();

		// Output custom.css
		if ( function_exists( 'lok_output_custom_css' ) )
			lok_output_custom_css();
			
		do_action( 'lokthemes_nxt_head_after' );
	} // End lokthemes_nxt_head()
}
add_action( 'nxt_head', 'lokthemes_nxt_head', 10 );

/*-----------------------------------------------------------------------------------*/
/* Output alternative stylesheet - lok_output_alt_stylesheet */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'lok_output_alt_stylesheet' ) ) {
	function lok_output_alt_stylesheet() {

		$style = '';

		if ( isset( $_REQUEST['style'] ) ) {
			// Sanitize requested value.
			$requested_style = strtolower( strip_tags( trim( $_REQUEST['style'] ) ) );
			$style = $requested_style;
		}

		echo "\n" . "<!-- Alt Stylesheet -->\n";
		if ($style != '') {
			echo '<link href="'. get_template_directory_uri() . '/styles/'. $style . '.css" rel="stylesheet" type="text/css" />' . "\n";
		} else {
			$style = get_option( 'lok_alt_stylesheet' );
			if( $style != '' ) {
				// Sanitize value.
				$style = strtolower( strip_tags( trim( $style ) ) );
				echo '<link href="'. get_template_directory_uri() . '/styles/'. $style .'" rel="stylesheet" type="text/css" />' . "\n";
			} else {
				echo '<link href="'. get_template_directory_uri() . '/styles/default.css" rel="stylesheet" type="text/css" />' . "\n";
			}
		}

	} // End lok_output_alt_stylesheet()
}

/*-----------------------------------------------------------------------------------*/
/* Output favicon link - lok_custom_favicon() */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'lok_output_custom_favicon' ) ) {
	function lok_output_custom_favicon() {
		// Favicon
		$favicon = '';
		$favicon = get_option( 'lok_custom_favicon' );
		
		// Allow child themes/plugins to filter here.
		$favicon = apply_filters( 'lok_custom_favicon', $favicon );
		if( $favicon != '' ) {
			echo "\n" . "<!-- Custom Favicon -->\n";
	        echo '<link rel="shortcut icon" href="' .  esc_url( $favicon )  . '"/>' . "\n";
	    }
	} // End lok_output_custom_favicon()
}

/*-----------------------------------------------------------------------------------*/
/* Load textdomain - lok_load_textdomain() */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'lok_load_textdomain' ) ) {
	function lok_load_textdomain() {

		load_theme_textdomain( 'lokthemes' );
		load_theme_textdomain( 'lokthemes', get_template_directory() . '/lang' );
		if ( function_exists( 'load_child_theme_textdomain' ) )
			load_child_theme_textdomain( 'lokthemes' );

	}
}

add_action( 'init', 'lok_load_textdomain', 10 );

/*-----------------------------------------------------------------------------------*/
/* Output CSS from standarized options */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'lok_head_css' ) ) {
	function lok_head_css() {

		$output = '';
		$text_title = get_option( 'lok_texttitle' );
		$tagline = get_option( 'lok_tagline' );
	    $custom_css = get_option( 'lok_custom_css' );

		$template = get_option( 'lok_template' );
		if (is_array($template)) {
			foreach($template as $option){
				if(isset($option['id'])){
					if($option['id'] == 'lok_texttitle') {
						// Add CSS to output
						if ( $text_title == 'true' ) {
							$output .= '#logo img { display:none; } .site-title { display:block!important; }' . "\n";
							if ( $tagline == "false" )
								$output .= '.site-description { display:none!important; }' . "\n";
							else
								$output .= '.site-description { display:block!important; }' . "\n";
						}
					}
				}
			}
		}

		if ( $custom_css != '' ) {
			$output .= $custom_css . "\n";
		}

		// Output styles
		if ( $output != '' ) {
			$output = strip_tags($output);
			echo "<!-- Options Panel Custom CSS -->\n";
			$output = "<style type=\"text/css\">\n" . $output . "</style>\n\n";
			echo stripslashes( $output );
		}

	} // End lok_head_css()
}



/*-----------------------------------------------------------------------------------*/
/* Output custom.css - lok_custom_css() */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'lok_output_custom_css' ) ) {
	function lok_output_custom_css() {

		$theme_dir = get_template_directory_uri();
		
		if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/custom.css' ) ) {
			$theme_dir = get_stylesheet_directory_uri();
		}
		// Custom.css insert
		echo "\n" . "<!-- Custom Stylesheet -->\n";
		echo '<link href="'. $theme_dir . '/custom.css" rel="stylesheet" type="text/css" />' . "\n";

	} // End lok_output_custom_css()
}

/*-----------------------------------------------------------------------------------*/
/* Post Images from WP2.9+ integration /*
/*-----------------------------------------------------------------------------------*/
if( function_exists( 'add_theme_support' ) ) {
	if( get_option( 'lok_post_image_support' ) == 'true' ) {
		add_theme_support( 'post-thumbnails' );
		// set height, width and crop if dynamic resize functionality isn't enabled
		if ( get_option( 'lok_pis_resize' ) != 'true' ) {
			$thumb_width = get_option( 'lok_thumb_w' );
			$thumb_height = get_option( 'lok_thumb_h' );
			$single_width = get_option( 'lok_single_w' );
			$single_height = get_option( 'lok_single_h' );
			$hard_crop = get_option( 'lok_pis_hard_crop' );
			if($hard_crop == 'true') { $hard_crop = true; } else { $hard_crop = false; }
			set_post_thumbnail_size( $thumb_width, $thumb_height, $hard_crop ); // Normal post thumbnails
			add_image_size( 'single-post-thumbnail', $single_width, $single_height, $hard_crop );
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Enqueue comment reply script */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'lok_comment_reply' ) ) {
	function lok_comment_reply() {
		if ( is_singular() ) nxt_enqueue_script( 'comment-reply' );
	} // End lok_comment_reply()
}
add_action( 'get_header', 'lok_comment_reply', 10 );
?>