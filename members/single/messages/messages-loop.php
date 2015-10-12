<?php do_action( 'bp_before_member_messages_loop' ); ?>

<?php if ( bp_has_message_threads( bp_ajax_querystring( 'messages' ) ) ) : ?>

	<div class="pagination" id="user-pag">

		<div class="pag-count" id="messages-dir-count">
			<?php bp_messages_pagination_count(); ?>
		</div>

		<div class="pagination-links" id="messages-dir-pag">
			<?php bp_messages_pagination(); ?>
		</div>

	</div><!-- .pagination -->

	<?php do_action( 'bp_after_member_messages_pagination' ); ?>

	<?php do_action( 'bp_before_member_messages_threads'   ); ?>

	<div id="message-threads" class="messages-notices">
            <ul>
		<?php while ( bp_message_threads() ) : bp_message_thread(); ?>

			<li id="m-<?php bp_message_thread_id(); ?>" class="message-item message-box  <?php bp_message_css_class(); ?><?php if ( bp_message_thread_has_unread() ) : ?> unread <?php else: ?> read<?php endif; ?>">
                           
                            <div class="message-metadata">
				<span class="thread-avatar"><?php bp_message_thread_avatar(); ?>
                                    <span class="unread-count"><?php $count=bp_get_message_thread_unread_count();if(empty($count)) $count=0; echo $count; ?></span>
                                </span>

				<?php if ( 'sentbox' != bp_current_action() ) : ?>
					<strong  class="thread-from">
						 <?php bp_message_thread_from(); ?>
						 <span class="activity"><?php bp_message_thread_last_post_date(); ?></span>
                                        </strong>
                                 
				<?php else: ?>
					<strong  class="thread-from">
                                            <?php bp_message_thread_to(); ?>
                                            <span class="activity"><?php bp_message_thread_last_post_date(); ?></span>	
                                        </strong>
                                 
				<?php endif; ?>
                                <span class="thread-options">
					<input type="checkbox" name="message_ids[]" value="<?php bp_message_thread_id(); ?>" />
				</span>
                            </div><!-- end of message meta data -->
				<div class="thread-info">
					<p class="message-subject"><a href="<?php bp_message_thread_view_link(); ?>" title="<?php _e( "View Message", "bp-magic" ); ?>"><?php bp_message_thread_subject(); ?></a></p>
					<p class="thread-excerpt"><?php bp_message_thread_excerpt(); ?></p>
				</div>

				<?php do_action( 'bp_messages_inbox_list_item' ); ?>

				
                            <span class="thread-options-bottom">
                                <a class="button confirm message-delete" id="message-delete-<?php bp_message_thread_id(); ?>" href="<?php bp_message_thread_delete_link(); ?>" title="<?php _e( "Delete Message", "bp-magic" ); ?>"><?php _e( '[x]', 'bp-magic' ); ?></a> &nbsp;
		
                            </span>
                             
                            <div class="clear"></div>
			</li><!-- /single list item -->

		<?php endwhile; ?>
        </ul>
	</div><!-- #message-threads -->

	<div class="messages-options-nav">
		<?php bpmagic_messages_options(); ?>
	</div><!-- .messages-options-nav -->

	<?php do_action( 'bp_after_member_messages_threads' ); ?>

	<?php do_action( 'bp_after_member_messages_options' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, no messages were found.', 'bp-magic' ); ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_member_messages_loop' ); ?>
