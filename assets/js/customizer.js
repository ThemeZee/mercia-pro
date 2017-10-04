/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Chronus Pro
 */

( function( $ ) {

	/* Header Search checkbox */
	wp.customize( 'chronus_theme_options[header_search]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.primary-navigation .main-navigation-menu li.header-search' );
			} else {
				showElement( '.primary-navigation .main-navigation-menu li.header-search' );
			}
		} );
	} );

	/* Author Bio checkbox */
	wp.customize( 'chronus_theme_options[author_bio]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.type-post .entry-footer .entry-author' );
			} else {
				showElement( '.type-post .entry-footer .entry-author' );
			}
		} );
	} );

	/* Footer textfield. */
	wp.customize( 'chronus_theme_options[footer_text]', function( value ) {
		value.bind( function( to ) {
			$( '.site-info .footer-text' ).text( to );
		} );
	} );

	/* Page Background Color Option */
	wp.customize( 'chronus_theme_options[page_bg_color]', function( value ) {
		value.bind( function( newval ) {
			var title_color = '#cc5555',
				link_color  = '#cc5555';
				navi_color  = '#cc5555';

			if( typeof wp.customize.value( 'chronus_theme_options[title_color]' ) !== 'undefined' ) {
				title_color = wp.customize.value( 'chronus_theme_options[title_color]' ).get();
			}

			if( typeof wp.customize.value( 'chronus_theme_options[link_color]' ) !== 'undefined' ) {
				link_color = wp.customize.value( 'chronus_theme_options[link_color]' ).get();
			}

			if( typeof wp.customize.value( 'chronus_theme_options[navi_color]' ) !== 'undefined' ) {
				navi_color = wp.customize.value( 'chronus_theme_options[navi_color]' ).get();
			}

			var text_color, meta_color, border_color;

			if( isColorDark( newval ) ) {
				text_color = '#ffffff';
				meta_color = 'rgba(255,255,255,0.45)';
				border_color = 'rgba(255,255,255,0.075)';
			} else {
				text_color = '#303030';
				meta_color = 'rgba(0,0,0,0.45)';
				border_color = 'rgba(0,0,0,0.075)';
			}

			$( '.site, .header-search .header-search-form, .scroll-to-top-button' )
				.css( 'background', newval );

			$( 'body, button, input, select, textarea, blockquote cite, blockquote small, .site-title, .site-title a, .main-navigation-menu, .main-navigation-menu > li > a, .main-navigation-toggle, .widget-title, .widget-title a, .entry-title, .entry-title a, .archive-title, .comments-header .comments-title, .comment-reply-title, .footer-navigation-menu a' )
				.css( 'color', text_color );

			$( 'a, button, input[type="button"], input[type="reset"], input[type="submit"], .infinite-scroll #infinite-handle span, .tzwb-tabbed-content .tzwb-tabnavi li a, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab' )
				.not( $( '.header-bar a, .main-navigation-menu ul a' ) )
				.hover( function() { $( this ).css( 'color', text_color ); },
					function() { $( this ).css( 'color', link_color ); }
				);

			$( '.site-title a, .entry-title a' )
				.hover( function() { $( this ).css( 'color', title_color ); },
					function() { $( this ).css( 'color', text_color ); }
				);

			$( '.main-navigation-menu > li > a, .main-navigation-toggle, .footer-navigation-menu a' )
				.hover( function() { $( this ).css( 'color', navi_color ); },
					function() { $( this ).css( 'color', text_color ); }
				);

			$( '.widget-title a' )
				.hover( function() { $( this ).css( 'color', link_color ); },
					function() { $( this ).css( 'color', text_color ); }
				);

			$( 'pre, th, td, button, input[type="button"], input[type="reset"], input[type="submit"], input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, .site-header, .primary-navigation-wrap, .widget ul li, .widget ol li, .sticky, .infinite-scroll #infinite-handle span, .featured-posts-wrap, .comment, .site-footer, .main-navigation-menu, .tzwb-tabbed-content .tzwb-tabnavi li a, .tzwb-social-icons .social-icons-menu li a, .footer-widgets-background, .footer-navigation, .header-search .header-search-form, .entry-author, .scroll-to-top-button' )
				.css( 'border-color', border_color );

			$( '.entry-meta' )
				.css( 'color', meta_color );

			$( '.main-navigation-menu > .menu-item-has-children > a .icon, .main-navigation-toggle .icon, .main-navigation-menu .submenu-dropdown-toggle .icon, .header-search .header-search-icon .icon-search' )
				.css( 'fill', text_color );

			$( '.main-navigation-menu > .menu-item-has-children > a, .main-navigation-toggle, .main-navigation-menu .submenu-dropdown-toggle' )
				.hover( function() { $( this ).find( '.icon' ).css( 'fill', navi_color ); },
					function() { $( this ).find( '.icon' ).css( 'fill', text_color ); }
				);

			$( '.search-form .search-submit, .tzwb-social-icons .social-icons-menu li a, .scroll-to-top-button' )
				.hover( function() { $( this ).find( '.icon' ).css( 'fill', text_color ); },
					function() { $( this ).find( '.icon' ).css( 'fill', link_color ); }
				);
		} );
	} );

	/* Link & Button Color Option */
	wp.customize( 'chronus_theme_options[link_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color, page_bg_color;

			if( typeof wp.customize.value( 'chronus_theme_options[page_bg_color]' ) !== 'undefined' ) {
				page_bg_color = wp.customize.value( 'chronus_theme_options[page_bg_color]' ).get();
			}

			if( isColorDark( page_bg_color ) ) {
				text_color = '#ffffff';
			} else {
				text_color = '#303030';
			}

			$( 'a, button, input[type="button"], input[type="reset"], input[type="submit"], .infinite-scroll #infinite-handle span, .tzwb-tabbed-content .tzwb-tabnavi li a, .widget-title a' )
				.not( $( '.header-bar a, .site-title a, .entry-title a, .widget-title a, .main-navigation-menu a, .main-navigation-menu ul a' ) )
				.css( 'color', newval );

			$( 'a, button, input[type="button"], input[type="reset"], input[type="submit"], .infinite-scroll #infinite-handle span, .tzwb-tabbed-content .tzwb-tabnavi li a, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab' )
				.not( $( '.header-bar a, .site-title a, .entry-title a, .widget-title a, .main-navigation-menu a, .main-navigation-menu ul a' ) )
				.hover( function() { $( this ).css( 'color', text_color ); },
					function() { $( this ).css( 'color', newval ); }
				);

			$( '.widget-title a' )
				.hover( function() { $( this ).css( 'color', newval ); },
					function() { $( this ).css( 'color', text_color ); }
				);

			$( '.search-form .search-submit .icon, .tzwb-social-icons .social-icons-menu li a .icon, .scroll-to-top-button .icon' )
				.css( 'fill', newval );

			$( '.search-form .search-submit, .tzwb-social-icons .social-icons-menu li a, .scroll-to-top-button' )
				.hover( function() { $( this ).find( '.icon' ).css( 'fill', text_color ); },
					function() { $( this ).find( '.icon' ).css( 'fill', newval ); }
				);
		} );
	} );

	/* Top Navigation Color Option */
	wp.customize( 'chronus_theme_options[top_navi_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.header-bar-wrap, .top-navigation-menu ul' )
				.css( 'background', newval );

			var text_color, hover_color, border_color;

			if( isColorLight( newval ) ) {
				text_color = '#303030';
				hover_color = 'rgba(0,0,0,0.5)';
				border_color = 'rgba(0,0,0,0.05)';
			} else {
				text_color = '#ffffff';
				hover_color = 'rgba(255,255,255,0.5)';
				border_color = 'rgba(255,255,255,0.1)';
			}

			$( '.top-navigation-menu, .top-navigation-menu ul, .top-navigation-menu a, .top-navigation-menu ul a' )
				.css( 'border-color', border_color );

			$( '.top-navigation-menu ul, .top-navigation-menu a, .top-navigation-toggle, .top-navigation-menu .submenu-dropdown-toggle' )
				.css( 'color', text_color );

			$( '.top-navigation-menu a, .top-navigation-toggle' )
				.hover( function() { $( this ).css( 'color', hover_color ); },
						function() { $( this ).css( 'color', text_color ); }
				);

			$( '.top-navigation-menu > .menu-item-has-children > a .icon, .top-navigation-menu ul .menu-item-has-children > a .icon, .header-bar .social-icons-menu li a .icon, .top-navigation-toggle .icon, .top-navigation-menu .submenu-dropdown-toggle .icon' )
				.css( 'fill', text_color );

			$( '.top-navigation-menu > .menu-item-has-children > a, .top-navigation-menu ul .menu-item-has-children > a, .header-bar .social-icons-menu li a, .top-navigation-toggle, .top-navigation-menu .submenu-dropdown-toggle' )
				.hover( function() { $( this ).find( '.icon' ).css( 'fill', hover_color ); },
					function() { $( this ).find( '.icon' ).css( 'fill', text_color ); }
				);
		} );
	} );

	/* Main Navigation Color Option */
	wp.customize( 'chronus_theme_options[navi_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color, page_bg_color, menu_color, hover_color, border_color;

			if( typeof wp.customize.value( 'chronus_theme_options[page_bg_color]' ) !== 'undefined' ) {
				page_bg_color = wp.customize.value( 'chronus_theme_options[page_bg_color]' ).get();
			}

			if( isColorDark( page_bg_color ) ) {
				text_color = '#ffffff';
			} else {
				text_color = '#303030';
			}

			$( '.main-navigation-menu ul' )
				.css( 'background', newval );

			$( '.main-navigation-menu > li > a, .main-navigation-menu > .menu-item-has-children > a, .main-navigation-toggle, .footer-navigation-menu a' )
				.hover( function() { $( this ).css( 'color', newval ); },
						function() { $( this ).css( 'color', text_color ); }
				);

			$( '.main-navigation-menu > .menu-item-has-children > a .icon, .main-navigation-toggle .icon, .main-navigation-menu .submenu-dropdown-toggle .icon' )
				.css( 'fill', text_color );

			$( '.main-navigation-menu > .menu-item-has-children > a, .main-navigation-toggle, .main-navigation-menu .submenu-dropdown-toggle, .header-search .header-search-icon' )
				.hover( function() { $( this ).find( '.icon' ).css( 'fill', newval ); },
					function() { $( this ).find( '.icon' ).css( 'fill', text_color ); }
				);

			if( isColorLight( newval ) ) {
				menu_color = 'rgba(0,0,0,0.75)';
				hover_color = 'rgba(0,0,0,0.5)';
				border_color = 'rgba(0,0,0,0.05)';
			} else {
				menu_color = '#ffffff';
				hover_color = 'rgba(255,255,255,0.5)';
				border_color = 'rgba(255,255,255,0.1)';
			}

			$( '.main-navigation-menu ul a' )
				.css( 'border-color', border_color );

			$( '.main-navigation-menu ul, .main-navigation-menu ul a' )
				.css( 'color', menu_color );

			$( '.main-navigation-menu ul a' )
				.hover( function() { $( this ).css( 'color', hover_color ); },
						function() { $( this ).css( 'color', menu_color ); }
				);

			$( '.main-navigation-menu ul .menu-item-has-children > a .icon' )
				.css( 'fill', menu_color );

			$( '.main-navigation-menu ul .menu-item-has-children > a' )
				.hover( function() { $( this ).find( '.icon' ).css( 'fill', hover_color ); },
						function() { $( this ).find( '.icon' ).css( 'fill', menu_color ); }
				);
		} );
	} );

	/* Title Color Option */
	wp.customize( 'chronus_theme_options[title_color]', function( value ) {
		value.bind( function( newval ) {
			var text_color, page_bg_color;

			if( typeof wp.customize.value( 'chronus_theme_options[page_bg_color]' ) !== 'undefined' ) {
				page_bg_color = wp.customize.value( 'chronus_theme_options[page_bg_color]' ).get();
			}

			if( isColorDark( page_bg_color ) ) {
				text_color = '#ffffff';
			} else {
				text_color = '#303030';
			}

			$( '.site-title, .site-title a, .entry-title, .entry-title a' )
				.css( 'color', text_color );

			$( '.site-title a, .entry-title a' )
				.hover( function() { $( this ).css( 'color', newval ); },
						function() { $( this ).css( 'color', text_color ); }
				);
		} );
	} );

	/* Theme Fonts */
	wp.customize( 'chronus_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='chronus-pro-custom-text-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#chronus-pro-custom-text-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#chronus-pro-custom-text-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( 'body, button, input, select, textarea' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'chronus_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='chronus-pro-custom-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#chronus-pro-custom-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#chronus-pro-custom-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.site-title, .entry-title' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'chronus_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='chronus-pro-custom-navi-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#chronus-pro-custom-navi-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#chronus-pro-custom-navi-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.top-navigation-menu, .top-navigation-toggle, .main-navigation-menu, .main-navigation-toggle, .footer-navigation-menu' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'chronus_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='chronus-pro-custom-widget-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#chronus-pro-custom-widget-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#chronus-pro-custom-widget-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.widget-title, .archive-title, .comments-header .comments-title, .comment-reply-title, .pagination a, .pagination .current' )
				.css( 'font-family', newval );

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

} )( jQuery );
