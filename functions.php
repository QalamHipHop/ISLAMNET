<?php
/**
 * IslamNET Theme Functions and Definitions
 *
 * @package IslamNET
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Include TGM Plugin Activation for bundling required plugins.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'islamnet_register_required_plugins' );

function islamnet_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'BuddyPress',
			'slug'      => 'buddypress',
			'required'  => true,
		),
		array(
			'name'      => 'Elementor Website Builder',
			'slug'      => 'elementor',
			'required'  => true,
		),
		array(
			'name'      => 'LearnPress - WordPress LMS Plugin',
			'slug'      => 'learnpress',
			'required'  => false,
		),
		array(
			'name'      => 'GamiPress',
			'slug'      => 'gamipress',
			'required'  => false,
		),
		array(
			'name'      => 'rtMedia for WordPress, BuddyPress and bbPress',
			'slug'      => 'rtmedia',
			'required'  => false,
		),
		array(
			'name'      => 'Loco Translate',
			'slug'      => 'loco-translate',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'islamnet',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}

/**
 * Setup Theme features.
 */
function islamnet_setup() {
	load_theme_textdomain( 'islamnet', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'islamnet_setup' );

/**
 * Enqueue scripts and styles.
 */
function islamnet_scripts() {
	wp_enqueue_style( 'islamnet-style', get_stylesheet_uri() );
	if ( is_rtl() ) {
		wp_enqueue_style( 'islamnet-rtl', get_template_directory_uri() . '/rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'islamnet_scripts' );
