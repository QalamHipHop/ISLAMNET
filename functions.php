<?php
/**
 * IslamNET Theme Functions and Definitions
 *
 * @package IslamNET
 * @author QALAM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'ISLAMNET_THEME_VERSION', '1.2.0' );
define( 'ISLAMNET_THEME_DIR', get_template_directory() );
define( 'ISLAMNET_THEME_URL', get_template_directory_uri() );
define( 'ISLAMNET_THEME_ASSETS', ISLAMNET_THEME_URL . '/assets' );

/**
 * Include TGM Plugin Activation
 */
require_once ISLAMNET_THEME_DIR . '/inc/tgmpa/class-tgm-plugin-activation.php';

/**
 * Include Setup Wizard
 */
require_once ISLAMNET_THEME_DIR . '/inc/setup/class-islamnet-setup-wizard.php';

/**
 * Include Helper Functions
 */
require_once ISLAMNET_THEME_DIR . '/inc/helpers/helper-functions.php';
require_once ISLAMNET_THEME_DIR . '/inc/helpers/buddypress-integration.php';
require_once ISLAMNET_THEME_DIR . '/inc/widgets/custom-widgets.php';

/**
 * Register Required and Recommended Plugins
 */
add_action( 'tgmpa_register', 'islamnet_register_required_plugins' );
function islamnet_register_required_plugins() {
	$plugins = array(
		// Required Plugins
		array(
			'name'      => esc_html__( 'BuddyPress', 'islamnet' ),
			'slug'      => 'buddypress',
			'required'  => true,
			'version'   => '',
		),
		array(
			'name'      => esc_html__( 'Elementor Website Builder', 'islamnet' ),
			'slug'      => 'elementor',
			'required'  => true,
			'version'   => '',
		),
		array(
			'name'      => esc_html__( 'Advanced Custom Fields', 'islamnet' ),
			'slug'      => 'advanced-custom-fields',
			'required'  => true,
			'version'   => '',
		),
		// Recommended Plugins for Learning
		array(
			'name'      => esc_html__( 'LearnPress', 'islamnet' ),
			'slug'      => 'learnpress',
			'required'  => false,
			'version'   => '',
		),
		// Recommended Plugins for Gamification
		array(
			'name'      => esc_html__( 'GamiPress', 'islamnet' ),
			'slug'      => 'gamipress',
			'required'  => false,
			'version'   => '',
		),
		// Recommended Plugins for Media
		array(
			'name'      => esc_html__( 'rtMedia for BuddyPress & Buddyboss', 'islamnet' ),
			'slug'      => 'rtmedia',
			'required'  => false,
			'version'   => '',
		),
		// Recommended Plugins for Translation
		array(
			'name'      => esc_html__( 'Loco Translate', 'islamnet' ),
			'slug'      => 'loco-translate',
			'required'  => false,
			'version'   => '',
		),
		// Recommended Plugins for E-commerce
		array(
			'name'      => esc_html__( 'WooCommerce', 'islamnet' ),
			'slug'      => 'woocommerce',
			'required'  => false,
			'version'   => '',
		),
		// Recommended Plugins for Contact Forms
		array(
			'name'      => esc_html__( 'Contact Form 7', 'islamnet' ),
			'slug'      => 'contact-form-7',
			'required'  => false,
			'version'   => '',
		),
		// Recommended Plugins for SEO
		array(
			'name'      => esc_html__( 'Yoast SEO', 'islamnet' ),
			'slug'      => 'wordpress-seo',
			'required'  => false,
			'version'   => '',
		),
		// Recommended Plugins for Performance
		array(
			'name'      => esc_html__( 'WP Super Cache', 'islamnet' ),
			'slug'      => 'wp-super-cache',
			'required'  => false,
			'version'   => '',
		),
	);

	$config = array(
		'id'           => 'islamnet',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => '',
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'islamnet' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'islamnet' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'islamnet' ),
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'islamnet' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'islamnet' ),
			'notice_can_install_required'     => _n_noop(
				'IslamNET requires the following plugin: %1$s.',
				'IslamNET requires the following plugins: %1$s.',
				'islamnet'
			),
			'notice_can_install_recommended'  => _n_noop(
				'IslamNET recommends the following plugin: %1$s.',
				'IslamNET recommends the following plugins: %1$s.',
				'islamnet'
			),
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with IslamNET: %1$s.',
				'The following plugins need to be updated to their latest versions to ensure maximum compatibility with IslamNET: %1$s.',
				'islamnet'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for: %1$s.',
				'islamnet'
			),
			'notice_can_activate'             => _n_noop(
				'The following plugin is currently inactive: %1$s.',
				'The following plugins are currently inactive: %1$s.',
				'islamnet'
			),
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'islamnet'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'islamnet'
			),
			'update_link'                     => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'islamnet'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'islamnet'
			),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'islamnet' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'islamnet' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. IslamNET is now ready to use!', 'islamnet' ),
			'pro_label'                       => esc_html__( 'Premium', 'islamnet' ),
		),
	);

	tgmpa( $plugins, $config );
}

/**
 * Theme Setup
 */
function islamnet_setup() {
	load_theme_textdomain( 'islamnet', ISLAMNET_THEME_DIR . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'responsive-embeds' );
	
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'islamnet' ),
		'footer'  => esc_html__( 'Footer Menu', 'islamnet' ),
		'mobile'  => esc_html__( 'Mobile Menu', 'islamnet' ),
	) );
}
add_action( 'after_setup_theme', 'islamnet_setup' );

/**
 * Register widget areas.
 */
function islamnet_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'islamnet' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Main sidebar for pages and posts', 'islamnet' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget Area', 'islamnet' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Footer sidebar for widgets', 'islamnet' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'islamnet_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function islamnet_scripts() {
	// Main stylesheet
	wp_enqueue_style( 'islamnet-main-style', get_stylesheet_uri(), array(), ISLAMNET_THEME_VERSION );
	
	// Custom CSS
	wp_enqueue_style( 'islamnet-custom', ISLAMNET_THEME_ASSETS . '/css/main.css', array(), ISLAMNET_THEME_VERSION );
	
	// RTL Support
	if ( is_rtl() ) {
		wp_enqueue_style( 'islamnet-rtl', ISLAMNET_THEME_ASSETS . '/css/rtl.css', array(), ISLAMNET_THEME_VERSION );
	}
	
	// BuddyPress Custom Styles
	if ( class_exists( 'BuddyPress' ) ) {
		wp_enqueue_style( 'islamnet-buddypress', ISLAMNET_THEME_ASSETS . '/css/buddypress-custom.css', array(), ISLAMNET_THEME_VERSION );
	}
	
	// Main JavaScript
	if ( file_exists( ISLAMNET_THEME_DIR . '/assets/js/main.js' ) ) {
		wp_enqueue_script( 'islamnet-main-js', ISLAMNET_THEME_ASSETS . '/js/main.js', array( 'jquery' ), ISLAMNET_THEME_VERSION, true );
	}
	
	// Comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'islamnet_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function islamnet_admin_scripts() {
	wp_enqueue_style( 'islamnet-admin', ISLAMNET_THEME_ASSETS . '/css/admin-custom.css', array(), ISLAMNET_THEME_VERSION );
}
add_action( 'admin_enqueue_scripts', 'islamnet_admin_scripts' );

/**
 * Custom logo support
 */
add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 300,
	'flex-height' => true,
	'flex-width'  => true,
) );

/**
 * Custom header support
 */
add_theme_support( 'custom-header', array(
	'default-image' => '',
	'width'         => 1200,
	'height'        => 200,
	'flex-height'   => true,
	'flex-width'    => true,
) );

/**
 * Custom background support
 */
add_theme_support( 'custom-background', array(
	'default-color' => 'ffffff',
	'default-image' => '',
) );
