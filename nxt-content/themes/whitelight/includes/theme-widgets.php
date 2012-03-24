<?php
/*-----------------------------------------------------------------------------------*/
/* Load the widgets, with support for overriding the widget via a child theme.
/*-----------------------------------------------------------------------------------*/

$widgets = array(
				'includes/widgets/widget-lok-tabs.php', 
				'includes/widgets/widget-lok-adspace.php', 
				'includes/widgets/widget-lok-blogauthor.php', 
				'includes/widgets/widget-lok-embed.php', 
				'includes/widgets/widget-lok-flickr.php', 
				'includes/widgets/widget-lok-search.php', 
				'includes/widgets/widget-lok-twitter.php', 
				'includes/widgets/widget-lok-subscribe.php',
				'includes/widgets/widget-lok-componentbase.php'
				);

// Allow child themes/plugins to add widgets to be loaded.
$widgets = apply_filters( 'lok_widgets', $widgets );
				
	foreach ( $widgets as $w ) {
		locate_template( $w, true );
	}

/*---------------------------------------------------------------------------------*/
/* Deregister Default Widgets */
/*---------------------------------------------------------------------------------*/
if (!function_exists( 'lok_deregister_widgets')) {
	function lok_deregister_widgets(){
	    unregister_widget( 'WP_Widget_Search' );         
	}
}
add_action( 'widgets_init', 'lok_deregister_widgets' );  


?>