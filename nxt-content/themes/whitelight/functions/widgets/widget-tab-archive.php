<?php

/*
 * Widget Name: Archive Tabbed Widget
 */


add_action( 'widgets_init', 'huddle_archive_widgets' );

function huddle_archive_widgets() {
	register_widget( 'huddle_archive_widget' );
}

class huddle_archive_widget extends nxt_Widget {
	
	function huddle_archive_widget() {
		$widget_ops = array( 'classname' => 'widget-archive', 'description' => __('A widget that displays categories, pages, and archives.', 'huddle') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widget-archive' );
		$this->nxt_Widget( 'widget-archive', __('Huddle: Tabbed Archive', 'huddle'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		global $nxtdb;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$title_cats = $instance['title_cats'];
		$title_pages = $instance['title_pages'];
		$title_archive = $instance['title_archive'];
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
			<ul class="tabs clf">
				<li><a class="btn-small"><span><?php echo $title_cats; ?></span></a></li>
				<li><a><span><?php echo $title_pages; ?></span></a></li>
				<li><a><span><?php echo $title_archive; ?></span></a></li>
			</ul>
			<div class="clear"></div>
			<div class="panes">
				<div class="pane">
					<ul>
					<?php nxt_list_categories( 'show_count=1&title_li=&orderby=name&depth=1' ) ?>
					</ul>
				</div><!--pane-->
				<div class="pane">
					<ul>
					<?php nxt_list_pages( 'title_li=&depth=1&' ) ?>
					</ul>
				</div><!--pane-->
				<div class="pane">
					<ul class="archive-item">
					<?php nxt_get_archives( 'type=monthly&show_post_count=true&format=html' ) ?>
					</ul>
				</div><!--pane-->
			</div><!--panes-->
			<div class="clf"></div>
		<?php		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['title_cats'] = $new_instance['title_cats'];
		$instance['title_pages'] = $new_instance['title_pages'];
		$instance['title_archive'] = $new_instance['title_archive'];
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array(
		'title' => '',
		'title_cats' => 'Categories',
		'title_pages' => 'Pages',
		'title_archive' => 'Archives',
		);
		$instance = nxt_parse_args( (array) $instance, $defaults ); ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'title_cats' ); ?>"><?php _e('Popular Posts Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'title_cats' ); ?>" name="<?php echo $this->get_field_name( 'title_cats' ); ?>" value="<?php echo $instance['title_cats']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'title_pages' ); ?>"><?php _e('Recent Posts Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'title_pages' ); ?>" name="<?php echo $this->get_field_name( 'title_pages' ); ?>" value="<?php echo $instance['title_pages']; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'title_archive' ); ?>"><?php _e('Recent Comments Title:', 'huddle') ?></label><input class="widefat" id="<?php echo $this->get_field_id( 'title_archive' ); ?>" name="<?php echo $this->get_field_name( 'title_archive' ); ?>" value="<?php echo $instance['title_archive']; ?>" /></p>				
	<?php
	}
}
?>