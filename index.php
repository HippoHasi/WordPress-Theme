<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
	<div id="content" class="content-area">
		<?php 
		if( have_posts() ):
			while( have_posts() ): the_post();
				get_template_part( 'templates/content', 'excerpt' );
			endwhile;
			the_posts_pagination( array(
				'prev_text' => huhtog_get_svg( array( 'icon' => 'arrow-left' ) ),
				'next_text' => huhtog_get_svg( array( 'icon' => 'arrow-right' ) ),
			//	'before_page_number' => '<span class="meta-nav">' . __( 'Page', 'huhtog' ) . ' </span>',
			) );
		else:
			get_template_part( 'templates/content', 'none' );
		endif; ?>
	</div><!-- #content -->
	<?php get_sidebar(); ?>
</div><!-- #wrap -->

<?php get_footer(); ?>