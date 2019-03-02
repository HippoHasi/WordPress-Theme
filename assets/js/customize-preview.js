/* Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Page layouts.
	wp.customize( 'layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body' ).addClass( 'one-column' ).removeClass( 'two-column' );
			} else {
				$( 'body' ).removeClass( 'one-column' ).addClass( 'two-column' );
			}
		} );
	} );

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title a' ).text( newval );
		});
	});
	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).text( newval );
		});
	});

	// Update site title color in real time...
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( newval ) {
			if ( 'blank' === newval ) {
				$( '.site-title, .site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {

				// Check if the text color has been removed and use default colors in theme stylesheet.
				if ( ! newval.length ) {
					$( '#huhtog-custom-header-styles' ).remove();
				}
				$( '.site-title, .site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				$( '.site-name, .site-name a, .site-description, .site-description a' ).css({
					color: newval
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-tagline-hidden' );
			}
		});
	});

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	wp.customize( 'header_image', function( value ) {
		value.bind( function() {
			if ( hasHeaderImage() ) {
				$( document.body ).addClass( 'has-header-image' );
			} else {
				$( document.body ).removeClass( 'has-header-image' );
			}			
		});
	});

} )( jQuery );