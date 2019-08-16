<?php
/**
 * The page template for displaying `{mimetype}/{subtype}` attachments. It
 * represents the `{subtype}.php` template in the template hierarchy where the
 * mime-type is whatever with a subtype of `{subtype}`.
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
