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

		// Filter Social Menu to add SVG icons.
		add_filter( 'walker_nav_menu_start_el',  array( __CLASS__, 'nav_menu_social_icons' ), 10, 4 );
	}

	/**
	 * Displays top navigation and social menu on header bar
	 *
	 * @return void
	 */
	static function display_header_bar() {

		// Check if there are menus.
		if ( has_nav_menu( 'social' ) or has_nav_menu( 'secondary' ) ) {

			echo '<div id="header-top" class="header-bar-wrap">';

			echo '<div id="header-bar" class="header-bar container clearfix">';

			// Check if there is a social menu.
			if ( has_nav_menu( 'social' ) ) {

				echo '<div id="header-social-icons" class="social-icons-navigation clearfix">';

				// Display Social Icons Menu.
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container' => false,
					'menu_class' => 'social-icons-menu',
					'echo' => true,
					'fallback_cb' => '',
					'link_before' => '<span class="screen-reader-text">',
					'link_after' => '</span>',
					'depth' => 1,
					)
				);

				echo '</div>';

			}

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
		}
	}

	/**
	 * Display SVG icons in social links menu.
	 *
	 * @param  string  $item_output The menu item output.
	 * @param  WP_Post $item        Menu item object.
	 * @param  int     $depth       Depth of the menu.
	 * @param  array   $args        wp_nav_menu() arguments.
	 * @return string  $item_output The menu item output with social icon.
	 */
	static function nav_menu_social_icons( $item_output, $item, $depth, $args ) {

		// Get supported social icons.
		$social_icons = self::supported_social_icons();

		// Change SVG icon inside social links menu if there is supported URL.
		if ( 'social' === $args->theme_location ) {
			$icon = 'star';
			foreach ( $social_icons as $attr => $value ) {
				if ( false !== strpos( $item_output, $attr ) ) {
					$icon = esc_attr( $value );
				}
			}
			$item_output = str_replace( $args->link_after, '</span>' . self::get_svg( $icon ), $item_output );
		}

		return $item_output;
	}

	/**
	 * Return SVG markup.
	 *
	 * @param string $icon SVG icon id.
	 * @return string $svg SVG markup.
	 */
	static function get_svg( $icon = null ) {
		// Return early if no icon was defined.
		if ( empty( $icon ) ) {
			return;
		}

		// Create SVG markup.
		$svg = '<svg class="icon icon-' . esc_attr( $icon ) . '" aria-hidden="true" role="img">';
		$svg .= ' <use xlink:href="' . MERCIA_PRO_PLUGIN_URL . 'assets/icons/social-icons.svg#icon-' . esc_html( $icon ) . '"></use> ';
		$svg .= '</svg>';

		return $svg;
	}

	/**
	 * Returns an array of supported social links (URL and icon name).
	 *
	 * @return array $social_links_icons
	 */
	static function supported_social_icons() {
		// Supported social links icons.
		$supported_social_icons = array(
			'500px.com'       => '500px',
			'amazon'          => 'amazon',
			'apple'           => 'apple',
			'bandcamp.com'    => 'bandcamp',
			'behance.net'     => 'behance',
			'bitbucket.org'   => 'bitbucket',
			'codepen.io'      => 'codepen',
			'deviantart.com'  => 'deviantart',
			'digg.com'        => 'digg',
			'dribbble.com'    => 'dribbble',
			'dropbox.com'     => 'dropbox',
			'etsy.com'        => 'etsy',
			'facebook.com'    => 'facebook',
			'feed'            => 'feed',
			'flickr.com'      => 'flickr',
			'foursquare.com'  => 'foursquare',
			'plus.google.com' => 'google-plus',
			'github.com'      => 'github',
			'instagram.com'   => 'instagram',
			'linkedin.com'    => 'linkedin',
			'mailto:'         => 'envelope-o',
			'medium.com'      => 'medium',
			'meetup.com'      => 'meetup',
			'pinterest.com'   => 'pinterest-p',
			'getpocket.com'   => 'get-pocket',
			'reddit.com'      => 'reddit-alien',
			'skype.com'       => 'skype',
			'skype:'          => 'skype',
			'slideshare.net'  => 'slideshare',
			'snapchat.com'    => 'snapchat-ghost',
			'soundcloud.com'  => 'soundcloud',
			'spotify.com'     => 'spotify',
			'stumbleupon.com' => 'stumbleupon',
			'tumblr.com'      => 'tumblr',
			'twitch.tv'       => 'twitch',
			'twitter.com'     => 'twitter',
			'vimeo.com'       => 'vimeo',
			'vine.co'         => 'vine',
			'vk.com'          => 'vk',
			'wordpress.org'   => 'wordpress',
			'wordpress.com'   => 'wordpress',
			'xing.com'        => 'xing',
			'yelp.com'        => 'yelp',
			'youtube.com'     => 'youtube',
		);

		return $supported_social_icons;
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
			'social' => esc_html__( 'Social Icons', 'mercia-pro' ),
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Mercia_Pro_Header_Bar', 'setup' ) );

// Register navigation menus in backend.
add_action( 'after_setup_theme', array( 'Mercia_Pro_Header_Bar', 'register_nav_menus' ), 20 );
