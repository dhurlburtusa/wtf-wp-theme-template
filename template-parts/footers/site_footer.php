<?php
/**
 * The template part for displaying the site header
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }
?>
<footer class="site-footer" role="contentinfo">
	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<nav class="navigation navigation--primary" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'wtf' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'menu_class'     => 'navbar-nav',
						'theme_location' => 'primary',
					)
				);
			?>
		</nav><!-- .navigation--primary -->
	<?php endif; ?>

	<?php if ( has_nav_menu( 'social' ) ) : ?>
		<nav class="navigation navigation--social" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'wtf' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="sr-only">',
						'link_after'     => '</span>',
					)
				);
			?>
		</nav><!-- .navigation--social -->
	<?php endif; ?>

	<div class="site-info">
		<?php
			/**
			 * Fires before the wtf footer text for footer customization.
			 *
			 * @since WTF 0.0.0-alpha
			 */
			do_action( 'wtf__credits' );
		?>
		<span class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</span>
	</div><!-- .site-info -->
</footer><!-- .site-footer -->
