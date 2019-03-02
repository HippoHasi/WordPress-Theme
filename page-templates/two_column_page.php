<?php
/**
* Template Name: Two Column Page
*
* This is a page template that displays at Pages > Add New > Attributes > Template
* in your admin dashboard for global use.
*
* @package WordPress
* @subpackage Huhtog
* @since Huhtog 1.0
*/

get_header(); ?>

<div class="wrap">
	<div id="content" class="content-area">	
		This is a two column page with right sidebar.
	</div><!-- #content -->
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>