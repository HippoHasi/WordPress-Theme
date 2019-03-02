<?php
/**
 * Huhtog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Huhtog
 * @since 1.0
 */

/**
 * Huhtog only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

function huhtog_setup() {

	add_theme_support( 'automatic-feed-links' );

	register_nav_menus( array(
		'main'    => __( 'Main Menu', 'huhtog' ),
		'social' => __( 'Social Links Menu', 'huhtog' ),
	) );	

	/*
	 *load the MO file with your theme’s translations.
	 */
	load_theme_textdomain( 'huhtog' );

	add_theme_support( 'post-thumbnails' );    //for featured images

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-background' );

	/* displays Customizer->Header Image (Header Media when 'video' is true) */
	add_theme_support( 'custom-header', apply_filters( 'huhtog_custom_header_args', array(
		'default-image'      => get_theme_file_uri( '/assets/images/header.jpg' ),
		'width'              => 2000,
		'height'             => 1200,
		'flex-height'        => true,
		'header-text'		 => true,
		'default-text-color' => '000',
		'video'              => false,
		'wp-head-callback'   => 'huhtog_header_style',
	) ) );

	/* Customizer->Header Media (Header Image)->Suggested */
	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header.jpg',
			'thumbnail_url' => '%s/assets/images/header.jpg',
			'description'   => __( 'Default Header Image', 'huhtog' ),
		),
		'girl' => array(
			'url'           => '%s/assets/images/girl.jpg',
			'thumbnail_url' => '%s/assets/images/girl.jpg',
			'description'   => __( 'Girl with Camera', 'huhtog' ),
		),
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	add_image_size( 'huhtog-featured-image', 2000, 1200, true );
	add_image_size( 'huhtog-thumbnail-avatar', 100, 100, true );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	//styling the admin module visual editor.
	add_editor_style( array( 'assets/css/editor-style.css', huhtog_fonts_url() ) );

	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'sidebar-1' => array(
				'search',
				'recent_posts',
				'recent_comments',
				'meta',
			),

			'sidebar-2' => array(
				'text_business_info',
			),
		),

		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-concert}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-journey}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-surfing}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-journey}}',
			),
		),

		'attachments' => array(
			'image-concert' => array(
				'post_title' => _x( 'Concert', 'Theme starter content', 'huhtog' ),
				'file' => 'assets/images/concert.jpg',
			),
			'image-journey' => array(
				'post_title' => _x( 'Journey', 'Theme starter content', 'huhtog' ),
				'file' => 'assets/images/journey.jpg',
			),
			'image-surfing' => array(
				'post_title' => _x( 'Surfing', 'Theme starter content', 'huhtog' ),
				'file' => 'assets/images/surfing.jpg',
			),
		),

		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		'nav_menus' => array(
			'main' => array(
				'name' => __( 'Main Menu', 'huhtog' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
			'social' => array(
				'name' => __( 'Social Links Menu', 'huhtog' ),
				'items' => array(
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_wordpress',
				),
			),
		),
	) );

}
add_action( 'after_setup_theme', 'huhtog_setup' );

//show_admin_bar( true );

// add post-formats to post_type 'page'
function huhtog_page_post_formats_setup() {
    add_post_type_support( 'page', 'post-formats' );
}
add_action( 'init', 'huhtog_page_post_formats_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function huhtog_content_width() {

	$content_width = 700;

	if ( is_front_page() ) {
		$content_width = 1120;
	}

	/**
	 * Filter Huhtog content width of the theme.
	 *
	 * @since Huhtog 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'huhtog_content_width', $content_width );
}
add_action( 'after_setup_theme', 'huhtog_content_width', 0 );

/**
 * Register custom fonts.
 */
function huhtog_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'huhtog' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Huhtog 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function huhtog_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'huhtog-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'huhtog_resource_hints', 10, 2 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function huhtog_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'huhtog' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'huhtog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'huhtog' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'huhtog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'huhtog_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'More' link.
 *
 * @since Huhtog 1.0
 *
 * @return string 'More' link prepended with an ellipsis.
 */
function huhtog_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		__( 'More...', 'huhtog' )
	);
	return ' &hellip; ' . $link; 	
}
add_filter( 'excerpt_more', 'huhtog_excerpt_more' );

if ( ! function_exists( 'huhtog_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see huhtog_custom_header_setup().
 */
function huhtog_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style id="huhtog-custom-header-styles" type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		body.has-header-image .site-title a,
		.site-description,
		body.has-header-image .site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // End of huhtog_header_style.

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Huhtog 1.0
 */
function huhtog_javascript_detection() {
	echo "<script>(function(html){
						html.className = html.className.replace(/\bno-js\b/,'js')
					})(document.documentElement);
		 </script>\n";
}
add_action( 'wp_head', 'huhtog_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function huhtog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'huhtog_pingback_header' );

function huhtog_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'huhtog-fonts', huhtog_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'huhtog-style', get_stylesheet_uri() );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'huhtog-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'huhtog-style' ), '1.0' );
		wp_style_add_data( 'huhtog-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'huhtog-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'huhtog-style' ), '1.0' );
	wp_style_add_data( 'huhtog-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv. You will require the HTML5shiv to provide compatibility for IE Browsers older than IE 9.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'huhtog-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$huhtog_l10n = array(
		'quote'          => huhtog_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'main' ) ) {
		wp_enqueue_script( 'huhtog-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
	}

	wp_enqueue_script( 'huhtog-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'huhtog_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Huhtog 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function huhtog_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'huhtog_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Huhtog 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function huhtog_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html; 
}
add_filter( 'get_header_image_tag', 'huhtog_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Huhtog 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function huhtog_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'huhtog_post_thumbnail_sizes_attr', 10, 3 );

add_action( 'register_form', 'myplugin_register_form' );
function huhtog_register_form() {

    $first_name = ( ! empty( $_POST['first_name'] ) ) ? sanitize_text_field( $_POST['first_name'] ) : '';
        
        ?>
        <p>
            <label for="first_name"><?php _e( 'First Name', 'huhtog' ) ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr(  $first_name  ); ?>" size="25" /></label>
        </p>
        <?php
}

    add_filter( 'registration_errors', 'huhtog_registration_errors', 10, 3 );
    function huhtog_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        
        if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
        	$errors->add( 'first_name_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'huhtog' ),__( 'You must include a first name.', 'huhtog' ) ) );

        }

        return $errors;
    }

    add_action( 'user_register', 'huhtog_user_register' );
    function huhtog_user_register( $user_id ) {
        if ( ! empty( $_POST['first_name'] ) ) {
            update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
        }
    }

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Adds custom classes to the array of body classes. 
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/customizer.php' );


?>