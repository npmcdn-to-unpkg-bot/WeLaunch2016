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

	wp_enqueue_script('jquery-google','//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js','','',true);
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

	$labels = array(
		"name" => "The World",
		"singular_name" => "The World image",
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
		"rewrite" => array( "slug" => "theworld", "with_front" => true ),
		"query_var" => true,
						"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),			);
	register_post_type( "theworld", $args );

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

// // Hide Posts from Loops
// add_action('pre_get_posts', 'hide_hidden_posts');
// function hide_hidden_posts($query) {
//   if ( is_admin() ) {
//     return $query;
//   }
//
//   if ( is_single() AND $query->is_main_query() ) {
//     return $query;
//   }
//   $ids = wp_cache_get('hidden_posts', 'posts');
//   if ( !$ids ) {
//     global $wpdb;
//     $ids = $wpdb->get_col("SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = 'hide_post'");
//     wp_cache_set('hidden_posts', $ids, 'posts');
//   }
//   $query->set('post__not_in', $ids);
//   return $query;
// }

// // ACF Export
// if(function_exists("register_field_group"))
// {
// 	register_field_group(array (
// 		'id' => 'acf_homepage',
// 		'title' => 'Homepage',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_54e5b55ff59ba',
// 				'label' => 'Feature panel',
// 				'name' => 'feature_panel',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'yes',
// 			),
// 			array (
// 				'key' => 'field_55716b8573f37',
// 				'label' => 'Feature video',
// 				'name' => 'feature_video',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'no',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'page',
// 					'operator' => '==',
// 					'value' => '181',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'no_box',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_the-world',
// 		'title' => 'The World',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_53fddf1638f8b',
// 				'label' => 'Image',
// 				'name' => 'image',
// 				'type' => 'image',
// 				'save_format' => 'url',
// 				'preview_size' => 'medium',
// 				'library' => 'all',
// 			),
// 			array (
// 				'key' => 'field_53fdfb07c0028',
// 				'label' => 'Image date',
// 				'name' => 'image_date',
// 				'type' => 'date_picker',
// 				'date_format' => 'yymmdd',
// 				'display_format' => 'dd/mm/yy',
// 				'first_day' => 1,
// 			),
// 			array (
// 				'key' => 'field_53fddf3938f8c',
// 				'label' => 'Description',
// 				'name' => 'description',
// 				'type' => 'textarea',
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'maxlength' => '',
// 				'rows' => '',
// 				'formatting' => 'br',
// 			),
// 			array (
// 				'key' => 'field_53fde10c885d7',
// 				'label' => 'Homepage image size',
// 				'name' => 'homepage_image_size',
// 				'type' => 'select',
// 				'choices' => array (
// 					'single' => 'single',
// 					'double' => 'double',
// 				),
// 				'default_value' => 'single',
// 				'allow_null' => 0,
// 				'multiple' => 0,
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'theworld',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'acf_after_title',
// 			'layout' => 'no_box',
// 			'hide_on_screen' => array (
// 				0 => 'permalink',
// 				1 => 'the_content',
// 				2 => 'excerpt',
// 				3 => 'custom_fields',
// 				4 => 'discussion',
// 				5 => 'comments',
// 				6 => 'revisions',
// 				7 => 'slug',
// 				8 => 'author',
// 				9 => 'format',
// 				10 => 'featured_image',
// 				11 => 'categories',
// 				12 => 'tags',
// 				13 => 'send-trackbacks',
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_services',
// 		'title' => 'Services',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_53fb9bd52b003',
// 				'label' => 'Images',
// 				'name' => 'images',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'yes',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'service',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'normal',
// 			'layout' => 'no_box',
// 			'hide_on_screen' => array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_testimonials',
// 		'title' => 'Testimonials',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_53ec8ed0e8900',
// 				'label' => 'Image',
// 				'name' => 'image',
// 				'type' => 'image',
// 				'save_format' => 'url',
// 				'preview_size' => 'medium',
// 				'library' => 'all',
// 			),
// 			array (
// 				'key' => 'field_53ec8efee8901',
// 				'label' => 'Quote',
// 				'name' => 'quote',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'no',
// 			),
// 			array (
// 				'key' => 'field_53ec8f13e8902',
// 				'label' => 'Name',
// 				'name' => 'name',
// 				'type' => 'text',
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'html',
// 				'maxlength' => '',
// 			),
// 			array (
// 				'key' => 'field_53ec8f21e8903',
// 				'label' => 'Position/Company',
// 				'name' => 'position_company',
// 				'type' => 'text',
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'prepend' => '',
// 				'append' => '',
// 				'formatting' => 'html',
// 				'maxlength' => '',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'testimonial',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'acf_after_title',
// 			'layout' => 'no_box',
// 			'hide_on_screen' => array (
// 				0 => 'permalink',
// 				1 => 'the_content',
// 				2 => 'excerpt',
// 				3 => 'custom_fields',
// 				4 => 'discussion',
// 				5 => 'comments',
// 				6 => 'revisions',
// 				7 => 'slug',
// 				8 => 'author',
// 				9 => 'format',
// 				10 => 'featured_image',
// 				11 => 'categories',
// 				12 => 'tags',
// 				13 => 'send-trackbacks',
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_clients',
// 		'title' => 'Clients',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_53e4d14601f3c',
// 				'label' => 'Logo',
// 				'name' => 'logo',
// 				'type' => 'image',
// 				'save_format' => 'url',
// 				'preview_size' => 'medium',
// 				'library' => 'all',
// 			),
// 			array (
// 				'key' => 'field_53f45f7f1b3df',
// 				'label' => 'Existing/Previous Client',
// 				'name' => 'existing-previous',
// 				'type' => 'select',
// 				'choices' => array (
// 					'Existing' => 'Existing',
// 					'Previous' => 'Previous',
// 				),
// 				'default_value' => 'Existing',
// 				'allow_null' => 0,
// 				'multiple' => 0,
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'client',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'acf_after_title',
// 			'layout' => 'no_box',
// 			'hide_on_screen' => array (
// 				0 => 'permalink',
// 				1 => 'excerpt',
// 				2 => 'custom_fields',
// 				3 => 'discussion',
// 				4 => 'comments',
// 				5 => 'revisions',
// 				6 => 'slug',
// 				7 => 'author',
// 				8 => 'format',
// 				9 => 'featured_image',
// 				10 => 'categories',
// 				11 => 'tags',
// 				12 => 'send-trackbacks',
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => 'acf_case-studies',
// 		'title' => 'Case Studies',
// 		'fields' => array (
// 			array (
// 				'key' => 'field_53e4c95e60b67',
// 				'label' => 'Client',
// 				'name' => 'client',
// 				'type' => 'relationship',
// 				'return_format' => 'object',
// 				'post_type' => array (
// 					0 => 'client',
// 				),
// 				'taxonomy' => array (
// 					0 => 'all',
// 				),
// 				'filters' => array (
// 					0 => 'search',
// 				),
// 				'result_elements' => array (
// 					0 => 'post_title',
// 				),
// 				'max' => '',
// 			),
// 			array (
// 				'key' => 'field_53eb912f40551',
// 				'label' => 'Homepage image size',
// 				'name' => 'homepage_image_size',
// 				'type' => 'select',
// 				'choices' => array (
// 					'single' => 'single',
// 					'double' => 'double',
// 				),
// 				'default_value' => 'single',
// 				'allow_null' => 0,
// 				'multiple' => 0,
// 			),
// 			array (
// 				'key' => 'field_53eb94577d44c',
// 				'label' => 'Short description',
// 				'name' => 'short_description',
// 				'type' => 'textarea',
// 				'default_value' => '',
// 				'placeholder' => '',
// 				'maxlength' => '',
// 				'rows' => '',
// 				'formatting' => 'br',
// 			),
// 			array (
// 				'key' => 'field_53e4c7c69235d',
// 				'label' => 'The Brief',
// 				'name' => 'the_brief',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'no',
// 			),
// 			array (
// 				'key' => 'field_53e4c8059235e',
// 				'label' => 'The Solution',
// 				'name' => 'the_solution',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'no',
// 			),
// 			array (
// 				'key' => 'field_53e4c81f9235f',
// 				'label' => 'Images',
// 				'name' => 'images',
// 				'type' => 'wysiwyg',
// 				'default_value' => '',
// 				'toolbar' => 'full',
// 				'media_upload' => 'yes',
// 			),
// 		),
// 		'location' => array (
// 			array (
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'casestudy',
// 					'order_no' => 0,
// 					'group_no' => 0,
// 				),
// 			),
// 		),
// 		'options' => array (
// 			'position' => 'acf_after_title',
// 			'layout' => 'no_box',
// 			'hide_on_screen' => array (
// 				0 => 'permalink',
// 				1 => 'the_content',
// 				2 => 'excerpt',
// 				3 => 'custom_fields',
// 				4 => 'discussion',
// 				5 => 'comments',
// 				6 => 'revisions',
// 				7 => 'author',
// 				8 => 'format',
// 				9 => 'categories',
// 				10 => 'send-trackbacks',
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// }
