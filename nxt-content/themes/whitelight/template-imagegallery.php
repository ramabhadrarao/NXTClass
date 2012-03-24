<?php
/**
 * Template Name: Image Gallery
 *
 * The image gallery page template displays a styled
 * image grid of a maximum of 60 posts with images attached.
 *
 * @package lokFramework
 * @subpackage Template
 */
 
 global $lok_options;
 get_header();
?>
       
    <div id="content">
    
    	<div class="page col-full">
    	
    		<?php if ( isset( $lok_options['lok_breadcrumbs_show'] ) && $lok_options['lok_breadcrumbs_show'] == 'true' ) { ?>
				<section id="breadcrumbs">
					<?php lok_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?> 
    
			<section id="main" class="col-left fix">
	
	            <article <?php post_class('image-gallery-item'); ?>>
					
					<header>
						<h1><?php the_title(); ?></h1>
					</header>
	                
					<section class="entry">
	
			            <?php
			            	if ( have_posts() ) { the_post();
			            		the_content();
			            	}
			            ?>
	               		<?php query_posts( 'shonxtosts=60&post_type=post' ); ?>
	                	<?php
	                		if ( have_posts() ) {
	                			while ( have_posts() ) { the_post();
	                			$nxt_query->is_home = false;
	                				lok_image( 'single=true&class=thumbnail alignleft' );
	                			}
	                		}
	                	?>	
	                </section>
	
	            </article><!-- /.post -->                
	                                                            
			</section><!-- /#main -->
			
	        <?php get_sidebar(); ?>
		
		</div>
		
    </div><!-- /#content -->
		
<?php get_footer(); ?>