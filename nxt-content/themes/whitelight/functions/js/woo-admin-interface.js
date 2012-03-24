/**
 * lokThemes Admin Interface JavaScript
 *
 * All JavaScript logic for the theme options admin interface.
 * @since 4.8.0
 *
 */

(function ($) {

  lokthemesAdminInterface = {
  
/**
 * toggle_nav_tabs()
 *
 * @since 4.8.0
 */
 
 	toggle_nav_tabs: function () {
 		var flip = 0;
	
		$( '#expand_options' ).click( function(){
			if( flip == 0 ){
				flip = 1;
				$( '#lok_container #lok-nav' ).hide();
				$( '#lok_container #content' ).width( 785 );
				$( '#lok_container .group' ).add( '#lok_container .group h1' ).show();

				$(this).text( '[-]' );

			} else {
				flip = 0;
				$( '#lok_container #lok-nav' ).show();
				$( '#lok_container #content' ).width( 595 );
				$( '#lok_container .group' ).add( '#lok_container .group h1' ).hide();
				$( '#lok_container .group:first' ).show();
				$( '#lok_container #lok-nav li' ).removeClass( 'current' );
				$( '#lok_container #lok-nav li:first' ).addClass( 'current' );

				$(this).text( '[+]' );

			}

		});
 	}, // End toggle_nav_tabs()

/**
 * load_first_tab()
 *
 * @since 4.8.0
 */
 
 	load_first_tab: function () {
 		$( '.group' ).hide();
 		$( '.group:has(".section"):first' ).fadeIn(); // Fade in the first tab containing options (not just the first tab).
 	}, // End load_first_tab()
 	
/**
 * open_first_menu()
 *
 * @since 5.0.0
 */
 
 	open_first_menu: function () {
 		$( '#lok-nav li.current.has-children:first ul.sub-menu' ).slideDown().addClass( 'open' ).children( 'li:first' ).addClass( 'active' ).parents( 'li.has-children' ).addClass( 'open' );
 	}, // End open_first_menu()
 	
/**
 * toggle_nav_menus()
 *
 * @since 5.0.0
 */
 
 	toggle_nav_menus: function () {
 		$( '#lok-nav li.has-children > a' ).click( function ( e ) {
 			if ( $( this ).parent().hasClass( 'open' ) ) { return false; }
 			
 			$( '#lok-nav li.top-level' ).removeClass( 'open' ).removeClass( 'current' );
 			$( '#lok-nav li.active' ).removeClass( 'active' );
 			if ( $( this ).parents( '.top-level' ).hasClass( 'open' ) ) {} else {
 				$( '#lok-nav .sub-menu.open' ).removeClass( 'open' ).slideUp().parent().removeClass( 'current' );
 				$( this ).parent().addClass( 'open' ).addClass( 'current' ).find( '.sub-menu' ).slideDown().addClass( 'open' ).children( 'li:first' ).addClass( 'active' );
 			}
 			
 			// Find the first child with sections and display it.
 			var clickedGroup = $( this ).parent().find( '.sub-menu li a:first' ).attr( 'href' );
 			
 			if ( clickedGroup != '' ) {
 				$( '.group' ).hide();
 				$( clickedGroup ).fadeIn();
 			}
 			return false;
 		});
 	}, // End toggle_nav_menus()
 	
/**
 * toggle_collapsed_fields()
 *
 * @since 4.8.0
 */
 
 	toggle_collapsed_fields: function () {
		$( '.group .collapsed' ).each(function(){
			$( this ).find( 'input:checked' ).parent().parent().parent().nextAll().each( function(){
				if ($( this ).hasClass( 'last' ) ) {
					$( this ).removeClass( 'hidden' );
					return false;
				}
				$( this ).filter( '.hidden' ).removeClass( 'hidden' );
				
				$( '.group .collapsed input:checkbox').click(function ( e ) {
					lokthemesAdminInterface.unhide_hidden( $( this ).attr( 'id' ) );
				});

			});
		});
 	}, // End toggle_collapsed_fields()

/**
 * setup_nav_highlights()
 *
 * @since 4.8.0
 */
 
 	setup_nav_highlights: function () {
	 	// Highlight the first item by default.
	 	$( '#lok-nav li.top-level:first' ).addClass( 'current' ).addClass( 'open' );
		
		// Default single-level logic.
		$( '#lok-nav li.top-level' ).not( '.has-children' ).find( 'a' ).click( function ( e ) {
			var thisObj = $( this );
			var clickedGroup = thisObj.attr( 'href' );
			
			if ( clickedGroup != '' ) {
				$( '#lok-nav .open' ).removeClass( 'open' );
				$( '.sub-menu' ).slideUp();
				$( '#lok-nav .active' ).removeClass( 'active' );
				$( '#lok-nav li.current' ).removeClass( 'current' );
				thisObj.parent().addClass( 'current' );
				
				$( '.group' ).hide();
				$( clickedGroup ).fadeIn();
				
				return false;
			}
		});
		
		$( '#lok-nav li:not(".has-children") > a:first' ).click( function( evt ) {
			var parentObj = $( this ).parent( 'li' );
			var thisObj = $( this );
			
			var clickedGroup = thisObj.attr( 'href' );
			
			if ( $( this ).parents( '.top-level' ).hasClass( 'open' ) ) {} else {
				$( '#lok-nav li.top-level' ).removeClass( 'current' ).removeClass( 'open' );
				$( '#lok-nav .sub-menu' ).removeClass( 'open' ).slideUp();
				$( this ).parents( 'li.top-level' ).addClass( 'current' );
			}
		
			$( '.group' ).hide();
			$( clickedGroup ).fadeIn();
		
			evt.preventDefault();
			return false;
		});
		
		// Sub-menu link click logic.
		$( '.sub-menu a' ).click( function ( e ) {
			var thisObj = $( this );
			var parentMenu = $( this ).parents( 'li.top-level' );
			var clickedGroup = thisObj.attr( 'href' );
			
			if ( $( '.sub-menu li a[href="' + clickedGroup + '"]' ).hasClass( 'active' ) ) {
				return false;
			}
			
			if ( clickedGroup != '' ) {
				parentMenu.addClass( 'open' );
				$( '.sub-menu li, .flyout-menu li' ).removeClass( 'active' );
				$( this ).parent().addClass( 'active' );
				$( '.group' ).hide();
				$( clickedGroup ).fadeIn();
			}
			
			return false;
		});
 	}, // End setup_nav_highlights()

/**
 * setup_custom_typography()
 *
 * @since 4.8.0
 */
 
 	setup_custom_typography: function () {
	 	$( 'select.lok-typography-unit' ).change( function(){
			var val = $( this ).val();
			var parent = $( this ).parent();
			var name = parent.find( '.lok-typography-size-px' ).attr( 'name' );
			if( name == '' ) { var name = parent.find( '.lok-typography-size-em' ).attr( 'name' ); }
			
			if( val == 'px' ) {
				var name = parent.find( '.lok-typography-size-em' ).attr( 'name' );
				parent.find( '.lok-typography-size-em' ).hide().removeAttr( 'name' );
				parent.find( '.lok-typography-size-px' ).show().attr( 'name', name );
			}
			else if( val == 'em' ) {
				var name = parent.find( '.lok-typography-size-px' ).attr( 'name' );
				parent.find( '.lok-typography-size-px' ).hide().removeAttr( 'name' );
				parent.find( '.lok-typography-size-em' ).show().attr( 'name', name );
			}
		
		});
 	}, // End setup_custom_typography()

/**
 * init_flyout_menus()
 *
 * @since 5.0.0
 */
 
 	init_flyout_menus: function () {
 		// Only trigger flyouts on menus with closed sub-menus.
 		$( '#lok-nav li.has-children' ).each ( function ( i ) {
 			$( this ).hover(
	 			function () {
	 				if ( $( this ).find( '.flyout-menu' ).length == 0 ) {
		 				var flyoutContents = $( this ).find( '.sub-menu' ).html();
		 				var flyoutMenu = $( '<div />' ).addClass( 'flyout-menu' ).html( '<ul>' + flyoutContents + '</ul>' );
		 				$( this ).append( flyoutMenu );
	 				}
	 			}, 
	 			function () {
	 				// $( '#lok-nav .flyout-menu' ).remove();
	 			}
	 		);
 		});
 		
 		// Add custom link click logic to the flyout menus, due to custom logic being required.
 		$( '.flyout-menu a' ).live( 'click', function ( e ) {
 			var thisObj = $( this );
 			var parentObj = $( this ).parent();
 			var parentMenu = $( this ).parents( '.top-level' );
 			var clickedGroup = $( this ).attr( 'href' );
 			
 			if ( clickedGroup != '' ) {
	 			$( '.group' ).hide();
	 			$( clickedGroup ).fadeIn();
	 			
	 			// Adjust the main navigation menu.
	 			$( '#lok-nav li' ).removeClass( 'open' ).removeClass( 'current' ).find( '.sub-menu' ).slideUp().removeClass( 'open' );
	 			parentMenu.addClass( 'open' ).addClass( 'current' ).find( '.sub-menu' ).slideDown().addClass( 'open' );
	 			$( '#lok-nav li.active' ).removeClass( 'active' );
	 			$( '#lok-nav a[href="' + clickedGroup + '"]' ).parent().addClass( 'active' );
 			}
 			
 			return false;
 		});
 	}, // End init_flyout_menus()

/**
 * unhide_hidden()
 *
 * @since 4.8.0
 * @see toggle_collapsed_fields()
 */
 
 	unhide_hidden: function ( obj ) {
 		obj = $( '#' + obj ); // Get the jQuery object.
 		
		if ( obj.attr( 'checked' ) ) {
			obj.parent().parent().parent().nextAll().slideDown().removeClass( 'hidden' ).addClass( 'visible' );
		} else {
			obj.parent().parent().parent().nextAll().each( function(){
				if ( $( this ).filter( '.last' ).length ) {
					$( this ).slideUp().addClass( 'hidden' );
				return false;
				}
				$( this ).slideUp().addClass( 'hidden' );
			});
		}
 	} // End unhide_hidden()
  
  }; // End lokthemesAdminInterface Object // Don't remove this, or the sky will fall on your head.

/**
 * Execute the above methods in the lokthemesAdminInterface object.
 *
 * @since 4.8.0
 */
	$(document).ready(function () {
	
		lokthemesAdminInterface.toggle_nav_tabs();
		lokthemesAdminInterface.load_first_tab();
		lokthemesAdminInterface.toggle_collapsed_fields();
		lokthemesAdminInterface.setup_nav_highlights();
		lokthemesAdminInterface.toggle_nav_menus();
		lokthemesAdminInterface.init_flyout_menus();
		lokthemesAdminInterface.open_first_menu();
		lokthemesAdminInterface.setup_custom_typography();
	
	});
  
})(jQuery);