<?php
/**
 * "Portfolio Gallery" Taxonomy Archive Template
 *
 * This template file is used when displaying an archive of posts in the
 * "portfolio-gallery" taxonomy. This is used with lokTumblog.
 *
 * @package lokFramework
 * @subpackage Template
 */

 global $lok_options; 
 get_header();
?>
    <div id="content">
		<section id="portfolio-gallery" class="page col-full">
		           
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

    </div><!-- /#content -->
		
<?php get_footer(); ?>