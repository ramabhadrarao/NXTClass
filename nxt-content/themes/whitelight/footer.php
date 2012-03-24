<?php
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package lokFramework
 * @subpackage Template
 */
	global $lok_options;

	$total = 4;
	if ( isset( $lok_options['lok_footer_sidebars'] ) && ( $lok_options['lok_footer_sidebars'] != '' ) ) {
		$total = $lok_options['lok_footer_sidebars'];
	}

	if ( ( lok_active_sidebar( 'footer-1' ) ||
		   lok_active_sidebar( 'footer-2' ) ||
		   lok_active_sidebar( 'footer-3' ) ||
		   lok_active_sidebar( 'footer-4' ) ) && $total > 0 ) {

?>
	<section id="footer-widgets" class="col-<?php echo $total; ?> fix">
	
		<div class="col-full">

			<?php $i = 0; while ( $i < $total ) { $i++; ?>
				<?php if ( lok_active_sidebar( 'footer-' . $i ) ) { ?>
	
			<div class="block footer-widget-<?php echo $i; ?>">
	        	<?php lok_sidebar( 'footer-' . $i ); ?>
			</div>
	
		        <?php } ?>
			<?php } // End WHILE Loop ?>
		
		</div>

	</section><!-- /#footer-widgets  -->
<?php } // End IF Statement ?>
	<footer id="footer">
	
		<div class="col-full">

			<div id="copyright" class="col-left">
			<?php if( isset( $lok_options['lok_footer_left'] ) && $lok_options['lok_footer_left'] == 'true' ) {
	
					echo stripslashes( $lok_options['lok_footer_left_text'] );
	
			} else { ?>
				<p><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', 'lokthemes' ); ?></p>
			<?php } ?>
			</div>
	
			<div id="credit" class="col-right">
			
			<?php if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'footer-menu' ) ) {
				nxt_nav_menu( array( 'depth' => 1, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'footer-nav', 'menu_class' => 'nav', 'theme_location' => 'footer-menu' ) );
			} elseif ( isset( $lok_options['lok_footer_right'] ) && $lok_options['lok_footer_right'] == 'true' ) {
	
	        	echo stripslashes( $lok_options['lok_footer_right_text'] );
	
			} else { ?>
				<p><?php _e( 'Powered by', 'lokthemes' ); ?> <a href="http://www.nxtclass.org">NXTClass</a>. <?php _e( 'Designed by', 'lokthemes' ); ?> <a href="<?php echo ( isset( $lok_options['lok_footer_aff_link'] ) && ! empty( $lok_options['lok_footer_aff_link'] ) ? esc_url( $lok_options['lok_footer_aff_link'] ) : 'http://www.lokthemes.com' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/lokthemes.png" width="74" height="19" alt="lok Themes" /></a></p>
			<?php } ?>
			</div>
			
		</div>
		
	</footer><!-- /#footer  -->

</div><!-- /#wrapper -->
<?php nxt_footer(); ?>
<?php lok_foot(); ?>
</body>
</html>