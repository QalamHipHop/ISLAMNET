<?php
/**
 * Template part for displaying site branding
 *
 * @package IslamNET
 */
?>
	<div class="site-branding">
		<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
		} else {
			// Fallback to text if no logo is set
			?>
			<div class="logo-fallback">
				<span class="logo-text"><?php bloginfo( 'name' ); ?></span>
			</div>
			<?php
		}
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
