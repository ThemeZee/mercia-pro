/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Mercia Pro
 */

( function( $ ) {

	/* Header textfield. */
	wp.customize( 'mercia_theme_options[header_text]', function( value ) {
		value.bind( function( to ) {
			$( '.header-bar .header-content .header-text' ).text( to );
		} );
	} );

	/* Header Date checkbox */
	wp.customize( 'mercia_theme_options[header_date]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.header-bar .header-content .header-date' );
			} else {
				showElement( '.header-bar .header-content .header-date' );
			}
		} );
	} );

	/* Header Search checkbox */
	wp.customize( 'mercia_theme_options[header_search]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.primary-navigation-wrap .header-search' );
			} else {
				showElement( '.primary-navigation-wrap .header-search' );
			}
		} );
	} );

	/* Author Bio checkbox */
	wp.customize( 'mercia_theme_options[author_bio]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.type-post .entry-footer .entry-author' );
			} else {
				showElement( '.type-post .entry-footer .entry-author' );
			}
		} );
	} );

	/* Footer Content checkbox */
	wp.customize( 'mercia_theme_options[footer_content]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.site > .footer-content' );
			} else {
				showElement( '.site > .footer-content' );
			}
		} );
	} );

	/* Footer textfield. */
	wp.customize( 'mercia_theme_options[footer_text]', function( value ) {
		value.bind( function( to ) {
			$( '.site-info .footer-text' ).text( to );
		} );
	} );

	/* Link & Button Color Option */
	wp.customize( 'mercia_theme_options[link_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color;

			if( isColorLight( newval ) ) {
				text_color = '#111';
			} else {
				text_color = '#fff';
			}

			document.documentElement.style.setProperty( '--link-color', newval );
			document.documentElement.style.setProperty( '--button-color', newval );
			document.documentElement.style.setProperty( '--header-bar-text-hover-color', newval );
			document.documentElement.style.setProperty( '--footer-text-hover-color', newval );
			document.documentElement.style.setProperty( '--button-text-color', text_color );
		} );
	} );

	/* Navigation Primary Color Option */
	wp.customize( 'mercia_theme_options[navi_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--navi-color', newval );
			document.documentElement.style.setProperty( '--navi-border-color', newval );
		} );
	} );

	/* Navigation Secondary Color Option */
	wp.customize( 'mercia_theme_options[navi_hover_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--navi-hover-color', newval );
		} );
	} );

	/* Title Color Option */
	wp.customize( 'mercia_theme_options[title_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--title-color', newval );
			document.documentElement.style.setProperty( '--site-title-color', newval );
		} );
	} );

	/* Title Hover Color Option */
	wp.customize( 'mercia_theme_options[title_hover_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--title-hover-color', newval );
			document.documentElement.style.setProperty( '--site-title-hover-color', newval );
		} );
	} );

	/* Widget Title Color Option */
	wp.customize( 'mercia_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {
			document.documentElement.style.setProperty( '--widget-title-color', newval );
		} );
	} );

	/* Text Font */
	wp.customize( 'mercia_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'text-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--text-font', newFont );
		} );
	} );

	/* Title Font */
	wp.customize( 'mercia_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'title-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--title-font', newFont );
		} );
	} );

	/* Title Font Weight */
	wp.customize( 'mercia_theme_options[title_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--title-font-weight', fontWeight );
		} );
	} );

	/* Title Text Transform */
	wp.customize( 'mercia_theme_options[title_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--title-text-transform', textTransform );
		} );
	} );

	/* Navi Font */
	wp.customize( 'mercia_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'navi-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--navi-font', newFont );
		} );
	} );

	/* Navi Font Weight */
	wp.customize( 'mercia_theme_options[navi_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--navi-font-weight', fontWeight );
		} );
	} );

	/* Navi Text Transform */
	wp.customize( 'mercia_theme_options[navi_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--navi-text-transform', textTransform );
		} );
	} );

	/* Widget Title Font */
	wp.customize( 'mercia_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'widget-title-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--widget-title-font', newFont );
		} );
	} );

	/* Widget Title Font Weight */
	wp.customize( 'mercia_theme_options[widget_title_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--widget-title-font-weight', fontWeight );
		} );
	} );

	/* Widget Title Text Transform */
	wp.customize( 'mercia_theme_options[widget_title_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--widget-title-text-transform', textTransform );
		} );
	} );

	function hideElement( element ) {
		$( element ).css({
			clip: 'rect(1px, 1px, 1px, 1px)',
			position: 'absolute',
			width: '1px',
			height: '1px',
			overflow: 'hidden'
		});
	}

	function showElement( element ) {
		$( element ).css({
			clip: 'auto',
			position: 'relative',
			width: 'auto',
			height: 'auto',
			overflow: 'visible'
		});
	}

	function hexdec( hexString ) {
		hexString = ( hexString + '' ).replace( /[^a-f0-9]/gi, '' );
		return parseInt( hexString, 16 );
	}

	function getColorBrightness( hexColor ) {

		// Remove # string.
		hexColor = hexColor.replace( '#', '' );

		// Convert into RGB.
		var r = hexdec( hexColor.substring( 0, 2 ) );
		var g = hexdec( hexColor.substring( 2, 4 ) );
		var b = hexdec( hexColor.substring( 4, 6 ) );

		return ( ( ( r * 299 ) + ( g * 587 ) + ( b * 114 ) ) / 1000 );
	}

	function isColorLight( hexColor ) {
		return ( getColorBrightness( hexColor ) > 130 );
	}

	function isColorDark( hexColor ) {
		return ( getColorBrightness( hexColor ) <= 130 );
	}

	function loadCustomFont( font, type ) {
		var fontFile = font.split( " " ).join( "+" );
		var fontFileURL = "https://fonts.googleapis.com/css?family=" + fontFile + ":400,700";

		var fontStylesheet = "<link id='mercia-pro-custom-" + type + "' href='" + fontFileURL + "' rel='stylesheet' type='text/css'>";
		var checkLink = $( "head" ).find( "#mercia-pro-custom-" + type ).length;

		if (checkLink > 0) {
			$( "head" ).find( "#mercia-pro-custom-" + type ).remove();
		}
		$( "head" ).append( fontStylesheet );
	}

} )( jQuery );
