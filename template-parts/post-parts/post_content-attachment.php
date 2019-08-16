<?php
/**
 * The template part for displaying the content of a post of type `attachment`.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>

<p>template-parts/post-parts/post_content-attachment.php</p>

<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

$post_mime_type = get_post_mime_type();
$post_mime_type_parts = explode( '/', $post_mime_type, 2 );
?>

<?php if ( wp_attachment_is( 'image' ) ) : ?>
	<nav class="navigation navigation--attachments">
		<div class="nav-links">
			<div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image', 'wtf' ) ); ?></div>
			<div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'wtf' ) ); ?></div>
		</div>
	</nav>
<?php endif; ?>

<?php
$wtf__component_attachment_post_tpl_slug = apply_filters( 'wtf__component_attachment_post_tpl_slug', 'attachment_post');
$wtf__component_attachment_post_tpl_name = apply_filters( 'wtf__component_attachment_post_tpl_name', $post_mime_type_parts[0]);
get_template_part( "template-parts/components/{$wtf__component_attachment_post_tpl_slug}", $wtf__component_attachment_post_tpl_name );
?>
