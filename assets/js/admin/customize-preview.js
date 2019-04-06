/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="custom_logo_max_width">@media (min-width: 600px) { body .custom-logo-link img.custom-logo { width: ' + to + 'px; } }</style>';

			el =  $( '.custom_logo_max_width' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'custom_logo_mobile_max_width', function( value ) {
		value.bind( function( to ) {
			var style, el;

			style = '<style class="custom_logo_mobile_max_width">@media (max-width: 599px) { body .custom-logo-link img.custom-logo { width: ' + to + 'px; } .main-navigation ul:not(.sub-menu) { top: calc( 30px + ' + to + 'px ); padding-top: ' + to + 'px; } .site-header::after { top: calc( 50px + ' + to + 'px ); } }</style>';

			el =  $( '.custom_logo_mobile_max_width' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'contact_button', function( value ) {
		value.bind( function( newval ) {
			$( '.bean-contact-form .button' ).html( newval );
		} );
	} );

	wp.customize( 'contact_email', function( value ) { } );

	wp.customize( 'portfolio_sorting', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.project-sorter' ).removeClass( 'hidden' );
			} else {
				$( '.project-sorter' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'portfolio_filter', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.project-filterer' ).removeClass( 'hidden' );
			} else {
				$( '.project-filterer' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'powered_by_snazzy', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.powered-by-snazzy' ).removeClass( 'hidden' );
			} else {
				$( '.powered-by-snazzy' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'powered_by_wordpress', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.powered-by-wordpress' ).removeClass( 'hidden' );
			} else {
				$( '.powered-by-wordpress' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'header_bg_color', function( value ) {
		value.bind( function( newval ) {
			$('body .site-header').css('background-color', newval );
		} );
	} );

	wp.customize( 'header_text_color', function( value ) {
		value.bind( function( newval ) {
			$('body .site-header, body .site-header p, body .site-header a').css('color', newval );
		} );
	} );

	wp.customize( 'header_title_color', function( value ) {
		value.bind( function( newval ) {
			$('body .site-header .widget-title, body .site-header .site-title a').css('color', newval );
		} );
	} );

	wp.customize( 'overlay_bg_color', function( value ) {
		value.bind( function( newval ) {
			$('body .project .overlay').css('background-color', newval );
		} );
	} );

	wp.customize( 'overlay_text_color', function( value ) {
		value.bind( function( newval ) {
			$('body .project .overlay').css('color', newval );
		} );
	} );

	wp.customize( 'overlay_title_color', function( value ) {
		value.bind( function( newval ) {
			$('body .project .overlay h2').css('color', newval );
		} );
	} );

} )( jQuery );
