<?php

/*
 * Widget Name: Video Widget
 */


add_action( 'widgets_init', 'huddle_video_widgets' );

function huddle_video_widgets() {
	register_widget( 'huddle_video_widget' );
}

class huddle_video_widget extends nxt_Widget {

	function huddle_video_widget() {
		$widget_ops = array( 'classname' => 'widget-video', 'description' => __('Displays a featured video.', 'huddle') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-video' );
		$this->nxt_Widget( 'widget-video', __('Huddle: Video Widget', 'huddle'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$huddle_vid_embed = $instance['huddle_vid_embed1'];
		$huddle_vid_desc = $instance['huddle_vid_desc1'];

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

			if ($huddle_vid_embed) {			
			echo '<div class="post-video">'.$huddle_vid_embed.'</div>
				<span>'.$huddle_vid_desc.'</span>
			';
			}
				
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['huddle_vid_embed1'] = $new_instance['huddle_vid_embed1'];
		$instance['huddle_vid_desc1'] = $new_instance['huddle_vid_desc1'];
		return $instance;
	}
	 
	function form( $instance ) {
		$defaults = array();
		$instance = nxt_parse_args( (array) $instance, $defaults ); ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" /></p>
	
		<p style="border-bottom:1px solid #DFDFDF; padding: 20px 0; margin-bottom:20px;"><strong><?php _e('Video', 'huddle'); ?>:</strong></p>
		<p><label for="<?php echo $this->get_field_id('huddle_vid_embed1'); ?>"><?php _e('Video Embed Code (Best at 265px wide)', 'huddle') ?></label><textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id('huddle_vid_embed1'); ?>" name="<?php echo $this->get_field_name('huddle_vid_embed1'); ?>"><?php echo stripslashes(htmlspecialchars(($instance['huddle_vid_embed1']), ENT_QUOTES)); ?></textarea></p>
		<p><label for="<?php echo $this->get_field_id('huddle_vid_desc1'); ?>"><?php _e('Description:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id('huddle_vid_desc1'); ?>" name="<?php echo $this->get_field_name('huddle_vid_desc1'); ?>" value="<?php echo stripslashes(htmlspecialchars(($instance['huddle_vid_desc1']), ENT_QUOTES)); ?>" /></p>
	
	<?php
	}
}
?>