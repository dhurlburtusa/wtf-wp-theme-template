<?php
/**
 * The page template for displaying the blog index page.
 *
 * This is where the blog index is generated. It displays the top `n` most recent
 * blog posts.
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
