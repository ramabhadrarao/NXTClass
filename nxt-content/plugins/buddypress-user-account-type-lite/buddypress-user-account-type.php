<?php
/* Plugin Name: Buddypress User Account type lite
 * Plugin URI: http://rimonhabib.com
 * Description: This plugin allow you to make user acount type
 * Version: 1.0
 * Author: Rimon_Habib
 * Author URI: http://rimonhabib.com
 * Tag: Buddypress, User account type
 */


register_activation_hook( __FILE__,'buat_activate');

register_deactivation_hook( __FILE__,'buat_deactivate');


function buat_activate()
{
    
}


function buat_deactivate()
{
    
}
include_once( ABSPATH . 'nxt-admin/includes/plugin.php' );
if(is_admin()) 
{
if(is_plugin_active('buddypress/bp-loader.php'))
{
require_once (dirname(__FILE__) .'/admin-menu/admin-menu.php');

}
else
{
    function buat_error_notice()
    {
        echo '<div class="error">
       <p>You must need to install and active <strong><a href="'.site_url().'/nxt-admin/plugin-install.php?tab=search&type=term&s=buddypress&plugin-search-input=Search+Plugins">
        Buddypress</strong></a> to use <strong>Buddypress User Account Type </strong> plugin </p>
    </div>';
    }
    add_action('admin_notices', 'buat_error_notice');
}
}
require_once (dirname(__FILE__) .'/buat_functions.php');
?>