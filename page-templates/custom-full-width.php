<?php
/*
Template Name: Full-Width
Template Post Type: attachment, page, post

@package WordPress
@subpackage WTF
@since WTF 0.0.0-alpha
*/
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

define( 'WTF__PAGE_TEMPLATE_NAME', basename( __FILE__, '.php' ) );

wtf__the_document();
