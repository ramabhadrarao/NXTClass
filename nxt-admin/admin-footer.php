<?php
/**
 * NXTClass Administration Template Footer
 *
 * @package NXTClass
 * @subpackage Administration
 */

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');
?>

<div class="clear"></div></div><!-- nxtbody-content -->
<div class="clear"></div></div><!-- nxtbody -->
<div class="clear"></div></div><!-- nxtcontent -->

<div id="footer">
<?php do_action( 'in_admin_footer' ); ?>
<p id="footer-left" class="alignleft"><?php
$upgrade = apply_filters( 'update_footer', '' );
$footer_text = array(
	'<span id="footer-thankyou">' . __( 'Thank you for creating with <a href="http://nxtclass.org/">NXTClass</a>.' ) . '</span>',
);
echo apply_filters( 'admin_footer_text', implode( ' &bull; ', $footer_text ) );
unset( $footer_text );
?></p>
<p id="footer-upgrade" class="alignright"><?php echo $upgrade; ?></p>
<div class="clear"></div>
</div>
<?php
do_action('admin_footer', '');
do_action('admin_print_footer_scripts');
do_action("admin_footer-" . $GLOBALS['hook_suffix']);

// get_site_option() won't exist when auto upgrading from <= 2.7
if ( function_exists('get_site_option') ) {
	if ( false === get_site_option('can_compress_scripts') )
		compression_test();
}

?>

<div class="clear"></div></div><!-- nxtwrap -->
<script type="text/javascript">if(typeof nxtOnload=='function')nxtOnload();</script>
</body>
</html>
