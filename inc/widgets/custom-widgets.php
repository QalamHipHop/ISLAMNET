<?php
/**
 * Custom Widgets for IslamNET
 *
 * @package IslamNET
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom Profile Widget
 */
class IslamNET_Profile_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'islamnet_profile_widget',
            __( 'IslamNET: User Profile', 'islamnet' ),
            array( 'description' => __( 'Displays current user profile summary.', 'islamnet' ) )
        );
    }

    public function widget( $args, $instance ) {
        if ( ! is_user_logged_in() ) return;
        
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        
        $user_id = get_current_user_id();
        echo '<div class="widget-user-profile">';
        echo get_avatar( $user_id, 64 );
        echo '<h4>' . bp_core_get_user_displayname( $user_id ) . '</h4>';
        echo '<a href="' . bp_loggedin_user_domain() . '">' . __( 'View Profile', 'islamnet' ) . '</a>';
        echo '</div>';
        
        echo $args['after_widget'];
    }
}

function islamnet_register_widgets() {
    register_widget( 'IslamNET_Profile_Widget' );
}
add_action( 'widgets_init', 'islamnet_register_widgets' );
