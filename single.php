<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="content" class="content-area">
			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'templates/content', get_post_format() );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					the_post_navigation( array(
						'prev_text' => '<span aria-hidden="true" class="nav-subtitle">' . __( 'Previous Post', 'huhtog' ) . '</span>',
						'next_text' => '<span aria-hidden="true" class="nav-subtitle">' . __( 'Next Post', 'huhtog' ) . '</span>',
					) );

				endwhile; // End of the loop.
			?>
	</div><!-- #content -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
