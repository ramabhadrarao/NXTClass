<?php
/**
 * "Portfolio" Post Type Archive
 *
 * The portfolio post type archive template displays your portfolio items with
 * a switcher to quickly filter between the various portfolio galleries. 
 *
 * @package lokFramework
 * @subpackage Template
 */

 global $lok_options; 
 get_header();
?>
    <div id="content">
    
    	<div class="page col-full">
    
			<section id="portfolio-gallery">
			           
			<?php if ( isset( $lok_options['lok_breadcrumbs_show'] ) && $lok_options['lok_breadcrumbs_show'] == 'true' ) { ?>
				<section id="breadcrumbs">
					<?php lok_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?>  			
	
	        <?php if ( have_posts() ) : $count = 0; ?>                                                           
	            <article <?php post_class(); ?>>
					<?php get_template_part( 'loop', 'portfolio' ); ?>
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