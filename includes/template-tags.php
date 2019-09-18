<?php
/**
 * Custom WTF template tags.
 *
 * @package WordPress
 * @subpackage WTF
 * @since WTF 0.0.0-alpha
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) { http_response_code(404); die(); }

if ( ! function_exists( 'wtf__the_document' ) ) :
	/**
	 * Outputs the document for the current page template.
	 *
	 * Developer must ensure that `WTF__PAGE_TEMPLATE_NAME` has been defined before
	 * calling this template tag.
	 *
	 * By default, the `template-parts/document.php` template is used to generate
	 * and output the document. You may add a template with the same name and in the
	 * same directory but in the child theme to override the default template.
	 *
	 * A different template can be used by adding a `wtf__document_tpl_slug` filter, a
	 * `wtf__document_tpl_name` filter, or both and adding declared template in the
	 * child theme. Using the `wtf__document_init` action to add said filters is an
	 * ideal location.
	 *
	 * Alternatively, create your own `wtf__the_document` function in a child theme to
	 * override the default behavior.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_document () {
		do_action( 'wtf__document_init' );

		$wtf__document_tpl_slug = apply_filters( 'wtf__document_tpl_slug', 'document');
		$wtf__document_tpl_name = apply_filters( 'wtf__document_tpl_name', NULL);
		get_template_part( "template-parts/{$wtf__document_tpl_slug}", $wtf__document_tpl_name );
	}
endif;

if ( ! function_exists( 'wtf__the_head_tag_attrs' ) ) :
	/**
	 * Outputs the `html` tag's attributes.
	 *
	 * Create your own `wtf__the_head_tag_attrs` function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_head_tag_attrs () {
		echo 'class="no-js" ' . get_language_attributes();
	}
endif;

if ( ! function_exists( 'wtf__the_body_tag_attrs' ) ) :
	/**
	 * Outputs the `body` tag's attributes.
	 *
	 * Create your own `wtf__the_body_tag_attrs` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_body_tag_attrs () {
		echo 'class="' . join( ' ', get_body_class() ) . '"';
	}
endif;

if ( ! function_exists( 'wtf__the_header' ) ) :
	/**
	 *
	 * Create your own `wtf__the_header` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_header () {
		$wtf__header_tpl_slug = apply_filters( 'wtf__header_tpl_slug', 'site_header');
		$wtf__header_tpl_name = apply_filters( 'wtf__header_tpl_name', NULL);
		get_template_part( "template-parts/headers/{$wtf__header_tpl_slug}", $wtf__header_tpl_name );
	}
endif;

if ( ! function_exists( 'wtf__the_footer' ) ) :
	/**
	 *
	 * Create your own `wtf__the_footer` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_footer () {
		$wtf__footer_tpl_slug = apply_filters( 'wtf__footer_tpl_slug', 'site_footer');
		$wtf__footer_tpl_name = apply_filters( 'wtf__footer_tpl_name', NULL);
		get_template_part( "template-parts/footers/{$wtf__footer_tpl_slug}", $wtf__footer_tpl_name );
	}
endif;

if ( ! function_exists( 'wtf__the_nav_menu' ) ) :
	/**
	 *
	 * Create your own `wtf__the_nav_menu` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_nav_menu ( $menu_name ) {
		if ( 'social--primary' === $menu_name ) {
			wp_nav_menu(
				array(
					'container' => NULL,
					'depth' => 1,
					'menu_class' => 'social-links-menu',
					'theme_location' => 'social--primary',
				)
			);
		}
		elseif ( 'site--primary' === $menu_name ) {
			wp_nav_menu(
				array(
					'container' => NULL,
					'menu_class' => 'navbar-nav',
					'theme_location' => 'site--primary',
				)
			);
		}
	}
endif;

if ( ! function_exists( 'wtf__the_custom_logo' ) ) :
	/**
	 * Outputs the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * Create your own `wtf__the_custom_logo` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_custom_logo () {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;

if ( ! function_exists( 'wtf__the_post_content' ) ) :
	/**
	 * Outputs the content of a post.
	 *
	 * Must be called from within the WP loop.
	 *
	 * Create your own `wtf__the_post_content` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_post_content () {
		$post_type = get_post_type();
		$post_format = get_post_format();
		if ( $post_format ) {
			get_template_part( "template-parts/post-parts/post_content", $post_type . '-' .$post_format );
		}
		else {
			get_template_part( "template-parts/post-parts/post_content", $post_type );
		}
	}
endif;

if ( ! function_exists( 'wtf__the_featured_image' ) ) :
	/**
	 * Outputs an optional featured image of the indicated post. Wraps the featured
	 * image in an anchor element on index views, or a `div` element when on single
	 * views.
	 *
	 * Must be called from within the WP loop.
	 *
	 * Create your own `wtf__the_featured_image` function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_featured_image () {
		if ( ! has_post_thumbnail() || post_password_required() || is_attachment() ) {
			return;
		}

		if ( is_singular() ) :
?>
			<div class="featured-image">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php
		else :
			$post_title = the_title_attribute( array( 'echo' => FALSE ) );
		?>
			<a class="link link--featured-image" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => $post_title ) ); ?>
			</a>
<?php
		endif; // End is_singular()
	}
endif;

if ( ! function_exists( 'wtf__the_excerpt' ) ) :
	/**
	 * Outputs the optional excerpt of the current post. Wraps the excerpt in a `div`
	 * element.
	 *
	 * Must be called from within the WP loop.
	 *
	 * Create your own `wtf__the_excerpt` function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry__summary'.
	 */
	function wtf__the_excerpt ( $class = 'entry__summary' ) {
		if ( has_excerpt() || is_search() ) :
?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php echo apply_filters( 'the_excerpt', get_the_excerpt() ); ?>
			</div>
<?php
		endif;
	}
endif;

if ( ! function_exists( 'wtf__the_post_meta' ) ) :
	/**
	 * Outputs HTML with meta information for the categories, tags.
	 *
	 * Must be called from within the WP loop.
	 *
	 * Create your own `wtf__the_post_meta` function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_post_meta () {
		$post_type = get_post_type();
		if ( 'post' === $post_type ) {
			$post_author_id = get_the_author_meta( 'ID' );
			$author_email = get_the_author_meta( 'user_email' );
			$author_avatar_size = apply_filters( 'wtf__author_avatar_size', 49 );
			printf(
				'<span class="byline"><span class="author vcard">%1$s<span class="author__label"> %2$s</span> <a class="link" href="%3$s">%4$s</a></span></span>',
				get_avatar( $author_email, $author_avatar_size ),
				_x( 'Author', 'Used before post author name.', 'wtf' ),
				esc_url( get_author_posts_url( $post_author_id ) ),
				get_the_author()
			);
		}

		if ( in_array( $post_type, array( 'post', 'attachment' ) ) ) {
			wtf__the_post_dates();
		}

		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			printf(
				'<span class="entry__format">%1$s<a class="link" href="%2$s">%3$s</a></span>',
				sprintf( '<span class="label">%s </span>', _x( 'Format', 'Used before post format.', 'wtf' ) ),
				esc_url( get_post_format_link( $format ) ),
				get_post_format_string( $format )
			);
		}

		if ( 'post' === $post_type ) {
			wtf__the_post_categories();
			wtf__the_post_tags();
		}

		if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="link link--comments">';
			comments_popup_link( sprintf( __( 'Leave a comment on<span class="post-title"> %s</span>', 'wtf' ), get_the_title() ) );
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'wtf__the_post_dates' ) ) :
	/**
	 * Outputs HTML with date information for current post.
	 *
	 * Must be called from within the WP loop.
	 *
	 * Create your own `wtf__the_post_dates` function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_post_dates () {
		$time_string = '<time class="entry__date published" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry__date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf(
			'<span class="posted-on"><span class="label">%1$s </span><a class="link" href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', 'wtf' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
endif;

if ( ! function_exists( 'wtf__the_post_categories' ) ) :
	/**
	 * Outputs the categories for current post. Each category is a link to that
	 * category's archive page.
	 *
	 * Must be called from within the WP loop.
	 *
	 * Create your own `wtf__the_post_categories` function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 *
	 * @param string $separator The separator to use between each category link.
	 * @param string $parents Accepts 'multiple', 'single', or empty.
	 */
	function wtf__the_post_categories ( $separator = ', ', $parents = '' ) {
		$categories_list = get_the_category_list( _x( $separator, 'Used between list items, there is a space after the comma.', 'wtf' ), $parents );

		if ( $categories_list && wtf__is_categorized_blog() ) {
			printf(
				'<span class="cat-links"><span class="label">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'wtf' ),
				$categories_list
			);
		}
	}
endif;

if ( ! function_exists( 'wtf__the_post_tags' ) ) :
	/**
	 * Outputs the tags for current post. Each tag is a link to that tag's archive
	 * page.
	 *
	 * Must be called from within the WP loop.
	 *
	 * Create your own `wtf__the_post_tags` function to override in a child theme.
	 *
	 * @since WTF 0.0.0-alpha
	 *
	 * @param string $separator The separator to use between each tag link.
	 * @param string $before The markup to insert before the list of tag links.
	 * @param string $after The markup to insert after the list of tag links.
	 */
	function wtf__the_post_tags ( $separator = ', ', $before = '', $after = '' ) {
		$tags_list = get_the_tag_list(
			$before,
			_x( $separator, 'Used between list items, there is a space after the comma.', 'wtf' ),
			$after
		);
		if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			printf(
				'<span class="tags-links"><span class="label">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', 'wtf' ),
				$tags_list
			);
		}
	}
endif;

if ( ! function_exists( 'wtf__the_edit_post_link' ) ) :
	/**
	 * Outputs the edit post link for the post.
	 *
	 * Must be called from within the WP loop.
	 *
	 * Create your own `wtf__the_edit_post_link` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_edit_post_link () {
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="post-title"> "%s"</span>', 'wtf' ),
				get_the_title()
			),
			'<span class="link link--edit">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'wtf__the_page_links' ) ) :
	/**
	 * Outputs page links for paginated posts.
	 *
	 * Must be called from within the WP loop.
	 *
	 * Create your own `wtf__the_page_links` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_page_links () {
		wp_link_pages(
			array(
				'before'      => '<div class="page-links"><span class="page-links__title">' . __( 'Pages:', 'wtf' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="label">' . __( 'Page', 'wtf' ) . ' </span>%',
				'separator'   => '<span class="sep">, </span>',
			)
		);
	}
endif;

if ( ! function_exists( 'wtf__the_posts_pagination' ) ) :
	/**
	 * Outputs a paginated navigation to next/previous set of posts, when applicable.
	 * This is typically used on pages that output multiple posts such as the blog
	 * index (i.e., `home.php`), any of the archive pages (e.g., `archive.php`,
	 * `author.php`, `category.php`, `date.php`, `tag.php`, `taxonomy.php`, and any
	 * specialized variations), or on the search results (i.e., `search.php`).
	 *
	 * Create your own `wtf__the_posts_pagination` function to override in a child
	 * theme.
	 *
	 * @see wtf__the_post_navigation
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_posts_pagination () {
		// Previous/next page pagination.
		the_posts_pagination(
			array(
				'prev_text'          => __( 'Previous page', 'wtf' ),
				'next_text'          => __( 'Next page', 'wtf' ),
				'before_page_number' => '<span class="label">' . __( 'Page', 'wtf' ) . ' </span>',
			)
		);
	}
endif;

if ( ! function_exists( 'wtf__the_post_navigation' ) ) :
	/**
	 * Outputs the navigation to next/previous post, when applicable. This is
	 * typically used on singular post pages or attachment pages.
	 *
	 * Must be called from within the WP loop.
	 *
	 * Create your own `wtf__the_post_navigation` function to override in a child
	 * theme.
	 *
	 * @see wtf__the_posts_pagination
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_post_navigation () {
		if ( is_singular( 'attachment' ) ) {
			// Parent post navigation.
			the_post_navigation(
				array(
					'prev_text' => _x( '<span class="label">Published in</span> <span class="post-title post-title--parent">%title</span>', 'Parent post link', 'wtf' ),
				)
			);
		}
		elseif ( is_singular( 'post' ) ) {
			// Previous/next post navigation.
			the_post_navigation(
				array(
					'next_text' => '<span class="label">' . __( 'Next post:', 'wtf' ) . '</span> ' .
						'<span class="post-title post-title--next">%title</span>',
					'prev_text' => '<span class="label">' . __( 'Previous post:', 'wtf' ) . '</span> ' .
						'<span class="post-title post-title--prev">%title</span>',
				)
			);
		}
	}
endif;

if ( ! function_exists( 'wtf__the_wp_post_comments' ) ) :
	/**
	 * Outputs the WordPress comments for the current post.
	 *
	 * Create your own `wtf__the_wp_post_comments` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_wp_post_comments () {
		$wtf__wp_post_comments_tpl_slug = apply_filters( 'wtf__wp_post_comments_tpl_slug', 'wp_post_comments');
		$wtf__wp_post_comments_tpl_name = apply_filters( 'wtf__wp_post_comments_tpl_name', NULL);
		get_template_part( "template-parts/components/{$wtf__wp_post_comments_tpl_slug}", $wtf__wp_post_comments_tpl_name );
	}
endif;

if ( ! function_exists( 'wtf__the_wp_post_comments_title' ) ) :
	/**
	 * Outputs the post comments title.
	 *
	 * Create your own `wtf__the_wp_post_comments_title` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_wp_post_comments_title () {
		$comments_number = get_comments_number();
		$post_title = get_the_title();
		if ( '1' === $comments_number ) {
			/* translators: %s: post title */
			printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'wtf' ), $post_title );
		} else {
			printf(
				/* translators: 1: number of comments, 2: post title */
				_nx(
					'%1$s thought on &ldquo;%2$s&rdquo;',
					'%1$s thoughts on &ldquo;%2$s&rdquo;',
					$comments_number,
					'comments title',
					'wtf'
				),
				number_format_i18n( $comments_number ),
				$post_title
			);
		}
	}
endif;

if ( ! function_exists( 'wtf__the_post_comments' ) ) :
	/**
	 * Outputs the comments for the current post.
	 *
	 * Create your own `wtf__the_post_comments` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_post_comments () {
		if ( comments_open() || get_comments_number() ) {
			$wtf__post_comments_tpl = apply_filters( 'wtf__post_comments_tpl', '/comments.php');
			comments_template( $wtf__post_comments_tpl );
		}
	}
endif;

if ( ! function_exists( 'wtf__the_no_posts_section' ) ) :
	/**
	 * Outputs the markup when there are no posts.
	 *
	 * Create your own `wtf__the_no_posts_section` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_no_posts_section () {
		$wtf__no_posts_section_tpl_name = apply_filters( 'wtf__no_posts_section_tpl_name', WTF__PAGE_TEMPLATE_NAME);
		get_template_part( 'template-parts/post-parts/no_posts_section', $wtf__no_posts_tpl_name );
	}
endif;

if ( ! function_exists( 'wtf__the_audio_attachment' ) ) :
	/**
	 *
	 * Create your own `wtf__the_audio_attachment` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_audio_attachment () {
		echo '<p class="alert alert-danger" role="alert">TODO: Embed audio.</p>';
	}
endif;

if ( ! function_exists( 'wtf__the_image_attachment' ) ) :
	/**
	 *
	 * Create your own `wtf__the_image_attachment` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_image_attachment ( $image_size = 'large') {
		/**
		 * Filter the default wtf image attachment size.
		 *
		 * @since WTF 0.0.0-alpha
		 *
		 * @param string $image_size Image size. Default 'large'.
		 */
		$image_size = apply_filters( 'wtf__image_attachment_size', $image_size );
		echo wp_get_attachment_image( get_the_ID(), $image_size );
	}
endif;

if ( ! function_exists( 'wtf__the_video_attachment' ) ) :
	/**
	 *
	 * Create your own `wtf__the_video_attachment` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_video_attachment () {
		echo '<p class="alert alert-danger" role="alert">TODO: Display attachment video.</p>';
	}
endif;

if ( ! function_exists( 'wtf__the_attachment_meta' ) ) :
	/**
	 * Outputs the attachment metadata.
	 *
	 * Create your own `wtf__the_attachment_meta` function to override in a child
	 * theme.
	 *
	 * @since WTF 0.0.0-alpha
	 */
	function wtf__the_attachment_meta () {
		// TODO: Check out https://developer.wordpress.org/reference/functions/attachment_submitbox_metadata/
		// for ideas of what metadata may be available to display.
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();
		if ( $metadata ) {
			if ( wp_attachment_is( 'image' ) ) {
				printf(
					'<span class="label">%1$s </span><a class="link" href="%2$s">%3$s &times; %4$s</a>',
					esc_html_x( 'Full size', 'Used before full size attachment link.', 'wtf' ),
					esc_url( wp_get_attachment_url() ),
					absint( $metadata['width'] ),
					absint( $metadata['height'] )
				);
			}
		}
	}
endif;
