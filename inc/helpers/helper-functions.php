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

/**
 * Get Prayer Times for a given location
 * (This is a skeleton for integration with external APIs like Aladhan)
 */
function islamnet_get_prayer_times( $city = 'Tehran', $country = 'Iran' ) {
    $transient_key = 'islamnet_prayer_times_' . md_5( $city . $country );
    $prayer_times = get_transient( $transient_key );

    if ( false === $prayer_times ) {
        // In a real scenario, we would call an API here
        // Example: https://api.aladhan.com/v1/timingsByCity
        $prayer_times = array(
            'Fajr'    => '04:15',
            'Dhuhr'   => '13:05',
            'Asr'     => '16:50',
            'Maghrib' => '20:10',
            'Isha'    => '21:45',
        );
        set_transient( $transient_key, $prayer_times, HOUR_IN_SECONDS * 12 );
    }

    return $prayer_times;
}

/**
 * Convert Gregorian date to Hijri
 */
function islamnet_get_hijri_date( $date = null ) {
    // This would ideally use a library or an API
    return "1447/12/10"; // Placeholder
}

/**
 * Add custom BuddyPress profile fields for religious information
 */
function islamnet_add_religious_profile_fields() {
    if ( ! function_exists( 'xprofile_insert_field' ) ) {
        return;
    }

    // Example of adding a field group and fields programmatically during theme setup
    // This should be called on a specific hook or checked if already exists
}

/**
 * Custom Messaging UI Enhancements for BuddyPress
 */
add_action( 'wp_enqueue_scripts', function() {
    if ( islamnet_is_buddypress_active() && bp_is_messages_component() ) {
        // Add specific JS/CSS for messaging
    }
});
