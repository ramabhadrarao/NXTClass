<?php

/*-------------------------------------------------------------------------------------

TABLE OF CONTENTS

- Hook Definitions

- Contextual Hook and Filter Functions
-- lok_do_atomic()
-- lok_apply_atomic()
-- lok_get_query_context()

-------------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Hook Definitions */
/*-----------------------------------------------------------------------------------*/

// header.php
function lok_head() { lok_do_atomic( 'lok_head' ); }					
function lok_top() { lok_do_atomic( 'lok_top' ); }					
function lok_header_before() { lok_do_atomic( 'lok_header_before' ); }			
function lok_header_inside() { lok_do_atomic( 'lok_header_inside' ); }				
function lok_header_after() { lok_do_atomic( 'lok_header_after' ); }			
function lok_nav_before() { lok_do_atomic( 'lok_nav_before' ); }					
function lok_nav_inside() { lok_do_atomic( 'lok_nav_inside' ); }					
function lok_nav_after() { lok_do_atomic( 'lok_nav_after' ); }		

// Template files: 404, archive, single, page, sidebar, index, search
function lok_content_before() { lok_do_atomic( 'lok_content_before' ); }					
function lok_content_after() { lok_do_atomic( 'lok_content_after' ); }					
function lok_main_before() { lok_do_atomic( 'lok_main_before' ); }					
function lok_main_after() { lok_do_atomic( 'lok_main_after' ); }					
function lok_post_before() { lok_do_atomic( 'lok_post_before' ); }					
function lok_post_after() { lok_do_atomic( 'lok_post_after' ); }					
function lok_post_inside_before() { lok_do_atomic( 'lok_post_inside_before' ); }					
function lok_post_inside_after() { lok_do_atomic( 'lok_post_inside_after' ); }	
function lok_loop_before() { lok_do_atomic( 'lok_loop_before' ); }	
function lok_loop_after() { lok_do_atomic( 'lok_loop_after' ); }	

// Tumblog Functionality
function lok_tumblog_content_before() { lok_do_atomic( 'lok_tumblog_content_before', 'Before' ); }	
function lok_tumblog_content_after() { lok_do_atomic( 'lok_tumblog_content_after', 'After' ); }

// Sidebar
function lok_sidebar_before() { lok_do_atomic( 'lok_sidebar_before' ); }					
function lok_sidebar_inside_before() { lok_do_atomic( 'lok_sidebar_inside_before' ); }					
function lok_sidebar_inside_after() { lok_do_atomic( 'lok_sidebar_inside_after' ); }					
function lok_sidebar_after() { lok_do_atomic( 'lok_sidebar_after' ); }					

// footer.php
function lok_footer_top() { lok_do_atomic( 'lok_footer_top' ); }					
function lok_footer_before() { lok_do_atomic( 'lok_footer_before' ); }					
function lok_footer_inside() { lok_do_atomic( 'lok_footer_inside' ); }					
function lok_footer_after() { lok_do_atomic( 'lok_footer_after' ); }	
function lok_foot() { lok_do_atomic( 'lok_foot' ); }					

/*-----------------------------------------------------------------------------------*/
/* Contextual Hook and Filter Functions */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* lok_do_atomic() */
/*-----------------------------------------------------------------------------------*/
/**
 * Adds contextual action hooks to the theme.  This allows users to easily add context-based content 
 * without having to know how to use NXTClass conditional tags.  The theme handles the logic.
 *
 * An example of a basic hook would be 'lok_head'.  The lok_do_atomic() function extends that to 
 * give extra hooks such as 'lok_head_home', 'lok_head_singular', and 'lok_head_singular-page'.
 *
 * Major props to Ptah Dunbar for the do_atomic() function.
 * @link http://ptahdunbar.com/nxtclass/smarter-hooks-context-sensitive-hooks
 *
 * @since 3.9.0
 * @uses lok_get_query_context() Gets the context of the current page.
 * @param string $tag Usually the location of the hook but defines what the base hook is.
 */

if ( ! function_exists( 'lok_do_atomic' ) ) {
	function lok_do_atomic( $tag = '', $args = '' ) {
		
		if ( !$tag ) { return false; } // End IF Statement
	
		/* Do actions on the basic hook. */
		do_action( $tag, $args );
	
		/* Loop through context array and fire actions on a contextual scale. */
		foreach ( (array) lok_get_query_context() as $context ) {
		
			do_action( "{$tag}_{$context}", $args );
			
		} // End FOREACH Loop
			
	} // End lok_do_atomic()
} // End IF Statement

/*-----------------------------------------------------------------------------------*/
/* lok_apply_atomic() */
/*-----------------------------------------------------------------------------------*/
/**
 * Adds contextual filter hooks to the theme.  This allows users to easily filter context-based content 
 * without having to know how to use NXTClass conditional tags. The theme handles the logic.
 *
 * An example of a basic hook would be 'lok_entry_meta'.  The lok_apply_atomic() function extends 
 * that to give extra hooks such as 'lok_entry_meta_home', 'lok_entry_meta_singular' and 'lok_entry_meta_singular-page'.
 *
 * @since 3.9.0
 * @uses lok_get_query_context() Gets the context of the current page.
 * @param string $tag Usually the location of the hook but defines what the base hook is.
 * @param mixed $value The value to be filtered.
 * @return mixed $value The value after it has been filtered.
 */

if ( ! function_exists( 'lok_apply_atomic' ) ) {
	function lok_apply_atomic( $tag = '', $value = '' ) {
	
		if ( !$tag )
			return false;
	
		/* Get theme prefix. */
		// $pre = lok_get_prefix();
		$pre = 'lok';
		
		/* Apply filters on the basic hook. */
		$value = apply_filters( "{$pre}_{$tag}", $value );
	
		/* Loop through context array and apply filters on a contextual scale. */
		foreach ( (array)lok_get_query_context() as $context )
			$value = apply_filters( "{$pre}_{$context}_{$tag}", $value );
	
		/* Return the final value once all filters have been applied. */
		return $value;
		
	} // End lok_apply_atomic()
} // End IF Statement

/*-----------------------------------------------------------------------------------*/
/* lok_get_query_context() */
/*-----------------------------------------------------------------------------------*/
/**
 * Retrieve the context of the queried template.
 *
 * @since 3.9.0
 * @return array $query_context
 */

if ( ! function_exists( 'lok_get_query_context' ) ) {
	function lok_get_query_context() {
		global $nxt_query, $query_context;
		
		/* If $query_context->context has been set, don't run through the conditionals again. Just return the variable. */
		if ( isset( $query_context->context ) && is_array( $query_context->context ) ) {
		
			return $query_context->context;
		
		} // End IF Statement
		
		$query_context->context = array();
	
		/* Front page of the site. */
		if ( is_front_page() ) {
		
			$query_context->context[] = 'home';
			
		} // End IF Statement
	
		/* Blog page. */
		if ( is_home() && ! is_front_page() ) {
		
			$query_context->context[] = 'blog';
	
		/* Singular views. */
		} elseif ( is_singular() ) {
		
			$query_context->context[] = 'singular';
			$query_context->context[] = "singular-{$nxt_query->post->post_type}";
		
			/* Page Templates. */
			if ( is_page_template() ) {
			
				$to_skip = array( 'page', 'post' );
			
				$page_template = basename( get_page_template() );
				$page_template = str_replace( '.php', '', $page_template );
				$page_template = str_replace( '.', '-', $page_template );
			
				if ( $page_template && ! in_array( $page_template, $to_skip ) ) {
			
					$query_context->context[] = $page_template;
					
				} // End IF Statement
				
			} // End IF Statement
			
			$query_context->context[] = "singular-{$nxt_query->post->post_type}-{$nxt_query->post->ID}";
		}
	
		/* Archive views. */
		elseif ( is_archive() ) {
			$query_context->context[] = 'archive';
	
			/* Taxonomy archives. */
			if ( is_tax() || is_category() || is_tag() ) {
				$term = $nxt_query->get_queried_object();
				$query_context->context[] = 'taxonomy';
				$query_context->context[] = $term->taxonomy;
				$query_context->context[] = "{$term->taxonomy}-" . sanitize_html_class( $term->slug, $term->term_id );
			}
	
			/* User/author archives. */
			elseif ( is_author() ) {
				$query_context->context[] = 'user';
				$query_context->context[] = 'user-' . sanitize_html_class( get_the_author_meta( 'user_nicename', get_query_var( 'author' ) ), $nxt_query->get_queried_object_id() );
			}
	
			/* Time/Date archives. */
			else {
				if ( is_date() ) {
					$query_context->context[] = 'date';
					if ( is_year() )
						$query_context->context[] = 'year';
					if ( is_month() )
						$query_context->context[] = 'month';
					if ( get_query_var( 'w' ) )
						$query_context->context[] = 'week';
					if ( is_day() )
						$query_context->context[] = 'day';
				}
				if ( is_time() ) {
					$query_context->context[] = 'time';
					if ( get_query_var( 'hour' ) )
						$query_context->context[] = 'hour';
					if ( get_query_var( 'minute' ) )
						$query_context->context[] = 'minute';
				}
			}
		}
	
		/* Search results. */
		elseif ( is_search() ) {
			$query_context->context[] = 'search';
	
		/* Error 404 pages. */
		} elseif ( is_404() ) {
			$query_context->context[] = 'error-404';
	
		} // End IF Statement
		
		return $query_context->context;
	
	} // End lok_get_query_context()
} // End IF Statement
?>