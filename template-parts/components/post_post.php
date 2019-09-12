<?php
/**
 * The template part for displaying a single blog post entry.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
/*
Relevant template tags:
- comments_open
- comments_popup_link
- edit_bookmark_link
- edit_comment_link
- edit_post_link
- edit_tag_link
- get_avatar
- get_delete_post_link
- get_edit_post_link
- get_attachment_link
- get_author_posts_url
- get_categories
- get_comments_number
- get_page_link
- get_permalink
- get_post_format
- get_post_format_link
- get_post_format_string
- get_post_permalink
- get_post_thumbnail_id
- get_post_type
- get_search_query
- get_the_author
- get_the_author_link
- get_the_author_meta
- get_the_category_list
- get_the_date
- get_the_ID
- get_the_modified_time
- get_the_password_form
- get_the_post_thumbnail
- get_the_tag_list
- get_the_time
- get_the_title
- has_excerpt
- has_post_thumbnail
- is_attachment
- is_home
- is_paged
- is_preview
- is_search
- is_singular
- is_sticky
- next_image_link
- next_post_link
- next_posts_link
- permalink_anchor
- post_class
- post_password_required
- post_permalink
- posts_nav_link
- previous_image_link
- previous_post_link
- previous_posts_link
- single_month_title
- single_post_title
- sticky_class
- the_attachment_link
- the_author
- the_author_link
- the_author_meta
- the_author_posts
- the_author_posts_link
- the_category
- the_category_rss
- the_content
- the_content_rss
- the_custom_logo
- the_date
- the_date_xml
- the_excerpt
- the_excerpt_rss
- the_permalink
- the_ID
- the_meta
- the_modified_author
- the_modified_date
- the_modified_time
- the_permalink
- the_post_navigation
- the_post_thumbnail
- the_posts_pagination
- the_search_query
- the_shortlink
- the_tags
- the_time
- the_title
- the_title_attribute
- the_title_rss
- wp_attachment_is_image
- wp_get_attachment_image
- wp_get_attachment_image_src
- wp_get_attachment_metadata
- wp_get_attachment_link
- wp_get_shortlink
- wp_link_pages
- wtf__is_categorized_blog
- wtf__the_custom_logo
- wtf__the_excerpt
- wtf__the_featured_image
- wtf__the_post_dates
- wtf__the_post_meta
- wtf__entry_taxonomies
*/
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }
?>

<!---
<p>template-parts/components/post_post.php</p>
--->

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<header class="entry__head">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'wtf' ); ?></span>
		<?php endif; ?>

		<h1 class="entry__title"><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></h1>
	</header><!-- .entry__head -->

	<?php wtf__the_excerpt(); ?>

	<?php wtf__the_featured_image(); ?>

	<div class="entry__content">
		<?php
			/* translators: %s: Name of current post */
			the_content(
				sprintf(
					__( 'Continue reading<span class="sr-only"> "%s"</span>', 'wtf' ),
					get_the_title()
				)
			);

			wtf__the_page_links();
		?>
	</div><!-- .entry__content -->

	<footer class="entry__foot">
		<?php
		wtf__the_post_meta();
		wtf__the_edit_post_link();
		?>
	</footer><!-- .entry__foot -->
</article>
