<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Veganos
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php get_template_part( 'components/header/header', 'image' ); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'veganos' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="header-top">
			<div class="wrap">
				<?php get_template_part( 'components/header/site', 'branding' ); ?>
				<?php get_template_part( 'components/navigation/navigation', 'top' ); ?>
			</div>
		</div><!-- .header-top -->

	</header>

	<div id="content" class="site-content">
