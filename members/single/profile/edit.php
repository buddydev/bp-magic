<?php do_action( 'bp_before_profile_edit_content' );?>
<?php if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) :
	    while ( bp_profile_groups() ) : bp_the_profile_group(); ?>
            <form action="<?php bp_the_profile_group_edit_form_action(); ?>" method="post" id="profile-edit-form" class="standard-form <?php bp_the_profile_group_slug(); ?> multistep-form">
            <div class="mnavigation nav-tab">
                <ul class="button-nav clearfix">
					<?php bp_profile_group_tabs(); ?>
                </ul>
            </div>

            <h4 class="item-subtitle"><?php printf( __( "Editing Profile ", "bp-magic" ), bp_get_the_profile_group_name() ); ?></h4>
            <div class="steps">
				<?php
				$field_ids = array();//we will store the xprofile field ids here
				?>

                <div class="step clearfix">
					<?php do_action( 'bp_before_profile_field_content' ); ?>

                    <!--<h4><?php echo bp_get_the_profile_group_name(); ?></h4> -->

					<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

                        <div<?php bp_field_css_class( 'editfield' ); ?>>

							<?php
							$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
							$field_type->edit_field_html();

							/**
							 * Fires before the display of visibility options for the field.
							 */
							do_action( 'bp_custom_profile_edit_fields_pre_visibility' );
							?>

							<?php if ( bp_current_user_can( 'bp_xprofile_change_field_visibility' ) ) : ?>
                                <div class="field-visibility-settings-toggle" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
									<?php printf( __( 'This field can be seen by: <span class="current-visibility-level">%s</span>', 'bp-magic' ), bp_get_the_profile_field_visibility_level_label() ) ?>
                                    <a href="#" class="visibility-toggle-link"><?php _e( 'Change', 'bp-magic' ); ?></a>
                                </div>

                                <div class="field-visibility-settings" id="field-visibility-settings-<?php bp_the_profile_field_id() ?>">
                                    <label for="field-visibility"><?php _e( 'Who can see this field?', 'bp-magic' ) ?></label>
									<?php bpmagic_profile_visibility_radio_buttons() ?>
                                    <a class="field-visibility-settings-close" href="#"><?php _e( 'Close', 'bp-magic' ) ?></a>
                                </div>
							<?php else : ?>
                                <div class="field-visibility-settings-notoggle" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
									<?php printf( __( 'This field can be seen by: <span class="current-visibility-level">%s</span>', 'bp-magic' ), bp_get_the_profile_field_visibility_level_label() ) ?>
                                </div>
							<?php endif ?>

							<?php do_action( 'bp_custom_profile_edit_fields' ); ?>
                        </div>
						<?php $field_ids[] = bp_get_the_profile_field_id(); ?>
					<?php endwhile; ?>

					<?php do_action( 'bp_after_profile_field_content' ); ?>

                </div><!-- end of step -->
            </div>

            <div class="submit">
                <input type="submit" name="profile-group-edit-submit" id="profile-group-edit-submit" class="btn-save"
                       value="<?php _e( 'Save Changes', 'bp-magic' ); ?> "/>
            </div>

            <input type="hidden" name="field_ids" id="field_ids" value="<?php echo join( ',', $field_ids ); ?>"/>

			<?php wp_nonce_field( 'bp_xprofile_edit' ); ?>

        </form>
	<?php endwhile; ?>
<?php endif; ?>

<?php do_action( 'bp_after_profile_edit_content' ); ?>
