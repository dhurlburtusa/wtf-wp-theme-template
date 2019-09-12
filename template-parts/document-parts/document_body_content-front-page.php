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
				<p>template-parts/document-parts/document_body_content-front-page.php</p>
				--->
			</main>
		</div>
	</div><!-- .pg__body -->

	<div class="pg__foot">
		<?php
		$wtf__page_footer_tpl_name = apply_filters( 'wtf__page_footer_tpl_name', null);
		get_footer( $wtf__page_footer_tpl_name );
		?>
	</div>
</div><!-- .pg -->
