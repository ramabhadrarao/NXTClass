<?php
$_head_profile_attr = '';
if ( bb_is_profile() ) {
	global $self;
	if ( !$self ) {
		$_head_profile_attr = ' profile="http://www.w3.org/2006/03/hcard"';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"<?php bb_language_attributes( '1.1' ); ?>>
<head<?php echo $_head_profile_attr; ?>>


<meta http-equiv="X-UA-Compatible" content="IE=8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php bb_title() ?></title>

<?php bb_feed_head(); ?>

<link rel="stylesheet" href="<?php bb_stylesheet_uri(); ?>" type="text/css" />

<?php include ('options-var.php'); ?>
<!-- start theme options sync -->
<?php print "<style type='text/css' media='screen'>"; ?>
<?php include ('theme-options.php'); ?>
<?php print "</style>"; ?>
<!-- end theme options sync -->


<script type="text/javascript" src="<?php bb_active_theme_uri(); ?>js/quicktags.js"></script>
<script type="text/javascript" src="<?php bb_active_theme_uri(); ?>js/simple-code.php"></script>

<?php bb_head(); ?>

</head>

<body id="custom">

<div id="top-header-wrap">
<div id="top-header">
<div class="h-content">

<div class="top-h-content">
<div class="site-logo">
<?php if( $bb_edubb_header_logo == '' ) { ?>
<h1><a title="<?php if ( bb_get_option('description') ) : ?><?php bb_option('description'); ?><?php else: ?><?php bb_option('name'); ?><?php endif; ?>" href="<?php bb_option('uri'); ?>"><?php bb_option('name'); ?></a></h1>
<?php if ( bb_get_option('description') ) : ?><p class="description"><?php bb_option('description'); ?></p><?php endif; ?>
<?php } else { ?>
<a href="<?php bb_option('uri'); ?>"><img src="<?php echo stripslashes($bb_edubb_header_logo); ?>" alt="<?php if ( bb_get_option('description') ) : ?><?php bb_option('description'); ?><?php else: ?><?php bb_option('name'); ?><?php endif; ?>" /></a>
<?php } ?>
</div>

<div class="site-stats"><span>
<?php include_once("bb-includes/functions.bb-statistics.php"); ?>
<strong><?php total_users(); ?></strong> users have made <strong><?php total_posts(); ?></strong> posts!
</span>
</div>

</div>

<div class="bottom-h-content">
<div class="navigation">

<!-- since BBPRESS did not have paged..page can be hardcoded -->
<ul class="pg-nav">
<li id="home"><a href="<?php bb_option('uri'); ?>" title="<?php bb_option('name'); ?> Forums homepage">Forums Home</a></li>

<!--edit this to your own links-->

<?php echo stripslashes($bb_edubb_nav_links); ?>
<!-- end -->

<li id="forumfeed"><a title="Subscribe to all topic feed" href="rss.php">Forums Feeds</a></li>
</ul>
<!-- end -->


</div>
</div>

</div>
</div>
</div> <!-- end top-header-wrap -->

<div id="main-header">
<div id="main-header-content">
<div id="main-header-inner">
<div id="main-header-inner-content">


<?php if( $bb_edubb_header_welcome_text == '' ) { ?>
<h4>Welcome to the <?php bb_option('name'); ?> - search, browse or post away!</h4>
<?php } else {  ?>
<h4><?php echo stripslashes($bb_edubb_header_welcome_text); ?></h4>
<?php } ?>

<?php login_form(); ?>


</div>
</div>
</div>
</div>

<div id="wraps-bg">
<div id="wraps">
<div id="container">

<?php if( is_front() || is_bb_search() ) { ?>
<?php search_form(); ?>
<?php } ?>

<div id="eduforum">