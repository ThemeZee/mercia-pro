<?php
/**
 * Custom Colors
 *
 * Adds color settings to Customizer and generates color CSS code
 *
 * @package Chronus Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Custom Colors Class
 */
class Chronus_Pro_Custom_Colors {

	/**
	 * Custom Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Chronus Theme is not active.
		if ( ! current_theme_supports( 'chronus-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'chronus_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

		// Add Custom Color Settings.
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );
	}

	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_colors_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = Chronus_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Chronus_Pro_Customizer::get_default_options();

		// Set Page Background Color.
		if ( $theme_options['page_bg_color'] !== $default_options['page_bg_color'] ) {

			$custom_css .= '
				/* Page Background Color Setting */
				.site,
				.header-search .header-search-form,
				.scroll-to-top-button {
					background: ' . $theme_options['page_bg_color'] . ';
				}
			';

			// Check if a dark background color was chosen.
			if ( self::is_color_dark( $theme_options['page_bg_color'] ) ) {
				$custom_css .= '
					body,
					button,
					input,
					select,
					textarea,
					blockquote cite,
					blockquote small,
					input[type="text"]:focus,
					input[type="email"]:focus,
					input[type="url"]:focus,
					input[type="password"]:focus,
					input[type="search"]:focus,
					textarea:focus,
					.site-title,
					.site-title a:link,
					.site-title a:visited,
					.main-navigation-menu,
					.main-navigation-menu a:link,
					.main-navigation-menu a:visited,
					.widget-title,
					.widget-title a:link,
					.widget-title a:visited,
					.entry-title,
					.entry-title a:link,
					.entry-title a:visited,
					.archive-title,
					.comments-header .comments-title,
					.comment-reply-title,
					.main-navigation-toggle,
					.footer-navigation-menu a,
					.footer-navigation-menu a:link,
					.footer-navigation-menu a:visited {
						color: #ffffff;
					}

					.site-title a:hover,
					.site-title a:active,
					.entry-title a:hover,
					.entry-title a:active,
					.widget-title a:hover,
					.widget-title a:active,
					.main-navigation-menu a:hover,
					.main-navigation-menu a:active,
					.footer-navigation-menu a:hover,
					.footer-navigation-menu a:active {
						color: #cc5555;
					}

					.entry-meta {
						color: rgba(255,255,255,0.45);
					}

					.entry-meta .meta-date:after,
					.entry-meta .meta-author:after {
						color: rgba(255,255,255,0.15);
					}

					blockquote {
						border-color: #ffffff;
					}

					pre,
					th,
					td,
					button,
					input[type="button"],
					input[type="reset"],
					input[type="submit"],
					input[type="text"],
					input[type="email"],
					input[type="url"],
					input[type="password"],
					input[type="search"],
					textarea,
					.site-header,
					.primary-navigation-wrap,
					.widget ul li,
					.widget ol li,
					.sticky,
					.infinite-scroll #infinite-handle span,
					.featured-posts-wrap,
					.comment,
					.site-footer,
					.main-navigation-menu,
					.tzwb-tabbed-content .tzwb-tabnavi li a,
					.tzwb-social-icons .social-icons-menu li a,
					.footer-widgets-background,
					.footer-navigation,
					.header-search .header-search-form,
					.entry-author,
					.scroll-to-top-button {
						border-color: rgba(255,255,255,0.075);
					}

					input[type="text"]:focus,
					input[type="email"]:focus,
					input[type="url"]:focus,
					input[type="password"]:focus,
					input[type="search"]:focus,
					textarea:focus {
						border: 1px solid  rgba(255,255,255,0.2);
					}

					.search-form .search-submit:hover .icon-search,
					.search-form .search-submit:active .icon-search,
					.main-navigation-menu > .menu-item-has-children > a .icon,
					.main-navigation-toggle .icon,
					.main-navigation-menu .submenu-dropdown-toggle .icon,
					.tzwb-social-icons .social-icons-menu li a:hover .icon,
					.header-search .header-search-icon .icon-search,
					.scroll-to-top-button:hover .icon {
						fill: #ffffff;
					}
				';
			} // End if().
		} // End if().

		// Set Link Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {

			$custom_css .= '
				/* Link and Button Color Setting */
				a:link,
				a:visited,
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.infinite-scroll #infinite-handle span,
				.tzwb-tabbed-content .tzwb-tabnavi li a:link,
				.tzwb-tabbed-content .tzwb-tabnavi li a:visited,
				.widget-title a:hover,
				.widget-title a:active {
					color: ' . $theme_options['link_color'] . ';
				}

				a:hover,
				a:focus,
				a:active,
				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				button:active,
				input[type="button"]:active,
				input[type="reset"]:active,
				input[type="submit"]:active,
				.infinite-scroll #infinite-handle span:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab {
					color: #303030;
				}

				.search-form .search-submit .icon-search,
				.tzwb-social-icons .social-icons-menu li a .icon,
				.scroll-to-top-button .icon {
					fill: ' . $theme_options['link_color'] . ';
				}
			';
		} // End if().

		// Set Top Navigation Color.
		if ( $theme_options['top_navi_color'] !== $default_options['top_navi_color'] ) {

			$custom_css .= '
				/* Top Navigation Color Setting */
				.header-bar-wrap,
				.top-navigation-menu ul {
					background: ' . $theme_options['top_navi_color'] . ';
				}
			';

			// Check if a dark background color was chosen.
			if ( self::is_color_light( $theme_options['top_navi_color'] ) ) {
				$custom_css .= '
					.top-navigation-menu,
					.top-navigation-menu ul,
					.top-navigation-menu a,
					.top-navigation-menu ul a {
						border-color: rgba(0,0,0,0.05);
					}

					.top-navigation-menu ul,
					.top-navigation-menu a:link,
					.top-navigation-menu a:visited,
					.top-navigation-toggle,
					.top-navigation-toggle:focus,
					.top-navigation-menu .submenu-dropdown-toggle {
					    color: #303030;
					}

					.top-navigation-menu a:hover,
					.top-navigation-menu a:active,
					.top-navigation-toggle:hover,
					.top-navigation-toggle:active {
						color: rgba(0,0,0,0.5);
					}

					.top-navigation-menu > .menu-item-has-children > a .icon,
					.top-navigation-menu ul .menu-item-has-children > a .icon,
					.header-bar .social-icons-menu li a .icon,
					.top-navigation-toggle .icon,
					.top-navigation-menu .submenu-dropdown-toggle .icon {
						fill: #303030;
					}

					.top-navigation-menu > .menu-item-has-children > a:hover .icon,
					.top-navigation-menu > .menu-item-has-children > a:active .icon,
					.top-navigation-menu ul .menu-item-has-children > a:hover .icon,
					.top-navigation-menu ul .menu-item-has-children > a:active .icon,
					.header-bar .social-icons-menu li a:hover .icon,
					.top-navigation-toggle:hover .icon,
					.top-navigation-toggle:active .icon,
					.top-navigation-menu .submenu-dropdown-toggle:hover .icon,
					.top-navigation-menu .submenu-dropdown-toggle:active .icon {
						fill: rgba(0,0,0,0.5);
					}
				';
			} // End if().
		} // End if().

		// Set Main Navigation Color.
		if ( $theme_options['navi_color'] !== $default_options['navi_color'] ) {

			$custom_css .= '
				/* Main Navigation Color Setting */
				.main-navigation-menu ul {
					background: ' . $theme_options['navi_color'] . ';
				}

				.main-navigation-menu a:hover,
				.main-navigation-menu a:active,
				.main-navigation-toggle:hover,
				.main-navigation-toggle:active,
				.footer-navigation-menu a:hover,
				.footer-navigation-menu a:active {
					color: ' . $theme_options['navi_color'] . ';
				}

				.main-navigation-menu > .menu-item-has-children > a:hover .icon,
				.main-navigation-menu > .menu-item-has-children > a:active .icon,
				.main-navigation-toggle:hover .icon,
				.main-navigation-toggle:active .icon,
				.main-navigation-menu .submenu-dropdown-toggle:hover .icon,
				.main-navigation-menu .submenu-dropdown-toggle:active .icon,
				.header-search .header-search-icon:hover .icon-search,
				.header-search .header-search-icon:active .icon-search {
					fill: ' . $theme_options['navi_color'] . ';
				}
			';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['navi_color'] ) ) {
				$custom_css .= '
					.main-navigation-menu ul a {
						border-color: rgba(0,0,0,0.05);
					}

					.main-navigation-menu ul,
					.main-navigation-menu ul a:link,
					.main-navigation-menu ul a:visited {
						color: rgba(0,0,0,0.75);
					}

					.main-navigation-menu ul a:hover,
					.main-navigation-menu ul a:active{
						color: rgba(0,0,0,0.5);
					}

					.main-navigation-menu ul .menu-item-has-children > a .icon {
						fill: rgba(0,0,0,0.75);
					}

					.main-navigation-menu ul .menu-item-has-children > a:hover .icon,
					.main-navigation-menu ul .menu-item-has-children > a:active .icon  {
						fill: rgba(0,0,0,0.5);
					}
				';
			}
		} // End if().

		// Set Title Color.
		if ( $theme_options['title_color'] != $default_options['title_color'] ) {

			$custom_css .= '
				/* Headings Color Setting */
				.site-title a:hover,
				.site-title a:active,
				.entry-title a:hover,
				.entry-title a:active {
					color: ' . $theme_options['title_color'] . ';
				}
			';
		}

		// Set Page Background Hover Color.
		if ( $theme_options['page_bg_color'] !== $default_options['page_bg_color'] ) {

			// Check if a dark background color was chosen.
			if ( self::is_color_dark( $theme_options['page_bg_color'] ) ) {
				$custom_css .= '
					a:hover,
					a:focus,
					a:active,
					button:hover,
					input[type="button"]:hover,
					input[type="reset"]:hover,
					input[type="submit"]:hover,
					button:focus,
					input[type="button"]:focus,
					input[type="reset"]:focus,
					input[type="submit"]:focus,
					button:active,
					input[type="button"]:active,
					input[type="reset"]:active,
					input[type="submit"]:active,
					.infinite-scroll #infinite-handle span:hover,
					.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
					.tzwb-tabbed-content .tzwb-tabnavi li a:active,
					.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab {
						color: #ffffff;
					}
				';
			}
		}

		return $custom_css;
	}

	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Theme Colors.
		$wp_customize->add_section( 'chronus_pro_section_colors', array(
			'title'    => __( 'Theme Colors', 'chronus-pro' ),
			'priority' => 60,
			'panel' => 'chronus_options_panel',
			)
		);

		// Get Default Colors from settings.
		$default_options = Chronus_Pro_Customizer::get_default_options();

		// Add Page Background Color setting.
		$wp_customize->add_setting( 'chronus_theme_options[page_bg_color]', array(
			'default'           => $default_options['page_bg_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'chronus_theme_options[page_bg_color]', array(
				'label'      => _x( 'Page Background', 'color setting', 'chronus-pro' ),
				'section'    => 'chronus_pro_section_colors',
				'settings'   => 'chronus_theme_options[page_bg_color]',
				'priority' => 10,
			)
		) );

		// Add Top Navigation Color setting.
		$wp_customize->add_setting( 'chronus_theme_options[top_navi_color]', array(
			'default'           => $default_options['top_navi_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'chronus_theme_options[top_navi_color]', array(
				'label'      => _x( 'Top Navigation', 'color setting', 'chronus-pro' ),
				'section'    => 'chronus_pro_section_colors',
				'settings'   => 'chronus_theme_options[top_navi_color]',
				'priority' => 20,
			)
		) );

		// Add Navigation Color setting.
		$wp_customize->add_setting( 'chronus_theme_options[navi_color]', array(
			'default'           => $default_options['navi_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'chronus_theme_options[navi_color]', array(
				'label'      => _x( 'Main Navigation', 'color setting', 'chronus-pro' ),
				'section'    => 'chronus_pro_section_colors',
				'settings'   => 'chronus_theme_options[navi_color]',
				'priority' => 30,
			)
		) );

		// Add Link and Button Color setting.
		$wp_customize->add_setting( 'chronus_theme_options[link_color]', array(
			'default'           => $default_options['link_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'chronus_theme_options[link_color]', array(
				'label'      => _x( 'Links and Buttons', 'color setting', 'chronus-pro' ),
				'section'    => 'chronus_pro_section_colors',
				'settings'   => 'chronus_theme_options[link_color]',
				'priority' => 40,
			)
		) );

		// Add Title Color setting.
		$wp_customize->add_setting( 'chronus_theme_options[title_color]', array(
			'default'           => $default_options['title_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'chronus_theme_options[title_color]', array(
				'label'      => _x( 'Post Titles', 'color setting', 'chronus-pro' ),
				'section'    => 'chronus_pro_section_colors',
				'settings'   => 'chronus_theme_options[title_color]',
				'priority' => 50,
			)
		) );
	}

	/**
	 * Returns color brightness.
	 *
	 * @param int Number of brightness.
	 */
	static function get_color_brightness( $hex_color ) {

		// Remove # string.
		$hex_color = str_replace( '#', '', $hex_color );

		// Convert into RGB.
		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 2, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );

		return ( ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000 );
	}

	/**
	 * Check if the color is light.
	 *
	 * @param bool True if color is light.
	 */
	static function is_color_light( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) > 130 );
	}

	/**
	 * Check if the color is dark.
	 *
	 * @param bool True if color is dark.
	 */
	static function is_color_dark( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) <= 130 );
	}
}

// Run Class.
add_action( 'init', array( 'Chronus_Pro_Custom_Colors', 'setup' ) );
