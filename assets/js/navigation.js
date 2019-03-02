/* global huhtogScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function($){	
	
 	var siteHeader, menuToggle, siteNavContain;

 	function initMainNavigation( container ) {

 		container.find( '.menu-item-has-children > a > .icon, .page_item_has_children > a > .icon' ).click( function( e ) {

			e.preventDefault();
			e.stopPropagation(); 			

 			$(this).toggleClass( 'toggled-on' );

 			var dropDownMenu = $(this).parents( '.menu-item-has-children:first, .page_item_has_children:first' ).find('ul:first');
 			dropDownMenu.toggle()
 						.attr( 'aria-expanded', dropDownMenu.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

 			var menuWidth = dropDownMenu.outerWidth(),
 			offsetLeft = dropDownMenu.offset().left,
 			offsetRight = ( $(window).width() - (offsetLeft + menuWidth) );
 			
 			if ( menuWidth > offsetRight ) {
 				dropDownMenu.addClass( 'displayLeft' );
 			}
 			else {
 				dropDownMenu.addClass( 'displayRight' )
 			}

 		});

 	}

 	initMainNavigation( $( '.main-navigation' ) );

	siteHeader       = $( '#siteHeader' );
	menuToggle     = siteHeader.find( '.menu-toggle' );
	siteNavContain = siteHeader.find( '.main-navigation' );	
	siteNavigation = siteHeader.find( '.main-navigation > div > ul' );

	// Enable menuToggle.
	(function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}
		
		// Add an initial value for the attribute.
		menuToggle.attr( 'aria-expanded', 'false' );		
		
		menuToggle.on( 'click.huhtog', function() {

			siteNavContain.toggleClass( 'toggled-on' );

			$( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );
		});

	})();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	(function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

				$( document.body ).on( 'touchstart.huhtog', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				});

				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
					.on( 'touchstart.huhtog', function( e ) {
						var el = $( this ).parent( 'li' );

						if ( ! el.hasClass( 'focus' ) ) {
							e.preventDefault();
							el.toggleClass( 'focus' );
							el.siblings( '.focus' ).removeClass( 'focus' );
						}
					});

			} else {
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.huhtog' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.huhtog', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.huhtog blur.huhtog', function() {
			$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
		});
	})();	

})( jQuery );