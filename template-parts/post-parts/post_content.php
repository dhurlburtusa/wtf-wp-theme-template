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

$wtf__component_page_post_tpl_slug = apply_filters( 'wtf__component_page_post_tpl_slug', 'page_post');
$wtf__component_page_post_tpl_name = apply_filters( 'wtf__component_page_post_tpl_name', null);
get_template_part( "template-parts/components/{$wtf__component_page_post_tpl_slug}", $wtf__component_page_post_tpl_name );
?>
