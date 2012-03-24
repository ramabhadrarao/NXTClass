<?php



function register_buat_admin_page()



{

add_submenu_page('bp-general-settings', "User Account Type", "User Account Type", 10, "user-account-type", 'buat_admin_page');

}



add_action('admin_menu', 'register_buat_admin_page');







function buat_admin_page()

{

    global $nxtdb;

    if($_POST['buat_type_field'] && $_POST['buat_type_field']!='DEFAULT')

    {

        update_option('buat_type_field', $_POST['buat_type_field']);

    }



    if($_POST['buat_default_type'])

    {

        update_option('buat_default_type_new',$_POST['buat_default_type']);

    }



    $query="SELECT * FROM ".$nxtdb->base_prefix."bp_xprofile_fields WHERE type='selectbox'";

    $fields=$nxtdb->get_results($query,ARRAY_A);



    ?>



<h3>Buddypress User Account Type Settings</h3>

<?php if(count($fields)<=0) { ?>

<h4>Theres no Select Box field found at Buddypress profile fields,<br>

Create a select box type profile filed from Buddypress->profile fields to configure account type</h4>



<?php } else { ?>

<form name="buat_admin_form" id="buat_admin_form" action="" method="post">

    <h4>Select field for account type:</h4>

    <select name="buat_type_field" onchange="document.buat_admin_form.submit()" style="min-width:150px ">

        <option value="DEFAULT"> ----------- </option>    

    <?php 

        $buat_type_field=get_option('buat_type_field');

        foreach($fields as $field) : 

        if($buat_type_field==$field['id'] && $_POST['buat_type_field'] != 'DEFAULT')

            $is_selected="selected";

        ?>

        <option value="<?php echo $field['id']; ?>" <?php echo "  $is_selected";  ?> ><?php echo $field['name'] ?></option>

        <?php 
        $is_selected='';
        endforeach; ?>

    </select>

    <input type="hidden" name="buat_is_submitted" value="true" />

    <?php 

    if(($_POST['buat_type_field']!="DEFAULT" && $_POST['buat_is_submitted']) || $buat_type_field)

    {



        if($_POST['buat_type_field'])



        {



        $fid=$_POST['buat_type_field'];



        }



        else {



        $fid=$buat_type_field;    



        }

        $query="SELECT * FROM ".$nxtdb->base_prefix."bp_xprofile_fields WHERE type='option' AND parent_id='".$fid."'";

        $options=$nxtdb->get_results($query,ARRAY_A);

     
if($_POST['buat_type_field']!='DEFAULT')
{
   ?> 
    <h4>Default type</h4>

<?php   $buat_default_type=get_option('buat_default_type_new','NO_VALUE'); ?>

    <select name="buat_default_type" style="min-width:150px ">

        <?php 

         foreach($options as $option) : 

        if($buat_default_type==$option['id'])
         {
            $is_default_selected="selected='selected'";
         }

        ?>

        <option value="<?php echo $option['id']; ?>"  <?php  echo $is_default_selected  ?> ><?php echo $option['name'] ?></option>

       <?php 
       $is_default_selected='';
       $option_name=$option['name'];

       $short_codes="[bp_user_account_type type=\"$option_name\"] , ".$short_codes; ?>

        <?php endforeach; ?>

    </select>

        <p>Create new pages and use these short codes to get member pages according to user types </p>

        <p><?php echo $short_codes ?></p>

   <?php

    }
}
    ?>

        <br>

    <input type="submit" value="Update Option" />

</form>

<?php }

}

?>