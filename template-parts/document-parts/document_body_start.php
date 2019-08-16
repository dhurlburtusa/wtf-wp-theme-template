<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

wp_body_open();
?>
<?php /* TODO: Add a filter for main content fragment ID */ ?>
<a class="sr-only" href="#content"><?php _e( 'Skip to content', 'wtf' ); ?></a>
