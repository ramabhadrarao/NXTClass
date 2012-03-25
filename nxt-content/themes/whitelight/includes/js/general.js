/*-----------------------------------------------------------------------------------*/
/* GENERAL SCRIPTS */
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(){

	// Table alt row styling
	jQuery( '.entry table tr:odd' ).addClass( 'alt-table-row' );
	
	// FitVids - Responsive Videos
	jQuery( ".post, .widget, #featured .slide .slide-video" ).fitVids();
	
	// Add class to parent menu items with JS until nxt does this natively
	jQuery("ul.sub-menu, ul.children").parents('li').addClass('parent');
	
	// Responsive Navigation (switch top drop down for select)
	jQuery('ul#top-nav').mobileMenu({
		switchWidth: 767,                   //width (in px to switch at)
		topOptionText: 'Select a page',     //first option text
		indentString: '&nbsp;&nbsp;&nbsp;'  //string for indenting nested items
	});
	
	// Show/hide the main navigation
  	jQuery('.nav-toggle').click(function() {
	  jQuery('#navigation').slideToggle('fast', function() {
	  	return false;
	    // Animation complete.
	  });
	});
	
	// Stop the navigation link moving to the anchor (Still need the anchor for semantic markup)
	jQuery('.nav-toggle a').click(function(e) {
        e.preventDefault();
    });
	
	// Apply styles when viewed on iPad
  	var deviceAgent = navigator.userAgent.toLowerCase();
    var agentID = deviceAgent.match(/(ipad)/);
    if (agentID) {
 
        // remove the transition so dropdowns work
        jQuery(".nav li ul").css("-webkit-transition","none", "visibility","visible", "display", "none");
        jQuery(".nav li:hover ul,.nav li li:hover ul,.nav li li li:hover ul,.nav li li li li:hover ul").css("display", "block");
 
    }
	
	/*-----------------------------------------------------------------------------------*/
	/* Add rel="lightbox" to image links if the lightbox is enabled */
	/*-----------------------------------------------------------------------------------*/
	
	if ( jQuery( 'body' ).hasClass( 'has-lightbox' ) && ! jQuery( 'body' ).hasClass( 'portfolio-component' ) ) {
		jQuery( 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".gif"], a[href$=".png"]' ).each( function () {
			var imageTitle = '';
			if ( jQuery( this ).next().hasClass( 'nxt-caption-text' ) ) {
				imageTitle = jQuery( this ).next().text();
			}
			
			jQuery( this ).attr( 'rel', 'lightbox' ).attr( 'title', imageTitle );
		});
		
		jQuery( 'a[rel^="lightbox"]' ).prettyPhoto();
	}

	
});
