<?php
/**
 * Helper functions for IslamNET theme
 *
 * @package IslamNET
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if BuddyPress is active
 */
function islamnet_is_buddypress_active() {
	return class_exists( 'BuddyPress' );
}

/**
 * Check if LearnPress is active
 */
function islamnet_is_learnpress_active() {
	return class_exists( 'LearnPress' );
}

/**
 * Check if Elementor is active
 */
function islamnet_is_elementor_active() {
	return did_action( 'elementor/loaded' );
}

/**
 * Get theme option (Placeholder for future customizer integration)
 */
function islamnet_get_option( $option_id, $default = '' ) {
	return get_theme_mod( $option_id, $default );
}
