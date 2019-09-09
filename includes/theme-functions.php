<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

function wtf__get_style_asset_manifest () {
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
	if ( false === ( $all_the_cool_cats = get_transient( 'wtf__categories' ) ) ) {
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
		return true;
	} else {
		// This blog has only 1 category so wtf__is_categorized_blog should return false.
		return false;
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

if ( ! function_exists( 'wtf__register_primary_sidebar' ) ) :
	/**
	 * Registers the Primary sidebar.
	 *
	 * Create your own `wtf__register_primary_sidebar` function to override in a
	 * child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
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
endif;

if ( ! function_exists( 'wtf__register_secondary_primary_sidebar' ) ) :
	/**
	 * Registers the primary Secondary sidebar (aka Bottom Widgets (Primary)).
	 *
	 * Create your own `wtf__register_secondary_primary_sidebar` function to override
	 * in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
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
endif;

if ( ! function_exists( 'wtf__register_secondary_secondary_sidebar' ) ) :
	/**
	 * Registers the secondary Secondary sidebar (aka Bottom Widgets (Secondary)).
	 *
	 * Create your own `wtf__register_secondary_secondary_sidebar` function to override
	 * in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
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
endif;
