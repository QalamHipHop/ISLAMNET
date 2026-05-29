<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="container header-container">
			<?php get_template_part( 'template-parts/header/branding' ); ?>
			<?php get_template_part( 'template-parts/header/navigation' ); ?>
			<?php get_template_part( 'template-parts/header/user' ); ?>
		</div>
	</header>
