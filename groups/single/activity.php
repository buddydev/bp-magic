<div class="item-list-tabs " id="subnav" role="navigation">
	<ul>
		<li class="feed"><a href="<?php bp_group_activity_feed_link(); ?>" title="<?php _e( 'RSS Feed', 'bp-magic' ); ?>"><?php _e( 'RSS', 'bp-magic' ); ?></a></li>

		<?php do_action( 'bp_group_activity_syndication_options' ); ?>

		<li id="activity-filter-select" class="last">
			<div class="bp-member-nav-right">
				<label for="activity-filter-by"><?php _e( 'Show:', 'bp-magic' ); ?></label>
				<select id="activity-filter-by">
					<option value="-1"><?php _e( 'Everything', 'bp-magic' ); ?></option>
					<option value="activity_update"><?php _e( 'Updates', 'bp-magic' ); ?></option>

					<?php if ( bp_is_active( 'forums' ) ) : ?>
						<option value="new_forum_topic"><?php _e( 'Forum Topics', 'bp-magic' ); ?></option>
						<option value="new_forum_post"><?php _e( 'Forum Replies', 'bp-magic' ); ?></option>
					<?php endif; ?>

					<option value="joined_group"><?php _e( 'Group Memberships', 'bp-magic' ); ?></option>

					<?php do_action( 'bp_group_activity_filter_options' ); ?>
				</select>
			</div>
		</li>
	</ul>

</div><!-- .item-list-tabs -->

<?php do_action( 'bp_before_group_activity_post_form' ); ?>

<?php if ( is_user_logged_in() && bp_group_is_member() ) : ?>
	<?php locate_template( array( 'activity/post-form.php'), true ); ?>
<?php endif; ?>

<?php do_action( 'bp_after_group_activity_post_form' ); ?>
<?php do_action( 'bp_before_group_activity_content' ); ?>

<div class="activity single-group" role="main">
	<?php locate_template( array( 'activity/activity-loop.php' ), true ); ?>
</div><!-- .activity.single-group -->

<?php do_action( 'bp_after_group_activity_content' ); ?>
