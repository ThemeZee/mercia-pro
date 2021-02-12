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
			var custom_css, text_color;

			custom_css = 'a:link, a:visited, .infinite-scroll #infinite-handle span, .secondary-menu-toggle:hover, .secondary-menu-toggle:active, .top-navigation ul a:hover, .top-navigation ul a:active, .footer-navigation-menu a:hover, .footer-navigation-menu a:active { color: ' + newval + '; }';
			custom_css += 'a:hover, a:focus, a:active, .infinite-scroll #infinite-handle span:hover { color: #353535; }';
			custom_css += '.secondary-menu-toggle:hover .icon, .secondary-menu-toggle:active .icon, .top-navigation ul > .menu-item-has-children a .sub-menu-icon:hover .icon, .top-navigation ul > .menu-item-has-children a .sub-menu-icon:active .icon { fill: ' + newval + '; }';
			custom_css += 'button, input[type="button"], input[type="reset"], input[type="submit"], .search-form .search-submit, .tzwb-tabbed-content .tzwb-tabnavi li a:hover, .tzwb-tabbed-content .tzwb-tabnavi li a:active, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab, .tzwb-social-icons .social-icons-menu li a, .scroll-to-top-button, .scroll-to-top-button:focus, .scroll-to-top-button:active { background: ' + newval + '; }';
			custom_css += '.secondary-menu-toggle:hover .icon, .secondary-menu-toggle:active .icon, .top-navigation .dropdown-toggle:hover .icon, .top-navigation .dropdown-toggle:active .icon, .top-navigation ul .menu-item-has-children > a:hover > .icon, .top-navigation ul .menu-item-has-children > a:active > .icon { fill: ' + newval + '; }';

			if( isColorLight( newval ) ) {
				text_color = '#222222';
			} else {
				text_color = '#ffffff';
			}

			custom_css += 'button, input[type="button"], input[type="reset"], input[type="submit"], .tzwb-tabbed-content .tzwb-tabnavi li a:hover, .tzwb-tabbed-content .tzwb-tabnavi li a:active, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab { color: ' + text_color + '; }';
			custom_css += '.search-form .search-submit .icon-search, .scroll-to-top-button .icon, .tzwb-social-icons .social-icons-menu li a .icon { fill: ' + text_color + '; }';

			custom_css += 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, button:active, input[type="button"]:active, input[type="reset"]:active, input[type="submit"]:active { color: #ffffff; }';
			custom_css += '.search-form .search-submit:hover .icon-search, .scroll-to-top-button:hover .icon, .tzwb-social-icons .social-icons-menu li a:hover .icon { fill: #ffffff; }';

			addColorStyles( custom_css, 1 );

			custom_css = '.widget-title a:hover, .widget-title a:active { color: ' + newval + '; }';

			addColorStyles( custom_css, 7 );

			$( '.has-primary-color' ).css( 'color', newval );
			$( '.has-primary-background-color' ).css( 'background-color', newval );
		} );
	} );

	/* Navigation Primary Color Option */
	wp.customize( 'mercia_theme_options[navi_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css;

			custom_css = '.primary-menu-toggle, .primary-menu-toggle:focus, .main-navigation ul, .main-navigation ul a:link, .main-navigation ul a:visited { color: ' + newval + '; }';
			custom_css += '.primary-navigation-wrap, .main-navigation ul, .main-navigation ul ul, .main-navigation ul ul a, .main-navigation ul ul li a, .footer-content { border-color: ' + newval + '; }';
			custom_css += '.primary-menu-toggle .icon, .main-navigation .dropdown-toggle .icon, .main-navigation .dropdown-toggle:focus .icon, .main-navigation ul .menu-item-has-children > a > .icon, .header-search .header-search-icon .icon-search, .header-search .header-search-form-wrap .header-search-form .header-search-close .icon-close { fill: ' + newval + '; }';

			custom_css += '.primary-menu-toggle:hover, .primary-menu-toggle:active, .main-navigation ul a:hover, .main-navigation ul a:active { color: #3377bb; }';
			custom_css += '.primary-menu-toggle:hover .icon, .primary-menu-toggle:active .icon, .main-navigation .dropdown-toggle:hover .icon, .main-navigation .dropdown-toggle:active .icon, .main-navigation ul .menu-item-has-children > a:hover > .icon, .main-navigation ul .menu-item-has-children > a:active > .icon { fill: #3377bb; }';

			addColorStyles( custom_css, 2 );
		} );
	} );

	/* Navigation Secondary Color Option */
	wp.customize( 'mercia_theme_options[navi_hover_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css;

			custom_css = '.primary-menu-toggle:hover, .primary-menu-toggle:active, .main-navigation ul a:hover, .main-navigation ul a:active { color: ' + newval + '; }';
			custom_css += '.primary-menu-toggle:hover .icon, .primary-menu-toggle:active .icon, .main-navigation .dropdown-toggle:hover .icon, .main-navigation .dropdown-toggle:active .icon, .main-navigation ul .menu-item-has-children > a:hover > .icon, .main-navigation ul .menu-item-has-children > a:active > .icon, .header-search .header-search-icon:hover .icon-search, .header-search .header-search-icon:active .icon-search, .header-search .header-search-form-wrap .header-search-form .header-search-close:hover .icon-close, .header-search .header-search-form-wrap .header-search-form .header-search-close:active .icon-close { fill: ' + newval + '; }';

			addColorStyles( custom_css, 3 );
		} );
	} );

	/* Title Color Option */
	wp.customize( 'mercia_theme_options[title_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css;

			custom_css = '.site-title, .site-title a:link, .site-title a:visited, .entry-title, .entry-title a:link, .entry-title a:visited { color: ' + newval + '; }';
			custom_css += '.site-title a:hover, .site-title a:active, .entry-title a:hover, .entry-title a:active { color: #3377bb; }';
			custom_css += '.mercia-social-menu .social-icons-menu li a .icon { fill: ' + newval + '; }';

			addColorStyles( custom_css, 4 );
		} );
	} );

	/* Title Hover Color Option */
	wp.customize( 'mercia_theme_options[title_hover_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css;

			custom_css = '.site-title a:hover, .site-title a:active, .entry-title a:hover, .entry-title a:active { color: ' + newval + '; }';
			custom_css += '.mercia-social-menu .social-icons-menu li a:hover .icon { fill: ' + newval + '; }';

			addColorStyles( custom_css, 5 );
		} );
	} );

	/* Widget Title Color Option */
	wp.customize( 'mercia_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css;

			custom_css = '.widget-title, .widget-title a:link, .widget-title a:visited, .archive-title, .comments-title, .comment-reply-title, .entry-author .author-heading .author-title { color: ' + newval + '; }';
			custom_css += '.widget-title a:hover, .widget-title a:active { color: #3377bb; }';

			addColorStyles( custom_css, 6 );
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

	function writeColorStyles() {
		for( var i = 1; i < 8; i++) {
			$( 'head' ).append( '<style id="mercia-pro-colors-' + i + '"></style>' );
		}
	}

	function addColorStyles( colorRules, priority ) {

		// Write Color Styles if they do not exist.
		if ( ! $( '#mercia-pro-colors-1' ).length ) {
			writeColorStyles();
		}

		$( '#mercia-pro-colors-' + priority ).html( colorRules );
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
