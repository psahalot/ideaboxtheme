/**
 * Handles toggling the main navigation menu for small screens.
 * And also adds a custom CSS class to main navigation if page scrolls more than 100px 
 */

jQuery( document ).ready( function( $ ) {
	var $masthead = $( '#masthead' ),
	    timeout = false;

	$.fn.smallMenu = function() {
		$masthead.find( '#site-navigation' ).removeClass( 'main-navigation' ).addClass( 'main-small-navigation' );
		$masthead.find( '#site-navigation h3' ).removeClass( 'assistive-text' ).addClass( 'menu-toggle' );

		$( '.menu-toggle' ).unbind( 'click' ).click( function() {
			$masthead.find( '.nav-menu' ).toggle();
			$( this ).toggleClass( 'toggled-on' );
		} );
	};

	// Check viewport width on first load.
	if ( $( window ).width() < 520 )
		$.fn.smallMenu();

	// Check viewport width when user resizes the browser window.
	$( window ).resize( function() {
		var browserWidth = $( window ).width();

		if ( false !== timeout )
			clearTimeout( timeout );

		timeout = setTimeout( function() {
			if ( browserWidth < 520 ) {
				$.fn.smallMenu();
			} else {
				$masthead.find( '#site-navigation' ).removeClass( 'main-small-navigation' ).addClass( 'main-navigation' );
				$masthead.find( '#site-navigation h3' ).removeClass( 'menu-toggle' ).addClass( 'assistive-text' );
				$masthead.find( '.nav-menu' ).removeAttr( 'style' );
			}
		}, 200 );
	} );
        
        // add shrink class to site header if page scrolls more than 100px 
        $(document).on("scroll", function(){

		if($(document).scrollTop() > 100){

			$("#headercontainer").addClass("shrink");
			updateSliderMargin();

		} else {

			$("#headercontainer").removeClass("shrink");
			updateSliderMargin();

		}

	});
} );
