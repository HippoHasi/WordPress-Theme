<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #site-content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 * @version 1.0
 */
?>
		</div><!-- #site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
				<?php
				get_template_part( 'templates/footer', 'widgets' );
				
				if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'huhtog' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span>',
								'link_after'     => '</span>' . huhtog_get_svg( array( 'icon' => 'chain' ) ),
							) );
						?>
					</nav><!-- .social-navigation --> 
				<?php endif;

				get_template_part( 'templates/site', 'link' );
				?>
			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->

<?php wp_footer(); ?>

</body>
</html>
