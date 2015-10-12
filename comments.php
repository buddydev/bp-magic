<?php if ( post_password_required() ) : ?>
	<section id="comments">
		<p class="nopassword">
			<?php _e( 'This  is password protected for one post. Enter the password to view more comments.', 'bp-magic' ); ?>
		</p>

	</section><!-- comments end here -->
<?php	return; ?>

<?php endif; ?>
<section id="comments">
	<?php if ( have_comments() ) : ?>

		<h2 id="comments-title">
			<?php
			printf( _n( 'New Comments  on &ldquo;%2$s&rdquo;', '%1$s Comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'bp-magic' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav id="comment-nav-above" class="navigation">

				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'bp-magic' ); ?></h1>

				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bp-magic' ) ); ?></div>

				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bp-magic' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<ol class="commentlist">
			<?php
				wp_list_comments( array( 'type' => 'comment', 'callback' => 'bpmagic_comment_format' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<div id="comment-nav-below" class="navigation">

				<h2 class="assistive-text"><?php _e( 'Comment navigation', 'bp-magic' ); ?></h2>

				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bp-magic' ) ); ?></div>

				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bp-magic' ) ); ?></div>
			</div>

		<?php endif; ?>

		<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'blog' ); ?></p>

		<?php endif; ?>

		<?php if ( comments_open() ) : ?>
			<?php
				$post_id = get_the_ID();
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				$user = wp_get_current_user();

				$user_identity = $user->exists() ? get_avatar( $user->ID, 50 ) : '';

				$fields = array(
					'author' => '<p class="comment-form-author">' . '<label for="author">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Your Name *', 'bp-magic' ) . '"/>' . ( $req ? '<span class="required"></span>' : '' ) . '</label></p>',
					'email' => '<p class="comment-form-email"><label for="email">' .
						'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Email *', 'bp-magic' ) . '" />' . ( $req ? '<span class="required"></span>' : '' ) . '</label></p>',
					'url' => '<p class="comment-form-url"><label for="url">' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . __( 'Website', 'bp-magic' ) . '" /></label></p>',
				);



			$required_text = sprintf( ' ' . __( 'All the fields marked as %s are required.', 'bp-magic' ), '<span class="required">*</span>' );
			$comment_form_info = array(
				'fields'				=> $fields,
				'comment_field'			=> '<p class="comment-form-comment"><label for="comment">' . '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __( 'Please Enter your comment here', 'bp-magic' ) . '"></textarea></label></p>',
				'must_log_in'			=> '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'bp-magic' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
				'logged_in_as'			=> '<p class="logged-in-as">' . sprintf( __( '<a href="%1$s">%2$s</a>', 'bp-magic' ), admin_url( 'profile.php' ), $user_identity ) . '</p>',
				'comment_notes_before'	=> '<p class="comment-notes">' . __( 'Your email address will not be published.', 'bp-magic' ) . ( $req ? $required_text : '' ) . '</p>',
				'comment_notes_after'	=> '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'bp-magic' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
				'id_form'				=> 'commentform',
				'id_submit'				=> 'submit',
				'title_reply'			=> __( 'Leave a Reply', 'bp-magic' ),
				'title_reply_to'		=> __( 'Write a Reply to %s', 'bp-magic' ),
				'cancel_reply_link'		=> __( 'Cancel reply', 'bp-magic' ),
				'label_submit'			=> __( 'Post Comment', 'bp-magic' ),
			);
			
			comment_form( $comment_form_info );
		?>
	<?php endif; ?>

	<?php
		$trackbacks = get_comments( array( 'type' => 'trackback' ) );
		$num_trackbacks = count( $trackbacks );
		if ( ! empty( $trackbacks ) ) :
	?>
			<div id="trackbacks">
				<h3 class="trackback-title"><?php printf( _n( '1 trackback', '%d trackbacks', $num_trackbacks, 'bp-magic' ), number_format_i18n( $num_trackbacks ) ) ?></h3>

				<ul id="trackbacklist">
					<?php foreach ( (array) $trackbacks as $trackback ) : ?>

						<li>
							<strong><?php echo get_comment_author_link( $trackback->comment_ID ); ?></strong>
							<em>on <?php echo get_comment_date( '', $trackback->comment_ID ); ?></em>
						</li>

					<?php endforeach; ?>
				</ul>

			</div>
		<?php endif; ?>

</section><!-- #comments -->