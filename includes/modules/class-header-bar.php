<?php
/**
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Mercia theme to display widgets
 *
 * @package Mercia Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Header Bar Class
 */
class Mercia_Pro_Header_Bar {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Mercia Theme is not active.
		if ( ! current_theme_supports( 'mercia-pro' ) ) {
			return;
		}

		// Display Header Bar.
		add_action( 'mercia_header_bar', array( __CLASS__, 'display_header_bar' ) );
	}

	/**
	 * Displays top navigation and social menu on header bar
	 *
	 * @return void
	 */
	static function display_header_bar() {

		// Check if there are menus.
		if ( has_nav_menu( 'secondary' ) ) {

			echo '<div id="header-top" class="header-bar-wrap">';

			echo '<div id="header-bar" class="header-bar container clearfix">';

			echo '<div class="header-text">Header Text Header Text Header Text  Text Header Text  Text Header Text</div>';

			// Check if there is a top navigation menu.
			if ( has_nav_menu( 'secondary' ) ) {

				echo '<nav id="top-navigation" class="secondary-navigation navigation clearfix" role="navigation">';

				// Display Top Navigation.
				wp_nav_menu( array(
					'theme_location' => 'secondary',
					'container' => false,
					'menu_class' => 'top-navigation-menu',
					'echo' => true,
					'fallback_cb' => '',
					)
				);

				echo '</nav>';

			}

			echo '</div>';

			echo '</div>';
		} // End if().
	}

	/**
	 * Register navigation menus
	 *
	 * @return void
	 */
	static function register_nav_menus() {

		// Return early if Mercia Theme is not active.
		if ( ! current_theme_supports( 'mercia-pro' ) ) {
			return;
		}

		register_nav_menus( array(
			'secondary' => esc_html__( 'Top Navigation', 'mercia-pro' ),
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Mercia_Pro_Header_Bar', 'setup' ) );

// Register navigation menus in backend.
add_action( 'after_setup_theme', array( 'Mercia_Pro_Header_Bar', 'register_nav_menus' ), 20 );
