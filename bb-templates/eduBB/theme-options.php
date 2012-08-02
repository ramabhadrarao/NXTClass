


body {
font-family: <?php echo $bb_edubb_body_font; ?> !important;
}

h1, h2, h3, h4, h5, h6 {
font-family: <?php echo $bb_edubb_headline_font; ?> !important;
}


#wraps-bg {
background: <?php if($bb_edubb_wrap_bg_color == ""){ ?><?php echo "#FFF"; } else { ?><?php echo $bb_edubb_wrap_bg_color; ?><?php } ?><?php if($bb_edubb_bg_image == "") { ?><?php } else { ?> url(<?php echo $bb_edubb_bg_image; ?>)<?php } ?> <?php echo $bb_edubb_bg_image_repeat; ?> <?php echo $bb_edubb_bg_image_attachment; ?> <?php echo $bb_edubb_bg_image_horizontal; ?> <?php echo $bb_edubb_bg_image_vertical; ?>!important;
}


<?php if($bb_edubb_top_header_bg_color != '') { ?>
#top-header-wrap {
	background: <?php echo $bb_edubb_top_header_bg_color; ?> !important;
}
<?php } ?>


<?php if($bb_edubb_header_color != '') { ?>
#main-header-content, #footer { background: <?php echo $bb_edubb_header_color; ?> !important; }
#home a, #home a:hover, .pg-nav li a {
background: <?php echo $bb_edubb_header_color; ?> !important;
}

#custom #forumfeed a {
	background: <?php echo $bb_edubb_header_color; ?> url(<?php bb_active_theme_uri(); ?>images/rss.png) no-repeat 10px center !important;
}

.pg-nav li a:hover { background: <?php echo $bb_edubb_header_color; ?> !important; }
<?php } ?>

<?php if($bb_edubb_header_border_color != '') { ?>
#main-header-content { border-bottom: 5px solid <?php echo $bb_edubb_header_border_color; ?> !important; }
#main-header-inner-content h4 { text-shadow: 2pt 1pt 2pt <?php echo $bb_edubb_header_border_color; ?> !important; }
#footer { border-top: 5px solid <?php echo $bb_edubb_header_border_color; ?> !important; }
input.log-in {
border: 1px solid <?php echo $bb_edubb_header_border_color; ?> !important;
}
<?php } ?>

<?php if($bb_edubb_header_text_color != '') { ?>
#main-header-inner-content, #main-header-inner-content p, #main-header-inner-content small, #custom #footer, .edufooter  { color: <?php echo $bb_edubb_header_text_color; ?> !important; }
<?php } ?>

<?php if($bb_edubb_header_text_link_color != '') { ?>
#main-header-inner-content a, #home a, #footer a, #forumfeed a, .site-logo h1 a, .site-logo p  { color: <?php echo $bb_edubb_header_text_link_color; ?> !important; }

.site-logo h1 a, .site-logo p {
text-shadow: 2pt 1pt 2pt #333333 !important;
}
<?php } ?>

<?php if($bb_edubb_header_text_hover_link_color != '') { ?>
#main-header-inner-content a:hover, .pg-nav li a, .pg-nav li a:hover, #footer a:hover { color: <?php echo $bb_edubb_header_text_hover_link_color; ?> !important; }
<?php } ?>


<?php if($bb_edubb_searchbar_bg_color != '') { ?>
#searchbar #mysearch {
background: <?php echo $bb_edubb_searchbar_bg_color; ?> !important;
border: 2px solid <?php echo $bb_edubb_searchbar_border_color; ?> !important;
}
input.sbar {
  border: 2px solid <?php echo $bb_edubb_searchbar_border_color; ?> !important;
  }
<?php } ?>


<?php if($bb_edubb_global_link_color != '') { ?>
#eduforum a, .active-header div, h3#we-are-the-angel {
color: <?php echo $bb_edubb_global_link_color; ?> !important;
}
p#get-info a, #eduforum .com-related a, #main-forum-title small a, #profile-menu li a {
  background: <?php echo $bb_edubb_global_link_color; ?> !important;
  color: #fff !important;
}

#paging .current {
	background: <?php echo $bb_edubb_global_link_color; ?> !important;
	color: #FFFFFF !important;
	text-decoration: none;
	border: 1px solid <?php echo $bb_edubb_global_link_color; ?> !important;
}

p#get-info a:hover, p#heatmap a:hover, #eduforum .com-related a:hover, #main-forum-title small a:hover, #profile-menu li a:hover {
  background: <?php echo $bb_edubb_global_link_color; ?> !important;
  color: #fff !important;
  text-decoration: underline !important;
}
<?php } ?>


<?php if($bb_edubb_active_forum_hover_bg_color != '') { ?>
.active-forum-category:hover, #active-discussion .sticky, .threadstarter, .form-box, .admin-pre  {
 background: <?php echo $bb_edubb_active_forum_hover_bg_color; ?> !important;
}

#active-discussion .active-discussion-header {
border-bottom: 2px solid #ddd !important;
border-top: 2px solid #ddd !important;
}
<?php } ?>


<?php if($bb_edubb_sticky_border_color != '') { ?>
#active-discussion .sticky  {
 border-bottom: 1px solid <?php echo $bb_edubb_sticky_border_color; ?> !important;
}
.threadstarter  {
 border: 2px solid <?php echo $bb_edubb_sticky_border_color; ?> !important;
}
#eduforum .form-box, #eduforum .admin-pre  {
 border-top: 2px solid <?php echo $bb_edubb_sticky_border_color; ?> !important;
 border-bottom: 2px solid <?php echo $bb_edubb_sticky_border_color; ?> !important;
}
<?php } ?>



<?php if($bb_edubb_active_forum_alt_bg_color != '') { ?>
#active-discussion .alt, #eduforum .post-comment .alt .mycom, #profile-edit-form .form-field, .extra-caps-row  {
 background: <?php echo $bb_edubb_active_forum_alt_bg_color; ?> !important;
}
<?php } ?>



<?php if($bb_edubb_global_link_hover_color != '') { ?>
#eduforum a:hover {
color: <?php echo $bb_edubb_global_link_hover_color; ?> !important;
}
<?php } ?>