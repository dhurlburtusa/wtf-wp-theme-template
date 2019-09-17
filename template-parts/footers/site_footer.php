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
	<?php if ( has_nav_menu( 'site--primary' ) ) : ?>
		<nav class="navigation navigation--site navigation--site--primary" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'wtf' ); ?>">
			<?php wtf__the_nav_menu( 'site--primary' ); ?>
		</nav><!-- .navigation--site--primary -->
	<?php endif; ?>

	<?php if ( has_nav_menu( 'social--primary' ) ) : ?>
		<nav class="navigation navigation--social navigation--social--primary" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'wtf' ); ?>">
			<?php wtf__the_nav_menu( 'social--primary' ); ?>
		</nav><!-- .navigation--social--primary -->
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
			<a class="link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</span>
	</div><!-- .site-info -->
</footer><!-- .site-footer -->
