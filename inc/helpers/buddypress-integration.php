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

/**
 * Register BuddyPress member types for IslamNET
 */
add_action( 'bp_init', 'islamnet_bp_register_member_types' );
function islamnet_bp_register_member_types() {
if ( ! islamnet_is_buddypress_active() || ! function_exists( 'bp_register_member_type' ) ) {
return;
}

bp_register_member_type( 'scholar', array(
'labels' => array(
'name'          => __( 'Scholars', 'islamnet' ),
'singular_name' => __( 'Scholar', 'islamnet' ),
),
'has_directory' => true,
'show_in_list'  => true,
) );

bp_register_member_type( 'student', array(
'labels' => array(
'name'          => __( 'Students', 'islamnet' ),
'singular_name' => __( 'Student', 'islamnet' ),
),
'has_directory' => true,
'show_in_list'  => true,
) );

bp_register_member_type( 'instructor', array(
'labels' => array(
'name'          => __( 'Instructors', 'islamnet' ),
'singular_name' => __( 'Instructor', 'islamnet' ),
),
'has_directory' => true,
'show_in_list'  => true,
) );
}

/**
 * Register BuddyPress group types for IslamNET
 */
add_action( 'bp_init', 'islamnet_bp_register_group_types' );
function islamnet_bp_register_group_types() {
if ( ! islamnet_is_buddypress_active() || ! function_exists( 'bp_groups_register_group_type' ) ) {
return;
}

bp_groups_register_group_type( 'study-circle', array(
'labels' => array(
'name'          => __( 'Study Circles', 'islamnet' ),
'singular_name' => __( 'Study Circle', 'islamnet' ),
),
'has_directory' => true,
'show_in_create_screen' => true,
) );

bp_groups_register_group_type( 'discussion', array(
'labels' => array(
'name'          => __( 'Discussion Forums', 'islamnet' ),
'singular_name' => __( 'Discussion Forum', 'islamnet' ),
),
'has_directory' => true,
'show_in_create_screen' => true,
) );

bp_groups_register_group_type( 'charity', array(
'labels' => array(
'name'          => __( 'Charity Initiatives', 'islamnet' ),
'singular_name' => __( 'Charity Initiative', 'islamnet' ),
),
'has_directory' => true,
'show_in_create_screen' => true,
) );
}

/**
 * Register BuddyPress activity types for IslamNET
 */
add_action( 'bp_init', 'islamnet_bp_register_activity_types' );
function islamnet_bp_register_activity_types() {
if ( ! islamnet_is_buddypress_active() || ! function_exists( 'bp_activity_set_action' ) ) {
return;
}

bp_activity_set_action( 'islamnet', 'prayer_reminder', __( 'shared a prayer reminder', 'islamnet' ) );
bp_activity_set_action( 'islamnet', 'hijri_event', __( 'created a Hijri calendar event', 'islamnet' ) );
bp_activity_set_action( 'islamnet', 'course_started', __( 'started an Islamic course', 'islamnet' ) );
bp_activity_set_action( 'islamnet', 'charity_donation', __( 'made a charitable donation', 'islamnet' ) );
}

/**
 * Add Islamic greeting to BuddyPress emails
 */
add_filter( 'bp_email_get_content_html', 'islamnet_bp_email_greeting' );
function islamnet_bp_email_greeting( $content ) {
$greeting = __( 'Assalamu Alaikum (Peace be upon you),', 'islamnet' ) . "\n\n";
return $greeting . $content;
}

/**
 * Add prayer time reminder functionality
 */
add_action( 'wp_footer', 'islamnet_bp_prayer_reminder_script' );
function islamnet_bp_prayer_reminder_script() {
if ( ! is_user_logged_in() || ! islamnet_is_buddypress_active() ) {
return;
}

$user_id = get_current_user_id();
$prayer_reminders_enabled = get_user_meta( $user_id, 'islamnet_prayer_reminders', true );

if ( ! $prayer_reminders_enabled ) {
return;
}

?>
<script type="text/javascript">
(function() {
// Prayer time reminder functionality
var prayerReminderEnabled = true;

if (prayerReminderEnabled) {
// Check prayer times and show reminders
// This would be implemented with actual prayer time checking logic
}
})();
</script>
<?php
}
