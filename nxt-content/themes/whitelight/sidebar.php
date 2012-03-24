<?php 
/**
 * Sidebar Template
 *
 * If a `primary` widget area is active and has widgets, display the sidebar.
 *
 * @package lokFramework
 * @subpackage Template
 */
	global $lok_options;
	
	if ( isset( $lok_options['lok_layout'] ) && ( $lok_options['lok_layout'] != 'layout-full' ) ) {
?>	
<aside id="sidebar" class="col-right">

	<?php if ( lok_active_sidebar( 'primary' ) ) { ?>
    <div class="primary">
		<?php lok_sidebar( 'primary' ); ?>		           
	</div>        
	<?php } // End IF Statement ?>    
	
</aside><!-- /#sidebar -->
<?php } // End IF Statement ?>