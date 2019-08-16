<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

$wtf__document_body_start_tpl_name = apply_filters( 'wtf__document_body_start_tpl_name', null);
$wtf__document_body_content_tpl_name = apply_filters( 'wtf__document_body_content_tpl_name', null);
$wtf__document_body_end_tpl_name = apply_filters( 'wtf__document_body_end_tpl_name', null);
?>
<body <?php wtf__the_body_tag_attrs(); ?>>
	<?php get_template_part( 'template-parts/document-parts/document_body_start', $wtf__document_body_start_tpl_name ); ?>

	<?php get_template_part( 'template-parts/document-parts/document_body_content', $wtf__document_body_content_tpl_name ); ?>

	<?php get_template_part( 'template-parts/document-parts/document_body_end', $wtf__document_body_end_tpl_name ); ?>
</body>
