<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="site-content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 * @version 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">   
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
	<header id="siteHeader" class="site-header" role="banner">
		<div class="custom-header">
			<div class="custom-header-media"><?php the_custom_header_markup(); ?></div>

			<div class="site-name">
				<div class="wrap">				
					<?php the_custom_logo(); ?>
					<div class="site-name-text">
						<?php if ( is_front_page() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>

						<?php $description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; ?></p>
							<?php endif; ?>
					</div><!-- .site-name-text -->
				</div><!-- .wrap -->
			</div><!-- .site-name -->
		</div><!-- .custom-header -->
		<?php if ( has_nav_menu( 'main' ) ) : ?>
			<div class="navigation-main">
				<div class="wrap">
					<?php get_template_part( 'templates/navigation', 'main' ); ?>
				</div><!-- .wrap -->
			</div><!-- .navigation-main -->
		<?php endif; ?>
		<?php if ( is_front_page() && has_custom_header()) : ?>
			<a href="#content" class="scroll-to-content"><?php echo huhtog_get_svg( array( 'icon' => 'arrow-right' ) ); ?></a>
		<?php endif; ?>
	</header>

	<div class="site-content-contain">
		<div id="site-content" class="site-content">