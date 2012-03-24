<?php
/**
 * Single Post Template
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a post ('post' post_type).
 * @link http://codex.nxtclass.org/Post_Types#Post
 *
 * @package lokFramework
 * @subpackage Template
 */
	get_header();
	global $lok_options;
	
/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */
	
	$settings = array(
					'thumb_single' => 'false', 
					'thumb_w' => 710, 
					'thumb_h' => 180, 
					);
					
	$settings = lok_get_dynamic_values( $settings );
?>
       
    <div id="content">
    	
    	<div class="col-full">
    		
    		<?php if ( isset( $lok_options['lok_breadcrumbs_show'] ) && $lok_options['lok_breadcrumbs_show'] == 'true' ) { ?>
				<section id="breadcrumbs">
					<?php lok_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?>
    		
			<section id="main" class="col-left">
			           
	        <?php
	        	if ( have_posts() ) { $count = 0;
	        		while ( have_posts() ) { the_post(); $count++;
	        ?>
				<article <?php post_class('fix'); ?>>
	
					<?php echo lok_embed( 'width=580' ); ?>
	                <?php if ( $settings['thumb_single'] == 'true' && ! lok_embed( '' ) ) { lok_image( 'noheight=true&width=' . $settings['thumb_w'] . '&height=' . $settings['thumb_h'] . '&class=thumbnail ' ); } ?>
	                
	                <?php lok_post_meta(); ?>
	                
	                <div class="post-body">
	
	                	<header>
	                	
		            	    <h1><?php the_title(); ?></h1>
		            	    <p class="post-category"><?php _e( 'Categories:', 'lokthemes' ); ?> <?php the_category( ', ') ?></p>
	                		
	                	</header>
	                	
	                	<section class="entry">
	                		<?php the_content(); ?>
							<?php nxt_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'lokthemes' ), 'after' => '</div>' ) ); ?>
						</section>
											
						<?php the_tags( '<p class="tags">'.__( 'Tags: ', 'lokthemes' ), ', ', '</p>' ); ?>
					
					</div>
	                                
	            </article><!-- .post -->
	
					<?php if ( isset( $lok_options['lok_post_author'] ) && $lok_options['lok_post_author'] == 'true' ) { ?>
					<aside id="post-author" class="fix">
						<div class="profile-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), '70' ); ?></div>
						<div class="profile-content">
							<h3 class="title"><?php printf( esc_attr__( 'About %s', 'lokthemes' ), get_the_author() ); ?></h3>
							<?php the_author_meta( 'description' ); ?>
							<div class="profile-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'lokthemes' ), get_the_author() ); ?>
								</a>
							</div><!-- #profile-link	-->
						</div><!-- .post-entries -->
					</aside><!-- .post-author-box -->
					<?php } ?>
	
					<?php lok_subscribe_connect(); ?>
	
		        <nav id="post-entries" class="fix">
		            <div class="nav-prev fl"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ); ?></div>
		            <div class="nav-next fr"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ); ?></div>
		        </nav><!-- #post-entries -->
	            <?php
	            	// Determine wether or not to display comments here, based on "Theme Options".
	            	if ( isset( $lok_options['lok_comments'] ) && in_array( $lok_options['lok_comments'], array( 'post', 'both' ) ) ) {
	            		comments_template();
	            	}
	
					} // End WHILE Loop
				} else {
			?>
				<article <?php post_class(); ?>>
	            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'lokthemes' ); ?></p>
				</article><!-- .post -->             
	       	<?php } ?>  
	        
			</section><!-- #main -->
	
	        <?php get_sidebar(); ?>
        
        </div>

    </div><!-- #content -->
		
<?php get_footer(); ?>