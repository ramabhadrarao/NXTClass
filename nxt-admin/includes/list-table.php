<?php
/**
 * Helper functions for displaying a list of items in an ajaxified HTML table.
 *
 * @package NXTClass
 * @subpackage List_Table
 * @since 3.1.0
 */

/**
 * Fetch an instance of a nxt_List_Table class.
 *
 * @access private
 * @since 3.1.0
 *
 * @param string $class The type of the list table, which is the class name.
 * @return object|bool Object on success, false if the class does not exist.
 */
function _get_list_table( $class ) {
	$core_classes = array(
		//Site Admin
		'nxt_Posts_List_Table' => 'posts',
		'nxt_Media_List_Table' => 'media',
		'nxt_Terms_List_Table' => 'terms',
		'nxt_Users_List_Table' => 'users',
		'nxt_Comments_List_Table' => 'comments',
		'nxt_Post_Comments_List_Table' => 'comments',
		'nxt_Links_List_Table' => 'links',
		'nxt_Plugin_Install_List_Table' => 'plugin-install',
		'nxt_Themes_List_Table' => 'themes',
		'nxt_Theme_Install_List_Table' => 'theme-install',
		'nxt_Plugins_List_Table' => 'plugins',
		// Network Admin
		'nxt_MS_Sites_List_Table' => 'ms-sites',
		'nxt_MS_Users_List_Table' => 'ms-users',
		'nxt_MS_Themes_List_Table' => 'ms-themes',
	);

	if ( isset( $core_classes[ $class ] ) ) {
		require_once( ABSPATH . 'nxt-admin/includes/class-nxt-' . $core_classes[ $class ] . '-list-table.php' );
		return new $class;
	}

	return false;
}

/**
 * Register column headers for a particular screen.
 *
 * @since 2.7.0
 *
 * @param string $screen The handle for the screen to add help to. This is usually the hook name returned by the add_*_page() functions.
 * @param array $columns An array of columns with column IDs as the keys and translated column names as the values
 * @see get_column_headers(), print_column_headers(), get_hidden_columns()
 */
function register_column_headers($screen, $columns) {
	$nxt_list_table = new _nxt_List_Table_Compat($screen, $columns);
}

/**
 * Prints column headers for a particular screen.
 *
 * @since 2.7.0
 */
function print_column_headers($screen, $id = true) {
	$nxt_list_table = new _nxt_List_Table_Compat($screen);

	$nxt_list_table->print_column_headers($id);
}

/**
 * Helper class to be used only by back compat functions
 *
 * @since 3.1.0
 */
class _nxt_List_Table_Compat extends nxt_List_Table {
	var $_screen;
	var $_columns;

	function _nxt_List_Table_Compat( $screen, $columns = array() ) {
		if ( is_string( $screen ) )
			$screen = convert_to_screen( $screen );

		$this->_screen = $screen;

		if ( !empty( $columns ) ) {
			$this->_columns = $columns;
			add_filter( 'manage_' . $screen->id . '_columns', array( &$this, 'get_columns' ), 0 );
		}
	}

	function get_column_info() {
		$columns = get_column_headers( $this->_screen );
		$hidden = get_hidden_columns( $this->_screen );
		$sortable = array();

		return array( $columns, $hidden, $sortable );
	}

	function get_columns() {
		return $this->_columns;
	}
}
?>