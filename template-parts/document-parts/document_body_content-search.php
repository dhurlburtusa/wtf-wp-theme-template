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
				<p><?php echo WTF__PAGE_TEMPLATE_NAME; ?></p>
				<p>template-parts/document-parts/document_body_content-search.php</p>

				<?php if ( have_posts() ) : ?>
					<section class="posts-area posts-area--<?php echo WTF__PAGE_TEMPLATE_NAME; ?>">
						<h1>
							<span class="page__title"><?php printf( __( 'Search Results for: %s', 'wtf' ), '<span class="search-query">' . esc_html( get_search_query() ) . '</span>' ); ?></span>
						</h1>

						<?php
						while ( have_posts() ) :
							the_post();

							wtf__the_post_content();
						endwhile;

						wtf__the_posts_pagination();
						?>
					</section>
				<?php
				else :
					wtf__the_no_posts_section();
				endif;
				?>
			</main>
		</div>

		<div class="pg__sidebar pg__sidebar--primary">
			<?php
			$wtf__primary_page_sidebar_tpl_name = apply_filters( 'wtf__primary_page_sidebar_tpl_name', null);
			get_sidebar( $wtf__primary_page_sidebar_tpl_name );
			?>
		</div>
	</div><!-- .pg__body -->

	<div class="pg__foot">
		<?php
		$wtf__page_footer_tpl_name = apply_filters( 'wtf__page_footer_tpl_name', null);
		get_footer( $wtf__page_footer_tpl_name );
		?>
	</div>
</div><!-- .pg -->
