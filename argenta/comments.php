<?php
	if ( post_password_required() ) return;
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) : ?>
		<h3 class="title text-left comments-title">
			<?php
				printf( esc_html( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', 'argenta' ) ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="title screen-reader-text"><?php esc_html_e( 'Comment navigation', 'argenta' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'argenta' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'argenta' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( 'type=comment&callback=argenta_gh_comment' );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="title screen-reader-text"><?php esc_html_e( 'Comment navigation', 'argenta' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'argenta' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'argenta' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().

	if ( comments_open() ) : ?>
		<section class="comment-respond" id="respond">
			<h3 class="title text-left">
				<?php comment_form_title( esc_html__('Post a Comment', 'argenta'), esc_html__('Leave a Reply to %s', 'argenta')); ?>
			</h3>
			<div class="reply-cancle"><?php cancel_comment_reply_link( esc_html__( 'Click here to cancel reply', 'argenta' ) ); ?></div>
			<?php if ( is_user_logged_in() ): ?>
				<p class="text-left"><?php esc_html_e( 'Logged in as', 'argenta' ); echo ' <a href="' . esc_url( get_option( 'siteurl' ) ) . '/wp-admin/profile.php" class="box-name brand-color">' . $user_identity . '</a>'; ?>
					<a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>" title="<?php esc_attr_e( 'Log out of this account', 'argenta' ); ?>" class="box-name brand-color"><?php esc_html_e( 'Log out', 'argenta' ); ?> &raquo;</a>
				</p>
			<?php endif; ?>
			<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
				<p><?php printf( esc_html__( 'You must be %s logged in %s to post a comment.', 'argenta' ), '<a href="' . esc_url( wp_login_url( get_permalink() ) ) . '">', '</a>' ); ?></p>
			<?php else : ?>
			<form action="<?php echo esc_url( get_option( 'siteurl' ) ); ?>/wp-comments-post.php" method="post" class="without-label-offset" id="commentform">

				<div class="input-vertical-group">
					<?php if ( ! is_user_logged_in() ) : ?>
					<div class="input-group">
						<div class="input-wrap">
							<label for="author" class="col-4">
								<input type="text" placeholder="<?php esc_attr_e( 'Name', 'argenta' ); ?>" name="author" id="author" value="<?php echo esc_attr( $comment_author ); ?>" tabindex="1">
							</label>
							<label for="email" class="col-4">	
								<input type="email" placeholder="<?php esc_attr_e( 'Email', 'argenta' ); ?>" name="email" id="email" value="<?php echo esc_attr( $comment_author_email ); ?>" tabindex="2">
							</label>
							<label for="url" class="col-4">
								<input type="text" placeholder="<?php esc_attr_e( 'Website', 'argenta' ); ?>" name="url" id="url" value="<?php echo esc_attr( $comment_author_url ); ?>" size="22" tabindex="3">
							</label>
						</div>
					<?php endif; ?>

						<textarea rows="8" name="comment" id="comment" tabindex="4" placeholder="<?php esc_attr_e( 'Comment', 'argenta' ); ?>"></textarea>
					<?php if ( !is_user_logged_in() ) : ?>
					</div>
					<?php endif; ?>
				</div>

				<p class="text-left">
					<button name="submit" class="btn submit-comment" tabindex="5"><?php esc_html_e( 'Submit Comment', 'argenta' ); ?></button>
				</p>

				<div class="clear"></div>

				<?php comment_id_fields(); ?>
				<?php do_action( 'comment_form', $post->ID ); ?>
			</form>
			<?php endif; ?>
		</section>
	<?php endif; ?>

</div><!-- #comments -->
