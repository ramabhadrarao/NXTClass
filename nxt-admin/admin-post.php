<?php
/**
 * NXTClass Administration Generic POST Handler.
 *
 * @package NXTClass
 * @subpackage Administration
 */

/** We are located in NXTClass Administration Screens */
define('nxt_ADMIN', true);

if ( defined('ABSPATH') )
	require_once(ABSPATH . 'nxt-load.php');
else
	require_once('../nxt-load.php');

require_once(ABSPATH . 'nxt-admin/includes/admin.php');

nocache_headers();

do_action('admin_init');

$action = 'admin_post';

if ( !nxt_validate_auth_cookie() )
	$action .= '_nopriv';

if ( !empty($_REQUEST['action']) )
	$action .= '_' . $_REQUEST['action'];

do_action($action);

?>