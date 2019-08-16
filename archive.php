<?php
/**
 * The template for displaying archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no `date.php` file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, `tag.php` (Tag archives),
 * `category.php` (Category archives), `author.php` (Author archives), etc.
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
