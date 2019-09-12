<?php
/**
 * The template part for displaying a single CMS page entry.
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
<p>template-parts/components/page_post.php</p>
--->

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<header class="entry__head">
		<h1 class="entry__title"><?php the_title(); ?></h1>
	</header>

	<?php wtf__the_featured_image(); ?>

	<div class="entry__content">
		<?php
		the_content();

		wtf__the_page_links();
		?>
	</div>

	<footer class="entry__foot">
		<?php wtf__the_edit_post_link(); ?>
	</footer>
</article>
