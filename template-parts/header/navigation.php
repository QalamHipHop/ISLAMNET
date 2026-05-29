<?php
/**
 * Template part for displaying site navigation
 *
 * @package IslamNET
 */
?>
<nav id="site-navigation" class="main-navigation">
	<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'islamnet' ); ?></button>
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'menu_id'        => 'primary-menu',
		)
	);
	?>
</nav><!-- #site-navigation -->
