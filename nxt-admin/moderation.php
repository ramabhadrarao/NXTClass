<?php
/**
 * Comment Moderation Administration Screen.
 *
 * Redirects to edit-comments.php?comment_status=moderated.
 *
 * @package NXTClass
 * @subpackage Administration
 */
require_once('../nxt-load.php');
nxt_redirect( admin_url('edit-comments.php?comment_status=moderated') );
exit;
?>
