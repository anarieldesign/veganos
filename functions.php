<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Veganos
 */

if ( ! function_exists( 'veganos_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the aftercomponentsetup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function veganos_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'veganos' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'veganos', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'veganos-featured-image', 2600, 900, true );

	add_image_size( 'veganos-featured-archive-image', 700, 9999 );
	
	add_image_size( 'veganos-single-image', 1120, 99999, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top'=> esc_html__( 'Top Menu', 'veganos' ),
		'social'=> esc_html__( 'Social Menu', 'veganos' ),
	) );
	
	/* Add support for editor styles */
	add_editor_style( array( 'editor-style.css', veganos_fonts_url() ) );
	
	/*
	 * Enable support for custom logo.
	 *
	 *  @since Zeko 1.0
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 9999,
		'width'       => 500,
		'flex-height' => true,
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'veganos_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add support to selectively refresh widgets in Customizer
	add_theme_support( 'customize_selective_refresh_widgets' );
	
	// Adding support for core block visual styles.
	add_theme_support( 'wp-block-styles' );
	
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );
		
	// Add support for custom color scheme.
	add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Strong Green', 'veganos' ),
				'slug'  => 'strong-green',
				'color' => '#3a8014',
			),
			array(
				'name'  => esc_html__( 'Strong Gray', 'veganos' ),
				'slug'  => 'strong-gray',
				'color' => '#1b1f22',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'veganos' ),
				'slug'  => 'light-gray',
				'color' => '#efefef',
			),
	) );
}
endif;
add_action( 'after_setup_theme', 'veganos_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function veganos_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'veganos_content_width', 700 );
	
	//Adjust content_width value for page and attachement templates.
	if ( is_page_template( 'page-templates/full-width-page.php' )) {
		$GLOBALS['content_width'] = 1120;
	}
}
add_action( 'after_setup_theme', 'veganos_content_width', 0 );


/**
 * Register custom fonts
 */
function veganos_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Open Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$poppins = esc_html_x( 'on', 'Poppins font: on or off', 'veganos' );

	if ( 'off' !== $poppins ) {
		$font_families = array();

		if ( 'off' !== $poppins ) {
			$font_families[] = 'Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Wrap avatars in div for easier styling
 */
function veganos_get_avatar( $avatar ) {
	if ( ! is_admin() ) {
		$avatar = '<span class="avatar-container">' . $avatar . '</span>';
	}
	return $avatar;
}
add_filter( 'get_avatar', 'veganos_get_avatar', 10, 5 );


/**
 * Use front-page.php when 'Front page displays' is set to a static page.
 * Will use custom page templates if set.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults
 * to index.php), else $template.
 */
function veganos_front_page_template( $template ) {
	
	// Get the template for the page if it were displayed normally.
	$page_template = get_page_template();

	// Check the template name. If it's not a default page tmeplate file, ie
	// it's a custom page template, then use the custom template instead.
	if ( ! in_array( basename( $page_template ), array( 'single.php', 'singular.php', 'page.php' ), true ) ) {
		$template = $page_template;
	}

	// If is a blog post listing then use the default index template.
	if ( is_home() ) {
		return '';
	}

	// Use the page template that has been selected.
	return $template;

}
add_filter( 'frontpage_template',  'veganos_front_page_template' );

/**
 * Enqueue scripts and styles.
 */
function veganos_scripts() {
	wp_enqueue_style( 'veganos-style', get_stylesheet_uri() );

	wp_enqueue_style( 'veganos-fonts_url', veganos_fonts_url(), array(), null );

	wp_enqueue_script( 'veganos-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0', true );

	wp_enqueue_script( 'veganos-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'veganos_scripts' );

/**
 * Enqueue theme styles within Gutenberg.
 */
function veganos_gutenberg_styles() {

	// Load the theme styles within Gutenberg.
	wp_enqueue_style( 'veganos-gutenberg', get_theme_file_uri( '/editor.css' ), false, '1.1.2', 'all' );

	// Add custom fonts to Gutenberg.
	wp_enqueue_style( 'veganos-fonts_url', veganos_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'veganos_gutenberg_styles' );

/**
 * Enqueue the stylesheet.
 */
function veganos_enqueue_customizer_stylesheet() {
	
	wp_enqueue_style( 'veganos-customizer-css', get_template_directory_uri() . '/admin/customizer.css', array(), '1.0' );

}
add_action( 'customize_controls_print_styles', 'veganos_enqueue_customizer_stylesheet' );

if (!function_exists('veganos_admin_scripts')) {
	function veganos_admin_scripts($hook) {
		if ('appearance_page_charity' === $hook) {
			wp_enqueue_style('veganos-admin', get_template_directory_uri() . '/admin/admin.css');
		}
	}
}
add_action('admin_enqueue_scripts', 'veganos_admin_scripts');

if (is_admin()) {
	require get_template_directory() . '/admin/admin.php';
}

/**
 * Custom_Comment_Form_Setup
 */
function veganos_comment_form_before() {
	ob_start();
}
add_action( 'comment_form_before', 'veganos_comment_form_before' );

function veganos_comment_form_after() {
	$html = ob_get_clean();
	$html = preg_replace(
		'/<h3 id="reply-title"(.*)>(.*)<\/h3>/',
		'<h2 id="reply-title"\1>\2</h2>',
		$html
	);
	echo $html;
}
add_action( 'comment_form_after', 'veganos_comment_form_after' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load icon (SVG) functions file.
 */
require get_template_directory() . '/inc/functions-icons.php';

/**
 * Load Veganos Style.
 */
require get_template_directory() . '/inc/veganos_style.php';

/**
 * TGM Plugin Activation
 */
require get_template_directory() . '/assets/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'veganos_require_plugins' );

function veganos_require_plugins() {

	$plugins = array(

		// Gutenberg
		array(
			'name'      => esc_html__( 'Gutenberg', 'veganos' ),
			'slug'      => 'gutenberg',
			'required'  => false,
		),
		// Atomic Blocks
		array(
			'name'      => esc_html__( 'Atomic Blocks', 'veganos' ),
			'slug'      => 'atomic-blocks',
			'required'  => false,
		),
		// One Click Demo Import
		array(
			'name'      => esc_html__( 'One Click Demo Import', 'veganos' ),
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),
		// Elementor
		array(
			'name'      => esc_html__( 'Elementor', 'veganos' ),
			'slug'      => 'elementor',
			'required'  => false,
		),
		// WPForms
		array(
			'name'      => esc_html__( 'WPForms Lite', 'veganos' ),
			'slug'      => 'wpforms-lite',
			'required'  => false,
		),
		// Orbit Fox Companion
		array(
			'name'      => esc_html__( 'Orbit Fox Companion', 'veganos' ),
			'slug'      => 'themeisle-companion',
			'required'  => false,
		),

);
		$config = array(
		'id'           => 'veganos',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		);
	tgmpa( $plugins, $config );
}
/**
 * One Click Demo Import
 */
function veganos_ocdi_import_files() {
	return array(
		array(
			'import_file_name'           => esc_html__( 'Demo Import', 'veganos' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/veganos.xml',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo/veganos-customizer.dat',
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'veganos_ocdi_import_files' );
function veganos_ocdi_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$social_menu = get_term_by( 'name', 'Social Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
		'top' => $main_menu->term_id,
		'social' => $social_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title (esc_html__( 'Welcome to Veganos', 'veganos' ));
	$blog_page_id  = get_page_by_title (esc_html__( 'Blog', 'veganos' ));

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'veganos_ocdi_after_import_setup' );
function veganos_ocdi_plugin_intro_notice ( $default_text ) {
	return wp_kses_post( str_replace ( 'Before you begin, make sure all the required plugins are activated.', esc_html__( 'Before you begin, make sure all the recommended plugins are activated.', 'veganos'), $default_text ) );
}
add_filter( 'pt-ocdi/plugin_intro_text', 'veganos_ocdi_plugin_intro_notice' );
