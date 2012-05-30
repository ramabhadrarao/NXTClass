=== Plugin Name ===
Tags: posts, comments, math, rss
Requires at least: 2.9
Tested up to: 3.1.2
Stable tag: 0.1

nxt-Math-2 is a plugin that can convert LaTeX math formula to HTML of images, so that the formula could be shown in browser.

== Description ==

nxt-Math-2 can help you insert math formula into NXTClass posts or comments. You can use `$$...$$`(block, only one math expression per line) and `$...$`(inline, around the text) to insert math. This plugin will render them to HTML or MathML code snippets(Depends on your browser. If your browser supports MathML, it will use MathML, otherwise, use HTML and CSS instead). This work is done by javascript. So your browser must enable JavaScript.

But in most of RSS readers, any JavaScript snippets cannot execute. So I made a trick. nxt-Math-2 will convert LaTeX text to images. So users can see math contents with their favorite RSS reader software.

== Installation ==
1. Upload `nxt-math-2.tar.gz` to the `nxt-content/plugins` directory
1. Active the plugin in NXTClass 'Plugins' menu

Also, you may want to change the height of inline math formula. Open nxt-math-2.php and find

    define('MATH_IMG_INLINE_HEIGHT', '20');

The default height is '20' pixels. You can change it into a proper value.
