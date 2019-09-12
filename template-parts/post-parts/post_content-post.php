<?php
/**
 * The template part for displaying the content of a post of type `post`.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>

<!---
<p>template-parts/post-parts/post_content-post.php</p>
--->

<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

$post_format = get_post_format();

$wtf__component_post_post_tpl_slug = apply_filters( 'wtf__component_post_post_tpl_slug', 'post_post');
$wtf__component_post_post_tpl_name = apply_filters( 'wtf__component_post_post_tpl_name', $post_format);
get_template_part( "template-parts/components/{$wtf__component_post_post_tpl_slug}", $wtf__component_post_post_tpl_name );
?>
