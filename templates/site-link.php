<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 * @version 1.0
 */
?>
<div class="site-link">
	<?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
	}
	?>
	<a href="<?php echo esc_url( __( 'https://huhtog.com/', 'huhtog' ) ); ?>" class="imprint">
		<?php printf( __( 'Proudly powered by %s', 'huhtog' ), 'Huhtog' ); ?>
	</a>
</div><!-- .site-link -->
