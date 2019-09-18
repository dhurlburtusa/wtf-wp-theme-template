<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

$wtf__document_head_tpl_name = apply_filters( 'wtf__document_head_tpl_name', NULL);
$wtf__document_body_tpl_name = apply_filters( 'wtf__document_body_tpl_name', NULL);
?>
<!DOCTYPE html>
<html <?php wtf__the_head_tag_attrs(); ?>>
	<?php get_template_part( 'template-parts/document-parts/document_head', $wtf__document_head_tpl_name ); ?>
	<?php get_template_part( 'template-parts/document-parts/document_body', $wtf__document_body_tpl_name ); ?>
</html>
