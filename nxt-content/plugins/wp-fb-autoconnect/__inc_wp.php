<?php
/*
 * This file tries to include the nxtclass header by searching UP the directory structure
 */
$searchFile = 'nxt-blog-header.php';
for($i = 0; $i < 10; $i++)
{
    if( file_exists($searchFile) )
    {
        require_once($searchFile);
        break;    
    }
    $searchFile = "../" . $searchFile;
}

//Make sure we got it
if( !defined('nxtINC') )
{
    if( function_exists('j_die') ) j_die("Failed to locate nxt-blog-header.php.");
    else                           die(  "Failed to locate nxt-blog-header.php.");
}

//Include the User Registration code so we can use nxt_insert_user
if( !function_exists('nxt_insert_user') )
    require_once(ABSPATH . nxtINC . '/registration.php');
if( !function_exists('nxt_insert_user') )
{
    if( function_exists('j_die') ) j_die("Failed to include registration.php.");
    else                           die(  "Failed to include registration.php.");
}


?>