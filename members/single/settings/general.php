<?php

/**
 * BuddyPress - Users Home
 *
 * @package bp-magic
 */

get_header( 'buddypress' ); ?>

	<div id="content">
		<div class="padder">

			<?php do_action( 'bp_before_member_home_content' ); ?>

			<div id="item-header" role="complementary">

				<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>

			</div><!-- #item-header -->

			

			<div id="item-body">
                          

				<?php do_action( 'bp_before_member_body' ); ?>

				<div class="item-list-tabs no-ajax" id="subnav">
					<ul>

						<?php bp_get_options_nav(); ?>

						<?php do_action( 'bp_member_plugin_options_nav' ); ?>

					</ul>
				</div><!-- .item-list-tabs -->
                               <div class="item-body-content">
				<h3><?php _e( 'General Settings', 'bp-magic' ); ?></h3>

				<?php do_action( 'bp_template_content' ); ?>

				<form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>" method="post" class="standard-form" id="settings-form">

					<?php if ( !is_super_admin() ) : ?>
                                    <div class="row">
						<label for="pwd"><?php _e( 'Current Password <span>(required to update email or change current password)</span>', 'bp-magic' ); ?></label>
						<input type="password" name="pwd" id="pwd" size="16" value="" class="settings-input small" /> 
                                    </div>          
					<?php endif; ?>
                                    <div class="row">
					<label for="email"><?php _e( 'Account Email', 'bp-magic' ); ?></label>
					<input type="text" name="email" id="email" value="<?php echo bp_get_displayed_user_email(); ?>" class="settings-input" />
                                    </div>
                                    <div class="row">
					<label for="pass1"><?php _e( 'Change Password <span>(leave blank for no change)</span>', 'bp-magic' ); ?></label>
                                        <input type="password" name="pass1" id="pass1" size="16" value="" class="settings-input small" placeholder="<?php _e( 'New Password', 'bp-magic' ); ?>" />
                                    </div>
                                    <div class="row">
                                        <label for="pass2"><?php _e( 'Confirm New Password', 'bp-magic' ); ?></label>
                                        <input type="password" name="pass2" id="pass2" size="16" value="" class="settings-input small" placeholder="<?php _e( 'Repeat New Password', 'bp-magic' ); ?>" /> 
                                    </div>    
					<?php do_action( 'bp_core_general_settings_before_submit' ); ?>

					<div class="submit">
						<input type="submit" name="submit" value="<?php _e( 'Save Changes', 'bp-magic' ); ?>" id="submit" class="auto" />
					</div>

					<?php do_action( 'bp_core_general_settings_after_submit' ); ?>

					<?php wp_nonce_field( 'bp_settings_general' ); ?>

				</form>

				<?php do_action( 'bp_after_member_body' ); ?>
                        </div>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_settings_template' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>