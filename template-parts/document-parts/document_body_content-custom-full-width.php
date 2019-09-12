<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }
?>
<div class="pg">
	<div class="pg__head">
		<?php
		$wtf__page_header_tpl_name = apply_filters( 'wtf__page_header_tpl_name', null);
		get_header( $wtf__page_header_tpl_name );
		?>
	</div>

	<div class="pg__body" id="content">
		<div class="pg__body__content">
			<main>
				<!---
				<p><?php echo WTF__PAGE_TEMPLATE_NAME; ?></p>
				<p>template-parts/document-parts/document_body_content-custom-full-width.php</p>
				--->

				<section class="posts-area posts-area--<?php echo WTF__PAGE_TEMPLATE_NAME; ?>">
					<?php
					while ( have_posts() ) :
						the_post();

						wtf__the_post_content();

						// TODO: Decide whether to include the comments here or in the post parts content template.
						// If comments are open or we have at least one comment, load up the comment template.
						wtf__the_post_comments();
						// if ( comments_open() || get_comments_number() ) {
						// 	comments_template();
						// }
					endwhile;
					?>
				</section>
			</main>

			<?php get_sidebar( 'content' ); ?>
		</div>
	</div><!-- .pg__body -->

	<div class="pg__foot">
		<?php
		$wtf__page_footer_tpl_name = apply_filters( 'wtf__page_footer_tpl_name', null);
		get_footer( $wtf__page_footer_tpl_name );
		?>
	</div>
</div><!-- .pg -->
