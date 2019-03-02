<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">

	<header class="page-header">
		<?php if ( have_posts() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'huhtog' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e( 'Nothing Found', 'huhtog' ); ?></h1>
		<?php endif; ?>
	</header><!-- .page-header -->

	<div id="content" class="content-area">

		<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'templates/content', 'excerpt' );

			endwhile; // End of the loop.

			the_posts_pagination(
				array(
					'prev_text'          => huhtog_get_svg( array( 'icon' => 'arrow-left' ) ),
					'next_text'          => huhtog_get_svg( array( 'icon' => 'arrow-right' ) ),
					//'before_page_number' => '<span class="meta-nav">' . __( 'Page', 'huhtog' ) . ' </span>',
				)
			);

		else :
		?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'huhtog' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>

	</div><!-- #content -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php
get_footer();
