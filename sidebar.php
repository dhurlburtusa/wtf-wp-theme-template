<?php
/**
 * The template for the sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }
?>
<?php if ( is_active_sidebar( 'sidebar-primary' ) ) : ?>
	<aside>
		<div class="widget-area widget-area--primary">
			<?php dynamic_sidebar( 'sidebar-primary' ); ?>
		</div>
	</aside>
<?php endif; ?>
