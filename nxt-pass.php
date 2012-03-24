<?php
/**
 * Creates the password cookie and redirects back to where the
 * visitor was before.
 *
 * @package NXTClass
 */

/** Make sure that the NXTClass bootstrap has run before continuing. */
require( dirname(__FILE__) . '/nxt-load.php');

// 10 days
setcookie('nxt-postpass_' . COOKIEHASH, stripslashes( $_POST['post_password'] ), time() + 864000, COOKIEPATH);

nxt_safe_redirect(nxt_get_referer());
exit;
?>
