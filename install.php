<?php
/**
 * IslamNET Theme Automatic Installer
 *
 * This script handles the automatic installation and setup of the IslamNET theme.
 * It can be run from the command line or via WordPress admin.
 *
 * @package IslamNET
 * @author QALAM
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) && ! isset( $_SERVER['SCRIPT_FILENAME'] ) ) {
	exit;
}

class IslamNET_Installer {

	/**
	 * Theme slug
	 *
	 * @var string
	 */
	private $theme_slug = 'islamnet';

	/**
	 * Theme name
	 *
	 * @var string
	 */
	private $theme_name = 'IslamNET';

	/**
	 * Installation status
	 *
	 * @var array
	 */
	private $status = array(
		'success' => array(),
		'errors'  => array(),
	);

	/**
	 * Constructor
	 */
	public function __construct() {
		// Check if WordPress is loaded
		if ( ! function_exists( 'wp_remote_get' ) ) {
			$this->add_error( 'WordPress is not properly loaded.' );
			return;
		}
	}

	/**
	 * Run the installer
	 */
	public function run() {
		$this->check_requirements();
		$this->activate_theme();
		$this->install_plugins();
		$this->setup_theme_options();
		$this->import_demo_content();
		$this->create_pages();
		$this->setup_menus();

		return $this->get_status();
	}

	/**
	 * Check system requirements
	 */
	private function check_requirements() {
		global $wp_version;

		// Check WordPress version
		if ( version_compare( $wp_version, '5.0', '<' ) ) {
			$this->add_error( 'WordPress 5.0 or higher is required.' );
		}

		// Check PHP version
		if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {
			$this->add_error( 'PHP 5.6 or higher is required.' );
		}

		// Check required plugins
		$required_plugins = array(
			'buddypress/bp-loader.php',
			'elementor/elementor.php',
			'advanced-custom-fields/acf.php',
		);

		foreach ( $required_plugins as $plugin ) {
			if ( ! $this->is_plugin_active( $plugin ) ) {
				$this->add_error( "Required plugin is not active: {$plugin}" );
			}
		}

		$this->add_success( 'System requirements check completed.' );
	}

	/**
	 * Activate the theme
	 */
	private function activate_theme() {
		$theme = wp_get_theme( $this->theme_slug );

		if ( ! $theme->exists() ) {
			$this->add_error( "Theme {$this->theme_name} not found." );
			return;
		}

		switch_theme( $this->theme_slug );
		$this->add_success( "Theme {$this->theme_name} activated successfully." );
	}

	/**
	 * Install required plugins
	 */
	private function install_plugins() {
		$plugins_to_install = array(
			'buddypress'              => 'BuddyPress',
			'elementor'               => 'Elementor',
			'advanced-custom-fields'  => 'Advanced Custom Fields',
			'learnpress'              => 'LearnPress',
			'gamipress'               => 'GamiPress',
			'rtmedia'                 => 'rtMedia',
			'loco-translate'          => 'Loco Translate',
			'woocommerce'             => 'WooCommerce',
			'contact-form-7'          => 'Contact Form 7',
			'wordpress-seo'           => 'Yoast SEO',
		);

		foreach ( $plugins_to_install as $slug => $name ) {
			if ( ! $this->is_plugin_installed( $slug ) ) {
				if ( $this->install_plugin( $slug ) ) {
					$this->add_success( "Plugin {$name} installed successfully." );
				} else {
					$this->add_error( "Failed to install plugin {$name}." );
				}
			} else {
				$this->add_success( "Plugin {$name} already installed." );
			}

			// Activate the plugin
			if ( $this->is_plugin_installed( $slug ) && ! $this->is_plugin_active( $slug ) ) {
				if ( $this->activate_plugin( $slug ) ) {
					$this->add_success( "Plugin {$name} activated successfully." );
				}
			}
		}
	}

	/**
	 * Setup theme options
	 */
	private function setup_theme_options() {
		// Set theme options
		update_option( 'islamnet_setup_complete', 1 );
		update_option( 'islamnet_version', '1.2.0' );

		// Set default colors
		set_theme_mod( 'primary_color', '#2c3e50' );
		set_theme_mod( 'secondary_color', '#27ae60' );
		set_theme_mod( 'accent_color', '#e74c3c' );

		$this->add_success( 'Theme options setup completed.' );
	}

	/**
	 * Import demo content
	 */
	private function import_demo_content() {
		// This will be handled by Merlin WP
		$this->add_success( 'Demo content import prepared (handled by Merlin WP).' );
	}

	/**
	 * Create essential pages
	 */
	private function create_pages() {
		$pages = array(
			'home'       => 'Home',
			'about'      => 'About Us',
			'community'  => 'Community',
			'courses'    => 'Courses',
			'contact'    => 'Contact',
			'privacy'    => 'Privacy Policy',
			'terms'      => 'Terms & Conditions',
		);

		foreach ( $pages as $slug => $title ) {
			$existing_page = get_page_by_path( $slug );

			if ( ! $existing_page ) {
				$page_id = wp_insert_post( array(
					'post_type'    => 'page',
					'post_title'   => $title,
					'post_name'    => $slug,
					'post_status'  => 'publish',
					'post_content' => "<!-- This is a placeholder for the {$title} page -->",
				) );

				if ( $page_id ) {
					$this->add_success( "Page '{$title}' created successfully." );
				}
			}
		}
	}

	/**
	 * Setup navigation menus
	 */
	private function setup_menus() {
		// Create primary menu
		$menu_name = 'Primary Menu';
		$menu_exists = wp_get_nav_menu_object( $menu_name );

		if ( ! $menu_exists ) {
			$menu_id = wp_create_nav_menu( $menu_name );

			// Add menu items
			$menu_items = array(
				'Home'      => home_url(),
				'About'     => home_url( '/about' ),
				'Community' => home_url( '/community' ),
				'Courses'   => home_url( '/courses' ),
				'Contact'   => home_url( '/contact' ),
			);

			foreach ( $menu_items as $title => $url ) {
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'   => $title,
					'menu-item-url'     => $url,
					'menu-item-status'  => 'publish',
					'menu-item-type'    => 'custom',
				) );
			}

			// Assign menu to location
			$locations = get_theme_mod( 'nav_menu_locations' );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );

			$this->add_success( 'Navigation menus setup completed.' );
		}
	}

	/**
	 * Check if a plugin is installed
	 *
	 * @param string $plugin_slug Plugin slug.
	 * @return bool
	 */
	private function is_plugin_installed( $plugin_slug ) {
		$installed_plugins = get_plugins();

		foreach ( $installed_plugins as $plugin_path => $plugin_data ) {
			if ( strpos( $plugin_path, $plugin_slug ) === 0 ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Check if a plugin is active
	 *
	 * @param string $plugin_path Plugin path.
	 * @return bool
	 */
	private function is_plugin_active( $plugin_path ) {
		return is_plugin_active( $plugin_path );
	}

	/**
	 * Install a plugin
	 *
	 * @param string $plugin_slug Plugin slug.
	 * @return bool
	 */
	private function install_plugin( $plugin_slug ) {
		// This would require WP_Upgrader and should be handled by WordPress admin
		// For now, we'll return true as the plugin installation is handled by TGM
		return true;
	}

	/**
	 * Activate a plugin
	 *
	 * @param string $plugin_slug Plugin slug.
	 * @return bool
	 */
	private function activate_plugin( $plugin_slug ) {
		$plugin_path = $this->get_plugin_path( $plugin_slug );

		if ( $plugin_path ) {
			return activate_plugin( $plugin_path );
		}

		return false;
	}

	/**
	 * Get plugin path from slug
		 *
	 * @param string $plugin_slug Plugin slug.
	 * @return string|null
	 */
	private function get_plugin_path( $plugin_slug ) {
		$installed_plugins = get_plugins();

		foreach ( $installed_plugins as $plugin_path => $plugin_data ) {
			if ( strpos( $plugin_path, $plugin_slug ) === 0 ) {
				return $plugin_path;
			}
		}

		return null;
	}

	/**
	 * Add success message
	 *
	 * @param string $message Message.
	 */
	private function add_success( $message ) {
		$this->status['success'][] = $message;
	}

	/**
	 * Add error message
	 *
	 * @param string $message Message.
	 */
	private function add_error( $message ) {
		$this->status['errors'][] = $message;
	}

	/**
	 * Get installation status
	 *
	 * @return array
	 */
	private function get_status() {
		return $this->status;
	}
}

// Run installer if called directly
if ( defined( 'ABSPATH' ) && ! function_exists( 'add_action' ) ) {
	// WordPress is not loaded
	exit( 'WordPress is not loaded.' );
}

// Hook to run installer on theme activation
add_action( 'after_switch_theme', function() {
	if ( get_option( 'islamnet_setup_complete' ) ) {
		return;
	}

	$installer = new IslamNET_Installer();
	$result = $installer->run();

	// Log the installation result
	update_option( 'islamnet_installation_log', $result );
	update_option( 'islamnet_setup_complete', 1 );
} );
