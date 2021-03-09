<?php
/**
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Mercia Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Class
 */
class Mercia_Pro_Customizer {

	/**
	 * Customizer Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Mercia Theme is not active.
		if ( ! current_theme_supports( 'mercia-pro' ) ) {
			return;
		}

		// Enqueue scripts and styles in the Customizer.
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customize_preview_css' ) );

		// Remove Upgrade section.
		remove_action( 'customize_register', 'mercia_customize_register_upgrade_settings' );
	}

	/**
	 * Get saved user settings from database or plugin defaults
	 *
	 * @return array
	 */
	static function get_theme_options() {

		// Merge Theme Options Array from Database with Default Options Array.
		return wp_parse_args( get_option( 'mercia_theme_options', array() ), self::get_default_options() );
	}


	/**
	 * Returns the default settings of the plugin
	 *
	 * @return array
	 */
	static function get_default_options() {

		$default_options = array(
			'header_text'               => '',
			'header_date'               => false,
			'header_search'             => false,
			'author_bio'                => false,
			'footer_content'            => false,
			'footer_text'               => '',
			'credit_link'               => true,
			'scroll_to_top'             => false,
			'primary_color'             => '#3377bb',
			'secondary_color'           => '#0d5195',
			'tertiary_color'            => '#002b6f',
			'accent_color'              => '#0d9551',
			'highlight_color'           => '#bb3353',
			'light_gray_color'          => '#e5e5e5',
			'gray_color'                => '#858585',
			'dark_gray_color'           => '#353535',
			'page_bg_color'             => '#ffffff',
			'navi_color'                => '#353535',
			'navi_hover_color'          => '#3377bb',
			'link_color'                => '#3377bb',
			'link_hover_color'          => '#353535',
			'button_color'              => '#3377bb',
			'button_hover_color'        => '#353535',
			'title_color'               => '#353535',
			'title_hover_color'         => '#3377bb',
			'widget_title_color'        => '#353535',
			'text_font'                 => 'Roboto',
			'title_font'                => 'Open Sans',
			'title_is_bold'             => true,
			'title_is_uppercase'        => false,
			'navi_font'                 => 'Roboto',
			'navi_is_bold'              => false,
			'navi_is_uppercase'         => false,
			'widget_title_font'         => 'Open Sans',
			'widget_title_is_bold'      => true,
			'widget_title_is_uppercase' => true,
		);

		return $default_options;
	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	static function customize_preview_js() {
		wp_enqueue_script( 'mercia-pro-customizer-js', MERCIA_PRO_PLUGIN_URL . 'assets/js/customize-preview.min.js', array( 'customize-preview' ), '20210309', true );
	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {
		wp_enqueue_style( 'mercia-pro-customizer-css', MERCIA_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), '20210212' );
	}
}

// Run Class.
add_action( 'init', array( 'Mercia_Pro_Customizer', 'setup' ) );
