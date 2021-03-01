<?php
/**
 * Custom Colors
 *
 * Adds color settings to Customizer and generates color CSS code
 *
 * @package Mercia Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom Colors Class
 */
class Mercia_Pro_Custom_Colors {

	/**
	 * Custom Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Mercia Theme is not active.
		if ( ! current_theme_supports( 'mercia-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'mercia_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

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
		$theme_options = Mercia_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Mercia_Pro_Customizer::get_default_options();

		// Color Variables.
		$color_variables = '';

		// Set Link Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {
			$color_variables .= '--page-background-color: ' . $theme_options['page_bg_color'] . ';';

			$custom_css .= '
				/* Link and Button Color Setting */
				a:link,
				a:visited,
				.infinite-scroll #infinite-handle span,
				.secondary-menu-toggle:hover,
				.secondary-menu-toggle:active,
				.top-navigation ul a:hover,
				.top-navigation ul a:active,
				.footer-navigation-menu a:hover,
				.footer-navigation-menu a:active,
				.has-primary-color {
					color: ' . $theme_options['link_color'] . ';
				}

				a:hover,
				a:focus,
				a:active,
				.infinite-scroll #infinite-handle span:hover {
					color: #353535;
				}

				.secondary-menu-toggle:hover .icon,
				.secondary-menu-toggle:active .icon,
				.top-navigation .dropdown-toggle:hover .icon,
				.top-navigation .dropdown-toggle:active .icon,
				.top-navigation ul .menu-item-has-children > a:hover > .icon,
				.top-navigation ul .menu-item-has-children > a:active > .icon {
					fill: ' . $theme_options['link_color'] . ';
				}

				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.search-form .search-submit,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab,
				.tzwb-social-icons .social-icons-menu li a,
				.scroll-to-top-button,
				.scroll-to-top-button:focus,
				.scroll-to-top-button:active,
				.has-primary-background-color {
					background-color: ' . $theme_options['link_color'] . ';
				}
			';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['link_color'] ) ) {
				$custom_css .= '
					button,
					input[type="button"],
					input[type="reset"],
					input[type="submit"],
					.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
					.tzwb-tabbed-content .tzwb-tabnavi li a:active,
					.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab {
						color: #222;
					}

					.search-form .search-submit .icon-search,
					.scroll-to-top-button .icon,
					.tzwb-social-icons .social-icons-menu li a .icon {
						fill: #222;
					}

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
					input[type="submit"]:active {
						color: #fff;
					}

					.search-form .search-submit:hover .icon-search,
					.scroll-to-top-button:hover .icon,
					.tzwb-social-icons .social-icons-menu li a:hover .icon {
						fill: #fff;
					}
				';
			} // End if().
		} // End if().

		// Set Navigation Color.
		if ( $theme_options['navi_color'] !== $default_options['navi_color'] ) {

			$custom_css .= '
				/* Navigation Color Setting */
				.primary-menu-toggle,
				.primary-menu-toggle:focus,
				.main-navigation ul,
				.main-navigation ul a,
				.main-navigation ul a:link,
				.main-navigation ul a:visited {
					color: ' . $theme_options['navi_color'] . ';
				}

				.primary-navigation-wrap,
				.main-navigation ul,
				.main-navigation ul ul,
				.main-navigation ul ul a,
				.main-navigation ul ul li a,
				.footer-content {
					border-color: ' . $theme_options['navi_color'] . ';
				}

				.primary-menu-toggle .icon,
				.main-navigation .dropdown-toggle .icon,
				.main-navigation .dropdown-toggle:focus .icon,
				.main-navigation ul .menu-item-has-children > a > .icon,
				.header-search .header-search-icon .icon-search,
				.header-search .header-search-form-wrap .header-search-form .header-search-close .icon-close {
					fill: ' . $theme_options['navi_color'] . ';
				}

				.primary-menu-toggle:hover,
				.primary-menu-toggle:active,
				.main-navigation ul a:hover,
				.main-navigation ul a:active {
					color: #3377bb;
				}

				.primary-menu-toggle:hover .icon,
				.primary-menu-toggle:active .icon,
				.main-navigation .dropdown-toggle:hover .icon,
				.main-navigation .dropdown-toggle:active .icon,
				.main-navigation ul .menu-item-has-children > a:hover > .icon,
				.main-navigation ul .menu-item-has-children > a:active > .icon {
					fill: #3377bb;
				}
			';
		} // End if().

		// Set Navigation Hover Color.
		if ( $theme_options['navi_hover_color'] !== $default_options['navi_hover_color'] ) {

			$custom_css .= '
				/* Navigation Hover Color Setting */
				.primary-menu-toggle:hover,
				.primary-menu-toggle:active,
				.main-navigation ul a:hover,
				.main-navigation ul a:active {
					color: ' . $theme_options['navi_hover_color'] . ';
				}

				.primary-menu-toggle:hover .icon,
				.primary-menu-toggle:active .icon,
				.main-navigation .dropdown-toggle:hover .icon,
				.main-navigation .dropdown-toggle:active .icon,
				.main-navigation ul .menu-item-has-children > a:hover > .icon,
				.main-navigation ul .menu-item-has-children > a:active > .icon,
				.header-search .header-search-icon:hover .icon-search,
				.header-search .header-search-icon:active .icon-search,
				.header-search .header-search-form-wrap .header-search-form .header-search-close:hover .icon-close,
				.header-search .header-search-form-wrap .header-search-form .header-search-close:active .icon-close {
					fill: ' . $theme_options['navi_hover_color'] . ';
				}
			';
		}

		// Set Title Color.
		if ( $theme_options['title_color'] !== $default_options['title_color'] ) {

			$custom_css .= '
				/* Post Titles Color Setting */
				.site-title,
				.site-title a:link,
				.site-title a:visited,
				.entry-title,
				.entry-title a:link,
				.entry-title a:visited {
					color: ' . $theme_options['title_color'] . ';
				}

				.site-title a:hover,
				.site-title a:active,
				.entry-title a:hover,
				.entry-title a:active {
					color: #3377bb;
				}

				.mercia-social-menu .social-icons-menu li a .icon {
					fill: ' . $theme_options['title_color'] . ';
				}
			';
		}

		// Set Title Hover Color.
		if ( $theme_options['title_hover_color'] !== $default_options['title_hover_color'] ) {

			$custom_css .= '
				/* Post Titles Hover Color Setting */
				.site-title a:hover,
				.site-title a:active,
				.entry-title a:hover,
				.entry-title a:active {
					color: ' . $theme_options['title_hover_color'] . ';
				}

				.mercia-social-menu .social-icons-menu li a:hover .icon {
					fill: ' . $theme_options['title_hover_color'] . ';
				}
			';
		}

		// Set Widget Title Color.
		if ( $theme_options['widget_title_color'] !== $default_options['widget_title_color'] ) {

			$custom_css .= '
				/* Widget Titles Color Setting */
				.widget-title,
				.widget-title a:link,
				.widget-title a:visited,
				.archive-title,
				.comments-title,
				.comment-reply-title,
				.entry-author .author-heading .author-title {
					color: ' . $theme_options['widget_title_color'] . ';
				}

				.widget-title a:hover,
				.widget-title a:active {
					color: #3377bb;
				}
			';
		}

		/* Set Link Color 2. */
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {

			$custom_css .= '
				.widget-title a:hover,
				.widget-title a:active {
					color: ' . $theme_options['link_color'] . ';
				}
			';
		} // End if().

		// Set Color Variables.
		if ( '' !== $color_variables ) {
			$custom_css .= ':root {' . $color_variables . '}';
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
		$wp_customize->add_section( 'mercia_pro_section_colors', array(
			'title'    => esc_html__( 'Color Settings', 'mercia-pro' ),
			'priority' => 60,
			'panel'    => 'mercia_options_panel',
		) );

		// Get Default Colors from settings.
		$default_options = Mercia_Pro_Customizer::get_default_options();

		// Add Link and Button Color setting.
		$wp_customize->add_setting( 'mercia_theme_options[link_color]', array(
			'default'           => $default_options['link_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'mercia_theme_options[link_color]', array(
				'label'    => esc_html_x( 'Links and Buttons', 'color setting', 'mercia-pro' ),
				'section'  => 'mercia_pro_section_colors',
				'settings' => 'mercia_theme_options[link_color]',
				'priority' => 10,
			)
		) );

		// Add Navigation Primary Color setting.
		$wp_customize->add_setting( 'mercia_theme_options[navi_color]', array(
			'default'           => $default_options['navi_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'mercia_theme_options[navi_color]', array(
				'label'    => esc_html_x( 'Main Navigation (primary)', 'color setting', 'mercia-pro' ),
				'section'  => 'mercia_pro_section_colors',
				'settings' => 'mercia_theme_options[navi_color]',
				'priority' => 20,
			)
		) );

		// Add Navigation Secondary Color setting.
		$wp_customize->add_setting( 'mercia_theme_options[navi_hover_color]', array(
			'default'           => $default_options['navi_hover_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'mercia_theme_options[navi_hover_color]', array(
				'label'    => esc_html_x( 'Main Navigation (secondary)', 'color setting', 'mercia-pro' ),
				'section'  => 'mercia_pro_section_colors',
				'settings' => 'mercia_theme_options[navi_hover_color]',
				'priority' => 30,
			)
		) );

		// Add Title Color setting.
		$wp_customize->add_setting( 'mercia_theme_options[title_color]', array(
			'default'           => $default_options['title_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'mercia_theme_options[title_color]', array(
				'label'    => esc_html_x( 'Post Titles', 'color setting', 'mercia-pro' ),
				'section'  => 'mercia_pro_section_colors',
				'settings' => 'mercia_theme_options[title_color]',
				'priority' => 40,
			)
		) );

		// Add Title Hover Color setting.
		$wp_customize->add_setting( 'mercia_theme_options[title_hover_color]', array(
			'default'           => $default_options['title_hover_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'mercia_theme_options[title_hover_color]', array(
				'label'    => esc_html_x( 'Post Titles Hover', 'color setting', 'mercia-pro' ),
				'section'  => 'mercia_pro_section_colors',
				'settings' => 'mercia_theme_options[title_hover_color]',
				'priority' => 50,
			)
		) );

		// Add Widget Title Color setting.
		$wp_customize->add_setting( 'mercia_theme_options[widget_title_color]', array(
			'default'           => $default_options['widget_title_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'mercia_theme_options[widget_title_color]', array(
				'label'    => esc_html_x( 'Widget Titles', 'color setting', 'mercia-pro' ),
				'section'  => 'mercia_pro_section_colors',
				'settings' => 'mercia_theme_options[widget_title_color]',
				'priority' => 60,
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
add_action( 'init', array( 'Mercia_Pro_Custom_Colors', 'setup' ) );
