<?php
/**
 * IslamNET Setup Wizard
 *
 * Initializes and configures Merlin WP setup wizard for IslamNET theme.
 *
 * @package IslamNET
 * @author QALAM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class IslamNET_Setup_Wizard {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'init_merlin' ) );
	}

	/**
	 * Initialize Merlin WP Setup Wizard
	 */
	public function init_merlin() {
		// Check if Merlin class exists
		if ( ! class_exists( 'Merlin' ) ) {
			require_once ISLAMNET_THEME_DIR . '/inc/Merlin/class-merlin.php';
		}

		// Define Merlin configuration
		$wizard_config = array(
			'directory'            => 'Merlin',
			'merlin_url'           => 'islamnet-setup',
			'parent_slug'          => 'themes.php',
			'capability'           => 'manage_options',
			'child_action_button_url' => 'https://codex.wordpress.org/Child_Themes',
			'dev_mode'             => false,
			'license_step'         => false,
			'license_required'     => false,
			'show_on_admin'        => false,
			'steps'                => array(
				'welcome',
				'plugins',
				'content',
				'finished',
			),
		);

		// Initialize Merlin
		$merlin = new Merlin( $wizard_config );

		// Define demo content files
		$demo_content_path = ISLAMNET_THEME_DIR . '/inc/demo-content/';

		// Configure demo content import
		if ( method_exists( $merlin, 'set_demo_content' ) ) {
			$merlin->set_demo_content( array(
				'content'    => $demo_content_path . 'content.xml',
				'widgets'    => $demo_content_path . 'widgets.wie',
				'customizer' => $demo_content_path . 'customizer.dat',
			) );
		}
	}
}

// Instantiate the setup wizard
new IslamNET_Setup_Wizard();
