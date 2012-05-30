<?php

/*
 * Widget Name: Latest Tweets
 */


add_action( 'widgets_init', 'huddle_tweets_widgets' );

function huddle_tweets_widgets() {
	register_widget( 'huddle_tweet_widget' );
}

class huddle_tweet_widget extends nxt_Widget {

	function huddle_tweet_widget() {
		$widget_ops = array( 'classname' => 'widget-twitter', 'description' => __('Displays your latest tweets.', 'huddle') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-twitter' );
		$this->nxt_Widget( 'widget-twitter', __('Huddle: Latest Tweets','huddle'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$huddle_twitter_id = $instance['huddle_twitter_id'];
		$huddle_twitter_count = $instance['huddle_twitter_count'];
		$huddle_twitter_text = $instance['huddle_twitter_text'];
		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title; ?>
			<span><a href="http://twitter.com/<?php echo $instance["huddle_twitter_id"] ?>"><?php echo $instance["huddle_twitter_text"] ?></a></span>
			<?php echo $after_title;
		}
		?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.tweet.js"></script>
		<div class="tweet"></div>
		<script type="text/javascript">
		$( ".tweet" ).tweet( {
			username:	'<?php echo $instance["huddle_twitter_id"]; ?>',
			count:		<?php echo $instance["huddle_twitter_count"]; ?>
		} );
		</script>
		<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['huddle_twitter_id'] = strip_tags( $new_instance['huddle_twitter_id'] );
		$instance['huddle_twitter_count'] = strip_tags( $new_instance['huddle_twitter_count'] );
		$instance['huddle_twitter_text'] = strip_tags( $new_instance['huddle_twitter_text'] );
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array(
		'title' => 'Recent Tweets',
		'huddle_twitter_id' => 'aaronlynch',
		'huddle_twitter_count' => '2',
		'huddle_twitter_text' => 'Follow Us &rarr;',
		);
		$instance = nxt_parse_args( (array) $instance, $defaults ); ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'huddle_twitter_id' ); ?>"><?php _e('Twitter ID (username):', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'huddle_twitter_id' ); ?>" name="<?php echo $this->get_field_name( 'huddle_twitter_id' ); ?>" value="<?php echo $instance['huddle_twitter_id']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'huddle_twitter_count' ); ?>"><?php _e('Number Of Tweets:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'huddle_twitter_count' ); ?>" name="<?php echo $this->get_field_name( 'huddle_twitter_count' ); ?>" value="<?php echo $instance['huddle_twitter_count']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'huddle_twitter_text' ); ?>"><?php _e('Follow Text (ex: Follow me on Twitter):', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'huddle_twitter_text' ); ?>" name="<?php echo $this->get_field_name( 'huddle_twitter_text' ); ?>" value="<?php echo $instance['huddle_twitter_text']; ?>" /></p>
	<?php
	}
}
?>