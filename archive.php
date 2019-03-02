<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">

	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="content" class="content-area">

		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'templates/content', 'excerpt' );

			endwhile;

			the_posts_pagination( array(
				'prev_text' => huhtog_get_svg( array( 'icon' => 'arrow-left' ) ),
				'next_text' => huhtog_get_svg( array( 'icon' => 'arrow-right' ) ),
				//'before_page_number' => '<span class="meta-nav">' . __( 'Page', 'huhtog' ) . ' </span>',
			) );

		else :

			get_template_part( 'templates/content', 'none' );

		endif; ?>

	</div><!-- #content -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
