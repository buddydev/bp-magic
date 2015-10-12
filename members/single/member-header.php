<?php

/**
 * BuddyPress - Single Member Header
 *
 */

?>

<?php do_action( 'bp_before_member_header' ); ?>

<div id="item-header-info">
    <div id="item-header-meta">
            <a href="<?php bp_user_link(); ?>">
                    <?php bp_displayed_user_avatar( 'type=full' ); ?>
            </a>
            <h2>
               <a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a>
            </h2>
            <p>
                <span class="user-nicename">@<?php bp_displayed_user_username(); ?></span>
            </p>
            <p>
                <span class="activity"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>
            </p>
    </div><!-- #item-header-meta -->    
</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<?php do_action( 'bp_before_member_header_meta' ); ?>

	<div id="item-meta">

		<?php if ( bp_is_active( 'activity' ) ) : ?>
                        <?php $latest_update=bp_get_activity_latest_update( bp_displayed_user_id() );?>
                        <?php if(!empty($latest_update)):?>
                            <div id="latest-update">
                                    <?php echo $latest_update; ?>
                            </div>
                        <?php endif;?>
		<?php endif; ?>

		<div id="item-buttons">
			<?php do_action( 'bp_member_header_actions' ); ?>
		</div><!-- #item-buttons -->

		<?php
		/***
		 * If you'd like to show specific profile fields here use:
		 * bp_profile_field_data( 'field=About Me' ); -- Pass the name of the field
		 */
		 do_action( 'bp_profile_header_meta' );

		 ?>

	</div><!-- #item-meta -->

</div><!-- #item-header-content -->
<div class="clear"></div>
<?php do_action( 'bp_after_member_header' ); ?>

<?php do_action( 'template_notices' ); ?>