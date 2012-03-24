<?php
/**
 * Front to the NXTClass application. This file doesn't do anything, but loads
 * nxt-blog-header.php which does and tells NXTClass to load the theme.
 *
 * @package NXTClass
 */

/**
 * Tells NXTClass to load the NXTClass theme and output it.
 *
 * @var bool
 */
define('nxt_USE_THEMES', true);

/** Loads the NXTClass Environment and Template */
require('./nxt-blog-header.php');
?>