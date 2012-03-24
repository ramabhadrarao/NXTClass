<?php

/*
 * Function Name: buat_shortcode_grabber()
 * Description: This function reads shortcodes from page and call template function according to user type
 */

function buat_shortcode_grabber( $atts ) {
    
        $buat_default_type=get_option('buat_default_type');
	extract( shortcode_atts( array(
		'type' => "$buat_default_type",
		
	), $atts ) );
        if(!is_plugin_active('buddypress/bp-loader.php'))
            {
            echo 'You must need to install and active <a href="http://buddypress.org">Buddypress</a> 
                to use Buddypress User Account Type plugin';
            }
            else   
            {
            buat_get_user_template($type);
            }
        
}
add_shortcode( 'bp_user_account_type', 'buat_shortcode_grabber' );




function buat_get_user_template($type)
{
    $filtered_users=buat_gather_user_ids($type);
     if ( bp_has_members("include=$filtered_users&type=alphabetical") ) : ?>
 
    <div class="pagination">
 
        <div class="pag-count" id="member-dir-count">
            <?php bp_members_pagination_count() ?>
        </div>
 
        <div class="pagination-links" id="member-dir-pag">
            <?php bp_members_pagination_links() ?>
        </div>
 
    </div>
 
    <?php do_action( 'bp_before_directory_members_list' ) ?>
 
    <ul id="members-list" class="item-list" style="list-style-type:none; margin: 0; width: auto">
    <?php while ( bp_members() ) : bp_the_member(); ?>
 
        <li>
            <div class="item-avatar">
                <a href="<?php bp_member_permalink() ?>"><?php bp_member_avatar() ?></a>
            </div>
 
            <div class="item">
                <div class="item-title">
                    <a href="<?php bp_member_permalink() ?>"><?php bp_member_name() ?></a>
                    <?php if ( bp_get_member_latest_update() ) : ?>
                        <span class="update"> - <?php bp_member_latest_update( 'length=10' ) ?></span>
                    <?php endif; ?>
                </div>
                <div class="item-meta"><span class="activity"><?php bp_member_last_active() ?></span></div>
 
                <?php do_action( 'bp_directory_members_item' ) ?>
 
                <?php
                 /***
                  * If you want to show specific profile fields here you can,
                  * but it'll add an extra query for each member in the loop
                  * (only one regadless of the number of fields you show):
                  *
                  * bp_member_profile_data( 'field=the field name' );
                  */
                ?>
            </div>
 
            <div class="action">
                <?php do_action( 'bp_directory_members_actions' ) ?>
            </div>
 
            <div class="clear"></div>
        </li>
 
    <?php endwhile; ?>
    </ul>
 
    <?php do_action( 'bp_after_directory_members_list' ) ?>
 
    <?php bp_member_hidden_fields() ?>
 
<?php else: ?>
 
    <div id="message" class="info">
        <p><?php _e( "Sorry, no members were found.", 'buddypress' ) ?></p>
    </div>
 
<?php endif; 

    
}


function buat_gather_user_ids($type)
{
    global $nxtdb;
    $fid=get_option('buat_type_field');
    
    $query= "SELECT * FROM ".$nxtdb->base_prefix."bp_xprofile_data WHERE field_id='$fid' AND value='$type'";
    $xpro_data=$nxtdb->get_results($query,ARRAY_A);
    $id_string='';
    foreach ($xpro_data as $gather_data)
    {
       $id_string.=$gather_data['user_id'].",";
    }
    
    $id_string=substr($id_string,0,strlen($id_string)-1 );
    return $id_string;
    
}

?>