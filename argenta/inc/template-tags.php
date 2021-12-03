<?php

if ( ! function_exists( 'argenta_gh_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function argenta_gh_posted_time() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		return $time_string;
	}

	function argenta_gh_posted_on() {
		$time_string = argenta_gh_posted_time();

		$byline = sprintf(
			esc_html_x( '%s', 'post author', 'argenta' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		$posted_on = sprintf(
			esc_html_x( '%s', 'post date', 'argenta' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="byline"> ' . $byline . '</span><span class="square"></span><span class="posted-on">' . $posted_on . '</span><span class="square"></span>'; // WPCS: XSS OK.

		echo '<span class="comments-count">';
		comments_number( esc_html__( 'No comments', 'argenta' ), esc_html__( '1 comment', 'argenta' ), esc_html__( '% comments', 'argenta' ) );
		echo '</span>';

	}
}



if ( ! function_exists( 'argenta_gh_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function argenta_gh_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			global $post;
			echo '<div class="left">';
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( ' ' );
			if ( $categories_list && argenta_lh_categorized_blog() ) {
				$categories_list = preg_replace( '/(<a)(.+?>)/i', '$1 class="brand-color brand-border-color" $2 ', $categories_list );
				printf( '<span class="category subtitle-font">%1$s</span>', $categories_list ); // WPCS: XSS OK.
			}
			?>
				<div class="select share-btn" data-select="true">
					<a class="select-title brand-color-hover" data-toggle="select">
						<span><?php esc_html_e( 'Share post', 'argenta' ); ?></span>
					</a>
					<ul class="select-menu">
						<li>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank">
								<span class="icon ion-social-facebook"></span>
								<?php esc_html_e( 'Facebook', 'argenta' ); ?>
							</a>
						</li>
						<li>
							<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $post->post_title ); ?>,+<?php echo rawurlencode( get_permalink() ); ?>" target="_blank">
								<span class="icon ion-social-twitter"></span>
								<?php esc_html_e( 'Twitter', 'argenta' ); ?>
							</a>
						</li>
						<li>
							<a href="https://plus.google.com/share?url=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank">
								<span class="icon ion-social-googleplus-outline"></span>
								<?php esc_html_e( 'Google+', 'argenta' ); ?>
							</a>
						</li>
						<li>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&title=<?php echo urlencode( $post->post_title ); ?>&source=<?php echo urlencode( get_bloginfo( 'name' ) ); ?>" target="_blank">
								<span class="icon ion-social-linkedin-outline"></span>
								<?php esc_html_e( 'LinkedIn', 'argenta' ); ?>
							</a>
						</li>
						<li>
							<a href="http://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_permalink() ); ?>&description=<?php echo urlencode( $post->post_title ); ?>" target="_blank">
								<span class="icon ion-social-pinterest-outline"></span>
								<?php esc_html_e( 'Pinterest', 'argenta' ); ?>
							</a>
						</li>
					</ul>
				</div>
			</div><!--.left-->
			<div class="right">
			<?php

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', ', ' );
			if ( $tags_list ) {
				$tags = explode( ', ', $tags_list );
				foreach( $tags as $tag ) {
					printf( '<span class="tag-wrap">%1$s</span>', $tag ); // WPCS: XSS OK.
				}
			}

			echo '</div><div class="clear"></div>';
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( esc_html__( 'Leave a Comment %s on %s', 'argenta' ), '<span class="screen-reader-text">', get_the_title() . '</span>' ) );
			echo '</span>';
		}

		edit_post_link(
			get_the_title( '<span class="screen-reader-text">"', '"</span>', false )
		);
	}

}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function argenta_lh_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'cbrio_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'cbrio_categories', $all_the_cool_cats );
	}

	return true;
}

/**
 * Flush out the transients used in argenta_lh_categorized_blog.
 */
function argenta_lh_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'cbrio_categories' );
}

// add_action( 'edit_category', 'argenta_lh_category_transient_flusher' );
// add_action( 'save_post',     'argenta_lh_category_transient_flusher' );
