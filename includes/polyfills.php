<?php

if ( ! function_exists( 'is_privacy_policy' ) ) {
	function is_privacy_policy () {
			return get_option( 'wp_page_for_privacy_policy' ) && is_page( get_option( 'wp_page_for_privacy_policy' ) );
	}
}

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the `wp_body_open` action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wp_body_open () {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since WTF 0.0.0-alpha
		 */
		do_action( 'wp_body_open' );
	}
endif;
