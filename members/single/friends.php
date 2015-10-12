<?php

/**
 * BuddyPress - Users Friends
 *
 * @package bp-magic
 * 
 */

?>

<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
	<ul>
		<?php if ( bp_is_my_profile() ) bp_get_options_nav(); ?>

		<?php if ( !bp_is_current_action( 'requests' ) ) : ?>

		<?php endif; ?>

	</ul>
	<div id="members-order-select" class="last filter">

		 <label for="members-all"><?php _e( 'Order By:', 'bp-magic' ); ?></label>
		 <select id="members-all">
    			<option value="active"><?php _e( 'Last Active', 'bp-magic' ); ?></option>
				<option value="newest"><?php _e( 'Newest Registered', 'bp-magic' ); ?></option>
				<option value="alphabetical"><?php _e( 'Alphabetical', 'bp-magic' ); ?></option>
				<?php do_action( 'bp_member_blog_order_options' ); ?>
		</select>
	</div>
</div>

<?php

if ( bp_is_current_action( 'requests' ) ) :
	 locate_template( array( 'members/single/friends/requests.php' ), true );

else :
	do_action( 'bp_before_member_friends_content' ); ?>

	<div class="members friends">

		<?php locate_template( array( 'members/members-loop.php' ), true ); ?>

	</div><!-- .members.friends -->

	<?php do_action( 'bp_after_member_friends_content' ); ?>

<?php endif; ?>
