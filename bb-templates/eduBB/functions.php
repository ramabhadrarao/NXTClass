<?php


/////////////////////////////////////////////////////////////
// load admin style for theme option
/////////////////////////////////////////////////////////////
function bb_option_admin_style() {
?>
<link rel="stylesheet" href="<?php bb_active_theme_uri(); ?>bb-admin-style.css" type="text/css" />

<?php if($_GET["plugin"] == "bboption") { ?>
<script type="text/javascript" src="<?php bb_active_theme_uri(); ?>js/jscolor.js"></script>
<script type="text/javascript" src="<?php bb_active_theme_uri(); ?>js/jquery.js"></script>
<?php } ?>

<?php }

add_action( 'bb_admin_head', 'bb_option_admin_style' );


///////////////////////////////////////////////////////////////
// get poster time since
////////////////////////////////////////////////////////////////
function aposttime ( $dtformat = "jS F Y" ) {
global $bb_post;
$aposttime = date( $dtformat, strtotime( $bb_post->post_time ) );
echo $aposttime;
}



///////////////////////////////////////////////////////////////
// using the basic prinsipal of nxt theme options
// start bb theme option
// Developed by Richie_KS (Richard Kiew) Dezzain.com (incsub)
////////////////////////////////////////////////////////////////

$themename = "EduBB";
$shortname = "bb";
$shortprefix = "_edubb_";

$bb_option = array (


    array(  "name" => "Select your global body font",
            "id" => $shortname . $shortprefix . "body_font",
            "inblock" => "font",
            "type" => "select",
            "std" => "Helvetica, Arial, sans-serif",
			"value" => array(
            "Helvetica, Arial, sans-serif",
            "Helvetica LT Light, Helvetica, Arial",
            "Univers LT 55, Lucida Grande, Lucida Sans",
            "Arial, Verdana, Times New Roman, sans-serif",
            "Verdana, Arial, Times New Roman, sans-serif",
            "Calibri, Helvetica, Trebuchet MS",
            "Lucida Grande, Verdana, Tahoma, Trebuchet MS",
            "Times New Roman, Georgia, Tahoma, Trajan Pro",
            "Georgia, Times New Roman, Helvetica, sans-serif",
            "Cambria, Georgia, Times New Roman",
            "Futura LT Book, Helvetica Neue, Tahoma, Georgia",
            "Tahoma, Lucida Sans, Arial",
            "Lucida Sans, Lucida Grande, Trebuchet MS",
            "Century Gothic, Century, Georgia, Times New Roman",
            "Arial Rounded MT Bold, Arial, Verdana, sans-serif",
            "Trebuchet MS, Arial, Verdana, Helvetica, sans-serif",
            "Qlassik Bold, Qlassik Medium, Trebuchet MS",
            "Delicious, Delicious Heavy, Decker, Denmark",
            "Helvetica Neue, Helvetica LT Std Cond, Helvetica-Normal",
            "Humana Sans ITC, Humana Sans Md ITC, Lucida Grande, Georgia",
            "Qlassik Bold, Qlassik Medium, Trebuchet MS, Tahoma, Arial",
            "Trebuchet MS, Arial, Verdana, Helvetica, sans-serif",
            "Myriad Pro, Myriad Pro Black SemiExt, Trebuchet MS, Tahoma",
            "Anivers, Trebuchet MS, Tahoma",
            "Geneva, Arial, Verdana, sans-serif"
            )
            ),



    array(  "name" => "Select your global headline (h1,h2,h3...) font",
            "id" => $shortname . $shortprefix . "headline_font",
            "inblock" => "font",
            "type" => "select",
            "std" => "Helvetica, Arial, sans-serif",
			"value" => array(
            "Helvetica, Arial, sans-serif",
            "Helvetica LT Light, Helvetica, Arial",
            "Univers LT 55, Lucida Grande, Lucida Sans",
            "Arial, Verdana, Times New Roman, sans-serif",
            "Verdana, Arial, Times New Roman, sans-serif",
            "Calibri, Helvetica, Trebuchet MS",
            "Lucida Grande, Verdana, Tahoma, Trebuchet MS",
            "Times New Roman, Georgia, Tahoma, Trajan Pro",
            "Georgia, Times New Roman, Helvetica, sans-serif",
            "Cambria, Georgia, Times New Roman",
            "Futura LT Book, Helvetica Neue, Tahoma, Georgia",
            "Tahoma, Lucida Sans, Arial",
            "Lucida Sans, Lucida Grande, Trebuchet MS",
            "Century Gothic, Century, Georgia, Times New Roman",
            "Arial Rounded MT Bold, Arial, Verdana, sans-serif",
            "Trebuchet MS, Arial, Verdana, Helvetica, sans-serif",
            "Qlassik Bold, Qlassik Medium, Trebuchet MS",
            "Delicious, Delicious Heavy, Decker, Denmark",
            "Helvetica Neue, Helvetica LT Std Cond, Helvetica-Normal",
            "Humana Sans ITC, Humana Sans Md ITC, Lucida Grande, Georgia",
            "Qlassik Bold, Qlassik Medium, Trebuchet MS, Tahoma, Arial",
            "Trebuchet MS, Arial, Verdana, Helvetica, sans-serif",
            "Myriad Pro, Myriad Pro Black SemiExt, Trebuchet MS, Tahoma",
            "Anivers, Trebuchet MS, Tahoma",
            "Geneva, Arial, Verdana, sans-serif"
            )
            ),


    array ( "name" => __("Choose your global <strong>link</strong> color"),
            "id" => $shortname . $shortprefix . "global_link_color",
            "inblock" => "font",
            "std" => "",
            "type" => "colorpicker"),

   array ( "name" => __("Choose your global <strong>link hover</strong> color"),
            "id" => $shortname . $shortprefix . "global_link_hover_color",
            "inblock" => "font",
            "std" => "",
            "type" => "colorpicker"),


    array( "name" => "Edit your navigation links here <em>*html allowed</em><br /><span>can add more to 5-8 links</span>",
		   "id" => $shortname . $shortprefix . "nav_links",
           "inblock" => "navigation",
"std" => "<li><a title='custom-title' href='http://linkto/'>link1</a></li>
<li><a title='custom-title' href='http://linkto/'>link2</a></li>
<li><a title='custom-title' href='http://linkto/'>link3</a></li>
<li><a title='custom-title' href='http://linkto/'>link4</a></li>
           ",
           "type" => "textarea"),



    array( "name" => "If you want to used logo instead of header title, insert your logo full img url here<br /><em>sample: http://mysite.com/logo.gif</em><br /><span>*only url allowed</span>",
		   "id" => $shortname . $shortprefix . "header_logo",
           "inblock" => "header",
           "std" => "",
           "type" => "text"),


    array ( "name" => __("Choose your <strong>top header</strong> background color"),
            "id" => $shortname . $shortprefix . "top_header_bg_color",
            "inblock" => "header",
            "std" => "",
            "type" => "colorpicker"),


    array( "name" => "Insert your header welcome text here<br /><em>sample: hello welcome to my forum...</em><br /><span>*html allowed</span>",
		   "id" => $shortname . $shortprefix . "header_welcome_text",
           "inblock" => "header",
           "std" => "",
           "type" => "textarea"),

    array ( "name" => __("Choose your forum header &amp footer <strong>background</strong> color"),
            "id" => $shortname . $shortprefix . "header_color",
            "inblock" => "header",
            "std" => "",
            "type" => "colorpicker"),

    array ( "name" => __("Choose your forum header &amp footer <strong>border</strong> color"),
            "id" => $shortname . $shortprefix . "header_border_color",
            "inblock" => "header",
            "std" => "",
            "type" => "colorpicker"),


    array ( "name" => __("Choose your forum header &amp footer <strong>text</strong> color"),
            "id" => $shortname . $shortprefix . "header_text_color",
            "inblock" => "header",
            "std" => "",
            "type" => "colorpicker"),

    array ( "name" => __("Choose your forum header &amp footer text <strong>link</strong> color"),
            "id" => $shortname . $shortprefix . "header_text_link_color",
            "inblock" => "header",
            "std" => "",
            "type" => "colorpicker"),

    array ( "name" => __("Choose your forum header &amp footer text <strong>hover link</strong> color"),
            "id" => $shortname . $shortprefix . "header_text_hover_link_color",
            "inblock" => "header",
            "std" => "",
            "type" => "colorpicker"),




    array ( "name" => __("Choose your searchbar bg color"),
            "id" => $shortname . $shortprefix . "searchbar_bg_color",
            "inblock" => "searchbar",
            "std" => "",
            "type" => "colorpicker"),

    array ( "name" => __("Choose your searchbar border color"),
            "id" => $shortname . $shortprefix . "searchbar_border_color",
            "inblock" => "searchbar",
            "std" => "",
            "type" => "colorpicker"),




    array ( "name" => __("Choose your forums <strong>bg hover and sticky bg</strong> color"),
            "id" => $shortname . $shortprefix . "active_forum_hover_bg_color",
            "inblock" => "forum",
            "std" => "",
            "type" => "colorpicker"),


    array ( "name" => __("Choose your forums post <strong>alt bg</strong> color"),
            "id" => $shortname . $shortprefix . "active_forum_alt_bg_color",
            "inblock" => "forum",
            "std" => "",
            "type" => "colorpicker"),

    array ( "name" => __("Choose your forum <strong>sticky border</strong> color <br /><small>*slightly stronger color than forums <strong>bg hover and sticky bg</strong> should do it</small>"),
            "id" => $shortname . $shortprefix . "sticky_border_color",
            "inblock" => "forum",
            "std" => "",
            "type" => "colorpicker"),



 //bg image

   array (	"name" => __("If you want to use an image as the background, enter the image full url here:<br /><em>sample: http://mysite.com/images/mybg.gif</em><br /><span>*only url allowed</span>"),
			"id" => $shortname . $shortprefix . "bg_image",
            "inblock" => "bg",
            "std" => "",
			"type" => "text"),

   array ( "name" => __("Choose your <strong>background</strong> color"),
            "id" => $shortname . $shortprefix . "wrap_bg_color",
            "inblock" => "bg",
            "std" => "",
            "type" => "colorpicker"),



array(
"name" => __("Background Images Repeat"),
"id" => $shortname . $shortprefix . "bg_image_repeat",
"inblock" => "bg",
"type" => "select",
"std" => "no-repeat",
"value" => array("no-repeat","repeat","repeat-x","repeat-y")),


array(
"name" => __("Background Images Attachment"),
"id" => $shortname . $shortprefix . "bg_image_attachment",
"inblock" => "bg",
"type" => "select",
"std" => "fixed",
"value" => array("fixed", "scroll")),


array(
"name" => __("Background Images Horizontal Position"),
"id" => $shortname . $shortprefix . "bg_image_horizontal",
"inblock" => "bg",
"type" => "select",
"std" => "left",
"value" => array("left", "center", "right")),


array(
"name" => __("Background Images Vertical Position"),
"id" => $shortname . $shortprefix . "bg_image_vertical",
"inblock" => "bg",
"type" => "select",
"std" => "top",
"value" => array("top", "center", "bottom"))

);


function bboption() {
global $themename, $shortname, $shortprefix, $bb_option;
?>


<div id="wrap-admin">
<div id="content-admin">
<div id="top-content-admin">
<h4><?php echo $themename . __(' Theme Options'); ?></h4>
<p><?php _e('Customize Your BBpress site design below'); ?></p>
</div>


<div class="admin-content">

<?php
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>' . $themename . __(' settings saved.') . '</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>' . $themename . __(' settings reset.') . '</strong></p></div>';
?>

<form method="post" id="option-mz-form">


<div class="option-box">
<?php $inblock = 'font'; ?>
<h5><?php _e('Fonts Settings'); ?></h5>
<div class="option-box-wrap">
<?php foreach ($bb_option as $options) { ?>

<?php if (($options['inblock'] == $inblock) && ($options['type'] == "text")) { ?>
<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<div class="theme-type">
<input name="<?php echo $options['id']; ?>" class="ops-text" id="<?php echo $options['id']; ?>" type="<?php echo $options['type']; ?>" value="<?php if ( bb_get_option( $options['id'] ) != "") {
echo bb_get_option( $options['id'] );
} else {
echo $options['std']; } ?>" />
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "colorpicker") ) {  $i == $i++ ; ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?></div>
<div class="theme-type"><input class="color {required:false,hash:true}" name="<?php echo $options['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( bb_get_option( $options['id'] ) != "") { echo bb_get_option( $options['id'] ); } else { echo $options['std']; } ?>" /></div>
 </div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "textarea")) { ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<?php
$valuex = $options['value'];
$valuey = stripslashes($valuex);
$video_code = bb_get_option($options['id'] . ',' . $options['value'] );
?>
<div class="theme-type">
<textarea class="ops-area" name="<?php echo $options['id'];; ?>" cols="40%" rows="8" /><?php if ( bb_get_option( $options['id'] ) != "") { echo stripslashes($video_code);
} else { echo $options['std']; } ?>
</textarea>
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "select")) {  ?>

<div class="pwrap">
<div class="theme-title"> <?php echo $options['name']; ?>:</div>

<div class="theme-type"><select name="<?php echo $options['id']; ?>" class="ops-select" id="<?php echo $options['id']; ?>">

<?php foreach ($options['value'] as $option) { ?>

<option<?php if ( bb_get_option($options['id'])  == $option ) { echo ' selected="selected"'; } elseif ( $option == $options['std']) { echo ' selected="selected"'; } ?>>
<?php echo $option; ?></option>

<?php } ?>

</select>
</div></div>

<?php } } ?>
</div> <!-- end wrap -->
</div> <!-- end box -->


<div class="option-box">
<?php $inblock = 'bg'; ?>
<h5><?php _e('Background Image Settings'); ?></h5>
<div class="option-box-wrap">
<?php foreach ($bb_option as $options) { ?>

<?php if (($options['inblock'] == $inblock) && ($options['type'] == "text")) { ?>
<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<div class="theme-type">
<input name="<?php echo $options['id']; ?>" class="ops-text" id="<?php echo $options['id']; ?>" type="<?php echo $options['type']; ?>" value="<?php if ( bb_get_option( $options['id'] ) != "") {
echo bb_get_option( $options['id'] );
} else {
echo $options['std']; } ?>" />
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "colorpicker") ) {  $i == $i++ ; ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?></div>
<div class="theme-type"><input class="color {required:false,hash:true}" name="<?php echo $options['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( bb_get_option( $options['id'] ) != "") { echo bb_get_option( $options['id'] ); } else { echo $options['std']; } ?>" /></div>
 </div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "textarea")) { ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<?php
$valuex = $options['value'];
$valuey = stripslashes($valuex);
$video_code = bb_get_option($options['id'] . ',' . $options['value'] );
?>
<div class="theme-type">
<textarea class="ops-area" name="<?php echo $options['id'];; ?>" cols="40%" rows="8" /><?php if ( bb_get_option( $options['id'] ) != "") { echo stripslashes($video_code);
} else { echo $options['std']; } ?>
</textarea>
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "select")) {  ?>

<div class="pwrap">
<div class="theme-title"> <?php echo $options['name']; ?>:</div>

<div class="theme-type"><select name="<?php echo $options['id']; ?>" class="ops-select" id="<?php echo $options['id']; ?>">

<?php foreach ($options['value'] as $option) { ?>

<option<?php if ( bb_get_option($options['id'])  == $option ) { echo ' selected="selected"'; } elseif ( $option == $options['std']) { echo ' selected="selected"'; } ?>>
<?php echo $option; ?></option>

<?php } ?>

</select>
</div></div>

<?php } } ?>
</div> <!-- end wrap -->
</div>



<div class="option-box">
<?php $inblock = 'navigation'; ?>
<h5><?php _e('Navigation Settings'); ?></h5>
<div class="option-box-wrap">
<?php foreach ($bb_option as $options) { ?>

<?php if (($options['inblock'] == $inblock) && ($options['type'] == "text")) { ?>
<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<div class="theme-type">
<input name="<?php echo $options['id']; ?>" class="ops-text" id="<?php echo $options['id']; ?>" type="<?php echo $options['type']; ?>" value="<?php if ( bb_get_option( $options['id'] ) != "") {
echo bb_get_option( $options['id'] );
} else {
echo $options['std']; } ?>" />
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "colorpicker") ) {  $i == $i++ ; ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?></div>
<div class="theme-type"><input class="color {required:false,hash:true}" name="<?php echo $options['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( bb_get_option( $options['id'] ) != "") { echo bb_get_option( $options['id'] ); } else { echo $options['std']; } ?>" /></div>
 </div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "textarea")) { ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<?php
$valuex = $options['value'];
$valuey = stripslashes($valuex);
$video_code = bb_get_option($options['id'] . ',' . $options['value'] );
?>
<div class="theme-type">
<textarea class="ops-area" name="<?php echo $options['id'];; ?>" cols="40%" rows="8" /><?php if ( bb_get_option( $options['id'] ) != "") { echo stripslashes($video_code);
} else { echo $options['std']; } ?>
</textarea>
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "select")) {  ?>

<div class="pwrap">
<div class="theme-title"> <?php echo $options['name']; ?>:</div>

<div class="theme-type"><select name="<?php echo $options['id']; ?>" class="ops-select" id="<?php echo $options['id']; ?>">

<?php foreach ($options['value'] as $option) { ?>

<option<?php if ( bb_get_option($options['id'])  == $option) { echo ' selected="selected"'; } elseif ( $option ==  $options['std']) { echo ' selected="selected"'; } ?>>
<?php echo $option; ?></option>

<?php } ?>

</select>
</div></div>

<?php } } ?>
</div> <!-- end wrap -->
</div>


<div class="option-box">
<?php $inblock = 'media'; ?>
<h5><?php _e('Media Settings'); ?></h5>
<div class="option-box-wrap">
<?php foreach ($bb_option as $options) { ?>

<?php if (($options['inblock'] == $inblock) && ($options['type'] == "text")) { ?>
<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<div class="theme-type">
<input name="<?php echo $options['id']; ?>" class="ops-text" id="<?php echo $options['id']; ?>" type="<?php echo $options['type']; ?>" value="<?php if ( bb_get_option( $options['id'] ) != "") {
echo bb_get_option( $options['id'] );
} else {
echo $options['std']; } ?>" />
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "colorpicker") ) {  $i == $i++ ; ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?></div>
<div class="theme-type"><input class="color {required:false,hash:true}" name="<?php echo $options['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( bb_get_option( $options['id'] ) != "") { echo bb_get_option( $options['id'] ); } else { echo $options['std']; } ?>" /></div>
 </div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "textarea")) { ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<?php
$valuex = $options['value'];
$valuey = stripslashes($valuex);
$video_code = bb_get_option($options['id'] . ',' . $options['value'] );
?>
<div class="theme-type">
<textarea class="ops-area" name="<?php echo $options['id'];; ?>" cols="40%" rows="8" /><?php if ( bb_get_option( $options['id'] ) != "") { echo stripslashes($video_code);
} else { echo $options['std']; } ?>
</textarea>
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "select")) {  ?>

<div class="pwrap">
<div class="theme-title"> <?php echo $options['name']; ?>:</div>

<div class="theme-type"><select name="<?php echo $options['id']; ?>" class="ops-select" id="<?php echo $options['id']; ?>">

<?php foreach ($options['value'] as $option) { ?>

<option<?php if ( bb_get_option($options['id'])  == $option) { echo ' selected="selected"'; } elseif ( $option ==  $options['std']) { echo ' selected="selected"'; } ?>>
<?php echo $option; ?></option>

<?php } ?>

</select>
</div></div>

<?php } } ?>
</div> <!-- end wrap -->
</div>


<div class="option-box">
<?php $inblock = 'header'; ?>
<h5><?php _e('Header &amp Footer Settings'); ?></h5>
<div class="option-box-wrap">
<?php foreach ($bb_option as $options) { ?>

<?php if (($options['inblock'] == $inblock) && ($options['type'] == "text")) { ?>
<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<div class="theme-type">
<input name="<?php echo $options['id']; ?>" class="ops-text" id="<?php echo $options['id']; ?>" type="<?php echo $options['type']; ?>" value="<?php if ( bb_get_option( $options['id'] ) != "") {
echo bb_get_option( $options['id'] );
} else {
echo $options['std']; } ?>" />
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "colorpicker") ) {  $i == $i++ ; ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?></div>
<div class="theme-type"><input class="color {required:false,hash:true}" name="<?php echo $options['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( bb_get_option( $options['id'] ) != "") { echo bb_get_option( $options['id'] ); } else { echo $options['std']; } ?>" /></div>
 </div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "textarea")) { ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<?php
$valuex = $options['value'];
$valuey = stripslashes($valuex);
$video_code = bb_get_option($options['id'] . ',' . $options['value'] );
?>
<div class="theme-type">
<textarea class="ops-area" name="<?php echo $options['id'];; ?>" cols="40%" rows="8" /><?php if ( bb_get_option( $options['id'] ) != "") { echo stripslashes($video_code);
} else { echo $options['std']; } ?>
</textarea>
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "select")) {  ?>

<div class="pwrap">
<div class="theme-title"> <?php echo $options['name']; ?>:</div>

<div class="theme-type"><select name="<?php echo $options['id']; ?>" class="ops-select" id="<?php echo $options['id']; ?>">

<?php foreach ($options['value'] as $option) { ?>

<option<?php if ( bb_get_option($options['id'])  == $option) { echo ' selected="selected"'; } elseif ( $option ==  $options['std']) { echo ' selected="selected"'; } ?>>
<?php echo $option; ?></option>

<?php } ?>

</select>
</div></div>

<?php } } ?>
</div> <!-- end wrap -->
</div>


<div class="option-box">
<?php $inblock = 'searchbar'; ?>
<h5><?php _e('Searchbar Settings'); ?></h5>
<div class="option-box-wrap">
<?php foreach ($bb_option as $options) { ?>

<?php if (($options['inblock'] == $inblock) && ($options['type'] == "text")) { ?>
<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<div class="theme-type">
<input name="<?php echo $options['id']; ?>" class="ops-text" id="<?php echo $options['id']; ?>" type="<?php echo $options['type']; ?>" value="<?php if ( bb_get_option( $options['id'] ) != "") {
echo bb_get_option( $options['id'] );
} else {
echo $options['std']; } ?>" />
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "colorpicker") ) {  $i == $i++ ; ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?></div>
<div class="theme-type"><input class="color {required:false,hash:true}" name="<?php echo $options['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( bb_get_option( $options['id'] ) != "") { echo bb_get_option( $options['id'] ); } else { echo $options['std']; } ?>" /></div>
 </div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "textarea")) { ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<?php
$valuex = $options['value'];
$valuey = stripslashes($valuex);
$video_code = bb_get_option($options['id'] . ',' . $options['value'] );
?>
<div class="theme-type">
<textarea class="ops-area" name="<?php echo $options['id'];; ?>" cols="40%" rows="8" /><?php if ( bb_get_option( $options['id'] ) != "") { echo stripslashes($video_code);
} else { echo $options['std']; } ?>
</textarea>
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "select")) {  ?>

<div class="pwrap">
<div class="theme-title"> <?php echo $options['name']; ?>:</div>

<div class="theme-type"><select name="<?php echo $options['id']; ?>" class="ops-select" id="<?php echo $options['id']; ?>">

<?php foreach ($options['value'] as $option) { ?>

<option<?php if ( bb_get_option($options['id'])  == $option) { echo ' selected="selected"'; } elseif ( $option ==  $options['std']) { echo ' selected="selected"'; } ?>>
<?php echo $option; ?></option>

<?php } ?>

</select>
</div></div>

<?php } } ?>
</div> <!-- end wrap -->
</div>




<div class="option-box">
<?php $inblock = 'forum'; ?>
<h5><?php _e('Forums Settings'); ?></h5>
<div class="option-box-wrap">
<?php foreach ($bb_option as $options) { ?>

<?php if (($options['inblock'] == $inblock) && ($options['type'] == "text")) { ?>
<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<div class="theme-type">
<input name="<?php echo $options['id']; ?>" class="ops-text" id="<?php echo $options['id']; ?>" type="<?php echo $options['type']; ?>" value="<?php if ( bb_get_option( $options['id'] ) != "") {
echo bb_get_option( $options['id'] );
} else {
echo $options['std']; } ?>" />
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "colorpicker") ) {  $i == $i++ ; ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?></div>
<div class="theme-type"><input class="color {required:false,hash:true}" name="<?php echo $options['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( bb_get_option( $options['id'] ) != "") { echo bb_get_option( $options['id'] ); } else { echo $options['std']; } ?>" /></div>
 </div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "textarea")) { ?>

<div class="pwrap">
<div class="theme-title"><?php echo $options['name']; ?>:</div>
<?php
$valuex = $options['value'];
$valuey = stripslashes($valuex);
$video_code = bb_get_option($options['id'] . ',' . $options['value'] );
?>
<div class="theme-type">
<textarea class="ops-area" name="<?php echo $options['id'];; ?>" cols="40%" rows="8" /><?php if ( bb_get_option( $options['id'] ) != "") { echo stripslashes($video_code);
} else { echo $options['std']; } ?>
</textarea>
</div>
</div>

<?php } elseif (($options['inblock'] == $inblock) && ($options['type'] == "select")) {  ?>

<div class="pwrap">
<div class="theme-title"> <?php echo $options['name']; ?>:</div>

<div class="theme-type"><select name="<?php echo $options['id']; ?>" class="ops-select" id="<?php echo $options['id']; ?>">

<?php foreach ($options['value'] as $option) { ?>

<option<?php if ( bb_get_option($options['id'])  == $option) { echo ' selected="selected"'; } elseif ( $option ==  $options['std']) { echo ' selected="selected"'; } ?>>
<?php echo $option; ?></option>

<?php } ?>

</select>
</div></div>

<?php } } ?>
</div> <!-- end wrap -->
</div>


<input name="save" type="submit" class="submit" id="saveme" value="<?php _e('Save Options'); ?>" />
<input type="hidden" name="action" value="save" />

</form>


<form method="post">
<input name="reset" type="submit" class="submit" id="resetme" value="<?php _e('Reset All Options'); ?>" />
<input type="hidden" name="action" value="reset" />
</form>

</div>
</div>
</div>

<?php
}



function bboption_two() { ?>

<div id="wrap-admin">
<div id="content-admin">
<div id="top-content-admin">
<h4></h4>
<p><?php _e('Customize Your BBpress site design below'); ?></p>
</div>


<div class="admin-content">
</div>
</div>
</div>
<?php }



function bboption_add_admin_page() {
$bb_option_url = bb_get_option('uri');
$bb_save_url = $bb_option_url . 'bb-admin/admin-base.php?plugin=bboption&saved=true';
$bb_reset_url = $bb_option_url . 'bb-admin/admin-base.php?plugin=bboption&reset=true';


global $themename, $shortname, $bb_option;
if ( $_GET['plugin'] == 'bboption' ) {
if ( 'save' == $_REQUEST['action'] ) {
foreach ($bb_option as $option) {
bb_update_option($option['id'] , $_REQUEST[ $option['id']] ); }
//print "<script>";
//print "self.location='$bb_save_url';";
//print "</script>";
bb_safe_redirect( $bb_save_url );
die;
} else if( 'reset' == $_REQUEST['action'] ) {
foreach ($bb_option as $option) {
bb_update_option( $option['id'], $option['std'] );
}
//print "<script>";
//print "self.location='$bb_reset_url';";
//print "</script>";
bb_safe_redirect( $bb_reset_url );
die;
}
}

bb_admin_add_submenu(__($themename . ' Options'), 'use_keys', 'bboption', 'themes.php');

}


add_action( 'bb_admin_menu_generator', 'bboption_add_admin_page' );





?>
