<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Veganos
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function veganos_body_classes( $classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options
	if ( is_customize_preview() ) {
		$classes[] = 'zeko-customizer';
	}

	// Add class on front page
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'zeko-front-page';
	}

	// Add class if no custom header or featured images
	$header_image = get_header_image();
	if ( ! has_header_image() && ( ! has_post_thumbnail() || is_home() ) ) {
		$classes[] = 'no-header-image';
	}
	
	return $classes;
}
add_filter( 'body_class', 'veganos_body_classes' );

/**
 * Checks to see if we're on the homepage or not.
 */
function veganos_is_frontpage() {
	if ( is_front_page() && ! is_home() ) :
		return true;
	else :
		return false;
	endif;
}
