<?php

/**
 * outside-task functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package outside-task
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function outside_task_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on outside-task, use a find and replace
		* to change 'outside-task' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('outside-task', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'outside-task'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'outside_task_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'outside_task_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function outside_task_content_width()
{
	$GLOBALS['content_width'] = apply_filters('outside_task_content_width', 640);
}
add_action('after_setup_theme', 'outside_task_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function my_acf_blocks_init()
{
	// Check if ACF is active
	if (function_exists('acf_register_block_type')) {
		acf_register_block_type(array(
			'name'              => 'accordion-slider', // Unique name for the block
			'title'             => __('Accordion Slider'), // Block title in editor
			'description'       => __('A custom accordion slider block.'), // Block description
			'render_template'   => 'template-parts/blocks/accordion-slider/accordion-slider.php', // Path to the block's PHP template
			'category'          => 'formatting', // Block category (can be 'widgets', 'common', etc.)
			'icon'              => 'slides', // Dashicon or custom icon
			'keywords'          => array('accordion', 'slider'), // Keywords for searching the block
			'enqueue_assets'    => function () {
				// Enqueue block-specific assets
				wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null);
				wp_enqueue_style('accordion-slider-style', get_template_directory_uri() .'/template-parts/blocks/accordion-slider/accordion-slider.css');

			},
			'supports' => array(
				'align' => false,
				'mode'  => false,
			),
		));
	}
}
add_action('acf/init', 'my_acf_blocks_init');





function outside_task_scripts()
{
	// Enqueue Google Fonts
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Roboto+Condensed:wght@400;500&family=Inter:wght@400&display=swap', array(), null);
	// Enqueue Swiper CSS
	wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null);
	// Enqueue custom styles
	wp_enqueue_style('accordion-slider-style', get_stylesheet_directory_uri() . '/template-parts/blocks/accordion-slider/accordion-slider.css');


	// Enqueue Swiper JS
	wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
	wp_enqueue_script('vimeo-js', 'https://player.vimeo.com/api/player.js', array(), null, true);
	wp_enqueue_script('accordion-slider-script', get_stylesheet_directory_uri() .'/template-parts/blocks/accordion-slider/accordion-slider.js', array(), '', true);
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'outside_task_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
