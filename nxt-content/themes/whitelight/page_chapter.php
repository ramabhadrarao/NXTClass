<?php
/* Template name: Chapter */ 
	get_header();
	global $lok_options;
?>
       
    <div id="content">
    	<div class="page col-full">
    	
    		<?php if ( isset( $lok_options['lok_breadcrumbs_show'] ) && $lok_options['lok_breadcrumbs_show'] == 'true' && !is_front_page() ) { ?>
				<section id="breadcrumbs">
					<?php lok_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?> 
    	
			<section id="main" class="col-left"> 			
	
	        <?php
	        	if ( have_posts() ) { $count = 0;
	        		while ( have_posts() ) { the_post(); $count++;
	        ?>                                                           
	            <article <?php post_class(); ?>>
					
					<header>
				    	<h1><?php the_title(); ?></h1>
					</header>
					
	                <section class="entry">
	                	<div id="accordion" class="accordion"><?php the_content(); ?></div>
	
						<?php nxt_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'lokthemes' ), 'after' => '</div>' ) ); ?>
	               	</section><!-- /.entry -->
	
					<?php edit_post_link( __( '{ Edit }', 'lokthemes' ), '<span class="small">', '</span>' ); ?>
	                
	            </article><!-- /.post -->
	            
	            <?php
	            	// Determine wether or not to display comments here, based on "Theme Options".
	            	if ( isset( $lok_options['lok_comments'] ) && in_array( $lok_options['lok_comments'], array( 'page', 'both' ) ) ) {
	            		comments_template();
	            	}
	
					} // End WHILE Loop
				} else {
			?>
				<article <?php post_class(); ?>>
	            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'lokthemes' ); ?></p>
	            </article><!-- /.post -->
	        <?php } // End IF Statement ?>  
	        
			</section><!-- /#main -->
	
	        <?php get_sidebar(); ?>
		</div>
    </div><!-- /#content -->
		
<?php get_footer(); ?>