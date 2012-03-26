</section><!-- /#main -->
<?php if ( bp_is_register_page() ) : ?>
    <script type="text/javascript">
        jQuery(document).ready( function() {
            if ( jQuery('div#blog-details').length && !jQuery('div#blog-details').hasClass('show') )
                jQuery('div#blog-details').toggle();
            jQuery( 'input#signup_with_blog' ).click( function() {
                jQuery('div#blog-details').fadeOut().toggle();
            });
        });
    </script>
<?php endif; ?><?php 
/**
 * Sidebar Template
 *
 * If a `primary` widget area is active and has widgets, display the sidebar.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;
	
	if ( isset( $woo_options['woo_layout'] ) && ( $woo_options['woo_layout'] != 'layout-full' ) ) {
?>	
<aside id="sidebar" class="col-right">

	<?php if ( woo_active_sidebar( 'primary' ) ) { ?>
    <div class="primary">
		<?php woo_sidebar( 'primary' ); ?>		           
	</div>        
	<?php } // End IF Statement ?>    
	
</aside><!-- /#sidebar -->
<?php } // End IF Statement ?>