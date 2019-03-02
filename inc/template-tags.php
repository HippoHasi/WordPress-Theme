<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 */

if ( ! function_exists( 'huhtog_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function huhtog_posted_on() {

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		/* translators: %s: post author */
		__( 'by %s', 'huhtog' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);

	// Finally, let's write all of this to the page.
	echo '<span class="posted-on">' . huhtog_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
}
endif;

if ( ! function_exists( 'huhtog_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function huhtog_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span>Posted on</span> %s', 'huhtog' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;

function huhtog_edit_link() {
	$link = edit_post_link(		
		__( 'Edit', 'huhtog' ),
		'<span class="edit-link">',
		'</span>'
	);

	return $link;
}

if ( ! function_exists( 'huhtog_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function huhtog_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'huhtog' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );

	// We don't want to output .entry-footer if it will be empty, so make sure its not.
	if ( ( ( huhtog_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

		echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && huhtog_categorized_blog() ) || $tags_list ) {
					echo '<span class="cat-tags-links">';

						// Make sure there's more than one category before displaying.
						if ( $categories_list && huhtog_categorized_blog() ) {
							echo '<span class="cat-links">' . huhtog_get_svg( array( 'icon' => 'folder-open' ) ) . $categories_list . '</span>';
						}

						if ( $tags_list ) {
							echo '<span class="tags-links">' . huhtog_get_svg( array( 'icon' => 'hashtag' ) ) . $tags_list . '</span>';
						}

					echo '</span>';
				}
			}

			huhtog_edit_link();

		echo '</footer> <!-- .entry-footer -->';
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function huhtog_categorized_blog() {
	$category_count = get_transient( 'huhtog_categories_count' );  //set 'huhtog_categories_count' below

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'huhtog_categories_count', $category_count );
	}

	return $category_count > 1;
}

/**
 * Flush out the transients used in huhtog_categorized_blog.
 */
function huhtog_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'huhtog_categories_count' );
}
add_action( 'edit_category', 'huhtog_category_transient_flusher' );
add_action( 'save_post',     'huhtog_category_transient_flusher' );



?>