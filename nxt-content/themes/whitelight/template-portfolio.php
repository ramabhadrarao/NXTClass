<?php
/**
 * Template Name: Portfolio
 *
 * The portfolio page template displays your portfolio items with
 * a switcher to quickly filter between the various portfolio galleries. 
 *
 * @package lokFramework
 * @subpackage Template
 */

 get_header();
 global $lok_options; 
?>
    <div id="content">
    	<div class="page col-full">
    		
    		<?php if ( isset( $lok_options['lok_breadcrumbs_show'] ) && $lok_options['lok_breadcrumbs_show'] == 'true' ) { ?>
				<section id="breadcrumbs">
					<?php lok_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?>  
    	
			<section id="portfolio-gallery">			
			
        	<?php if ( have_posts() ) : $count = 0; ?>                                                           
        	    <article <?php post_class(); ?>>
					
					<?php get_template_part( 'loop', 'portfolio' ); ?>
			
					<?php edit_post_link( __( '{ Edit }', 'lokthemes' ), '<span class="small">', '</span>' ); ?>
        	        
        	    </article><!-- /.post -->
        	    
        	<?php else : ?>
				<article <?php post_class(); ?>>
        	    	<p><?php _e( 'Sorry, no posts matched your criteria.', 'lokthemes' ); ?></p>
        	    </article><!-- /.post -->
        	<?php endif; ?>  
        	
			</section><!-- /#portfolio-gallery -->
		</div>
    </div><!-- /#content -->
		
<?php get_footer(); ?>