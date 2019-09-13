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

$home_url = home_url( '/' );
$site_title = get_bloginfo( 'name', 'display' );
$tagline = get_bloginfo( 'description', 'display' );
?>
<header class="site-header" role="banner">
	<div class="site-header__main navbar navbar-expand-md">
		<div class="site-nameplate navbar-brand">
			<?php wtf__the_custom_logo(); ?>

			<span class="site-title">
				<a href="<?php echo esc_url( $home_url ); ?>" rel="home"><?php echo $site_title; ?></a>
			</span>

			<?php if ( $tagline || is_customize_preview() ) : ?>
				<span class="site-tagline"><?php echo $tagline; ?></span>
			<?php endif; ?>
		</div><!-- .site-nameplate -->

		<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#site-header-menu" aria-controls="primary-navigation social-navigation" aria-expanded="false" aria-label="Toggle Menu">
				<span class="sr-only"><?php _e( 'Menu', 'wtf' ); ?></span>
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="site-header__menu collapse navbar-collapse justify-content-end" id="site-header-menu">
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<nav class="navigation navigation--primary" id="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'wtf' ); ?>">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'container' => null,
									'menu_class' => 'navbar-nav',
								)
							);
						?>
					</nav><!-- .navigation--primary -->
				<?php endif; ?>

				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="navigation navigation--social" id="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'wtf' ); ?>">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'container' => null,
									'menu_class'  => 'social-links-menu',
									'depth'       => 1,
									'link_before' => '<span class="sr-only">',
									'link_after'  => '</span>',
								)
							);
						?>
					</nav><!-- .navigation--social -->
				<?php endif; ?>
			</div><!-- .site-header__menu -->
		<?php endif; ?>
	</div><!-- .site-header__main -->

	<?php if ( get_header_image() ) : ?>
		<?php
			/**
			 * Filter the default wtf custom header sizes attribute.
			 *
			 * @since WTF 0.0.0-alpha
			 *
			 * @param string $custom_header_sizes sizes attribute
			 * for Custom Header. Default '(max-width: 709px) 85vw,
			 * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
			 */
			$custom_header_sizes = apply_filters( 'wtf__custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
		?>
		<div class="header-image">
			<a href="<?php echo esc_url( $home_url ); ?>" rel="home">
				<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			</a>
		</div><!-- .header-image -->
	<?php endif; // End header image check. ?>
</header><!-- .site-header -->
