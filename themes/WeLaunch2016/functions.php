<?php
/**
 * WeLaunch2016 functions and definitions. Replace 'WeLaunch2016' with project WeLaunch2016.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WeLaunch2016
 */

if ( ! function_exists( 'WeLaunch2016_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function WeLaunch2016_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WeLaunch2016, use a find and replace
	 * to change 'WeLaunch2016' to the WeLaunch2016 of your theme in all the template files.
	 */
	load_theme_textdomain( 'WeLaunch2016', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'WeLaunch2016' ),
	) );

	// Register Custom Navigation Walker
	require_once('wp_bootstrap_navwalker.php');

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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'WeLaunch2016_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'WeLaunch2016_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function WeLaunch2016_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'WeLaunch2016_content_width', 640 );
}
add_action( 'after_setup_theme', 'WeLaunch2016_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function WeLaunch2016_widgets_init() {
	register_sidebar( array(
		'WeLaunch2016'          => esc_html__( 'Sidebar', 'WeLaunch2016' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'WeLaunch2016_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function WeLaunch2016_scripts() {
	wp_enqueue_style( 'WeLaunch2016-style', get_stylesheet_uri() );

	wp_enqueue_script('jquery-google','https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js','','',true);
	wp_enqueue_script('isotope','https://unpkg.com/isotope-layout@3.0/dist/isotope.pkgd.min.js','','',true);
	wp_enqueue_script('bootstrap-js','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js','','',true);
	wp_enqueue_script('scripts', get_template_directory_uri() . '/js/custom.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'WeLaunch2016_scripts' );

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

/* Adds SVG Functionality */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//Page Slug Body Class
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );



// Custom Post Types
add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name" => "Clients",
		"singular_name" => "Client",
		);

	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "client", "with_front" => true ),
		"query_var" => true,
						"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),			);
	register_post_type( "client", $args );

	$labels = array(
		"name" => "Case Studies",
		"singular_name" => "Case Study",
		);

	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "casestudy", "with_front" => true ),
		"query_var" => true,
						"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),			);
	register_post_type( "casestudy", $args );

	$labels = array(
		"name" => "Testimonials",
		"singular_name" => "Testimonial",
		);

	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "testimonial", "with_front" => true ),
		"query_var" => true,
						"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),			);
	register_post_type( "testimonial", $args );

	$labels = array(
		"name" => "Services",
		"singular_name" => "Service",
		);

	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "service", "with_front" => true ),
		"query_var" => true,
						"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),			);
	register_post_type( "service", $args );

	// $labels = array(
	// 	"name" => "The World",
	// 	"singular_name" => "The World image",
	// 	);

	// $args = array(
	// 	"labels" => $labels,
	// 	"description" => "",
	// 	"public" => true,
	// 	"show_ui" => true,
	// 	"has_archive" => false,
	// 	"show_in_menu" => true,
	// 	"exclude_from_search" => false,
	// 	"capability_type" => "post",
	// 	"map_meta_cap" => true,
	// 	"hierarchical" => false,
	// 	"rewrite" => array( "slug" => "theworld", "with_front" => true ),
	// 	"query_var" => true,
	// 					"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),			);
	// register_post_type( "theworld", $args );

	$labels = array(
		"name" => "News",
		"singular_name" => "News",
		);

	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "news", "with_front" => true ),
		"query_var" => true,
						"supports" => array( "title", "editor", "thumbnail" ),			);
	register_post_type( "news", $args );

// End of cptui_register_my_cpts()
}

//Custom Taxonomy
add_action( 'init', 'cptui_register_my_taxes' );
function cptui_register_my_taxes() {

	$labels = array(
		"name" => "deliverables",
		"label" => "Deliverables",
			);

	$args = array(
		"labels" => $labels,
		"hierarchical" => 0,
		"label" => "Deliverables",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'deliverables', 'with_front' => false ),
		"show_admin_column" => 0,
	);
	register_taxonomy( "deliverables", array( "casestudy" ), $args );


	$labels = array(
		"name" => "industry_sectors",
		"label" => "Industry Sectors",
			);

	$args = array(
		"labels" => $labels,
		"hierarchical" => 1,
		"label" => "Industry Sectors",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'industry_sectors', 'with_front' => false ),
		"show_admin_column" => 0,
	);
	register_taxonomy( "industry_sectors", array( "casestudy" ), $args );

// End cptui_register_my_taxes
}


