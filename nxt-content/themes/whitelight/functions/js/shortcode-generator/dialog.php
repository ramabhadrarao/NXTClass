<?php 
// Get the path to the root.
$full_path = __FILE__;

$path_bits = explode( 'nxt-content', $full_path );

$url = $path_bits[0];

// Require NXTClass bootstrap.
require_once( $url . '/nxt-load.php' );
                                   
$lok_framework_version = get_option( 'lok_framework_version' );

$MIN_VERSION = '2.9';

$meetsMinVersion = version_compare($lok_framework_version, $MIN_VERSION) >= 0;

$lok_framework_path = dirname(__FILE__) .  '/../../';

$lok_framework_url = get_template_directory_uri() . '/functions/';

$lok_shortcode_css = $lok_framework_path . 'css/shortcodes.css';
                                  
$islokTheme = file_exists($lok_shortcode_css);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<div id="lok-dialog">

<?php if ( $meetsMinVersion && $islokTheme ) { ?>

<div id="lok-options-buttons" class="clear">
	<div class="alignleft">
	
	    <input type="button" id="lok-btn-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />
	    
	</div>
	<div class="alignright">
	
	    <input type="button" id="lok-btn-preview" class="button" name="preview" value="Preview" accesskey="P" />
	    <input type="button" id="lok-btn-insert" class="button-primary" name="insert" value="Insert" accesskey="I" />
	    
	</div>
	<div class="clear"></div><!--/.clear-->
</div><!--/#lok-options-buttons .clear-->

<div id="lok-options" class="alignleft">
    <h3><?php echo __( 'Customize the Shortcode', 'lokthemes' ); ?></h3>
    
	<table id="lok-options-table">
	</table>

</div>

<div id="lok-preview" class="alignleft">

    <h3><?php echo __( 'Preview', 'lokthemes' ); ?></h3>

    <iframe id="lok-preview-iframe" frameborder="0" style="width:100%;height:250px" scrolling="no"></iframe>   
    
</div>
<div class="clear"></div>


<script type="text/javascript" src="<?php echo $lok_framework_url; ?>js/shortcode-generator/js/column-control.js"></script>
<script type="text/javascript" src="<?php echo $lok_framework_url; ?>js/shortcode-generator/js/tab-control.js"></script>
<?php  }  else { ?>

<div id="lok-options-error">

    <h3><?php echo __( 'Ninja Trouble', 'lokthemes' ); ?></h3>
    
    <?php if ( $islokTheme && ( ! $meetsMinVersion ) ) { ?>
    <p><?php echo sprinf ( __( 'Your version of the lokFramework (%s) does not yet support shortcodes. Shortcodes were introduced with version %s of the framework.', 'lokthemes' ), $lok_framework_version, $MIN_VERSION ); ?></p>
    
    <h4><?php echo __( 'What to do now?', 'lokthemes' ); ?></h4>
    
    <p><?php echo __( 'Upgrading your theme, or rather the lokFramework portion of it, will do the trick.', 'lokthemes' ); ?></p>

	<p><?php echo sprintf( __( 'The framework is a collection of functionality that all lokThemes have in common. In most cases you can update the framework even if you have modified your theme, because the framework resides in a separate location (under %s).', 'lokthemes' ), '<code>/functions/</code>' ); ?></p>
	
	<p><?php echo sprintf ( __( 'There\'s a tutorial on how to do this on lokThemes.com: %sHow to upgradeyour theme%s.', 'lokthemes' ), '<a title="lokThemes Tutorial" target="_blank" href="http://www.lokthemes.com/2009/08/how-to-upgrade-your-theme/">', '</a>' ); ?></p>
	
	<p><?php echo __( '<strong>Remember:</strong> Every Ninja has a backup plan. Safe or not, always backup your theme before you update it or make changes to it.', 'lokthemes' ); ?></p>

<?php } else { ?>

    <p><?php echo __( 'Looks like your active theme is not from lokThemes. The shortcode generator only works with themes from lokThemes.', 'lokthemes' ); ?></p>
    
    <h4><?php echo __( 'What to do now?', 'lokthemes' ); ?></h4>

	<p><?php echo __( 'Pick a fight: (1) If you already have a theme from lokThemes, install and activate it or (2) if you don\'t yet have one of the awesome lokThemes head over to the <a href="http://www.lokthemes.com/themes/" target="_blank" title="lokThemes Gallery">lokThemes Gallery</a> and get one.', 'lokthemes' ); ?></p>

<?php } ?>

<div style="float: right"><input type="button" id="lok-btn-cancel"
	class="button" name="cancel" value="Cancel" accesskey="C" /></div>
</div>

<?php  } ?>

<script type="text/javascript" src="<?php echo $lok_framework_url; ?>js/shortcode-generator/js/dialog-js.php"></script>

</div>

</body>
</html>