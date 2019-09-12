<?php
/**
 * The template part for displaying the content of a post of type `page`.
 *
 * Instead of having a template dedicated to pages (i.e., a `content-page.php`),
 * this template acts as the fallback for `page` and any other post type that does
 * not have its own specialized template.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>

<!---
<p>template-parts/post-parts/post_content.php</p>
--->

<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

$post_type = get_post_type();

$wtf__post_component_tpl_slug = "post_{$post_type}";
$wtf__post_component_tpl_name = NULL;

if ( 'attachment' === $post_type ) {
	$post_mime_type = get_post_mime_type();
	$post_mime_type_parts = explode( '/', $post_mime_type, 2 );
	if ( count( $post_mime_type_parts ) === 2 ) {
		$wtf__post_component_tpl_name = $post_mime_type_parts[0] . '-' . $post_mime_type_parts[1];
	}
	else {
		$wtf__post_component_tpl_name = $post_mime_type_parts[0];
	}
}
elseif ( 'post' === $post_type ) {
	$post_format = get_post_format();
	if ( FALSE !== $post_format ) {
		$wtf__post_component_tpl_name = $post_format;
	}
}

$wtf__post_component_tpl_slug = apply_filters( 'wtf__post_component_tpl_slug', $wtf__post_component_tpl_slug);
$wtf__post_component_tpl_name = apply_filters( 'wtf__post_component_tpl_name', $wtf__post_component_tpl_name);
get_template_part( "template-parts/components/{$wtf__post_component_tpl_slug}", $wtf__post_component_tpl_name );

unset( $post_format );
unset( $post_mime_type );
unset( $post_mime_type_parts );
unset( $post_type );
unset( $wtf__post_component_tpl_name );
unset( $wtf__post_component_tpl_slug );
