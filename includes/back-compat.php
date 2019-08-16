<?php
/**
 * WTF back compat functionality
 *
 * Prevents WTF from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

/**
 * Prevent switching to WTF on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since WTF 0.0.0-alpha
 */
function wtf__switch_theme () {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'wtf__upgrade_notice' );
}
add_action( 'after_switch_theme', 'wtf__switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * WTF on WordPress versions prior to 4.7.
 *
 * @since WTF 0.0.0-alpha
 *
 * @global string $wp_version WordPress version.
 */
function wtf__upgrade_notice () {
	$message = sprintf( __( 'WTF requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wtf' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since WTF 0.0.0-alpha
 *
 * @global string $wp_version WordPress version.
 */
function wtf__customize () {
	wp_die(
		sprintf( __( 'WTF requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wtf' ), $GLOBALS['wp_version'] ),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'wtf__customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since WTF 0.0.0-alpha
 *
 * @global string $wp_version WordPress version.
 */
function wtf__preview () {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'WTF requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wtf' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'wtf__preview' );
