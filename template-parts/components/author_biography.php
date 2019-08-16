<?php
/**
 * The template part for displaying an author biography.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }
?>

<div class="author author--biography">
	<div class="author__avatar">
		<?php
		/**
		 * Filter the WTF author bio avatar size.
		 *
		 * @since WTF 0.0.0-alpha
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'wtf__author_bio_avatar_size', 42 );
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author__avatar -->
	<p>
		<label class="author__label"><?php _e( 'Author:', 'wtf' ); ?></label>
		<span class="author__name"><?php echo get_the_author(); ?></span>
	</p>
	<p class="author__description">
		<?php the_author_meta( 'description' ); ?>
	</p>
	<address>
		<a class="author__link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php printf( __( 'View all posts by %s', 'wtf' ), get_the_author() ); ?>
		</a>
	</address>
</div><!-- .author.author--biography -->
