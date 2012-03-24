<?php
/**
 * Used to be the page which displayed the registration form.
 *
 * This file is no longer used in NXTClass and is
 * deprecated.
 *
 * @package NXTClass
 * @deprecated Use nxt_register() to create a registration link instead
 */

require('./nxt-load.php');
nxt_redirect( site_url('nxt-login.php?action=register') );
exit;
?>
