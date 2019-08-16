<?php
/**
 * The template for the content bottom widget areas on posts and pages.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }
?>
<?php if ( is_active_sidebar( 'sidebar-secondary-primary' ) || is_active_sidebar( 'sidebar-secondary-secondary' ) ) : ?>
	<aside class="content-widgets" role="complementary">
		<?php if ( is_active_sidebar( 'sidebar-secondary-primary' ) ) : ?>
			<div class="widget-area widget-area--secondary widget-area--secondary--primary">
				<?php dynamic_sidebar( 'sidebar-secondary-primary' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-secondary-secondary' ) ) : ?>
			<div class="widget-area widget-area--secondary widget-area--secondary--secondary">
				<?php dynamic_sidebar( 'sidebar-secondary-secondary' ); ?>
			</div>
		<?php endif; ?>
	</aside><!-- .content-widgets -->
<?php endif; ?>
