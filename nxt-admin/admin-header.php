<?php
/**
 * NXTClass Administration Template Header
 *
 * @package NXTClass
 * @subpackage Administration
 */

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
if ( ! defined( 'nxt_ADMIN' ) )
	require_once( './admin.php' );

// In case admin-header.php is included in a function.
global $title, $hook_suffix, $current_screen, $nxt_locale, $pagenow, $nxt_version, $is_iphone,
	$current_site, $update_title, $total_update_count, $parent_file;

// Catch plugins that include admin-header.php before admin.php completes.
if ( empty( $current_screen ) )
	set_current_screen();

get_admin_page_title();
$title = esc_html( strip_tags( $title ) );

if ( is_network_admin() )
	$admin_title = __( 'Network Admin' );
elseif ( is_user_admin() )
	$admin_title = __( 'Global Dashboard' );
else
	$admin_title = get_bloginfo( 'name' );

if ( $admin_title == $title )
	$admin_title = sprintf( __( '%1$s &#8212; NXTClass' ), $title );
else
	$admin_title = sprintf( __( '%1$s &lsaquo; %2$s &#8212; NXTClass' ), $title, $admin_title );

$admin_title = apply_filters( 'admin_title', $admin_title, $title );

nxt_user_settings();

_nxt_admin_html_begin();
?>
<title><?php echo $admin_title; ?></title>
<?php

nxt_enqueue_style( 'colors' );
nxt_enqueue_style( 'ie' );
nxt_enqueue_script('utils');

$admin_body_class = preg_replace('/[^a-z0-9_-]+/i', '-', $hook_suffix);
?>
<script type="text/javascript">
addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof nxtOnload!='function'){nxtOnload=func;}else{var oldonload=nxtOnload;nxtOnload=function(){oldonload();func();}}};
var userSettings = {
		'url': '<?php echo SITECOOKIEPATH; ?>',
		'uid': '<?php if ( ! isset($current_user) ) $current_user = nxt_get_current_user(); echo $current_user->ID; ?>',
		'time':'<?php echo time() ?>'
	},
	ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>',
	pagenow = '<?php echo $current_screen->id; ?>',
	typenow = '<?php echo $current_screen->post_type; ?>',
	adminpage = '<?php echo $admin_body_class; ?>',
	thousandsSeparator = '<?php echo addslashes( $nxt_locale->number_format['thousands_sep'] ); ?>',
	decimalPoint = '<?php echo addslashes( $nxt_locale->number_format['decimal_point'] ); ?>',
	isRtl = <?php echo (int) is_rtl(); ?>;
</script>
<?php

do_action('admin_enqueue_scripts', $hook_suffix);
do_action("admin_print_styles-$hook_suffix");
do_action('admin_print_styles');
do_action("admin_print_scripts-$hook_suffix");
do_action('admin_print_scripts');
do_action("admin_head-$hook_suffix");
do_action('admin_head');

if ( get_user_setting('mfold') == 'f' )
	$admin_body_class .= ' folded';

if ( is_admin_bar_showing() )
	$admin_body_class .= ' admin-bar';

if ( is_rtl() )
	$admin_body_class .= ' rtl';

$admin_body_class .= ' branch-' . str_replace( array( '.', ',' ), '-', floatval( $nxt_version ) );
$admin_body_class .= ' version-' . str_replace( '.', '-', preg_replace( '/^([.0-9]+).*/', '$1', $nxt_version ) );
$admin_body_class .= ' admin-color-' . sanitize_html_class( get_user_option( 'admin_color' ), 'fresh' );

if ( $is_iphone ) { ?>
<style type="text/css">.row-actions{visibility:visible;}</style>
<?php } ?>
</head>
<body class="nxt-admin no-js <?php echo apply_filters( 'admin_body_class', '' ) . " $admin_body_class"; ?>">
<script type="text/javascript">document.body.className = document.body.className.replace('no-js','js');</script>

<div id="nxtwrap">
<?php require(ABSPATH . 'nxt-admin/menu-header.php'); ?>
<div id="nxtcontent">

<?php
do_action('in_admin_header');
?>

<div id="nxtbody">
<?php
unset($title_class, $blog_name, $total_update_count, $update_title);

$current_screen->set_parentage( $parent_file );

?>

<div id="nxtbody-content">
<?php

$current_screen->render_screen_meta();

if ( is_network_admin() )
	do_action('network_admin_notices');
elseif ( is_user_admin() )
	do_action('user_admin_notices');
else
	do_action('admin_notices');

do_action('all_admin_notices');

if ( $parent_file == 'options-general.php' )
	require(ABSPATH . 'nxt-admin/options-head.php');
