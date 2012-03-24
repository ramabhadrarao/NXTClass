<?php
/**
 * Search Template
 *
 * The search template is used to display search results from the native NXTClass search.
 *
 * If no search results are found, the user is assisted in refining their search query in
 * an attempt to produce an appropriate search results set for the user's search query.
 *
 * @package lokFramework
 * @subpackage Template
 */

 get_header();
 global $lok_options;
?>     
    <div id="content">
    
    	<div class="col-full">
    		
    		<?php if ( isset( $lok_options['lok_breadcrumbs_show'] ) && $lok_options['lok_breadcrumbs_show'] == 'true' ) { ?>
				<section id="breadcrumbs">
					<?php lok_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?>  	
			
			<header class="archive_header"><?php echo __( 'Search results:', 'lokthemes' ) . ' '; the_search_query(); ?></header>
    		
			<section id="main" class="col-left">
	            
			<?php if ( have_posts() ) : $count = 0; ?>
	
				<div class="fix"></div>                
				        
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); $count++; ?>
	
					<?php get_template_part( 'content', 'search' ); ?>
	
				<?php endwhile; ?>
	
			<?php else : ?>
	        
	            <article <?php post_class(); ?>>
	                <p><?php _e( 'Sorry, no posts matched your criteria.', 'lokthemes' ); ?></p>
	            </article><!-- /.post -->
	        
	        <?php endif; ?>
	
				<?php lok_pagenav(); ?>
	                
	        </section><!-- /#main -->
	
	        <?php get_sidebar(); ?>
        
        </div>

    </div><!-- /#content -->
		
<?php get_footer(); ?>