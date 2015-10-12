<?php do_action( 'bp_before_notices_loop' ); ?>

<?php if ( bp_has_message_threads() ) : ?>

	<div class="pagination" id="user-pag">

		<div class="pag-count" id="messages-dir-count">
			<?php bp_messages_pagination_count(); ?>
		</div>

		<div class="pagination-links" id="messages-dir-pag">
			<?php bp_messages_pagination(); ?>
		</div>

	</div><!-- .pagination -->

	<?php do_action( 'bp_after_notices_pagination' ); ?>
	<?php do_action( 'bp_before_notices' ); ?>

	<div id="message-threads" class="messages-notices">
              <ul>
		<?php while ( bp_message_threads() ) : bp_message_thread(); ?>
			<li id="notice-<?php bp_message_thread_id(); ?>" class="message-item message-box message-box-notice <?php bp_message_css_class(); ?><?php if ( bp_message_thread_has_unread() ) : ?> unread <?php else: ?> read<?php endif; ?>">
				<div class="message-metadata">
                                    <span class="thread-avatar"><?php bp_message_thread_avatar(); ?>

                                    </span>
                                </div>
                                <div class="thread-info">
					<p class="message-subject"><?php bp_message_notice_subject(); ?></p>
					<p class="thread-excerpt"><?php bp_message_thread_excerpt(); ?></p>
				</div>
					
					<?php bp_message_notice_text(); ?>
				

					<?php if ( bp_messages_is_active_notice() ) : ?>

						<strong><?php bp_messages_is_active_notice(); ?></strong>

					<?php endif; ?>

					<span class="activity"><?php _e( 'Sent:', 'bp-magic' ); ?> <?php bp_message_notice_post_date(); ?></span>
				

				<?php do_action( 'bp_notices_list_item' ); ?>

				
					<a class="button" href="<?php bp_message_activate_deactivate_link(); ?>" class="confirm"><?php bp_message_activate_deactivate_text(); ?></a>
					<a class="button" href="<?php bp_message_notice_delete_link(); ?>" class="confirm" title="<?php _e( "Delete Message", "bp-magic" ); ?>">x</a>
                                        </li>
			
		<?php endwhile; ?>
	  </ul>
        </div>
	<?php do_action( 'bp_after_notices' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, no notices were found.', 'bp-magic' ); ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_notices_loop' ); ?>