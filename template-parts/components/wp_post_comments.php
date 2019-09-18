<?php
/**
 * The template part for displaying the comments section of a post.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$comments_number = get_comments_number();
?>

<div class="wp-post-comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php wtf__the_wp_post_comments_title(); ?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comments-list">
			<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => TRUE,
						'avatar_size' => 42,
					)
				);
			?>
		</ol><!-- .comments-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php
	// If comments are closed but there are comments, then let the user know.
	if ( $comments_number && ! comments_open() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'wtf' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form(
			array(
				'title_reply_before' => '<h2 id="reply-title"><span class="comment-reply-title">',
				'title_reply_after'  => '</span></h2>',
			)
		);
	?>

</div><!-- .wp-post-comments-area -->
