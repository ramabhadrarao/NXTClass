<?php

/*
Plugin Name: CKEditor for NXTClass
Plugin URI: http://nxtclass.ckeditor.com/
Description: Replaces the default NXTClass editor with <a href="http://ckeditor.com/"> CKEditor</a>
Version: 3.6.3
Author: CKSource
Author URI: http://cksource.com/
*/

add_action('init', 'ckeditor_init');

function ckeditor_init(){
	global $ckeditor_nxtclass;
	require_once 'ckeditor_class.php';
	require_once ABSPATH . 'nxt-admin/includes/plugin.php';

	if(is_admin()){
		add_action('admin_menu', array(&$ckeditor_nxtclass, 'add_option_page'));
		add_action('admin_head', array(&$ckeditor_nxtclass, 'add_admin_head'));
		add_action('personal_options_update', array(&$ckeditor_nxtclass, 'user_personalopts_update'));
		add_action('admin_print_scripts', array(&$ckeditor_nxtclass, 'add_post_js'));
		add_action('admin_print_footer_scripts', array(&$ckeditor_nxtclass, 'remove_tinymce'));
	}

	add_action( 'nxt_print_scripts', array(&$ckeditor_nxtclass, 'add_comment_js'));
	add_filter( 'ckeditor_external_plugins', array(&$ckeditor_nxtclass, 'ckeditor_nxtmore_plugin') );
	add_filter( 'ckeditor_buttons', array(&$ckeditor_nxtclass, 'ckeditor_nxtmore_button') );
	add_filter( 'ckeditor_external_plugins', array(&$ckeditor_nxtclass, 'ckeditor_nxtgallery_plugin') );
	add_filter( 'ckeditor_load_lang_options', array(&$ckeditor_nxtclass, 'ckeditor_load_lang_options') );

	//add filter to change content before insert/update to database - needed for nxteditimage plugin
	add_filter( 'nxt_insert_post_data' , array(&$ckeditor_nxtclass, 'ckeditor_insert_post_data_filter'));

	/** temporary for vvq **/
	add_filter( 'ckeditor_external_plugins', array(&$ckeditor_nxtclass, 'ckeditor_externalvvq_plugin') );
	add_filter( 'ckeditor_buttons', array(&$ckeditor_nxtclass, 'ckeditor_vvqbuttons') );
	/** temporary for nxtpoll **/
	add_filter( 'ckeditor_external_plugins', array(&$ckeditor_nxtclass, 'nxtpoll_external') );
	add_filter( 'ckeditor_buttons', array(&$ckeditor_nxtclass, 'nxtpoll_buttons') );

	/** temporary for ngggallery **/
	include_once(dirname(__FILE__) . '/plugins/nggallery/ckeditor.php');

	/** temporary for gd-star-rating **/
	add_filter( 'ckeditor_external_plugins', array(&$ckeditor_nxtclass, 'starrating_external_plugin') );
	add_filter( 'ckeditor_buttons', array(&$ckeditor_nxtclass, 'starrating_buttons') );
}
?>
