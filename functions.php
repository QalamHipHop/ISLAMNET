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
define( 'ISLAMNET_THEME_VERSION', '1.1.0' );
define( 'ISLAMNET_THEME_DIR', get_template_directory() );
define( 'ISLAMNET_THEME_URL', get_template_directory_uri() );

/**
 * Include TGM Plugin Activation
 */
require_once ISLAMNET_THEME_DIR . '/inc/tgmpa/class-tgm-plugin-activation.php';

/**
 * Include Helper Functions
 */
require_once ISLAMNET_THEME_DIR . '/inc/helpers/helper-functions.php';
require_once ISLAMNET_THEME_DIR . '/inc/helpers/buddypress-integration.php';
require_once ISLAMNET_THEME_DIR . '/inc/widgets/custom-widgets.php';

/**
 * Register Required Plugins
 */
add_action( 'tgmpa_register', 'islamnet_register_required_plugins' );
function islamnet_register_required_plugins() {
	$plugins = array(
		array( 'name' => 'BuddyPress', 'slug' => 'buddypress', 'required' => true ),
		array( 'name' => 'Elementor Website Builder', 'slug' => 'elementor', 'required' => true ),
		array( 'name' => 'LearnPress', 'slug' => 'learnpress', 'required' => false ),
		array( 'name' => 'GamiPress', 'slug' => 'gamipress', 'required' => false ),
		array( 'name' => 'rtMedia', 'slug' => 'rtmedia', 'required' => false ),
		array( 'name' => 'Loco Translate', 'slug' => 'loco-translate', 'required' => false ),
		array( 'name' => 'WooCommerce', 'slug' => 'woocommerce', 'required' => false ),
		array( 'name' => 'Contact Form 7', 'slug' => 'contact-form-7', 'required' => false ),
	);

	$config = array(
		'id'           => 'islamnet',
		'is_automatic' => true,
		'menu'         => 'tgmpa-install-plugins',
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
	
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'islamnet' ),
		'footer'  => esc_html__( 'Footer Menu', 'islamnet' ),
	) );
}
add_action( 'after_setup_theme', 'islamnet_setup' );

/**
 * Register widget area.
 */
function islamnet_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'islamnet' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'islamnet' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'islamnet_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function islamnet_scripts() {
	wp_enqueue_style( 'islamnet-main-style', get_stylesheet_uri(), array(), ISLAMNET_THEME_VERSION );
	wp_enqueue_style( 'islamnet-custom', ISLAMNET_THEME_URL . '/assets/css/main.css', array(), ISLAMNET_THEME_VERSION );
	if ( is_rtl() ) {
		wp_enqueue_style( 'islamnet-rtl', ISLAMNET_THEME_URL . '/rtl.css', array(), ISLAMNET_THEME_VERSION );
	}
	// Add custom JS if exists
	if ( file_exists( ISLAMNET_THEME_DIR . '/assets/js/main.js' ) ) {
		wp_enqueue_script( 'islamnet-main-js', ISLAMNET_THEME_URL . '/assets/js/main.js', array( 'jquery' ), ISLAMNET_THEME_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'islamnet_scripts' );
