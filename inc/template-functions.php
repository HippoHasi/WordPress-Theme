<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function huhtog_body_classes( $classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}	

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'huhtog-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'huhtog-front-page'; //static front page class
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-sidebar';
	}

	// Add class for one or two column page layouts.
	if ( 'one-column' === get_theme_mod( 'layout' ) ) {
		$classes[] = 'one-column';
	} else {
		$classes[] = 'two-column';
	}

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) {
		$classes[] = 'title-tagline-hidden';
	}

	return $classes;
}
add_filter( 'body_class', 'huhtog_body_classes' );

/**
 * Checks to see if we're on the homepage or not.
 */
function huhtog_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}



?>