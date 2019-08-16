<?php
/**
 * WTF functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://developer.wordpress.org/themes/advanced-topics/child-themes/
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */

/**
 * WTF only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/includes/back-compat.php';
}

// https://codex.wordpress.org/Theme_Features

if ( ! function_exists( 'wtf__setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own wtf__setup() function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://hypersoft.llc/products/wordpress/themes/wtf
		 * If you're building a theme based on WTF, use a find and replace
		 * to change 'wtf' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'wtf' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for custom logo.
		 *
		 * @since WTF 0.0.0-alpha
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height' => 240,
				'width' => 240,
				'flex-height' => true,
			)
		);

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Dark Gray', 'wtf' ),
					'slug'  => 'dark-gray',
					'color' => '#1a1a1a',
				),
				array(
					'name'  => __( 'Medium Gray', 'wtf' ),
					'slug'  => 'medium-gray',
					'color' => '#686868',
				),
				array(
					'name'  => __( 'Light Gray', 'wtf' ),
					'slug'  => 'light-gray',
					'color' => '#e5e5e5',
				),
				array(
					'name'  => __( 'White', 'wtf' ),
					'slug'  => 'white',
					'color' => '#fff',
				),
				array(
					'name'  => __( 'Blue Gray', 'wtf' ),
					'slug'  => 'blue-gray',
					'color' => '#4d545c',
				),
				array(
					'name'  => __( 'Bright Blue', 'wtf' ),
					'slug'  => 'bright-blue',
					'color' => '#007acc',
				),
				array(
					'name'  => __( 'Light Blue', 'wtf' ),
					'slug'  => 'light-blue',
					'color' => '#9adffd',
				),
				array(
					'name'  => __( 'Dark Brown', 'wtf' ),
					'slug'  => 'dark-brown',
					'color' => '#402b30',
				),
				array(
					'name'  => __( 'Medium Brown', 'wtf' ),
					'slug'  => 'medium-brown',
					'color' => '#774e24',
				),
				array(
					'name'  => __( 'Dark Red', 'wtf' ),
					'slug'  => 'dark-red',
					'color' => '#640c1f',
				),
				array(
					'name'  => __( 'Bright Red', 'wtf' ),
					'slug'  => 'bright-red',
					'color' => '#ff675f',
				),
				array(
					'name'  => __( 'Yellow', 'wtf' ),
					'slug'  => 'yellow',
					'color' => '#ffef8e',
				),
			)
		);

		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );

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
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails (aka Feature Image) on posts and pages.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'wtf' ),
				'social' => __( 'Social Links Menu', 'wtf' ),
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'assets/styles/editor-style.css', wtf__fonts_url() ) );
	}
endif; // wtf__setup
add_action( 'after_setup_theme', 'wtf__setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since WTF 0.0.0-alpha
 */
function wtf__content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wtf__content_width', 840 );
}
add_action( 'after_setup_theme', 'wtf__content_width', 0 );

/**
 * Flushes out the transients used in `wtf__is_categorized_blog` template tag.
 *
 * @since WTF 0.0.0-alpha
 */
function wtf__category_transient_flusher () {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'wtf__categories' );
}
add_action( 'edit_category', 'wtf__category_transient_flusher' );
add_action( 'save_post', 'wtf__category_transient_flusher' );

/**
 * Add preconnect for Google Fonts.
 *
 * @since WTF 0.0.0-alpha
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function wtf__filter__wp_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'wtf-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'wtf__filter__wp_resource_hints', 10, 2 );

function wtf__register_primary_sidebar () {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar (Primary)', 'wtf' ),
			'id'            => 'sidebar-primary',
			'description'   => __( 'Add widgets here to appear in the primary sidebar.', 'wtf' ),
			// The class is prepended	with `sidebar-` and used in the Appearance > Widgets page in the WP admin.
			'class'         => '-primary',
			'before_widget' => '<div class="widget %2$s" id="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget__head"><span class="widget-title">',
			'after_title'   => '</span></div>',
		)
	);
}

function wtf__filter__dynamic_sidebar_params ( $params ) {
	// TODO: Force BEM naming convention.
	// $params[0]['before_widget'] = str_replace( 'widget_', 'widget--', $params[0]['before_widget'] );
	// $params[0]['before_widget'] = preg_replace( '/class="widget widget_([^"]+)"/', 'class="widget widget--$1"', $params[0]['before_widget'] );
	return $params;
}
add_filter( 'dynamic_sidebar_params', 'wtf__filter__dynamic_sidebar_params' );

if ( ! function_exists( 'wtf__filter__excerpt_more' ) && ! is_admin() ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
	 * a 'Continue reading' link.
	 *
	 * Create your own wtf__filter__excerpt_more() function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 *
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 */
	function wtf__filter__excerpt_more ( $more_string ) {
		$post_id = get_the_ID();
		$link = sprintf(
			'<a class="link link--more" href="%1$s">%2$s</a>',
			esc_url( get_permalink( $post_id ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading<span class="sr-only"> "%s"</span>', 'wtf' ), get_the_title( $post_id ) )
		);
		return ' &hellip; ' . $link;
	}
	add_filter( 'excerpt_more', 'wtf__filter__excerpt_more' );
endif;

function wtf__register_secondary_primary_sidebar () {
	register_sidebar(
		array(
			'name'          => __( 'Bottom Widgets (Primary)', 'wtf' ),
			'id'            => 'sidebar-secondary-primary',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'wtf' ),
			// The class is prepended	with `sidebar-` and used in the Appearance > Widgets page in the WP admin.
			'class'         => '-secondary--primary',
			'before_widget' => '<div class="widget %2$s" id="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget__head"><span class="widget-title">',
			'after_title'   => '</span></div>',
		)
	);
}

function wtf__register_secondary_secondary_sidebar () {
	register_sidebar(
		array(
			'name'          => __( 'Bottom Widgets (Secondary)', 'wtf' ),
			'id'            => 'sidebar-secondary-secondary',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'wtf' ),
			// The class is prepended	with `sidebar-` and used in the Appearance > Widgets page in the WP admin.
			'class'         => '-secondary--secondary',
			'before_widget' => '<div class="widget %2$s" id="%1$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget__head"><span class="widget-title">',
			'after_title'   => '</span></div>',
		)
	);
}

if ( ! function_exists( 'wtf__action__widgets_init' ) ) :
	/**
	 * Registers a widget area.
	 *
	 * Create your own `wtf__action__widgets_init` function to override in a child
	 * theme.
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__action__widgets_init() {
		wtf__register_primary_sidebar();
		wtf__register_secondary_primary_sidebar();
		wtf__register_secondary_secondary_sidebar();
	}
endif;
add_action( 'widgets_init', 'wtf__action__widgets_init' );

if ( ! function_exists( 'wtf__fonts_url' ) ) :
	/**
	 * Register Google fonts for WTF.
	 *
	 * Create your own wtf__fonts_url() function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function wtf__fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'wtf' ) ) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}

		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'wtf' ) ) {
			$fonts[] = 'Montserrat:400,700';
		}

		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'wtf' ) ) {
			$fonts[] = 'Inconsolata:400';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since WTF 0.0.0-alpha
 */
function wtf__javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'wtf__javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since WTF 0.0.0-alpha
 */
function wtf__action__wp_enqueue_scripts() {
	// error_log( 'wtf__action__wp_enqueue_scripts' );
	// Add custom fonts, used in the main stylesheet.
	// wp_enqueue_style( 'wtf-fonts', wtf__fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'wtf-style', get_template_directory_uri() . '/style.css' );

	// Theme block stylesheet.
	// wp_enqueue_style( 'wtf-block-style', get_template_directory_uri() . '/assets/styles/blocks.css', array( 'wtf-style' ), '20181230' );

	// Load the Internet Explorer specific stylesheet.
	// wp_enqueue_style( 'wtf-ie', get_template_directory_uri() . '/assets/styles/ie.css', array( 'wtf-style' ), '20160816' );
	// wp_style_add_data( 'wtf-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	// wp_enqueue_style( 'wtf-ie8', get_template_directory_uri() . '/assets/styles/ie8.css', array( 'wtf-style' ), '20160816' );
	// wp_style_add_data( 'wtf-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	// wp_enqueue_style( 'wtf-ie7', get_template_directory_uri() . '/assets/styles/ie7.css', array( 'wtf-style' ), '20160816' );
	// wp_style_add_data( 'wtf-ie7', 'conditional', 'lt IE 8' );

	// Child theme stylesheet
	if ( TEMPLATEPATH !== STYLESHEETPATH ) {
		wp_enqueue_style( 'wtf-child-style', get_stylesheet_uri(), array( 'wtf-style' ) );
	}

	// Load the html5 shiv.
	// wp_enqueue_script( 'wtf-html5', get_template_directory_uri() . '/assets/scripts/html5.js', array(), '3.7.3' );
	// wp_script_add_data( 'wtf-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'wtf-skip-link-focus-fix', get_template_directory_uri() . '/assets/scripts/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		// wp_enqueue_script( 'wtf-keyboard-attachment-navigation', get_template_directory_uri() . '/assets/scripts/keyboard-attachment-navigation.js', array( 'jquery' ), '20160816' );
		wp_enqueue_script( 'wtf-keyboard-attachment-navigation', get_template_directory_uri() . '/assets/scripts/keyboard-attachment-navigation.js', array(), '20160816' );
	}

	// wp_enqueue_script( 'wtf-script', get_template_directory_uri() . '/assets/scripts/functions.js', array( 'jquery' ), '20181230', true );
	wp_enqueue_script( 'wtf-script', get_template_directory_uri() . '/assets/scripts/functions.js', array(), '20181230', true );

	// TODO: Better understand what wp_localize_script is for and how to properly use it.
	// wp_localize_script(
	// 	'wtf-script',
	// 	'screenReaderText',
	// 	array(
	// 		'expand'   => __( 'expand child menu', 'wtf' ),
	// 		'collapse' => __( 'collapse child menu', 'wtf' ),
	// 	)
	// );
}
add_action( 'wp_enqueue_scripts', 'wtf__action__wp_enqueue_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since WTF 0.0.0-alpha
 */
function wtf__action__enqueue_block_editor_assets() {
	// Block styles.
	wp_enqueue_style( 'wtf-block-editor-style', get_template_directory_uri() . '/assets/styles/editor-blocks.css', array(), '20181230' );
	// Add custom fonts.
	wp_enqueue_style( 'wtf-fonts', wtf__fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'wtf__action__enqueue_block_editor_assets' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since WTF 0.0.0-alpha
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function wtf__filter__body_class( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'wtf__filter__body_class' );

function wtf__filter__wp_nav_menu_objects ( $sorted_menu_items, $args ) {
	// Add Bootstrap-4 `nav-item` to the menu item's `classes`.
	foreach ( (array) $sorted_menu_items as &$menu_item ) {
		// Assuming it is okay to mutate the menu items.
		$menu_item->classes = [
			'nav-item',
			'nav-item--' . str_replace( '_', '-', $menu_item->type ),
			'nav-item--' . $menu_item->object . '-object',
		];
		if ( $menu_item->current || $menu_item->current_item_ancestor ) {
			$menu_item->classes[] = 'active';
		}
	}

	return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'wtf__filter__wp_nav_menu_objects', 10, 2 );

function wtf__filter__nav_menu_link_attributes ( $atts, $item, $args, $depth ) {
	// Add Bootstrap-4 `nav-link` to the link's `class` attribute.
	if ( ! empty( $atts['class'] ) ) {
		$atts['class'] .= ' nav-link';
	}
	else {
		$atts['class'] = 'nav-link';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'wtf__filter__nav_menu_link_attributes', 10, 4);

// /**
//  * Hides the custom post template for pages on WordPress 4.6 and older
//  *
//  * @param array $post_templates Array of page templates. Keys are filenames, values are translated names.
//  * @return array Filtered array of page templates.
//  */
// function wtf__filter__theme_page_templates( $post_templates ) {
// 	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
// 		// unset( $post_templates['page-templates/custom-full-width.php'] );
// 	}
// 	return $post_templates;
// }
// add_filter( 'theme_page_templates', 'wtf__filter__theme_page_templates' );

/**
 * Converts a HEX value to RGB.
 *
 * @since WTF 0.0.0-alpha
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function wtf__hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since WTF 0.0.0-alpha
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function wtf__filter__wp_calculate_image_sizes( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'wtf__filter__wp_calculate_image_sizes', 10, 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since WTF 0.0.0-alpha
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function wtf__filter__wp_get_attachment_image_attributes( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-primary' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'wtf__filter__wp_get_attachment_image_attributes', 10, 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since WTF 0.0.0-alpha
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function wtf__filter__widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'wtf__filter__widget_tag_cloud_args' );

if ( ! function_exists( 'wtf__filter__wtf__document_body_content_tpl_name' ) ) :
	/**
	 *
	 * @param {string} $default_document_body_content_tpl_name -
	 */
	function wtf__filter__wtf__document_body_content_tpl_name ( $default_document_body_content_tpl_name ) {
		/*
		 * WTF__PAGE_TEMPLATE_NAME is one of `'404'`, `'archive'`, `'attachment'`,
		 * `'audio'`, `'author'`, `'category'`, `'date'`, `'front-page'`, `'home'`,
		 * `'image'`, `'page'`, `'search'`, `'single'`, `'singular'`, `'tag'`,
		 * `'taxonomy'`, or `'video'`.
		*/
		$n = WTF__PAGE_TEMPLATE_NAME;
		$document_body_content_tpl_name = WTF__PAGE_TEMPLATE_NAME;
		if ( $n === 'author' || $n === 'category' || $n === 'date' || $n === 'tag' || $n === 'taxonomy' ) {
			$document_body_content_tpl_name = 'archive';
		}
		elseif ( $n === 'image' || $n === 'audio' || $n === 'video' ) {
			$document_body_content_tpl_name = 'attachment';
		}
		elseif ( $n === 'home' ) {
			$document_body_content_tpl_name = 'list';
		}
		return $document_body_content_tpl_name;
	}
endif;
add_filter( 'wtf__document_body_content_tpl_name', 'wtf__filter__wtf__document_body_content_tpl_name' );
