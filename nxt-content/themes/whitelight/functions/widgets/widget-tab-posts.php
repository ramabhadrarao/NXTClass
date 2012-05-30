<?php

/*
 * Widget Name: Posts Tabbed Widget
 */


add_action( 'widgets_init', 'huddle_posts_widgets' );

function huddle_posts_widgets() {
	register_widget( 'huddle_posts_widget' );
}

class huddle_posts_widget extends nxt_Widget {
	
	function huddle_posts_widget() {
		$widget_ops = array( 'classname' => 'widget-posts', 'description' => __('A widget that display popular posts, recent posts, recent comments and tags.', 'huddle') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-posts' );
		$this->nxt_Widget( 'widget-posts', __('Huddle: Tabbed Posts', 'huddle'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		global $nxtdb;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$title_popular = $instance['title_popular'];
		$title_recent = $instance['title_recent'];
		$title_comments = $instance['title_comments'];
		$display_count = $instance['display_count'];
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
			<ul class="tabs">
				<li><a class="btn-small"><span><?php echo $title_popular; ?></span></a></li>
				<li><a><span><?php echo $title_recent; ?></span></a></li>
				<li><a><span><?php echo $title_comments; ?></span></a></li>
			</ul>
			<div class="clear"></div>
			<div class="panes">
			
				<?php // Popular Posts
				$huddle_popular_posts = new nxt_Query();
				$huddle_popular_posts->query( 'shonxtosts=' . $display_count . '&orderby=comment_count' ); ?>
				<div class="pane">
					<?php  // Start the loop
					while ($huddle_popular_posts->have_posts()) : $huddle_popular_posts->the_post(); ?>
					<div class="post">
						<div class="post-img fl"><a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'post-small' ); ?></a></div>
						<h4 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						<span>
							<?php _e( 'On', 'huddle' ) ?>
							<?php the_time( get_option( 'date_format' ) ) ?>,
							<?php _e( 'with', 'huddle' ) ?>
							<?php comments_popup_link(__('0 Comments', 'huddle'), __('1 Comment', 'huddle'), __('% Comments', 'huddle')); ?>
						</span>
						<div class="clf"></div>
					</div><!--post-->
					<?php // End the loop
					endwhile; nxt_reset_query(); ?>
				</div><!--pane-->	
						
				<?php // Recent Posts
				$huddle_recent_posts = new nxt_Query();
				$huddle_recent_posts->query('shonxtosts='.$display_count.''); ?>
				<div class="pane">
					<?php  // Start the loop
					while ($huddle_recent_posts->have_posts()) : $huddle_recent_posts->the_post(); ?>
					<div class="post">
						<div class="post-img fl"><a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'post-small' ); ?></a></div>
						<h4 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						<span>
							<?php _e( 'On', 'huddle' ) ?>
							<?php the_time( get_option( 'date_format' ) ) ?>,
							<?php _e( 'with', 'huddle' ) ?>
							<?php comments_popup_link(__('0 Comments', 'huddle'), __('1 Comment', 'huddle'), __('% Comments', 'huddle')); ?>
						</span>
						<div class="clf"></div>
					</div><!--post-->
					<?php // End the loop
					endwhile; nxt_reset_query(); ?>
				</div><!--pane-->
				
				<?php // Recent Comments ?>
				<div class="pane">
				<?php // Query for comments
				global $nxtdb;
				$huddle_recent_comments_query = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
				comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
				comment_type,comment_author_url,
				SUBSTRING(comment_content,1,50) AS comment_excerpt
				FROM $nxtdb->comments
				LEFT OUTER JOIN $nxtdb->posts ON ($nxtdb->comments.comment_post_ID =
				$nxtdb->posts.ID)
				WHERE comment_approved = '1' AND comment_type = '' AND
				post_password = ''
				ORDER BY comment_date_gmt DESC LIMIT ".$display_count;
				$huddle_recent_comments = $nxtdb->get_results($huddle_recent_comments_query);
				foreach ($huddle_recent_comments as $huddle_recent_comment) {
				?>
					<div class="post clf">
						<div class="post-img"><?php echo get_avatar($huddle_recent_comment, 35); ?></div>
						<div class="post-txt">
							<h4 class="post-title"><a href="<?php echo get_permalink($huddle_recent_comment->ID); ?>#comment-<?php echo $huddle_recent_comment->comment_ID; ?>"><?php echo strip_tags($huddle_recent_comment->comment_author); ?></a></h4>
							<span class="em"><?php echo strip_tags($huddle_recent_comment->comment_excerpt); ?>...</span>
						</div>
					</div><!--post-->
				<?php } ?>
				</div><!--pane-->
			</div><!--panes-->
		
		<?php		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['title_popular'] = $new_instance['title_popular'];
		$instance['title_recent'] = $new_instance['title_recent'];
		$instance['title_comments'] = $new_instance['title_comments'];
		$instance['display_count'] = $new_instance['display_count'];		
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array(
		'title' => '',
		'title_popular' => 'Popular',
		'title_recent' => 'Recent',
		'title_comments' => 'Comments',
		'display_count' => 5,
		);
		$instance = nxt_parse_args( (array) $instance, $defaults ); ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'title_popular' ); ?>"><?php _e('Popular Posts Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'title_popular' ); ?>" name="<?php echo $this->get_field_name( 'title_popular' ); ?>" value="<?php echo $instance['title_popular']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'title_recent' ); ?>"><?php _e('Recent Posts Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'title_recent' ); ?>" name="<?php echo $this->get_field_name( 'title_recent' ); ?>" value="<?php echo $instance['title_recent']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'title_comments' ); ?>"><?php _e('Recent Comments Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'title_comments' ); ?>" name="<?php echo $this->get_field_name( 'title_comments' ); ?>" value="<?php echo $instance['title_comments']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'display_count' ); ?>"><?php _e('Number of Results To Display:', 'huddle') ?></label>
			<select id="<?php echo $this->get_field_id( 'display_count' ); ?>" name="<?php echo $this->get_field_name( 'display_count' ); ?>" class="widefat">
				<option <?php if ( '1' == $instance['display_count'] ) echo 'selected="selected"'; ?>>1</option>
				<option <?php if ( '2' == $instance['display_count'] ) echo 'selected="selected"'; ?>>2</option>
				<option <?php if ( '3' == $instance['display_count'] ) echo 'selected="selected"'; ?>>3</option>
				<option <?php if ( '4' == $instance['display_count'] ) echo 'selected="selected"'; ?>>4</option>
				<option <?php if ( '5' == $instance['display_count'] ) echo 'selected="selected"'; ?>>5</option>
				<option <?php if ( '6' == $instance['display_count'] ) echo 'selected="selected"'; ?>>6</option>
				<option <?php if ( '7' == $instance['display_count'] ) echo 'selected="selected"'; ?>>7</option>
				<option <?php if ( '8' == $instance['display_count'] ) echo 'selected="selected"'; ?>>8</option>
				<option <?php if ( '9' == $instance['display_count'] ) echo 'selected="selected"'; ?>>9</option>
				<option <?php if ( '10' == $instance['display_count'] ) echo 'selected="selected"'; ?>>10</option>
			</select>
		</p>
	<?php
	}
}
?>