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

if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

// Set our theme version.
define( 'WTF__VERSION', '0.0.0-alpha' );

// Usually setting up the theme is not necessary during an AJAX call or while
// running cron.
$set_up_theme = apply_filters( 'wtf__set_up_theme', ( ! wp_doing_ajax() && ! wp_doing_cron() ) );

if ( $set_up_theme ) :

	/**
	 * WTF only works in WordPress 4.7 or later.
	 */
	if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
		require get_template_directory() . '/includes/back-compat.php';
	}

	require get_template_directory() . '/includes/polyfills.php';

	require get_template_directory() . '/includes/theme-functions.php';

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/includes/template-tags.php';

	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/includes/customizer.php';

	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		require get_template_directory() . '/includes/debug.php';
		do_action( 'wtf__debug' );
	}

	if ( ! function_exists( 'wtf__filter__wtf__theme_support' ) ) :
		function &wtf__filter__wtf__theme_support ( $theme_support ) {

			$theme_support['menus'] = array(
				'site--primary' => __( 'Primary Site Menu', 'wtf' ),
				'site--Secondary' => __( 'Secondary Site Menu', 'wtf' ),
				'social--primary' => __( 'Primary Social Media Menu', 'wtf' ),
				'social--Secondary' => __( 'Secondary Social Media Menu', 'wtf' ),
			);

			// $theme_support['starter-content'] = array(
			// 	'attachments' => array(
			// 		'featured-image-logo' => array(
			// 			'file' => 'assets/images/featured-logo.jpg',
			// 			'post_content' => 'Attachment Description',
			// 			'post_excerpt' => 'Attachment Caption',
			// 			'post_title' => 'Featured Logo',
			// 		),
			// 	),
			// 	'posts' => array(
			// 		'about' => array(
			// 			// Use a page template with the predefined about page.
			// 			'template' => 'sample-about-page-template.php',
			// 		),
			// 		'blog' => array(
			// 			// Use a page template with the predefined blog index page.
			// 			'template' => 'sample-blog-page-template.php',
			// 		),
			// 		'contact' => array(
			// 			// Use a page template with the predefined contact page.
			// 			'template' => 'sample-contact-page-template.php',
			// 		),
			// 		'custom' => array(
			// 			'comment_status' => '',
			// 			'menu_order' => '',
			// 			'post_content' => '',
			// 			'post_excerpt' => '',
			// 			'post_name' => '',
			// 			'post_title' => 'Custom Post',
			// 			'post_type' => 'post',
			// 			'thumbnail' => '{{featured-image-logo}}',
			// 		),
			// 		'home' => array(
			// 			// Use a page template with the predefined home page.
			// 			'template' => 'sample-home-page-template.php',
			// 		),
			// 		'homepage-section' => array(
			// 			// Use a page template with the predefined page.
			// 			'template' => 'sample-homepage-section-template.php',
			// 		),
			// 		'news' => array(
			// 			// Use a page template with the predefined page.
			// 			'template' => 'sample-news-page-template.php',
			// 		),
			// 	),
			// 	'widgets' => array(
			// 		'sidebar-1' => array(
			// 			'meta_custom' => array(
			// 				'meta',
			// 				array(
			// 					'title' => 'Pre-hydrated meta widget.',
			// 				)
			// 			),
			// 		),
			// 	),
			// );

			$theme_support['widgets'] = array(
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
				),
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
				),
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
				),
			);

			return $theme_support;
		}
	endif;
	add_filter( 'wtf__theme_support', 'wtf__filter__wtf__theme_support' );

	if ( ! function_exists( 'wtf__action__after_theme_setup' ) ) :
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * Create your own `wtf__action__after_theme_setup` function to override in a child theme.
		 *
		 * https://codex.wordpress.org/Theme_Features
		 *
		 * @since WTF 0.0.0-alpha
		 */
		function wtf__action__after_theme_setup() {
			/*
			* Make theme available for translation.
			* Translations can be filed at WordPress.org. See: https://hypersoft.llc/products/wordpress/themes/wtf
			* If you're building a theme based on WTF, use a find and replace
			* to change 'wtf' to the name of your theme in all the template files
			*/
			load_theme_textdomain( 'wtf' );

			wtf__add_theme_support();

			/*
			* This theme styles the visual editor to resemble the theme style,
			* specifically font, colors, icons, and column width.
			*/
			add_editor_style( array( 'assets/styles/editor-style.css', wtf__fonts_url() ) );
		}
	endif; // wtf__action__after_theme_setup
	add_action( 'after_setup_theme', 'wtf__action__after_theme_setup' );

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
	 * Flushes out the transients used in `wtf__is_categorized_blog` function.
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

	if ( ! function_exists( 'wtf__filter__wp_resource_hints' ) ) :
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
	endif;
	add_filter( 'wp_resource_hints', 'wtf__filter__wp_resource_hints', 10, 2 );

	if ( ! function_exists( 'wtf__filter__dynamic_sidebar_params' ) ) :
		function wtf__filter__dynamic_sidebar_params ( $params ) {
			// TODO: Force BEM naming convention.
			// $params[0]['before_widget'] = str_replace( 'widget_', 'widget--', $params[0]['before_widget'] );
			// $params[0]['before_widget'] = preg_replace( '/class="widget widget_([^"]+)"/', 'class="widget widget--$1"', $params[0]['before_widget'] );
			return $params;
		}
	endif;
	add_filter( 'dynamic_sidebar_params', 'wtf__filter__dynamic_sidebar_params' );

	if ( ! function_exists( 'wtf__filter__excerpt_more' ) ) :
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
			if ( ! is_admin() ) {
				$post_id = get_the_ID();
				$link = sprintf(
					'<a class="link link--more" href="%1$s">%2$s</a>',
					esc_url( get_permalink( $post_id ) ),
					/* translators: %s: Name of current post */
					sprintf( __( 'Continue reading<span class="post-title"> "%s"</span>', 'wtf' ), get_the_title( $post_id ) )
				);
				$more_string = ' &hellip; ' . $link;
			}
			return $more_string;
		}
	endif;
	add_filter( 'excerpt_more', 'wtf__filter__excerpt_more' );

	if ( ! function_exists( 'wtf__action__enqueue_block_editor_assets' ) ) :
		/**
		 * Enqueue styles for the block-based editor.
		 *
		 * @since WTF 0.0.0-alpha
		 */
		function wtf__action__enqueue_block_editor_assets() {
			// Block styles.
			wp_enqueue_style( 'wtf-block-editor-style', get_template_directory_uri() . '/assets/styles/editor-blocks.css', array(), '20181230' );
			// Add custom fonts.
			wp_enqueue_style( 'wtf-fonts', wtf__fonts_url(), array(), NULL );
		}
	endif;
	add_action( 'enqueue_block_editor_assets', 'wtf__action__enqueue_block_editor_assets' );

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

	if ( ! function_exists( 'wtf__filter__wp_calculate_image_sizes' ) ) :
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
	endif;
	add_filter( 'wp_calculate_image_sizes', 'wtf__filter__wp_calculate_image_sizes', 10, 2 );

	if ( ! function_exists( 'wtf__filter__wp_get_attachment_image_attributes' ) ) :
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
	endif;
	add_filter( 'wp_get_attachment_image_attributes', 'wtf__filter__wp_get_attachment_image_attributes', 10, 3 );

	function _wtf__action__admin_init () {
		define( 'WTF__PAGE_TEMPLATE_NAME', 'wp-admin:' . basename( $GLOBALS['pagenow'], '.php' ) );
	}
	add_action( 'admin_init', '_wtf__action__admin_init' );

	function _wtf__action__login_init () {
		// confirmaction, login, logout, lostpassword, postpass, register, resetpass, retrievepassword
		$wtf_page_template_name = $GLOBALS['action'];
		if ( 'rp' === $wtf_page_template_name) {
			$wtf_page_template_name = 'resetpass';
		}
		define( 'WTF__PAGE_TEMPLATE_NAME', $wtf_page_template_name );
	}
	add_action( 'login_init', '_wtf__action__login_init' );

	if ( ! function_exists( 'wtf__action__wtf__document_init' ) ) :
		/**
		 * Document initialization.
		 *
		 * Note: `WTF__PAGE_TEMPLATE_NAME` will be defined at this point.
		 */
		function wtf__action__wtf__document_init () {
			// error_log( 'wtf__action__wtf__document_init' );
			// error_log( 'WTF__PAGE_TEMPLATE_NAME: ' . WTF__PAGE_TEMPLATE_NAME );

			/**
			 * Add the charset meta tag to the document head.
			 *
			 * It is recommended that the charset meta tag is one of the first two tags in the
			 * HTML head.
			 *
			 * See https://htmlhead.dev/.
			 */
			function wtf__action__wp_head__add_charset_meta () {
				echo '<meta charset="' . esc_attr( get_bloginfo( 'charset' ) ) . '">' . "\n";
			}
			add_action( 'wp_head', 'wtf__action__wp_head__add_charset_meta', 0 );

			/**
			 * Add the viewport meta tag to the document head.
			 *
			 * It is recommended that the viewport meta tag is one of the first two tags in the
			 * HTML head.
			 *
			 * See https://htmlhead.dev/.
			 */
			function wtf__action__wp_head__add_viewport_meta () {
				echo '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";
			}
			add_action( 'wp_head', 'wtf__action__wp_head__add_viewport_meta', 0 );

			/**
			 * Adds the profile link to the document head.
			 */
			function wtf__action__wp_head__add_profile_link () {
				echo '<link rel="profile" href="http://gmpg.org/xfn/11">' . "\n";
			}
			add_action( 'wp_head', 'wtf__action__wp_head__add_profile_link', 3 );

			/**
			 * Adds the pingback link to the document head.
			 */
			function wtf__action__wp_head__add_pingback_link () {
				if ( is_singular() && pings_open( get_queried_object() ) ) {
					echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
				}
			}
			add_action( 'wp_head', 'wtf__action__wp_head__add_pingback_link', 3 );

			if ( ! function_exists( 'wtf__javascript_detection' ) ) :
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
			endif;
			add_action( 'wp_head', 'wtf__javascript_detection', 4 );

			if ( ! function_exists( 'wtf__action__wp_enqueue_scripts' ) ) :
				/**
				 * Enqueues scripts and styles.
				 *
				 * @since WTF 0.0.0-alpha
				 */
				function wtf__action__wp_enqueue_scripts() {
					// error_log( 'wtf__action__wp_enqueue_scripts' );

					$style_assets_manifest = wtf__get_style_assets_manifest();

					if ( ! is_null( $style_assets_manifest ) ) {
						$css = $style_assets_manifest['bones.css'];

						if ( ! is_null( $css ) ) {
							// Theme stylesheet.
							wp_enqueue_style( 'wtf-style', get_template_directory_uri() . "/assets/styles/{$css}", array(), NULL );
						}
					}

					// Add custom fonts, used in the main stylesheet.
					// wp_enqueue_style( 'wtf-fonts', wtf__fonts_url(), array(), NULL );

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

					// // Child theme stylesheet
					// if ( TEMPLATEPATH !== STYLESHEETPATH ) {
					// 	wp_enqueue_style( 'wtf-child-style', get_stylesheet_uri(), array( 'wtf-style' ) );
					// }

					// Load the html5 shiv.
					// wp_enqueue_script( 'wtf-html5', get_template_directory_uri() . '/assets/scripts/html5.js', array(), '3.7.3' );
					// wp_script_add_data( 'wtf-html5', 'conditional', 'lt IE 9' );

					$script_assets_manifest = wtf_child__get_script_assets_manifest();

					if ( ! is_null( $script_assets_manifest ) ) {
						$js = $script_assets_manifest['runtime-main.js'];

						if ( ! is_null( $js ) ) {
							wp_enqueue_script(
								'wtf-runtime-main-js',
								get_theme_file_uri( "assets/scripts/{$js}" ),
								array(),
								NULL,
								TRUE
							);
						}

						$js = $script_assets_manifest['main.js'];

						if ( ! is_null( $js ) ) {
							wp_enqueue_script(
								'wtf-main-js',
								get_theme_file_uri( "assets/scripts/{$js}" ),
								array(),
								NULL,
								TRUE
							);
						}
					}

					wp_enqueue_script( 'wtf-skip-link-focus-fix', get_template_directory_uri() . '/assets/scripts/skip-link-focus-fix.js', array(), '20160816', TRUE );

					if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
						wp_enqueue_script( 'comment-reply' );
					}

					if ( is_singular() && wp_attachment_is_image() ) {
						// wp_enqueue_script( 'wtf-keyboard-attachment-navigation', get_template_directory_uri() . '/assets/scripts/keyboard-attachment-navigation.js', array( 'jquery' ), '20160816' );
						wp_enqueue_script( 'wtf-keyboard-attachment-navigation', get_template_directory_uri() . '/assets/scripts/keyboard-attachment-navigation.js', array(), '20160816' );
					}

					// wp_enqueue_script( 'wtf-script', get_template_directory_uri() . '/assets/scripts/functions.js', array( 'jquery' ), '20181230', TRUE );
					// wp_enqueue_script( 'wtf-script', get_template_directory_uri() . '/assets/scripts/functions.js', array(), '20181230', TRUE );

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
			endif;
			// Note: A priority of 0 is required to beat MemberPress theme.css insertion which
			// happens at priority of 1.
			add_action( 'wp_enqueue_scripts', 'wtf__action__wp_enqueue_scripts', 0 );

			function wtf__action__wp_body_open__add_skip_content_link () {
				/* TODO: Add a filter for main content fragment ID */
				echo '<a class="link  link--skip-to-content" href="#content">' . __( 'Skip to content', 'wtf' ) . '</a>' . "\n";
			}
			add_action( 'wp_body_open', 'wtf__action__wp_body_open__add_skip_content_link' );

			if ( ! function_exists( 'wtf__filter__body_class' ) ) :
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
			endif;
			add_filter( 'body_class', 'wtf__filter__body_class' );

			if ( ! function_exists( 'wtf__filter__nav_menu_link_attributes' ) ) :
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
			endif;
			add_filter( 'nav_menu_link_attributes', 'wtf__filter__nav_menu_link_attributes', 10, 4);

			if ( ! function_exists( 'wtf__filter__widget_tag_cloud_args' ) ) :
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
			endif;
			add_filter( 'widget_tag_cloud_args', 'wtf__filter__widget_tag_cloud_args' );

			if ( ! function_exists( 'wtf__filter__wp_nav_menu_objects' ) ) :
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
			endif;
			add_filter( 'wp_nav_menu_objects', 'wtf__filter__wp_nav_menu_objects', 10, 2 );

			/*
			Filters:
			wtf__document_tpl_slug
			wtf__document_tpl_name
				wtf__document_head_tpl_name
				wtf__document_body_tpl_name
					wtf__document_body_start_tpl_name
					wtf__document_body_content_tpl_name
						wtf__page_header_tpl_name
						wtf__primary_page_sidebar_tpl_name
						wtf__page_footer_tpl_name
					wtf__document_body_end_tpl_name
			*/

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

		}
	endif;
	add_action( 'wtf__document_init', 'wtf__action__wtf__document_init' );

endif; // eo if ( $set_up_theme )

unset( $set_up_theme );
