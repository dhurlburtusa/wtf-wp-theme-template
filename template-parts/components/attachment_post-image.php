<?php
/**
 * The template part for displaying a single post attachment with `image`
 * mime-type.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }
?>

<!---
<p>template-parts/components/attachment_post-image.php</p>
--->

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<header class="entry__head">
		<h1 class="entry__title"><?php the_title(); ?></h1>
	</header>

	<div class="entry__content">
		<div class="entry__attachment">
			<?php
			wtf__the_image_attachment();
			wtf__the_excerpt( 'entry__caption' );
			?>
		</div><!-- .entry__attachment -->

		<?php
		// TODO: Determine whether calling `the_content` is ever necessary for an image
		// attachment. So far I have not seen any output from this call.
		the_content();

		wtf__the_page_links();

		if ( '' !== get_the_author_meta( 'description' ) ) {
			get_template_part( 'template-parts/components/author_biography' );
		}
		?>
	</div><!-- .entry__content -->

	<footer class="entry__foot">
		<?php
		wtf__the_post_meta();
		wtf__the_attachment_meta();
		wtf__the_edit_post_link();
		?>
	</footer>
</article>
