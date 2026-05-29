<?php
/**
 * Template part for displaying site branding
 *
 * @package IslamNET
 */
?>
<div class="site-branding">
	<?php
	the_custom_logo();
	if ( is_front_page() && is_home() ) :
		?>
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php
	else :
		?>
		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
	endif;
	$islamnet_description = get_bloginfo( 'description', 'display' );
	if ( $islamnet_description || is_customize_preview() ) :
		?>
		<p class="site-description"><?php echo $islamnet_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
	<?php endif; ?>
</div><!-- .site-branding -->
