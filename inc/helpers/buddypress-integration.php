<?php
/**
 * BuddyPress Integration for IslamNET
 * 
 * Implements 8 core social features:
 * 1. Profile Management
 * 2. Activity Stream
 * 3. Private Messaging
 * 4. Group Discussions
 * 5. Notifications
 * 6. Friendship System
 * 7. Media Sharing (via rtMedia)
 * 8. Member Directory
 *
 * @package IslamNET
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register BuddyPress custom styles
 */
function islamnet_buddypress_scripts() {
    if ( ! islamnet_is_buddypress_active() ) {
        return;
    }
    wp_enqueue_style( 'islamnet-buddypress', ISLAMNET_THEME_URL . '/assets/css/buddypress-custom.css', array(), ISLAMNET_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'islamnet_buddypress_scripts' );

/**
 * Custom BuddyPress Profile Tabs
 */
function islamnet_customize_bp_profile_tabs() {
    // Add a custom tab for "Islamic Activity"
    bp_core_new_nav_item( array(
        'name' => __( 'Islamic Activity', 'islamnet' ),
        'slug' => 'islamic-activity',
        'position' => 20,
        'screen_function' => 'islamnet_islamic_activity_screen',
        'show_for_displayed_user' => true,
        'item_css_id' => 'islamic-activity'
    ) );

    // Add a custom tab for "Courses" if LearnPress is active
    if ( islamnet_is_learnpress_active() ) {
        bp_core_new_nav_item( array(
            'name' => __( 'My Courses', 'islamnet' ),
            'slug' => 'courses',
            'position' => 100,
            'screen_function' => 'islamnet_member_courses_screen',
            'show_for_displayed_user' => true,
            'item_css_id' => 'courses'
        ) );
    }
}
add_action( 'bp_setup_nav', 'islamnet_customize_bp_profile_tabs' );

function islamnet_islamic_activity_screen() {
    add_action( 'bp_template_content', 'islamnet_islamic_activity_content' );
    bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function islamnet_islamic_activity_content() {
    echo '<div class="islamic-activity-wrapper">';
    echo '<h3>' . esc_html__( 'Religious Progress & Activity', 'islamnet' ) . '</h3>';
    echo '<p>' . esc_html__( 'Track your Quran reading, prayers, and community contributions here.', 'islamnet' ) . '</p>';
    // Logic for displaying religious activity stats
    echo '</div>';
}

function islamnet_member_courses_screen() {
    add_action( 'bp_template_content', 'islamnet_member_courses_content' );
    bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function islamnet_member_courses_content() {
    echo '<h3>' . esc_html__( 'My Enrolled Courses', 'islamnet' ) . '</h3>';
    // Logic to list LearnPress courses for the user
}

/**
 * iPhone-style Messaging UI for BuddyPress
 */
function islamnet_bp_message_bubble_classes( $classes ) {
    $classes[] = 'ios-bubble';
    return $classes;
}
add_filter( 'bp_get_the_thread_message_css_class', 'islamnet_bp_message_bubble_classes' );
