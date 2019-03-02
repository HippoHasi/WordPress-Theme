<?php
/**
 * Huhtog: Customizer
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 */
 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function huhtog_customize_register( $wp_customize ) {
	/* Note: The 'transport' argument is optional, and defaults to 'refresh'. If left to default, 
	then the theme customizer's preview window will update by completely reloading itself 
	when this setting is changed. If you would prefer to avoid refreshes and improve responsiveness, 
	you can set this to 'postMessage' instead, then handle any styling updates manually with 
	a bit of JavaScript (see the Configure Live Preview section below).  */
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';	
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';
	
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'huhtog_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'huhtog_customize_partial_blogdescription',
	) );

	$wp_customize->add_section( 'layout', array(
		'title'    => __( 'Layout', 'huhtog' ),
		'priority' => 130, // Before Additional CSS.
	) );

	$wp_customize->add_setting( 'layout', array(
		'type'              => 'theme_mod',
		'default'           => 'two-column',
		'sanitize_callback' => 'huhtog_sanitize_layout',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'layout', array(
		'label'       => __( 'Layout', 'huhtog' ),
		'section'     => 'layout',
		'type'        => 'radio',
		'description' => __( 'When the two column layout is assigned, the page title is in one column and content is in the other.', 'huhtog' ),
		'choices'     => array(
			'one-column' => __( 'One Column', 'huhtog' ),
			'two-column' => __( 'Two Column', 'huhtog' ),
		),
		//'active_callback' => 'true',   // This option is available on all pages. It's also available on archives when there isn't a sidebar.
	) );

}
add_action( 'customize_register', 'huhtog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Huhtog 1.0
 * @see huhtog_customize_register()
 *
 * @return void
 */
function huhtog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Huhtog 1.0
 * @see huhtog_customize_register()
 *
 * @return void
 */
function huhtog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Sanitize the page layout options.
 */
function huhtog_sanitize_layout( $input ) {
	$valid = array(
		'one-column' => __( 'One Column', 'huhtog' ),
		'two-column' => __( 'Two Column', 'huhtog' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
/* To ensure that the file is loaded only on the Theme Customizer admin screen (and not your live website), 
 * you should use the customize_preview_init hook.  
 */
function huhtog_customize_preview_js() {
	wp_enqueue_script( 'huhtog-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'huhtog_customize_preview_js' );

?>