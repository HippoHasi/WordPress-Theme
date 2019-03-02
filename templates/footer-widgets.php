<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 * @version 1.0
 */
?>

<?php
if ( is_active_sidebar( 'sidebar-2' ) ) :
?>

	<aside class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'huhtog' ); ?>">
			<div class="widget-column footer-widget">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
	</aside><!-- .widget-area -->

<?php endif; ?>
