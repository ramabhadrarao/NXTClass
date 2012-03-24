<?php get_header(); ?>
    
    <div id="content">
    	<div class="col-full">
    		
    		<?php if ( isset($lok_options['lok_breadcrumbs_show']) && $lok_options['lok_breadcrumbs_show'] == 'true' ) { ?>
				<section id="breadcrumbs">
					<?php lok_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?>
		
			<header class="archive_header"><?php _e( 'Features', 'lokthemes' ); ?></header>
	
	        <?php
	        	// Display the description for this archive, if it's available.
	        	lok_archive_description();
	        ?>
	        
		        <div class="fix"></div>
    	
			<section id="main" class="col-left">
	
			<?php if (have_posts()) : $count = 0; ?>
	        
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); $count++; ?>
	
					<?php get_template_part( 'content', 'features' ); ?>
	
				<?php endwhile; ?>
	            
	        <?php else: ?>
	        
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