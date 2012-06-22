<?php
/*
Plugin Name: nxt-Math-2
Plugin URI: http://cn.programmingnote.com/blog/?p=185
Description: This plugin allows you write mathematical formula in TeX (or LaTeX) format. It parses math input such as <code>$$...$$</code> and <code>$...$</code> into HTML (if you use your browser visit it directly) or an image (if you read posts via RSS Reader which can't execute any javascript from the NXTClass site).
Author: Woody Wang
Version: 0.1
Author URI: http://cn.programmingnote.com/blog/
*/

/**
 * Define the height of the inline math formula images.
 */
define('MATH_IMG_INLINE_HEIGHT', '20');

/**
 * Set the math images fore color.
 */
define('MATH_IMG_COLOR', '000000');

/**
 * The the background color of math images.
 */
define('MATH_IMG_BACKGROUND_COLOR', 'FFFFFF');

include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'nxt-math-2-formula-class.php';

function nxt_mathjax_init() {
	$siteurl = get_option('siteurl');
	$siteurl = rtrim($siteurl, '/');
	nxt_enqueue_script('mathjax', 'http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML');
}

function nxt_mathjax_config()
{
	echo <<<EOT
<script type="text/javascript">
MathJax.Hub.Config({
  tex2jax: {
    inlineMath: [ ['$','$'], ["\\(","\\)"] ],
    processEscapes: true
  }
});
</script>
EOT;
}

function nxt_math_img_filter($content)
{
	$formulaImg = nxt_Math_2_Formula::getInstance();
	
	if(defined('MATH_IMG_BACKGROUND_COLOR'))
	{
		$formulaImg->setBackground(MATH_IMG_BACKGROUND_COLOR);
	}
	if(defined('MATH_IMG_COLOR'))
	{
		$formulaImg->setColor(MATH_IMG_COLOR);
	}
	
	$content = preg_replace_callback('/\$\$\s*(.+?)\s*\$\$/s', '_nxt_math_img_block_render', $content);
	$content = preg_replace_callback('/\$\s*(.+?)\s*\$/s', '_nxt_math_img_inline_render', $content);
	return $content;
}

function _nxt_math_img_block_render($match)
{
	$formulaImg = nxt_Math_2_Formula::getInstance();
	$formulaImg->setFormula($match[1]);
	$formulaImg->setHeight(NULL);
	return '<div style="text-align: center;"><img src="' . $formulaImg->getUrl() . '" /></div>';
}

function _nxt_math_img_inline_render($match)
{
	$formulaImg = nxt_Math_2_Formula::getInstance();
	if(defined('MATH_IMG_INLINE_HEIGHT'))
	{
		$formulaImg->setHeight(MATH_IMG_INLINE_HEIGHT);
	}
	$formulaImg->setFormula($match[1]);
	return '<img src="' . $formulaImg->getUrl() . '" />';
}

remove_filter('the_content', 'nxttexturize');
add_filter('the_content_feed', 'nxt_math_img_filter');
add_filter('the_comment_rss', 'nxt_math_img_filter');
add_filter('the_excerpt_rss', 'nxt_math_img_filter');

add_action('init', 'nxt_mathjax_init');
add_action('nxt_head', 'nxt_mathjax_config');
