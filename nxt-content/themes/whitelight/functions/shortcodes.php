<?php

/* ------------------------------------------------
   Theme Shortcodes
---------------------------------------------------
 
   
 TABLE OF CONTENTS
 
     0.0 - Shotcode Setup
     1.0 - CSS Columns 
   
   
------------------------------------------------ */



/* ------------------------------------------------
  0.0 Setup nxt For Shortcodes
------------------------------------------------ */

function huddle_shortcode_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= nxttexturize(nxtautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content', 'nxtautop');
remove_filter('the_content','nxttexturize');

add_filter('the_content', 'huddle_shortcode_formatter', 99);



/* ------------------------------------------------
  1.0 CSS Columns
------------------------------------------------ */

function huddle_one_third( $atts, $content = null ) {
	return '<div class="one_third">' . do_shortcode($content) . '</div>';
	}
add_shortcode('one_third', 'huddle_one_third');


function huddle_one_third_last( $atts, $content = null ) {
	return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('one_third_last', 'huddle_one_third_last');


function huddle_two_third( $atts, $content = null ) {
	return '<div class="two_third">' . do_shortcode($content) . '</div>';
	}
add_shortcode('two_third', 'huddle_two_third');


function huddle_two_third_last( $atts, $content = null ) {
	return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('two_third_last', 'huddle_two_third_last');


function huddle_one_half( $atts, $content = null ) {
	return '<div class="one_half">' . do_shortcode($content) . '</div>';
	}
add_shortcode('one_half', 'huddle_one_half');


function huddle_one_half_last( $atts, $content = null ) {
	return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('one_half_last', 'huddle_one_half_last');


function huddle_one_fourth( $atts, $content = null ) {
	return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
	}
add_shortcode('one_fourth', 'huddle_one_fourth');


function huddle_one_fourth_last( $atts, $content = null ) {
	return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('one_fourth_last', 'huddle_one_fourth_last');


function huddle_three_fourth( $atts, $content = null ) {
	return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
	}
add_shortcode('three_fourth', 'huddle_three_fourth');


function huddle_three_fourth_last( $atts, $content = null ) {
	return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('three_fourth_last', 'huddle_three_fourth_last');


function huddle_one_fifth( $atts, $content = null ) {
	return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
	}
add_shortcode('one_fifth', 'huddle_one_fifth');


function huddle_one_fifth_last( $atts, $content = null ) {
	return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('one_fifth_last', 'huddle_one_fifth_last');


function huddle_two_fifth( $atts, $content = null ) {
	return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
	}
add_shortcode('two_fifth', 'huddle_two_fifth');


function huddle_two_fifth_last( $atts, $content = null ) {
	return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('two_fifth_last', 'huddle_two_fifth_last');


function huddle_three_fifth( $atts, $content = null ) {
	return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
	}
add_shortcode('three_fifth', 'huddle_three_fifth');


function huddle_three_fifth_last( $atts, $content = null ) {
	return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('three_fifth_last', 'huddle_three_fifth_last');


function huddle_four_fifth( $atts, $content = null ) {
	return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
	}
add_shortcode('four_fifth', 'huddle_four_fifth');


function huddle_four_fifth_last( $atts, $content = null ) {
	return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('four_fifth_last', 'huddle_four_fifth_last');


function huddle_one_sixth( $atts, $content = null ) {
	return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
	}
add_shortcode('one_sixth', 'huddle_one_sixth');


function huddle_one_sixth_last( $atts, $content = null ) {
	return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('one_sixth_last', 'huddle_one_sixth_last');


function huddle_five_sixth( $atts, $content = null ) {
	return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
	}
add_shortcode('five_sixth', 'huddle_five_sixth');


function huddle_five_sixth_last( $atts, $content = null ) {
	return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
	}
add_shortcode('five_sixth_last', 'huddle_five_sixth_last');


?>