<?php
/**
 * Upgrade NXTClass Page.
 *
 * @package NXTClass
 * @subpackage Administration
 */

/**
 * We are upgrading NXTClass.
 *
 * @since 1.5.1
 * @var bool
 */
define( 'nxt_INSTALLING', true );

/** Load NXTClass Bootstrap */
require( '../nxt-load.php' );

timer_start();
require_once( ABSPATH . 'nxt-admin/includes/upgrade.php' );

delete_site_transient('update_core');

if ( isset( $_GET['step'] ) )
	$step = $_GET['step'];
else
	$step = 0;

// Do it.  No output.
if ( 'upgrade_db' === $step ) {
	nxt_upgrade();
	die( '0' );
}

$step = (int) $step;

$php_version    = phpversion();
$mysql_version  = $nxtdb->db_version();
$php_compat     = version_compare( $php_version, $required_php_version, '>=' );
if ( file_exists( nxt_CONTENT_DIR . '/db.php' ) && empty( $nxtdb->is_mysql ) )
	$mysql_compat = true;
else
	$mysql_compat = version_compare( $mysql_version, $required_mysql_version, '>=' );

@header( 'Content-Type: ' . get_option( 'html_type' ) . '; charset=' . get_option( 'blog_charset' ) );
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php echo get_option( 'blog_charset' ); ?>" />
	<title><?php _e( 'NXTClass &rsaquo; Update' ); ?></title>
	<?php
	nxt_admin_css( 'install', true );
	nxt_admin_css( 'ie', true );
	?>
</head>
<body>
<h1 id="logo"><img alt="NXTClass" src="images/nxtclass-logo.png" /></h1>

<?php if ( get_option( 'db_version' ) == $nxt_db_version || !is_blog_installed() ) : ?>

<h2><?php _e( 'No Update Required' ); ?></h2>
<p><?php _e( 'Your NXTClass database is already up-to-date!' ); ?></p>
<p class="step"><a class="button" href="<?php echo get_option( 'home' ); ?>/"><?php _e( 'Continue' ); ?></a></p>

<?php elseif ( !$php_compat || !$mysql_compat ) :
	if ( !$mysql_compat && !$php_compat )
		printf( __('You cannot update because <a href="http://codex.nxtclass.org/Version_%1$s">NXTClass %1$s</a> requires PHP version %2$s or higher and MySQL version %3$s or higher. You are running PHP version %4$s and MySQL version %5$s.'), $nxt_version, $required_php_version, $required_mysql_version, $php_version, $mysql_version );
	elseif ( !$php_compat )
		printf( __('You cannot update because <a href="http://codex.nxtclass.org/Version_%1$s">NXTClass %1$s</a> requires PHP version %2$s or higher. You are running version %3$s.'), $nxt_version, $required_php_version, $php_version );
	elseif ( !$mysql_compat )
		printf( __('You cannot update because <a href="http://codex.nxtclass.org/Version_%1$s">NXTClass %1$s</a> requires MySQL version %2$s or higher. You are running version %3$s.'), $nxt_version, $required_mysql_version, $mysql_version );
?>
<?php else :
switch ( $step ) :
	case 0:
		$goback = stripslashes( nxt_get_referer() );
		$goback = esc_url_raw( $goback );
		$goback = urlencode( $goback );
?>
<h2><?php _e( 'Database Update Required' ); ?></h2>
<p><?php _e( 'NXTClass has been updated! Before we send you on your way, we have to update your database to the newest version.' ); ?></p>
<p><?php _e( 'The update process may take a little while, so please be patient.' ); ?></p>
<p class="step"><a class="button" href="upgrade.php?step=1&amp;backto=<?php echo $goback; ?>"><?php _e( 'Update NXTClass Database' ); ?></a></p>
<?php
		break;
	case 1:
		nxt_upgrade();

			$backto = !empty($_GET['backto']) ? stripslashes( urldecode( $_GET['backto'] ) ) :  __get_option( 'home' ) . '/';
			$backto = esc_url( $backto );
			$backto = nxt_validate_redirect($backto, __get_option( 'home' ) . '/');
?>
<h2><?php _e( 'Update Complete' ); ?></h2>
	<p><?php _e( 'Your NXTClass database has been successfully updated!' ); ?></p>
	<p class="step"><a class="button" href="<?php echo $backto; ?>"><?php _e( 'Continue' ); ?></a></p>

<!--
<pre>
<?php printf( __( '%s queries' ), $nxtdb->num_queries ); ?>

<?php printf( __( '%s seconds' ), timer_stop( 0 ) ); ?>
</pre>
-->

<?php
		break;
endswitch;
endif;
?>
</body>
</html>
