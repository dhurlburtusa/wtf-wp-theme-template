<?php
/**
 * The template for displaying archive pages with a post type of `{post_type}`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

define( 'WTF__PAGE_TEMPLATE_NAME', basename( __FILE__, '.php' ) );

wtf__the_document();
