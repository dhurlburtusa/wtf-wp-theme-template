<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }
?>
<div class="pg">
	<div class="pg__head">
		<?php
		$wtf__page_header_tpl_name = apply_filters( 'wtf__page_header_tpl_name', NULL);
		get_header( $wtf__page_header_tpl_name );
		?>
	</div>

	<div class="pg__body" id="content">
		<div class="pg__body__content">
			<main>
				<!---
				<p><?php echo WTF__PAGE_TEMPLATE_NAME; ?></p>
				<p>template-parts/document-parts/document_body_content-404.php</p>
				--->

				<section class="site-error site-error--404">
					<h1>
						<span class="page__title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'wtf' ); ?></span>
					</h1>

					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'wtf' ); ?></p>

					<?php get_search_form(); ?>
				</section><?php /* eo .site-error--404 */ ?>
			</main>

			<?php get_sidebar( 'content' ); ?>
		</div>

		<div class="pg__sidebar pg__sidebar--primary">
			<?php
			$wtf__primary_page_sidebar_tpl_name = apply_filters( 'wtf__primary_page_sidebar_tpl_name', NULL);
			get_sidebar( $wtf__primary_page_sidebar_tpl_name );
			?>
		</div>
	</div><?php /* eo .pg__body */ ?>

	<div class="pg__foot">
		<?php
		$wtf__page_footer_tpl_name = apply_filters( 'wtf__page_footer_tpl_name', NULL);
		get_footer( $wtf__page_footer_tpl_name );
		?>
	</div>
</div><?php /* eo .pg */ ?>
