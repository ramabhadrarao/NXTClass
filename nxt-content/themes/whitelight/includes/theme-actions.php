<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Theme Setup
- Load layout.css in the <head>
- Load responsive <meta> tags in the <head>
- Add Google Maps to HEAD
- Add custom styling to HEAD
- Add custom typograhpy to HEAD
- Add layout to body_class output
- lok_feedburner_link
- Load responsive IE scripts

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Theme Setup */
/*-----------------------------------------------------------------------------------*/
/**
 * Theme Setup
 *
 * This is the general theme setup, where we add_theme_support(), create global variables
 * and setup default generic filters and actions to be used across our theme.
 *
 * @package lokFramework
 * @subpackage Logic
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */

if ( ! isset( $content_width ) ) $content_width = 640;

/**
 * Sets up theme defaults and registers support for various NXTClass features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support for post thumbnails.
 *
 * To override lokthemes_setup() in a child theme, add your own lokthemes_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for automatic feed links.
 * @uses add_editor_style() To style the visual editor.
 */

add_action( 'after_setup_theme', 'lokthemes_setup' );

if ( ! function_exists( 'lokthemes_setup' ) ) {
	function lokthemes_setup () {

		// This theme styles the visual editor with editor-style.css to match the theme style.
		if ( locate_template( 'editor-style.css' ) != '' ) { add_editor_style(); }

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		if ( is_child_theme() ) {
			$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );

			define( 'CHILD_THEME_URL', $theme_data['URI'] );
			define( 'CHILD_THEME_NAME', $theme_data['Name'] );
		}

	}
}

/**
 * Set the default Google Fonts used in theme.
 *
 * Used to set the default Google Fonts used in the theme, when Custom Typography is disabled.
 */

global $default_google_fonts;
$default_google_fonts = array( 'Signika' );

// add the function to the init hook
add_action( 'init', 'lok_add_googlefonts', 20 );
 
// add a font to the $google_fonts variable
if ( ! function_exists( 'lok_add_googlefonts' ) ) {
	function lok_add_googlefonts () {
	    global $google_fonts;
	    $google_fonts[] = array( 'name' => 'Signika', 'variant' => ':300,400,600');
	}
}

/*-----------------------------------------------------------------------------------*/
/* Load layout.css in the <head> */
/*-----------------------------------------------------------------------------------*/

if ( ! is_admin() ) { add_action( 'get_header', 'lok_load_frontend_css', 10 ); }

if ( ! function_exists( 'lok_load_frontend_css' ) ) {
	function lok_load_frontend_css () {
		nxt_register_style( 'lok-layout', get_template_directory_uri() . '/css/layout.css' );
		
		nxt_enqueue_style( 'lok-layout' );
	} // End lok_load_frontend_css()
}

/*-----------------------------------------------------------------------------------*/
/* Load responsive <meta> tags in the <head> */
/*-----------------------------------------------------------------------------------*/

add_action( 'nxt_head', 'lok_load_responsive_meta_tags', 10 );

if ( ! function_exists( 'lok_load_responsive_meta_tags' ) ) {
	function lok_load_responsive_meta_tags () {
		$html = '';
		
		$html .= "\n" . '<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->' . "\n";
		$html .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />' . "\n";
		/* Remove this if not responsive design */
		$html .= '<!--  Mobile vienxtort scale | Disable user zooming as the layout is optimised -->' . "\n";
		$html .= '<meta content="initial-scale=1.0" name="vienxtort"/>' . "\n" . "\n";
		
		echo $html;
	} // End lok_load_responsive_meta_tags()
}

/*-----------------------------------------------------------------------------------*/
/* Add Google Maps to HEAD */
/*-----------------------------------------------------------------------------------*/

add_action( 'lok_head', 'lok_google_maps', 10 ); // Add custom styling to HEAD

if ( ! function_exists( 'lok_google_maps' ) ) {
	
	function lok_google_maps() {
		if ( is_page_template( 'template-contact.php' ) ) { ?>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<?php 
		}
	}
	
}

/*-----------------------------------------------------------------------------------*/
/* Add Custom Styling to HEAD */
/*-----------------------------------------------------------------------------------*/

add_action( 'lok_head', 'lok_custom_styling', 10 ); // Add custom styling to HEAD

if ( ! function_exists( 'lok_custom_styling' ) ) {
	function lok_custom_styling() {
	
		$output = '';
		// Get options
		$settings = array(
						'body_color' => '', 
						'body_img' => '', 
						'body_repeat' => '', 
						'body_pos' => '',
						'header_color' => '', 
						'header_img' => '', 
						'header_repeat' => '', 
						'header_pos' => '',
						'slider_color' => '', 
						'slider_img' => '', 
						'slider_repeat' => '', 
						'slider_pos' => '',
						'intro_color' => '', 
						'intro_img' => '', 
						'intro_repeat' => '', 
						'intro_pos' => '', 
						'link_color' => '', 
						'link_hover_color' => '', 
						'button_color' => '',
						'navhover_color' => ''
						);
		$settings = lok_get_dynamic_values( $settings );
		
			
		// Add CSS to output
		if ( $settings['body_color'] != '' ) {
			$output .= '#content { background: ' . $settings['body_color'] . ' !important; }' . "\n";
		}
			
		if ( $settings['body_img'] != '' ) {
			$output .= '#content { background-image: url( ' . $settings['body_img'] . ' ) !important; }' . "\n";
		}

		if ( ( $settings['body_img'] != '' ) && ( $settings['body_repeat'] != '' ) && ( $settings['body_pos'] != '' ) ) {
			$output .= '#content { background-repeat: ' . $settings['body_repeat'] . ' !important; }' . "\n";
		}
		
		if ( ( $settings['body_img'] != '' ) && ( $settings['body_pos'] != '' ) ) {
			$output .= '#content { background-position: ' . $settings['body_pos'] . ' !important; }' . "\n";
		}
		
		if (( $settings['header_color'] != '' ) || ($settings['header_img'] != '')) {
			$output .= '.ie #header { filter: none; }' . "\n";
		}
		
		if ( $settings['header_color'] != '' ) {
			$output .= '#header { background: ' . $settings['header_color'] . ' !important; }' . "\n";
		}
			
		if ( $settings['header_img'] != '' ) {
			$output .= '#header { background-image: url( ' . $settings['header_img'] . ' ) !important; }' . "\n";
		}

		if ( ( $settings['header_img'] != '' ) && ( $settings['header_repeat'] != '' ) && ( $settings['header_pos'] != '' ) ) {
			$output .= '#header { background-repeat: ' . $settings['header_repeat'] . ' !important; }' . "\n";
		}
		
		if ( ( $settings['header_img'] != '' ) && ( $settings['header_pos'] != '' ) ) {
			$output .= '#header { background-position: ' . $settings['header_pos'] . ' !important; }' . "\n";
		}
		
		if ( $settings['intro_color'] != '' ) {
			$output .= '#intro { background: ' . $settings['intro_color'] . ' !important; }' . "\n";
		}
			
		if ( $settings['intro_img'] != '' ) {
			$output .= '#intro { background-image: url( ' . $settings['intro_img'] . ' ) !important; }' . "\n";
		}

		if ( ( $settings['intro_img'] != '' ) && ( $settings['intro_repeat'] != '' ) && ( $settings['intro_pos'] != '' ) ) {
			$output .= '#intro { background-repeat: ' . $settings['intro_repeat'] . ' !important; }' . "\n";
		}
		
		if ( ( $settings['intro_img'] != '' ) && ( $settings['intro_pos'] != '' ) ) {
			$output .= '#intro { background-position: ' . $settings['intro_pos'] . ' !important; }' . "\n";
		}
		
		if ( $settings['slider_color'] != '' ) {
			$output .= '#featured { background: ' . $settings['slider_color'] . ' !important; }' . "\n";
		}
			
		if ( $settings['slider_img'] != '' ) {
			$output .= '#featured { background-image: url( ' . $settings['slider_img'] . ' ) !important; }' . "\n";
		}

		if ( ( $settings['slider_img'] != '' ) && ( $settings['slider_repeat'] != '' ) && ( $settings['slider_pos'] != '' ) ) {
			$output .= '#featured { background-repeat: ' . $settings['slider_repeat'] . ' !important; }' . "\n";
		}
		
		if ( ( $settings['slider_img'] != '' ) && ( $settings['slider_pos'] != '' ) ) {
			$output .= '#featured { background-position: ' . $settings['slider_pos'] . ' !important; }' . "\n";
		}
		
		if ( $settings['link_color'] != '' ) {
			$output .= 'a { color: ' . $settings['link_color'] . ' !important; }' . "\n";
		}
		
		if ( $settings['link_hover_color'] != '' ) {
			$output .= 'a:hover, .post-more a:hover, .post-meta a:hover, .post p.tags a:hover { color: ' . $settings['link_hover_color'] . ' !important; }' . "\n";
		}
		
		if ( $settings['button_color'] != '' ) {
			$output .= 'a.button, a.comment-reply-link, #commentform #submit, #contact-page .submit { background: ' . $settings['button_color'] . ' !important; border-color: ' . $settings['button_color'] . ' !important; }' . "\n";
			$output .= 'a.button:hover, a.button.hover, a.button.active, a.comment-reply-link:hover, #commentform #submit:hover, #contact-page .submit:hover { background: ' . $settings['button_color'] . ' !important; opacity: 0.9; }' . "\n";
		}
		
		if ( $settings['navhover_color'] != '' ) {
			$output .= '.nav a:hover, .nav li ul, .nav li.current_page_item a, .nav li.current_page_parent a, .nav li.current-menu-ancestor a, .nav li.current-cat a, .nav li.li.current-menu-item a, .nav li:hover > a { background-color: ' . $settings['navhover_color'] . ' !important; }' . "\n";
		}
		
		// Output styles
		if ( isset( $output ) && $output != '' ) {
			$output = strip_tags( $output );
			$output = "<!-- lok Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
			
	} // End lok_custom_styling()
}

/*-----------------------------------------------------------------------------------*/
/* Add custom typograhpy to HEAD */
/*-----------------------------------------------------------------------------------*/

add_action( 'lok_head','lok_custom_typography', 10 ); // Add custom typography to HEAD

if ( ! function_exists( 'lok_custom_typography' ) ) {
	function lok_custom_typography() {
	
		// Get options
		global $lok_options;
				
		// Reset	
		$output = '';
		$default_google_font = false;
		
		// Add Text title and tagline if text title option is enabled
		if ( isset( $lok_options['lok_texttitle'] ) && $lok_options['lok_texttitle'] == 'true' ) {		
			
			if ( $lok_options['lok_font_site_title'] )
				$output .= '#header .site-title a {'.lok_generate_font_css($lok_options['lok_font_site_title']).'}' . "\n";	
			if ( $lok_options['lok_tagline'] == "true" AND $lok_options['lok_font_tagline'] ) 
				$output .= '#header .site-description {'.lok_generate_font_css($lok_options[ 'lok_font_tagline']).'}' . "\n";	
		}

		if ( isset( $lok_options['lok_typography'] ) && $lok_options['lok_typography'] == 'true' ) {
			
			if ( isset( $lok_options['lok_font_body'] ) && $lok_options['lok_font_body'] )
				$output .= 'body { '.lok_generate_font_css($lok_options['lok_font_body'], '1.5').' }' . "\n";	

			if ( isset( $lok_options['lok_font_nav'] ) && $lok_options['lok_font_nav'] )
				$output .= '#navigation, #navigation .nav a { '.lok_generate_font_css($lok_options['lok_font_nav'], '1.4').' }' . "\n";	

			if ( isset( $lok_options['lok_font_intro_section'] ) && $lok_options['lok_font_intro_section'] )
				$output .= '#intro h1 { '.lok_generate_font_css($lok_options[ 'lok_font_intro_section' ], '1.3').' }' . "\n";
			
			if ( isset( $lok_options['lok_font_page_title'] ) && $lok_options['lok_font_page_title'] )
				$output .= '.page header h1 { '.lok_generate_font_css($lok_options[ 'lok_font_page_title' ], '1.2').' }' . "\n";

			if ( isset( $lok_options['lok_font_post_title'] ) && $lok_options['lok_font_post_title'] )
				$output .= '.post header h1, .post header h1 a:link, .post header h1 a:visited { '.lok_generate_font_css($lok_options[ 'lok_font_post_title' ], '1.2').' }' . "\n";	
		
			if ( isset( $lok_options['lok_font_post_meta'] ) && $lok_options['lok_font_post_meta'] )
				$output .= '.post-meta { '.lok_generate_font_css($lok_options[ 'lok_font_post_meta' ]).' }' . "\n";	

			if ( isset( $lok_options['lok_font_post_entry'] ) && $lok_options['lok_font_post_entry'] )
				$output .= '.entry, .entry p { '.lok_generate_font_css($lok_options[ 'lok_font_post_entry' ], '1.5').' } h1, h2, h3, h4, h5, h6 { font-family: '.stripslashes($lok_options[ 'lok_font_post_entry' ]['face']).', arial, sans-serif; }'  . "\n";	

			if ( isset( $lok_options['lok_font_widget_titles'] ) && $lok_options['lok_font_widget_titles'] )
				$output .= '.widget h3 { '.lok_generate_font_css($lok_options[ 'lok_font_widget_titles' ]).' }'  . "\n";
				
			if ( isset( $lok_options['lok_font_widget_titles'] ) && $lok_options['lok_font_widget_titles'] )
				$output .= '.widget h3 { '.lok_generate_font_css($lok_options[ 'lok_font_widget_titles' ]).' }'  . "\n";
				
			// Component titles
			if ( isset( $lok_options['lok_font_component_titles'] ) && $lok_options['lok_font_component_titles'] )
				$output .= '.component h2.component-title { '.lok_generate_font_css($lok_options[ 'lok_font_component_titles' ]).' }'  . "\n";	

		// Add default typography Google Font
		} else {
		
			// Load default Google Fonts
			global $default_google_fonts;
			if ( is_array( $default_google_fonts) and count( $default_google_fonts ) > 0 ) :
			
				$count = 0;
				foreach ( $default_google_fonts as $font ) {
					$count++;
					$lok_options[ 'lok_default_google_font_'.$count ] = array( 'face' => $font );
				}
				$default_google_font = true;

			endif;
		
		} 
		
		// Output styles
		if (isset($output) && $output != '') {
		
			// Load Google Fonts stylesheet in HEAD
			if (function_exists( 'lok_google_webfonts')) lok_google_webfonts();
			
			$output = "\n" . "<!-- lok Custom Typography -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		
		// Check if default google font is set and load Google Fonts stylesheet in HEAD
		} elseif ( $default_google_font ) {
		
			// Enable Google Fonts stylesheet in HEAD
			if (function_exists( 'lok_google_webfonts')) lok_google_webfonts();

		}
			
	} // End lok_custom_typography()
}

// Returns proper font css output
if (!function_exists( 'lok_generate_font_css')) {
	function lok_generate_font_css($option, $em = '1') {

		// Test if font-face is a Google font
		global $google_fonts;
		foreach ( $google_fonts as $google_font ) {

			// Add single quotation marks to font name and default arial sans-serif ending
			if ( $option[ 'face' ] == $google_font[ 'name' ] )
				$option[ 'face' ] = "'" . $option[ 'face' ] . "', arial, sans-serif";

		} // END foreach

		if ( !@$option["style"] && !@$option["size"] && !@$option["unit"] && !@$option["color"] )
			return 'font-family: '.stripslashes($option["face"]).';';
		else
			return 'font:'.$option["style"].' '.$option["size"].$option["unit"].'/'.$em.'em '.stripslashes($option["face"]).';color:'.$option["color"].';';
	}
}

// Output stylesheet and custom.css after custom styling
remove_action( 'nxt_head', 'lokthemes_nxt_head' );
add_action( 'lok_head', 'lokthemes_nxt_head' );


/*-----------------------------------------------------------------------------------*/
/* Add layout to body_class output */
/*-----------------------------------------------------------------------------------*/

add_filter( 'body_class','lok_layout_body_class', 10 );		// Add layout to body_class output

if ( ! function_exists( 'lok_layout_body_class' ) ) {
	function lok_layout_body_class( $classes ) {
		
		global $lok_options;
		
		$layout = 'two-col-left';
		
		if ( isset( $lok_options['lok_site_layout'] ) && ( $lok_options['lok_site_layout'] != '' ) ) {
			$layout = $lok_options['lok_site_layout'];
		}

		// Set main layout on post or page
		if ( is_singular() ) {
			global $post;
			$single = get_post_meta($post->ID, '_layout', true);
			if ( $single != "" AND $single != "layout-default" ) 
				$layout = $single;
		}
		
		// Add layout to $lok_options array for use in theme
		$lok_options['lok_layout'] = $layout;
		
		// Add classes to body_class() output 
		$classes[] = $layout;
		return $classes;						
					
	} // End lok_layout_body_class()
}


/*-----------------------------------------------------------------------------------*/
/* lok_feedburner_link() */
/*-----------------------------------------------------------------------------------*/
/**
 * lok_feedburner_link()
 *
 * Replace the default RSS feed link with the Feedburner URL, if one
 * has been provided by the user.
 *
 * @package lokFramework
 * @subpackage Filters
 */

add_filter( 'feed_link', 'lok_feedburner_link', 10 );

function lok_feedburner_link ( $output, $feed = null ) {

	global $lok_options;

	$default = get_default_feed();

	if ( ! $feed ) $feed = $default;

	if ( isset($lok_options[ 'lok_feed_url']) && $lok_options[ 'lok_feed_url' ] && ( $feed == $default ) && ( ! stristr( $output, 'comments' ) ) ) $output = esc_url( $lok_options[ 'lok_feed_url' ] );

	return $output;

} // End lok_feedburner_link()


/*-----------------------------------------------------------------------------------*/
/* Load responsive IE scripts */
/*-----------------------------------------------------------------------------------*/

add_action( 'nxt_footer', 'lok_load_responsive_IE_footer', 10 );

if ( ! function_exists( 'lok_load_responsive_IE_footer' ) ) {
	function lok_load_responsive_IE_footer () {
		$html = '';
		echo '<!--[if lt IE 9]>'. "\n";
		echo '<script src="' . get_template_directory_uri() . '/includes/js/respond-IE.js"></script>'. "\n";
		echo '<![endif]-->'. "\n";

		echo $html;
	} // End ()
}


/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>