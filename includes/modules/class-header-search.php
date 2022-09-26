<?php
/**
 * Header Search
 *
 * Displays header search in main navigation menu
 *
 * @package Mercia Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Search Class
 */
class Mercia_Pro_Header_Search {

	/**
	 * Header Search Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Mercia Theme is not active.
		if ( ! current_theme_supports( 'mercia-pro' ) ) {
			return;
		}

		// Enqueue Header Search JavaScript.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_script' ) );

		// Add search icon on main navigation menu.
		add_action( 'mercia_header_search', array( __CLASS__, 'add_header_search' ) );

		// Add Header Search checkbox in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'header_search_settings' ) );

		// Hide Header Search if disabled.
		add_filter( 'mercia_hide_elements', array( __CLASS__, 'hide_header_search' ) );
	}

	/**
	 * Enqueue Scroll-To-Top JavaScript
	 *
	 * @return void
	 */
	static function enqueue_script() {

		// Get Theme Options from Database.
		$theme_options = Mercia_Pro_Customizer::get_theme_options();

		// Embed header search JS if enabled.
		if ( ( true === $theme_options['header_search'] || is_customize_preview() ) && ! self::is_amp() ) :

			wp_enqueue_script( 'mercia-pro-header-search', MERCIA_PRO_PLUGIN_URL . 'assets/js/header-search.min.js', array(), '20220121', true );

		endif;
	}

	/**
	 * Add search form to navigation menu
	 *
	 * @return void
	 */
	static function add_header_search() {

		// Get Theme Options from Database.
		$theme_options = Mercia_Pro_Customizer::get_theme_options();

		// Show header search if activated.
		if ( true === $theme_options['header_search'] || is_customize_preview() ) : ?>

			<div class="header-search">

				<button class="header-search-icon" aria-label="<?php esc_attr_e( 'Open search form', 'mercia-pro' ); ?>" aria-expanded="false" aria-controls="header-search-dropdown" <?php self::amp_search_toggle(); ?>>
					<?php echo mercia_get_svg( 'search' ); ?>
				</button>

				<div id="header-search-dropdown" class="header-search-form-wrap" <?php self::amp_search_is_toggled(); ?>>

					<div class="header-search-form">
						<?php get_search_form(); ?>
						<a class="header-search-close" <?php self::amp_search_toggle(); ?>>
							<?php echo mercia_get_svg( 'close' ); ?>
						</a>
					</div>

				</div>

			</div>

			<?php
		endif;
	}

	/**
	 * Adds header search checkbox setting
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function header_search_settings( $wp_customize ) {

		// Add Header Search Headline.
		$wp_customize->add_control( new Mercia_Customize_Header_Control(
			$wp_customize, 'mercia_theme_options[header_search_title]', array(
				'label'    => esc_html__( 'Header Search', 'mercia-pro' ),
				'section'  => 'mercia_pro_section_header',
				'settings' => array(),
				'priority' => 40,
			)
		) );

		// Add Header Search setting and control.
		$wp_customize->add_setting( 'mercia_theme_options[header_search]', array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'mercia_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'mercia_theme_options[header_search]', array(
			'label'    => esc_html__( 'Enable search field in header', 'mercia-pro' ),
			'section'  => 'mercia_pro_section_header',
			'settings' => 'mercia_theme_options[header_search]',
			'type'     => 'checkbox',
			'priority' => 50,
		) );
	}

	/**
	 * Hide Header Search if deactivated.
	 *
	 * @param array $elements / Elements to be hidden.
	 * @return array $elements
	 */
	static function hide_header_search( $elements ) {

		// Get Theme Options from Database.
		$theme_options = Mercia_Pro_Customizer::get_theme_options();

		// Hide Header Search?
		if ( false === $theme_options['header_search'] ) {
			$elements[] = '.primary-navigation-wrap .header-search';
		}

		return $elements;
	}

	/**
	 * Checks if AMP page is rendered.
	 */
	static function is_amp() {
		return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
	}

	/**
	 * Adds amp support for search toggle.
	 */
	static function amp_search_toggle() {
		if ( self::is_amp() ) {
			echo "[aria-expanded]=\"headerSearchExpanded? 'true' : 'false'\" ";
			echo 'on="tap:AMP.setState({headerSearchExpanded: !headerSearchExpanded})"';
		}
	}

	/**
	 * Adds amp support for search form.
	 */
	static function amp_search_is_toggled() {
		if ( self::is_amp() ) {
			echo "[class]=\"'header-search-form-wrap' + ( headerSearchExpanded ? ' toggled-on' : '' )\"";
		}
	}
}

// Run Class.
add_action( 'init', array( 'Mercia_Pro_Header_Search', 'setup' ) );
