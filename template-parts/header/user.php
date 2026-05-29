<?php
/**
 * Template part for displaying user info in header
 *
 * @package IslamNET
 */

if ( ! islamnet_is_buddypress_active() ) {
	return;
}
?>
<div class="header-user-profile">
	<?php if ( is_user_logged_in() ) : ?>
		<div class="user-avatar">
			<a href="<?php echo esc_url( bp_loggedin_user_domain() ); ?>">
				<?php bp_loggedin_user_avatar( 'type=thumb&width=40&height=40' ); ?>
			</a>
		</div>
		<div class="user-notifications">
			<?php if ( bp_is_active( 'notifications' ) ) : ?>
				<a href="<?php echo esc_url( bp_loggedin_user_domain() . bp_get_notifications_slug() ); ?>">
					<span class="notification-count"><?php echo bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ); ?></span>
				</a>
			<?php endif; ?>
		</div>
	<?php else : ?>
		<div class="user-login-link">
			<a href="<?php echo esc_url( wp_login_url() ); ?>"><?php esc_html_e( 'Login', 'islamnet' ); ?></a>
		</div>
	<?php endif; ?>
</div>
