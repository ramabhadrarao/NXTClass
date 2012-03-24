<?php
/**
 * Template Name: Tags
 *
 * The tags page template displays a user-friendly tag cloud of the
 * post tags used on your website.
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
    
			<section id="main" class="fullwidth"> 
	                                                                        
	            <article <?php post_class(); ?>>
					
					<header>
						<h1><?php the_title(); ?></h1>
					</header>
	                
		            <?php if ( have_posts() ) { the_post(); ?>
	            	<section class="entry">
	            		<?php the_content(); ?>
	            	</section>	            	
		            <?php } ?>  
		            
	                <div class="tag_cloud">
	        			<?php nxt_tag_cloud( 'number=0' ); ?>
	    			</div><!--/.tag-cloud-->
	
	            </article><!-- /.post -->
	        
			</section><!-- /#main -->
		
		</div>
		
    </div><!-- /#content -->
		
<?php get_footer(); ?>