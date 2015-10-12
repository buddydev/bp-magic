<?php

/**
 * Bp Magic get comment template 
 * 
 * Get comment template on the 
 * basis of theme option 'show comment' 
 * 
 */
function bpmagic_get_comment_template() {

	$show_comment = true; // bpmagic_get_option('show_comment');
	$show_comment ? comments_template( '', true ) : false;
}

/**
 * Generates the html for comment
 * used with wp_list_comments
 * @param type $comment
 * @param type $args
 * @param type $depeth 
 */
function bpmagic_comment_format( $comment, $args, $depeth ) {

	$GLOBALS['comment'] = $comment;
	$comment_class = '';
	
	if ( $comment->comment_approved == '0' )
		$comment_class = 'comment-pending';
	?>

	<li <?php comment_class( $comment_class ); ?> id="li-comment-<?php comment_ID() ?>">

		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-author">
				<?php echo get_avatar( $comment, 32 ); ?>
			</div><!-- comment author end here -->


			<div class="comment-data">

				<div class="author-meta">
					<?php printf( '<span class="fn">%s</span>', get_comment_author_link() ); ?>
					<span class="comment-time"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">

							<?php echo bpmagic_time_diff( strtotime( $comment->comment_date ), current_time( 'timestamp' ) ); ?>

						</a>
					</span>
				</div>

				<div class="comment-body">
					<?php comment_text(); ?> 
				</div>
				<div class="meta">
					<?php edit_comment_link( __( 'Edit', 'bpmagic' ), '' ); ?>
				</div>

				<div class="reply">

					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depeth, 'max_depth' => $args['max_depth'] ) ) ); ?>  

				</div><!-- reply end here -->

			</div><!-- comment data end here -->
			<?php if ( $comment->comment_approved == '0' ): ?>
				<span class="comment-awaiting"><?php _e( 'your comment is awaiting approval!', 'bpmagic' ); ?></span>

			<?php endif; ?> 

		</article><!-- comment end here -->

		<?php
	}	