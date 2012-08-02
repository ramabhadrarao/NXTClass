<?php bb_get_header(); ?>


<div id="right-forum">
<h5 class="header-hline">Browse recently updated forum topics:</h5>


<div id="active-discussion">

<?php if ( $topics || $super_stickies ) : ?>

<div class="active-discussion-header">
<div class="discussion-title"><?php _e('Topics'); ?></div>
<div class="discussion-post"><?php _e('Posts'); ?></div>
<div class="discussion-poster"><?php _e('Last Poster'); ?></div>
<div class="discussion-freshness"><?php _e('Freshness'); ?></div>
</div>


<?php if ( $super_stickies ) : foreach ( $super_stickies as $topic ) : ?>
<div id="topic-<?php topic_id(); ?>" class="discussion-box sticky">
<div class="discussion-box-title">
<p class="discussion-box-post-title"><?php bb_topic_labels(); ?><a href="<?php topic_link(); ?>"><?php topic_title(); ?></a></p>
</div>
<div class="discussion-box-total-post"><?php topic_posts(); ?></div>
<div class="discussion-box-last-poster"><?php topic_last_poster(); ?></div>
<div class="discussion-box-freshness"><a href="<?php topic_last_post_link(); ?>"><?php topic_time(); ?></a></div>
</div>
<?php endforeach; endif; // $super_stickies ?>

<?php if ( $topics ) :
$oddtopic = ' alt';
foreach ( $topics as $topic ) : ?>

<div id="topic-<?php topic_id(); ?>" class="discussion-box<?php echo $oddtopic; ?>">
<div class="discussion-box-title">
<p class="discussion-box-post-title"><?php bb_topic_labels(); ?><a href="<?php topic_link(); ?>"><?php topic_title(); ?></a></p>
</div>
<div class="discussion-box-total-post"><?php topic_posts(); ?></div>
<div class="discussion-box-last-poster"><?php topic_last_poster(); ?></div>
<div class="discussion-box-freshness"><a href="<?php topic_last_post_link(); ?>"><?php topic_time(); ?></a></div>
</div>

<?php if (' alt' == $oddtopic) $oddtopic = ''; else $oddtopic = ' alt'; ?>

<?php endforeach; endif; // $topics ?>

<?php endif; // $topics or $super_stickies ?>

</div>



<div id="paging">
<?php bb_latest_topics_pages( array( 'before' => '<div id="pages">', 'after' => '</div>' ) ); ?>
</div>


</div>


<?php include("leftbar.php"); ?>


<?php bb_get_footer(); ?>