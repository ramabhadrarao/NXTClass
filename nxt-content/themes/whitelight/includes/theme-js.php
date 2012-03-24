<?php
if ( ! is_admin() ) { add_action( 'nxt_enqueue_scripts', 'lokthemes_add_javascript' ); }

if ( ! function_exists( 'lokthemes_add_javascript' ) ) {
	function lokthemes_add_javascript() {
	
		global $lok_options;
		
		nxt_register_script( 'prettyPhoto', get_template_directory_uri() . '/includes/js/jquery.prettyPhoto.js', array( 'jquery' ) );
		nxt_register_script( 'portfolio', get_template_directory_uri() . '/includes/js/portfolio.js', array( 'jquery', 'prettyPhoto' ) );
		nxt_register_script( 'flexslider', get_template_directory_uri() . '/includes/js/jquery.flexslider.min.js', array( 'jquery' ) );
		
		if ( ( is_home() || is_front_page() ) && isset( $lok_options['lok_featured'] ) && ( $lok_options['lok_featured'] == 'true' ) ) {
			nxt_enqueue_script( 'flexslider' );
		}
		
		if ( is_page_template( 'template-portfolio.php' ) || is_front_page() || ( is_singular() && get_post_type() == 'portfolio' ) || is_tax( 'portfolio-gallery' ) || is_post_type_archive( 'portfolio' ) ) {			
			nxt_enqueue_script( 'portfolio' );
		}

		nxt_enqueue_script( 'third party', get_template_directory_uri() . '/includes/js/third-party.js', array( 'jquery' ) );
		nxt_enqueue_script( 'general', get_template_directory_uri() . '/includes/js/general.js', array( 'jquery' ) );
	}
	
}

if ( ! is_admin() ) { add_action( 'nxt_print_styles', 'lokthemes_add_css' ); }

if ( ! function_exists( 'lokthemes_add_css' ) ) {
	function lokthemes_add_css () {
		
		nxt_register_style( 'prettyPhoto', get_template_directory_uri().'/includes/css/prettyPhoto.css' );
	
		if ( is_page_template('template-portfolio.php') || is_front_page() || ( is_singular() && get_post_type() == 'portfolio' ) || is_tax( 'portfolio-gallery' ) || is_post_type_archive( 'portfolio' ) ) {
			nxt_enqueue_style( 'prettyPhoto' );
		}
	
		do_action( 'lokthemes_add_css' );
	
	} // End lokthemes_add_css()
}

?>