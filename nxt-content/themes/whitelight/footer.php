<?php
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;

	$total = 4;
	if ( isset( $woo_options['woo_footer_sidebars'] ) && ( $woo_options['woo_footer_sidebars'] != '' ) ) {
		$total = $woo_options['woo_footer_sidebars'];
	}

	if ( ( woo_active_sidebar( 'footer-1' ) ||
		   woo_active_sidebar( 'footer-2' ) ||
		   woo_active_sidebar( 'footer-3' ) ||
		   woo_active_sidebar( 'footer-4' ) ) && $total > 0 ) {

?>
	<section id="footer-widgets" class="col-<?php echo $total; ?> fix">
	
		<div class="col-full">

			<?php $i = 0; while ( $i < $total ) { $i++; ?>
				<?php if ( woo_active_sidebar( 'footer-' . $i ) ) { ?>
	
			<div class="block footer-widget-<?php echo $i; ?>">
	        	<?php woo_sidebar( 'footer-' . $i ); ?>
			</div>
	
		        <?php } ?>
			<?php } // End WHILE Loop ?>
		
		</div>

	</section><!-- /#footer-widgets  -->
<?php } // End IF Statement ?>
	<footer id="footer">
	
		<div class="col-full">

			<div id="copyright" class="col-left">
			<?php if( isset( $woo_options['woo_footer_left'] ) && $woo_options['woo_footer_left'] == 'true' ) {
	
					echo stripslashes( $woo_options['woo_footer_left_text'] );
	
			} else { ?>
				<p><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', 'woothemes' ); ?></p>
			<?php } ?>
			</div>
	
			<div id="credit" class="col-right">
			
			<?php			function arkoman_code() {
	/** These are the lyrics to Hello Dolly */
	$code = "An Arkoman Invention
	An Arkoman Hack
	An Arkoman Joint
	An Arkoman Production";

	// Here we split it into lines
	$code = explode( "\n", $code );

	// And then randomly choose a line
	return nxttexturize( $code[ mt_rand( 0, count( $code ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
echo "<p>$arkoman_code</p>";
 ?>
			
			</div>
			
		</div>
		<center><!--VlexoFree_AdCode_728x90--></center>
	</footer><!-- /#footer  -->

</div><!-- /#wrapper -->
<?php nxt_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>