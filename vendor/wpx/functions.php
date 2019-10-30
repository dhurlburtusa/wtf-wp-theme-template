<?php
if ( ! defined( 'ABSPATH' ) ) { status_header(404); die(); }

/**
 * Determines whether the specified string starts with a specified string.
 *
 * Unfortunately, PHP doesn't come with an equivalent function.
 *
 * @param string $haystack The string to be examined.
 * @param string $needle The string to look for at the start of the haystack.
 *
 * @return bool true if the haystack starts with the needle, false otherwise.
 */
// function wpx__starts_with ( $haystack, $needle ) {
// 	return $haystack[0] === $needle[0]
// 			? strncmp( $haystack, $needle, strlen( $needle )) === 0
// 			: false;
// }

/**
 * Determines whether the specified string ends with a specified string.
 *
 * Unfortunately, PHP doesn't come with an equivalent function.
 *
 * @param string $haystack The string to be examined.
 * @param string $needle The string to look for at the end of the haystack.
 *
 * @return bool true if the haystack ends with the needle, false otherwise.
 */
function wpx__ends_with ( $haystack, $needle ) {
	return substr_compare( $haystack, $needle, -strlen( $needle )) === 0;
}

/**
 * Determines whether the current request is running in a local environment.
 *
 * It is common for a virtual host to be set up locally using a domain
 * (aka hostname) that ends with `.local`. That is, `.local` is used as the
 * top-level domain. Based on this fact, a local environment is determined as
 * follows:
 *
 * - If the server IP address (`$_SERVER['SERVER_ADDR']`) is `127.0.0.1`, then we are
 * 	local.
 *
 * - If the host name (`$_SERVER['HTTP_HOST']`) or the server name
 * 	(`$_SERVER['SERVER_NAME']`) ends with `.local`, then we are local.
 *
 * @return bool true if determined to be local, false otherwise.
 */
function wpx__is_local () {
	// When running WP-CLI, the `$_SERVER variable` exists but many values are not set.
	// Therefore, we need to check whether the value is set before reading it. Otherwise
	// an error occurs.
	$is_local = ( isset( $_SERVER['SERVER_ADDR'] ) && $_SERVER['SERVER_ADDR'] === '127.0.0.1' ) ||
		( isset( $_SERVER['HTTP_HOST'] ) && wpx__ends_with( $_SERVER['HTTP_HOST'], '.local' ) ) ||
		( isset( $_SERVER['SERVER_NAME'] ) && wpx__ends_with( $_SERVER['SERVER_NAME'], '.local' ) );
	return $is_local;
}

/**
 * Determines whether the request is for one of the login pages.
 *
 * @return bool true if the request if for one of the login pages, false otherwise.
 */
function wpx__is_login () {
	return $GLOBALS['pagenow'] === 'wp-login.php';
}
