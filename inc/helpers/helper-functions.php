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
 * Check if GamiPress is active
 */
function islamnet_is_gamipress_active() {
	return class_exists( 'GamiPress' );
}

/**
 * Check if WooCommerce is active
 */
function islamnet_is_woocommerce_active() {
	return class_exists( 'WooCommerce' );
}

/**
 * Get theme option (Placeholder for future customizer integration)
 */
function islamnet_get_option( $option_id, $default = '' ) {
	return get_theme_mod( $option_id, $default );
}

/**
 * Get Prayer Times for a given location using Aladhan API
 * 
 * @param string $city City name
 * @param string $country Country name
 * @param string $method Prayer time calculation method (default: 2 for ISNA)
 * @return array Prayer times array or error message
 */
function islamnet_get_prayer_times( $city = 'Tehran', $country = 'Iran', $method = '2' ) {
	// Generate transient key based on city and country
	$transient_key = 'islamnet_prayer_times_' . md5( $city . $country . $method );
	$prayer_times = get_transient( $transient_key );

	if ( false === $prayer_times ) {
		// Call Aladhan API for prayer times
		$api_url = add_query_arg(
			array(
				'city'    => urlencode( $city ),
				'country' => urlencode( $country ),
				'method'  => intval( $method ),
			),
			'https://api.aladhan.com/v1/timingsByCity'
		);

		$response = wp_remote_get( $api_url, array(
			'timeout' => 10,
		) );

		if ( is_wp_error( $response ) ) {
			// Return cached data or default on error
			return array(
				'error' => $response->get_error_message(),
				'Fajr'    => '04:15',
				'Dhuhr'   => '13:05',
				'Asr'     => '16:50',
				'Maghrib' => '20:10',
				'Isha'    => '21:45',
			);
		}

		$body = wp_remote_retrieve_body( $response );
		$data = json_decode( $body, true );

		if ( isset( $data['data']['timings'] ) ) {
			$prayer_times = array(
				'Fajr'    => substr( $data['data']['timings']['Fajr'], 0, 5 ),
				'Sunrise' => substr( $data['data']['timings']['Sunrise'], 0, 5 ),
				'Dhuhr'   => substr( $data['data']['timings']['Dhuhr'], 0, 5 ),
				'Asr'     => substr( $data['data']['timings']['Asr'], 0, 5 ),
				'Maghrib' => substr( $data['data']['timings']['Maghrib'], 0, 5 ),
				'Isha'    => substr( $data['data']['timings']['Isha'], 0, 5 ),
				'date'    => $data['data']['date']['readable'],
				'hijri'   => $data['data']['date']['hijri']['date'],
			);
		} else {
			// Return default values on API error
			$prayer_times = array(
				'error'   => 'API Error',
				'Fajr'    => '04:15',
				'Sunrise' => '05:45',
				'Dhuhr'   => '13:05',
				'Asr'     => '16:50',
				'Maghrib' => '20:10',
				'Isha'    => '21:45',
			);
		}

		// Cache for 24 hours
		set_transient( $transient_key, $prayer_times, DAY_IN_SECONDS );
	}

	return $prayer_times;
}

/**
 * Convert Gregorian date to Hijri date
 * 
 * @param string|int $date Gregorian date (timestamp or date string)
 * @return string Hijri date in format YYYY/MM/DD
 */
function islamnet_get_hijri_date( $date = null ) {
	if ( null === $date ) {
		$date = time();
	} elseif ( is_string( $date ) ) {
		$date = strtotime( $date );
	}

	// Use Aladhan API to convert Gregorian to Hijri
	$gregorian_date = date( 'd-m-Y', $date );
	$api_url = add_query_arg(
		array(
			'g' => $gregorian_date,
		),
		'https://api.aladhan.com/v1/convert'
	);

	$response = wp_remote_get( $api_url, array(
		'timeout' => 10,
	) );

	if ( is_wp_error( $response ) ) {
		// Return fallback calculation if API fails
		return islamnet_gregorian_to_hijri_fallback( $date );
	}

	$body = wp_remote_retrieve_body( $response );
	$data = json_decode( $body, true );

	if ( isset( $data['data']['hijri']['date'] ) ) {
		return $data['data']['hijri']['date'];
	}

	return islamnet_gregorian_to_hijri_fallback( $date );
}

/**
 * Fallback function to convert Gregorian to Hijri date
 * Using a simple mathematical algorithm
 * 
 * @param int $timestamp Unix timestamp
 * @return string Hijri date
 */
function islamnet_gregorian_to_hijri_fallback( $timestamp ) {
	$date = new DateTime( '@' . $timestamp );
	$g_y = (int) $date->format( 'Y' );
	$g_m = (int) $date->format( 'm' );
	$g_d = (int) $date->format( 'd' );

	$jd = (int) ( ( 1461 * ( $g_y + 4800 + (int) ( ( $g_m - 14 ) / 12 ) ) ) / 4 ) +
		(int) ( ( 367 * ( $g_m - 2 - 12 * ( (int) ( ( $g_m - 14 ) / 12 ) ) ) ) / 12 ) -
		(int) ( ( 3 * ( (int) ( ( $g_y + 4900 + (int) ( ( $g_m - 14 ) / 12 ) ) / 100 ) ) ) / 4 ) +
		$g_d - 32045;

	$l = $jd - 1948440 + 10632;
	$n = (int) ( ( $l - 1 ) / 10631 );
	$l = $l - 10631 * $n + 354;
	$j = (int) ( ( 10985 - $l ) / 5316 ) * (int) ( ( 50 * $l ) / 17719 ) + (int) ( $l / 5670 ) * (int) ( ( 43 * $l ) / 15238 );
	$l = $l - (int) ( ( 30 - $j ) / 15 ) * (int) ( ( 17719 * $j ) / 50 ) - (int) ( $j / 16 ) * (int) ( ( 15238 * $j ) / 43 ) + 29;
	$m = (int) ( ( 24 * $l ) / 709 );
	$d = $l - (int) ( ( 709 * $m ) / 24 );
	$y = 30 * $n + $j - 30;

	return sprintf( '%04d/%02d/%02d', $y, $m, $d );
}

/**
 * Add custom BuddyPress profile fields for religious information
 */
function islamnet_add_religious_profile_fields() {
	if ( ! function_exists( 'xprofile_insert_field' ) || ! islamnet_is_buddypress_active() ) {
		return;
	}

	// Check if field group already exists
	$field_group_id = xprofile_get_field_group_id_by_name( __( 'Islamic Information', 'islamnet' ) );

	if ( ! $field_group_id ) {
		// Create field group
		$field_group_id = xprofile_insert_field_group( array(
			'name'        => __( 'Islamic Information', 'islamnet' ),
			'description' => __( 'Additional Islamic profile information', 'islamnet' ),
		) );
	}

	// Define fields to add
	$fields = array(
		array(
			'name'        => __( 'School of Thought (Madhab)', 'islamnet' ),
			'description' => __( 'Select your school of Islamic jurisprudence', 'islamnet' ),
			'type'        => 'selectbox',
			'options'     => array(
				__( 'Hanafi', 'islamnet' ),
				__( 'Maliki', 'islamnet' ),
				__( 'Shafi\'i', 'islamnet' ),
				__( 'Hanbali', 'islamnet' ),
				__( 'Twelver Shia', 'islamnet' ),
				__( 'Ismaili', 'islamnet' ),
				__( 'Zaidi', 'islamnet' ),
				__( 'Other', 'islamnet' ),
			),
		),
		array(
			'name'        => __( 'Quran Memorization', 'islamnet' ),
			'description' => __( 'How much of the Quran have you memorized?', 'islamnet' ),
			'type'        => 'selectbox',
			'options'     => array(
				__( 'None', 'islamnet' ),
				__( 'Juz (1/30)', 'islamnet' ),
				__( 'Partial (Multiple Juz)', 'islamnet' ),
				__( 'Half (15 Juz)', 'islamnet' ),
				__( 'Full Quran (Hafiz)', 'islamnet' ),
			),
		),
		array(
			'name'        => __( 'Islamic Education Level', 'islamnet' ),
			'description' => __( 'Your level of Islamic education', 'islamnet' ),
			'type'        => 'selectbox',
			'options'     => array(
				__( 'Beginner', 'islamnet' ),
				__( 'Intermediate', 'islamnet' ),
				__( 'Advanced', 'islamnet' ),
				__( 'Scholar', 'islamnet' ),
			),
		),
		array(
			'name'        => __( 'Hijri Date of Birth', 'islamnet' ),
			'description' => __( 'Your date of birth in Hijri calendar', 'islamnet' ),
			'type'        => 'datebox',
		),
		array(
			'name'        => __( 'Interests', 'islamnet' ),
			'description' => __( 'Select your areas of interest', 'islamnet' ),
			'type'        => 'checkbox',
			'options'     => array(
				__( 'Quranic Studies', 'islamnet' ),
				__( 'Hadith Studies', 'islamnet' ),
				__( 'Islamic Law', 'islamnet' ),
				__( 'Islamic History', 'islamnet' ),
				__( 'Islamic Philosophy', 'islamnet' ),
				__( 'Islamic Art & Culture', 'islamnet' ),
				__( 'Islamic Science', 'islamnet' ),
			),
		),
	);

	// Add fields to the group
	foreach ( $fields as $field ) {
		// Check if field already exists
		$existing_field = xprofile_get_field_id_from_name( $field['name'] );

		if ( ! $existing_field ) {
			$field_data = array(
				'field_group_id' => $field_group_id,
				'name'           => $field['name'],
				'description'    => $field['description'],
				'type'           => $field['type'],
				'required'       => false,
			);

			if ( isset( $field['options'] ) ) {
				$field_data['options'] = $field['options'];
			}

			xprofile_insert_field( $field_data );
		}
	}
}

// Hook to add religious profile fields on theme activation
add_action( 'after_switch_theme', 'islamnet_add_religious_profile_fields' );

/**
 * Get current Hijri date and time
 * 
 * @return array Array containing Hijri date information
 */
function islamnet_get_current_hijri_info() {
	$prayer_times = islamnet_get_prayer_times();
	
	if ( isset( $prayer_times['hijri'] ) ) {
		return array(
			'hijri_date' => $prayer_times['hijri'],
			'gregorian_date' => $prayer_times['date'] ?? date( 'Y-m-d' ),
		);
	}

	return array(
		'hijri_date' => islamnet_get_hijri_date(),
		'gregorian_date' => date( 'Y-m-d' ),
	);
}

/**
 * Display prayer times widget
 * 
 * @param string $city City name
 * @param string $country Country name
 * @return string HTML output of prayer times
 */
function islamnet_display_prayer_times_widget( $city = 'Tehran', $country = 'Iran' ) {
	$prayer_times = islamnet_get_prayer_times( $city, $country );

	if ( isset( $prayer_times['error'] ) ) {
		return '<div class="prayer-times-error">' . esc_html( $prayer_times['error'] ) . '</div>';
	}

	$html = '<div class="prayer-times-widget">';
	$html .= '<h3 class="prayer-times-title">' . sprintf( 
		esc_html__( 'Prayer Times - %s, %s', 'islamnet' ), 
		esc_html( $city ), 
		esc_html( $country ) 
	) . '</h3>';
	
	if ( isset( $prayer_times['hijri'] ) ) {
		$html .= '<p class="hijri-date">' . sprintf(
			esc_html__( 'Hijri Date: %s', 'islamnet' ),
			esc_html( $prayer_times['hijri'] )
		) . '</p>';
	}

	$html .= '<ul class="prayer-times-list">';
	
	$prayer_names = array(
		'Fajr'    => __( 'Fajr', 'islamnet' ),
		'Sunrise' => __( 'Sunrise', 'islamnet' ),
		'Dhuhr'   => __( 'Dhuhr', 'islamnet' ),
		'Asr'     => __( 'Asr', 'islamnet' ),
		'Maghrib' => __( 'Maghrib', 'islamnet' ),
		'Isha'    => __( 'Isha', 'islamnet' ),
	);

	foreach ( $prayer_names as $key => $label ) {
		if ( isset( $prayer_times[ $key ] ) ) {
			$html .= '<li class="prayer-time-item">';
			$html .= '<span class="prayer-name">' . esc_html( $label ) . ':</span> ';
			$html .= '<span class="prayer-time">' . esc_html( $prayer_times[ $key ] ) . '</span>';
			$html .= '</li>';
		}
	}

	$html .= '</ul>';
	$html .= '</div>';

	return $html;
}

/**
 * Custom Messaging UI Enhancements for BuddyPress
 */
add_action( 'wp_enqueue_scripts', function() {
	if ( islamnet_is_buddypress_active() && bp_is_messages_component() ) {
		// Add specific JS/CSS for messaging
		wp_enqueue_style( 'islamnet-messages', ISLAMNET_THEME_ASSETS . '/css/messages-custom.css', array(), ISLAMNET_THEME_VERSION );
	}
});

/**
 * Add custom user roles for IslamNET
 */
function islamnet_add_custom_roles() {
	// Scholar role
	add_role( 'scholar', __( 'Scholar', 'islamnet' ), array(
		'read'                 => true,
		'edit_posts'           => true,
		'delete_posts'         => true,
		'edit_published_posts' => true,
		'delete_published_posts' => true,
		'publish_posts'        => true,
		'upload_files'         => true,
		'manage_categories'    => true,
	) );

	// Moderator role
	add_role( 'moderator', __( 'Moderator', 'islamnet' ), array(
		'read'                 => true,
		'edit_posts'           => true,
		'delete_posts'         => true,
		'edit_others_posts'    => true,
		'delete_others_posts'  => true,
		'moderate_comments'    => true,
		'manage_categories'    => true,
	) );

	// Instructor role for LearnPress
	add_role( 'instructor', __( 'Instructor', 'islamnet' ), array(
		'read'                 => true,
		'edit_posts'           => true,
		'delete_posts'         => true,
		'publish_posts'        => true,
		'upload_files'         => true,
		'manage_categories'    => true,
	) );
}

// Hook to add roles on theme activation
add_action( 'after_switch_theme', 'islamnet_add_custom_roles' );

/**
 * Get statistics for dashboard
 * 
 * @return array Statistics data
 */
function islamnet_get_dashboard_stats() {
	$stats = array(
		'total_members'   => count_users(),
		'total_posts'     => wp_count_posts(),
		'total_comments'  => wp_count_comments(),
	);

	// Add BuddyPress stats if active
	if ( islamnet_is_buddypress_active() ) {
		$stats['total_groups'] = bp_get_total_group_count();
		$stats['total_activities'] = bp_activity_get_activity_count();
	}

	// Add LearnPress stats if active
	if ( islamnet_is_learnpress_active() ) {
		$stats['total_courses'] = wp_count_posts( 'lp_course' )->publish ?? 0;
		$stats['total_students'] = count_users()['total_users'] ?? 0;
	}

	return $stats;
}
