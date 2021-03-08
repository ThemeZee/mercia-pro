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
			$color_variables .= '--link-color: ' . $theme_options['link_color'] . ';';
			$color_variables .= '--button-color: ' . $theme_options['link_color'] . ';';
			$color_variables .= '--header-bar-text-hover-color: ' . $theme_options['link_color'] . ';';
			$color_variables .= '--footer-text-hover-color: ' . $theme_options['link_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['link_color'] ) ) {
				$color_variables .= '--button-text-color: #111;';
			}
		}

		// Set Navigation Color.
		if ( $theme_options['navi_color'] !== $default_options['navi_color'] ) {
			$color_variables .= '--navi-color: ' . $theme_options['navi_color'] . ';';
			$color_variables .= '--navi-border-color: ' . $theme_options['navi_color'] . ';';
		}

		// Set Navigation Hover Color.
		if ( $theme_options['navi_hover_color'] !== $default_options['navi_hover_color'] ) {
			$color_variables .= '--navi-hover-color: ' . $theme_options['navi_hover_color'] . ';';
		}

		// Set Title Color.
		if ( $theme_options['title_color'] !== $default_options['title_color'] ) {
			$color_variables .= '--title-color: ' . $theme_options['title_color'] . ';';
			$color_variables .= '--site-title-color: ' . $theme_options['title_color'] . ';';
		}

		// Set Title Hover Color.
		if ( $theme_options['title_hover_color'] !== $default_options['title_hover_color'] ) {
			$color_variables .= '--title-hover-color: ' . $theme_options['title_hover_color'] . ';';
			$color_variables .= '--site-title-hover-color: ' . $theme_options['title_hover_color'] . ';';
		}

		// Set Widget Title Color.
		if ( $theme_options['widget_title_color'] !== $default_options['widget_title_color'] ) {
			$color_variables .= '--widget-title-color: ' . $theme_options['widget_title_color'] . ';';
		}

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
			'priority' => 70,
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
