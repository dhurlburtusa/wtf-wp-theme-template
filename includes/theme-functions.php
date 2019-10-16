<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

/**
 * Returns the default theme support configuration.
 *
 * @since WTF 0.0.0-alpha
 */
function wtf__get_default_theme_support () {
	$theme_support = array(
		// @param {NULL|TRUE|FALSE} - Used with block editor.
		'align-wide' => NULL,

		// @param {NULL|TRUE|FALSE} - Enables automatically including feed links in the
		// 	response.
		'automatic-feed-links' => NULL,

		// @param {NULL|TRUE|FALSE|Array<String, String>} - Enables custom background
		// 	support. `TRUE` will enable custom background support with the WordPress default
		// 	values. `FALSE` will disable custom background support. An associative array
		// 	will enable custom background support with the specified values merged with the
		// 	WordPress default values.
		'custom-background' => NULL,

		// @param {NULL|TRUE|FALSE|Array<String, *>} - Enables custom header support. `TRUE`
		// 	will enable custom header support with the WordPress default values. `FALSE`
		// 	will disable custom header support. An associative array will enable custom
		// 	header support with the specified values merged with the WordPress default
		// 	values.
		'custom-header' => NULL,

		// @param {NULL|TRUE|FALSE|Array<String, *>} - Enables custom logo support. `TRUE`
		// 	will enable custom logo support with the WordPress default values. `FALSE` will
		// 	disable custom logo support. An associative array will enable custom logo
		// 	support with the specified values merged with the WordPress default values.
		'custom-logo' => NULL,

		// @param {NULL|TRUE|FALSE} - Flag indicating whether the theme has implemented Selective
		// 	Refresh support for widgets.
		'customize-selective-refresh-widgets' => NULL,

		// @param {NULL|TRUE|FALSE} - Enables/disables editor dark styles. Only applicable
		// 	when `editor-styles` is `TRUE`.
		'dark-editor-style' => NULL,

		// @param {NULL|TRUE|FALSE} - Enables/disables custom editor colors.
		'disable-custom-colors' => NULL,

		// @param {NULL|TRUE|FALSE} - Enables/disables custom editor font sizes.
		'disable-custom-font-sizes' => NULL,

		// @param {NULL|FALSE|Array<Array<String, String>>} - Enables a custom color
		// 	palette for the block editor. `FALSE` will resort back to the default WordPress
		// 	color palette. An associative array will enable a custom color palette with the
		// 	specified colors.
		'editor-color-palette' => NULL,

		// @param {NULL|FALSE|Array<Array<String, *>>} - Enables custom font sizes for the
		// 	block editor. `FALSE` will resort back to the default WordPress font sizes. An
		// 	associative array will enable custom font sizes with the specified sizes.
		'editor-font-sizes' => NULL,

		// @param {NULL|TRUE|FALSE} - Enables/disables editor styles.
		'editor-styles' => NULL,

		// @param {NULL|FALSE|Array<'caption'|'comment-form'|'comment-list'|'gallery'|'script'|'search-form'|'style'>} -
		// 	Sets which components should use HTML5 markup. `FALSE` will disable all
		// 	components from using HTML5. Defaults to using HTML5 for all components.
		'html5' => array(
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'script',
			'search-form',
			'style',
		),

		// @param {NULL|FALSE|Array<String, String>} -
		'menus' => NULL,

		// @param {NULL|TRUE|FALSE|Array<PostFormat|CustomPostFormat>} - Sets which post
		// 	formats are supported by the theme. `TRUE` will enable all post formats. `FALSE`
		// 	will disable post formats. An array of post formats will enable them.
		'post-formats' => NULL,

		// @param {NULL|TRUE|FALSE|Array<PostType|CustomPostTypes>} - Determines whether
		// 	featured images are supported by the theme and to which post types they apply.
		// 	`TRUE` will enable featured images for all post types. `FALSE` will disable
		// 	featured images for all post types. An array of post types will enable featured
		// 	images for the specified post types. Defaults to `TRUE`.
		'post-thumbnails' => TRUE,

		// @param {NULL|TRUE|FALSE} - Whether to add the `wp-embed-responsive` CSS class to the
		// 	`body` tag. Defaults to `TRUE`.
		'responsive-embeds' => TRUE,

		// @param {NULL|FALSE|Array<String, *>} - The starter content to use.
		'starter-content' => NULL,

		// @param {NULL|TRUE|FALSE} - Flag indicating whether the theme allows dynamic
		// 	`title` tags. That is, let WordPress manage the document title. By setting to
		// 	`TRUE`, you declare that this theme does not use a hard-coded `title` tag in
		// 	the document head, and expect WordPress to provide it for us. Defaults to
		// 	`TRUE`.
		'title-tag' => TRUE,

		// @param {NULL|FALSE|Array<Array<String, String>>}
		'widgets' => NULL,

		// @param {NULL|TRUE|FALSE} - Flag indicating whether to include the Block library theme
		// 	style sheet in the response. Defaults to `TRUE`.
		'wp-block-styles' => TRUE,
	);

	return $theme_support;
}

function wtf__get_script_assets_manifest () {
	$manifest = NULL;

	$manifest_json = file_get_contents( get_template_directory_uri() . '/assets/scripts/manifest.json' );

	if ( ! $manifest_json === FALSE ) {
		$manifest = json_decode( $manifest_json, TRUE );
	}

	return $manifest;
}

function wtf__get_style_assets_manifest () {
	$manifest = NULL;

	$manifest_json = file_get_contents( get_template_directory_uri() . '/assets/styles/manifest.json' );

	if ( ! $manifest_json === FALSE ) {
		$manifest = json_decode( $manifest_json, TRUE );
	}

	return $manifest;
}

/**
 * Converts a HEX value to RGB.
 *
 * @since WTF 0.0.0-alpha
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function wtf__hex2rgb ( $color ) {
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
 * Determines whether blog/site has more than one category.
 *
 * May be called inside or outside of the WP loop.
 *
 * Create your own `wtf__is_categorized_blog` function to override in a child theme.
 *
 * @since WTF 0.0.0-alpha
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function wtf__is_categorized_blog () {
	if ( FALSE === ( $all_the_cool_cats = get_transient( 'wtf__categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields' => 'ids',
				// We only need to know if there is more than one category.
				'number' => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'wtf__categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 || is_preview() ) {
		// This blog has more than 1 category so wtf__is_categorized_blog should return true.
		return TRUE;
	} else {
		// This blog has only 1 category so wtf__is_categorized_blog should return false.
		return FALSE;
	}
}

if ( ! function_exists( 'wtf__fonts_url' ) ) :
	/**
	 * Register Google fonts for WTF.
	 *
	 * Create your own `wtf__fonts_url` function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function wtf__fonts_url () {
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

if ( ! function_exists( 'wtf__add_theme_support' ) ) :
	/**
	 * Sets up theme support.
	 *
	 * Create your own `wtf__add_theme_support` function to override in a
	 * child theme.
	 *
	 * Alternatively, use the `wtf__theme_support` filter.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__add_theme_support () {
		$theme_support = wtf__get_default_theme_support();
		$theme_support = apply_filters( 'wtf__theme_support', $theme_support );

		if ( $theme_support['align-wide'] === TRUE ) {
			add_theme_support( 'align-wide' );
		}
		else if ( $theme_support['align-wide'] === FALSE ) {
			remove_theme_support( 'align-wide' );
		}

		if ( $theme_support['automatic-feed-links'] === TRUE ) {
			add_theme_support( 'automatic-feed-links' );
		}
		else if ( $theme_support['automatic-feed-links'] === FALSE ) {
			remove_theme_support( 'automatic-feed-links' );
		}

		$support = $theme_support['custom-background'];
		if ( $support === TRUE ) {
			remove_theme_support( 'custom-background' );
			add_theme_support( 'custom-background' );
		}
		else if ( $support === FALSE ) {
			remove_theme_support( 'custom-background' );
		}
		else if ( is_array( $support ) ) {
			remove_theme_support( 'custom-background' );
			add_theme_support( 'custom-background', $support );
		}

		$support = $theme_support['custom-header'];
		if ( $support === TRUE ) {
			remove_theme_support( 'custom-header' );
			add_theme_support( 'custom-header' );
		}
		else if ( $support === FALSE ) {
			remove_theme_support( 'custom-header' );
		}
		else if ( is_array( $support ) ) {
			remove_theme_support( 'custom-header' );
			add_theme_support( 'custom-header', $support );
		}

		$support = $theme_support['custom-logo'];
		if ( $support === TRUE ) {
			remove_theme_support( 'custom-logo' );
			add_theme_support( 'custom-logo' );
		}
		else if ( $support === FALSE ) {
			remove_theme_support( 'custom-logo' );
		}
		else if ( is_array( $support ) ) {
			remove_theme_support( 'custom-logo' );
			add_theme_support( 'custom-logo', $support );
		}

		if ( $theme_support['customize-selective-refresh-widgets'] === TRUE ) {
			add_theme_support( 'customize-selective-refresh-widgets' );
		}
		else if ( $theme_support['customize-selective-refresh-widgets'] === FALSE ) {
			remove_theme_support( 'customize-selective-refresh-widgets' );
		}

		if ( $theme_support['dark-editor-style'] === TRUE ) {
			add_theme_support( 'dark-editor-style' );
		}
		else if ( $theme_support['dark-editor-style'] === FALSE ) {
			remove_theme_support( 'dark-editor-style' );
		}

		if ( $theme_support['disable-custom-colors'] === TRUE ) {
			add_theme_support( 'disable-custom-colors' );
		}
		else if ( $theme_support['disable-custom-colors'] === FALSE ) {
			remove_theme_support( 'disable-custom-colors' );
		}

		if ( $theme_support['disable-custom-font-sizes'] === TRUE ) {
			add_theme_support( 'disable-custom-font-sizes' );
		}
		else if ( $theme_support['disable-custom-font-sizes'] === FALSE ) {
			remove_theme_support( 'disable-custom-font-sizes' );
		}

		if ( is_array( $theme_support['editor-color-palette'] ) ) {
			remove_theme_support( 'editor-color-palette' );
			add_theme_support( 'editor-color-palette', $theme_support['editor-color-palette'] );
		}
		else if ( $theme_support['editor-color-palette'] === FALSE ) {
			remove_theme_support( 'editor-color-palette' );
		}

		if ( is_array( $theme_support['editor-font-sizes'] ) ) {
			remove_theme_support( 'editor-font-sizes' );
			add_theme_support( 'editor-font-sizes', $theme_support['editor-font-sizes'] );
		}
		else if ( $theme_support['editor-font-sizes'] === FALSE ) {
			remove_theme_support( 'editor-font-sizes' );
		}

		if ( $theme_support['editor-styles'] === TRUE ) {
			add_theme_support( 'editor-styles' );
		}
		else if ( $theme_support['editor-styles'] === FALSE ) {
			remove_theme_support( 'editor-styles' );
		}

		if ( is_array( $theme_support['html5'] ) ) {
			remove_theme_support( 'html5' );
			add_theme_support( 'html5', $theme_support['html5'] );
		}
		else if ( $theme_support['html5'] === FALSE ) {
			remove_theme_support( 'html5' );
		}

		if ( is_array( $theme_support['menus'] ) ) {
			remove_theme_support( 'menus' );
			register_nav_menus( $theme_support['menus'] );
		}
		else if ( $theme_support['menus'] === FALSE ) {
			remove_theme_support( 'menus' );
		}

		$support = $theme_support['post-formats'];
		if ( $support === TRUE ) {
			add_theme_support( 'post-formats' );
		}
		else if ( $support === FALSE ) {
			remove_theme_support( 'post-formats' );
		}
		else if ( is_array( $support ) ) {
			add_theme_support( 'post-formats', $support );
		}

		$support = $theme_support['post-thumbnails'];
		if ( $support === TRUE ) {
			add_theme_support( 'post-thumbnails' );
		}
		else if ( $support === FALSE ) {
			remove_theme_support( 'post-thumbnails' );
		}
		else if ( is_array( $support ) ) {
			// Removing any previously set post type support in order to set the support,
			// not just add additional post type support.
			remove_theme_support( 'post-thumbnails' );
			add_theme_support( 'post-thumbnails', $support );
		}

		if ( $theme_support['responsive-embeds'] === TRUE ) {
			add_theme_support( 'responsive-embeds' );
		}
		else if ( $theme_support['responsive-embeds'] === FALSE ) {
			remove_theme_support( 'responsive-embeds' );
		}

		if ( is_array( $theme_support['starter-content'] ) ) {
			remove_theme_support( 'starter-content' );
			add_theme_support( 'starter-content', $theme_support['starter-content'] );
		}
		else if ( $theme_support['starter-content'] === FALSE ) {
			remove_theme_support( 'starter-content' );
		}

		if ( $theme_support['title-tag'] === TRUE ) {
			add_theme_support( 'title-tag' );
		}
		else if ( $theme_support['title-tag'] === FALSE ) {
			remove_theme_support( 'title-tag' );
		}

		if ( $theme_support['wp-block-styles'] === TRUE ) {
			add_theme_support( 'wp-block-styles' );
		}
		else if ( $theme_support['wp-block-styles'] === FALSE ) {
			remove_theme_support( 'wp-block-styles' );
		}

		if ( is_array( $theme_support['widgets'] ) ) {
			add_action( 'widgets_init', function () use ( $theme_support ) {
				remove_theme_support( 'widgets' );
				foreach ( $theme_support['widgets'] as $widget ) {
					register_sidebar($widget);
				}
			} );
		}
		else if ( $theme_support['widgets'] === FALSE ) {
			remove_theme_support( 'widgets' );
		}
	}
endif;
