<?php
/**
 * The default template for displaying content
 */

	global $lok_options;
 
/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */

 	$settings = array(
					'thumb_w' => 710, 
					'thumb_h' => 180, 
					);
					
	$settings = lok_get_dynamic_values( $settings );
 
?>

	<article <?php post_class('fix'); ?>>
	
	    <?php 
	    	$embed = get_post_meta( $post->ID, 'embed', true );
	    	if ( ( !isset($embed) || $embed == '' ) && isset( $lok_options['lok_post_content'] ) && $lok_options['lok_post_content'] != 'content' ) { 
	    		lok_image( 'noheight=true&width=' . $settings['thumb_w'] . '&height=' . $settings['thumb_h'] . '&class=thumbnail ' ); 
	    	} 
	    ?>
	    
	    <?php lok_post_meta(); ?>
	    
	    <section class="post-body">
	    
			<header>	
				<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
<!--
				<span class="post-category"><?php the_category( ', ') ?></span>
-->
			</header>
	
			<section class="entry">
			<?php if ( isset( $lok_options['lok_post_content'] ) && $lok_options['lok_post_content'] == 'content' ) { the_content( __( 'Continue Reading &rarr;', 'lokthemes' ) ); } else { the_excerpt(); } ?>
			</section>
	
			<footer class="post-more">      
			<?php if ( isset( $lok_options['lok_post_content'] ) && $lok_options['lok_post_content'] == 'excerpt' ) { ?>
				<span class="read-more"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'lokthemes' ); ?>"><?php _e( 'Continue Reading &rarr;', 'lokthemes' ); ?></a></span>
			<?php } ?>
			</footer>  
		
		</section><!-- /.post-body -->

	</article><!-- /.post -->