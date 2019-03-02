<?php
/**
 * Displays main navigation
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 * @version 1.0
 */
?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'huhtog' ); ?>">
	<div class="menu-toggle" aria-controls="main-menu" aria-expanded="false">
		<?php echo huhtog_get_svg( array( 'icon' => 'bars' ) ); 
			  echo huhtog_get_svg( array( 'icon' => 'close' ) ); 
			  _e( 'Menu', 'huhtog' ); 
		?>
	</div>
	<?php wp_nav_menu( array(
		'theme_location' => 'main',
		'menu_id'        => 'main-menu',
	) ); ?>
</nav><!-- #site-navigation -->