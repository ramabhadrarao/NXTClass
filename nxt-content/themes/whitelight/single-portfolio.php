<?php
/**
 * Single Portfolio Template
 *
 * This template is the portfolio item page template. It is used to display content when someone is viewing a
 * singular view of a portfolio item ('portfolio' post_type).
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
					'single_w' => 200, 
					'single_h' => 200, 
					'thumb_single_align' => 'alignright'
					);
					
	$settings = lok_get_dynamic_values( $settings );
?>
       
    <div id="content">
    	<div class="col-full single-portfolio">
			<section id="main" class="fullwidth">
			           
			<?php if ( isset( $lok_options['lok_breadcrumbs_show'] ) && $lok_options['lok_breadcrumbs_show'] == 'true' ) { ?>
				<section id="breadcrumbs">
					<?php lok_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?>
	        <?php
	        	if ( have_posts() ) { $count = 0;
	        		while ( have_posts() ) { the_post(); $count++;
	        ?>
				<article <?php post_class(); ?>>
	
	
	                <header>
	                
		                <h1 class="title"><?php the_title(); ?></h1>
		                                	
	                </header>
	                
	                <section class="entry">
	                	<?php the_content(); ?>
						<?php nxt_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'lokthemes' ), 'after' => '</div>' ) ); ?>
					</section>
										
	            	<?php lok_portfolio_meta( '' ); ?>
	
	            </article><!-- .post -->
	            
	            <div class="single-portfolio-gallery fix">
				
				<?php
					$width = 710;
					$args = 'width=' . $width;
					$embed = lok_embed( $args );
					
					if ( $embed != '' ) {
						echo $embed;
					} else {
						
						$args .= '&return=true&link=img&noheight=true';
	
						$html = '';
						$rel = 'lightbox';
						
						// Get the other images.
						$images = lok_get_post_images( 0, 'full' );

						if ( count ( $images ) > 0 ) 
							$rel = 'lightbox[' . $post->ID . ']'; 					
						
						// Store featured image ID for exclusion
						if ( isset( $lok_options['lok_post_image_support'] ) && ( $lok_options['lok_post_image_support'] == 'true' ) && current_theme_supports( 'post-thumbnails' ) && function_exists('get_post_thumbnail_id') ) {
							$featured_image_id = get_post_thumbnail_id( $post->ID );
						} else {
							$featured_image_id = '';
						}
						
						
						if ( $featured_image_id != '' ) {
							$html .= '<div class="portfolio-item single-portfolio-image ">';
							$image_data = nxt_get_attachment_image_src( $featured_image_id, 'full' );
							$image_url = $image_data[0];
							
							$html .= '<a href="' . $image_url . '" rel="' . $rel . '">' . lok_image( $args ) . '</a>' . "\n";
							$html .= '</div>';
						}
						
						
						
						
						
						if ( count ( $images ) > 0 ) {		
							foreach ( $images as $k => $v ) {
								$pos = false;
								
								// Skip if the image is used as the posts featured image
								if ( $featured_image_id == $v['id'] ) continue;
								
								if ( isset($image_url) && $image_url != '' && $v['url'] != '' ) {
									$pos = strpos( $v['url'], $image_url );
								}
								
								if ( $pos === false || ( $v['url'] != $image_url ) ) {
									$html .= '<div class="portfolio-item single-portfolio-image ">';
									
									// Use vt_resize to dynamically resize attached images
									$image = vt_resize( $v['id'], null, $width, null, true );						
									$html .= '<a href="' . $v['url'] . '" rel="' . $rel . ']"><img src="' . $image['url'] . '" width="' . $image['width'] . '" /></a>' . "\n";
									
									$html .= '</div>';
								}
							}
						}
						
						echo $html;
					}
				?>
				
				</div><!-- /.single-portfolio-gallery -->
				            
	            <div class="fix"></div>
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
		</div>
    </div><!-- #content -->
		
<?php get_footer(); ?>