<?php get_header( 'buddypress' ); ?>

<div id="content">
	<div class="padder">

		<?php do_action( 'bp_before_register_page' ); ?>

		<div  id="register-page">
			<?php $steps = array(); ?>
			<form action="" name="signup_form" id="signup_form" class="standard-form multistep-form" method="post" enctype="multipart/form-data">

				<?php if ( 'registration-disabled' == bp_get_current_signup_step() ) : ?>

					<?php do_action( 'template_notices' ); ?>
				
					<div class="signup-intro">
						<?php do_action( 'bp_before_registration_disabled' ); ?>

						<p><?php _e( 'User registration is currently not allowed.', 'bp-magic' ); ?></p>

						<?php do_action( 'bp_after_registration_disabled' ); ?>
					</div>
				
				<?php endif; // registration-disabled signup setp ?>

				<?php if ( 'request-details' == bp_get_current_signup_step() ) : ?>

					<h2><?php _e( 'Create an Account', 'bp-magic' ); ?></h2>

					<?php do_action( 'template_notices' ); ?>
					<div class="signup-intro">
						<p><?php _e( 'Registering for this site is easy, just fill in the fields below and we\'ll get a new account set up for you in no time.', 'bp-magic' ); ?></p>
					</div> 
					
					<?php ob_start(); ?>
					
					<?php do_action( 'bp_before_account_details_fields' ); ?>
					<div class="steps">
						<div class="step register-section" id="basic-details-section">

							<?php /*							 * *** Basic Account Details ***** */ ?>
							<?php $steps[] = __( 'Account Details' ); ?>
							<h4><?php _e( 'Account Details', 'bp-magic' ); ?></h4>
							<div class="row">
								<?php do_action( 'bp_signup_username_errors' ); ?>
								<label for="signup_username"><?php _e( 'Username', 'bp-magic' ); ?> <?php _e( '(required)', 'bp-magic' ); ?></label>

								<input type="text" name="signup_username" id="signup_username" value="<?php bp_signup_username_value(); ?>" />
							</div>
							<div class="row">
								<?php do_action( 'bp_signup_email_errors' ); ?>
								<label for="signup_email"><?php _e( 'Email Address', 'bp-magic' ); ?> <?php _e( '(required)', 'bp-magic' ); ?></label>
								<input type="text" name="signup_email" id="signup_email" value="<?php bp_signup_email_value(); ?>" />
							</div>
							<div class="row">
								<?php do_action( 'bp_signup_password_errors' ); ?>
								<label for="signup_password"><?php _e( 'Choose a Password', 'bp-magic' ); ?> <?php _e( '(required)', 'bp-magic' ); ?></label>

								<input type="password" name="signup_password" id="signup_password" value="" />
							</div>
							<div class="row">
								<?php do_action( 'bp_signup_password_confirm_errors' ); ?>
								<label for="signup_password_confirm"><?php _e( 'Confirm Password', 'bp-magic' ); ?> <?php _e( '(required)', 'bp-magic' ); ?></label>

								<input type="password" name="signup_password_confirm" id="signup_password_confirm" value="" />
							</div>
						</div><!-- #basic-details-section -->

						<?php do_action( 'bp_after_account_details_fields' ); ?>

						<?php /*						 * *** Extra Profile Details ***** */ ?>

						<?php if ( bp_is_active( 'xprofile' ) ) : ?>

							<?php do_action( 'bp_before_signup_profile_fields' ); ?>

							<div class="step register-section" id="profile-details-section">
								<?php $steps[] = __( 'Profile Details' ); ?>
								<h4><?php _e( 'Profile Details', 'bp-magic' ); ?></h4>

								<?php /* Use the profile field loop to render input fields for the 'base' profile field group */ ?>
								<?php if ( bp_is_active( 'xprofile' ) ) : if ( bp_has_profile( 'profile_group_id=1' ) ) : while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

											<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

												<div<?php bp_field_css_class( 'editfield' ); ?>>
													<?php
													$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
													$field_type->edit_field_html();

													/**
													 * Fires before the display of the visibility options for xprofile fields.
													 *
													 * @since BuddyPress (1.7.0)
													 */
													do_action( 'bp_custom_profile_edit_fields_pre_visibility' );
													?>

													<?php if ( bp_current_user_can( 'bp_xprofile_change_field_visibility' ) ) : ?>
														<p class="field-visibility-settings-toggle" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
															<?php printf( __( 'This field can be seen by: <span class="current-visibility-level">%s</span>', 'bp-magic' ), bp_get_the_profile_field_visibility_level_label() ) ?> <a href="#" class="visibility-toggle-link">Change</a>
														</p>

														<div class="field-visibility-settings" id="field-visibility-settings-<?php bp_the_profile_field_id() ?>">
															<fieldset>
																<legend><?php _e( 'Who can see this field?', 'bp-magic' ) ?></legend>

																<?php bpmagic_profile_visibility_radio_buttons() ?>

															</fieldset>
															<a class="field-visibility-settings-close" href="#"><?php _e( 'Close', 'bp-magic' ) ?></a>

														</div>
													<?php else : ?>
														<p class="field-visibility-settings-notoggle" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
															<?php printf( __( 'This field can be seen by: <span class="current-visibility-level">%s</span>', 'bp-magic' ), bp_get_the_profile_field_visibility_level_label() ) ?>
														</p>			
													<?php endif ?>


													<?php do_action( 'bp_custom_profile_edit_fields' ); ?>

												</div>

											<?php endwhile; ?>

											<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_group_field_ids(); ?>" />

										<?php
										endwhile;
									endif;
								endif;
								?>
								<?php do_action( 'bp_after_signup_profile_fields' ); ?>
							</div><!-- #profile-details-section -->

						<?php endif; ?>

						<?php if ( bp_get_blog_signup_allowed() ) : ?>

							<?php do_action( 'bp_before_blog_details_fields' ); ?>

								<?php /***** Blog Creation Details ***** */ ?>

								<div class=" step register-section" id="blog-details-section">
									<?php $steps[] = __( 'Blog Details' ); ?>
									<h4><?php _e( 'Blog Details', 'bp-magic' ); ?></h4>

									<p><input type="checkbox" name="signup_with_blog" id="signup_with_blog" value="1"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Yes, I\'d like to create a new site', 'bp-magic' ); ?></p>

									<div id="blog-details"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?>class="show"<?php endif; ?>>
										<?php do_action( 'bp_signup_blog_url_errors' ); ?>
										<label for="signup_blog_url"><?php _e( 'Blog URL', 'bp-magic' ); ?> <?php _e( '(required)', 'bp-magic' ); ?></label>

									<?php if ( is_subdomain_install() ) : ?>
										http:// <input type="text" name="signup_blog_url" id="signup_blog_url" value="<?php bp_signup_blog_url_value(); ?>" /> .<?php bp_blogs_subdomain_base(); ?>
									<?php else : ?>
										<?php echo site_url(); ?>/ <input type="text" name="signup_blog_url" id="signup_blog_url" value="<?php bp_signup_blog_url_value(); ?>" />
									<?php endif; ?>
		
									<?php do_action( 'bp_signup_blog_title_errors' ); ?>       
									<label for="signup_blog_title"><?php _e( 'Site Title', 'bp-magic' ); ?> <?php _e( '(required)', 'bp-magic' ); ?></label>

									<input type="text" name="signup_blog_title" id="signup_blog_title" value="<?php bp_signup_blog_title_value(); ?>" />
									<?php do_action( 'bp_signup_blog_privacy_errors' ); ?>
									<span class="label"><?php _e( 'I would like my site to appear in search engines, and in public listings around this network.', 'bp-magic' ); ?>:</span>


									<label><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_public" value="public"<?php if ( 'public' == bp_get_signup_blog_privacy_value() || ! bp_get_signup_blog_privacy_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Yes', 'bp-magic' ); ?></label>
									<label><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_private" value="private"<?php if ( 'private' == bp_get_signup_blog_privacy_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'No', 'bp-magic' ); ?></label>

								</div>

							</div><!-- #blog-details-section -->

							<?php do_action( 'bp_after_blog_details_fields' ); ?>

							<?php endif; ?>
						
						<div id='custom-registration-step'>   
							<?php do_action( 'bp_before_registration_submit_buttons' ); ?>
						</div>
					</div><!--end of steps -->
					
					<?php $content = ob_get_clean(); ?>
					
					<div class="mnavigation nav-tab">
						<ul class="button-nav clearfix">
							<?php foreach ( $steps as $step ): ?>
								<li><a href="#"><?php echo $step; ?></a></li>
							<?php endforeach; ?>    

						</ul>
					</div>
					<?php echo $content; ?>
					
					<div class="submit">
						<input type="submit" name="signup_submit" id="signup_submit" value="<?php _e( 'Complete Sign Up', 'bp-magic' ); ?>" />
					</div>

					<?php do_action( 'bp_after_registration_submit_buttons' ); ?>

					<?php wp_nonce_field( 'bp_new_signup' ); ?>

				<?php endif; // request-details signup step ?>

				<?php if ( 'completed-confirmation' == bp_get_current_signup_step() ) : ?>

					<h2><?php _e( 'Sign Up Complete!', 'bp-magic' ); ?></h2>

					<?php do_action( 'template_notices' ); ?>
					<?php do_action( 'bp_before_registration_confirmed' ); ?>

					<?php if ( bp_registration_needs_activation() ) : ?>
						<p><?php _e( 'You have successfully created your account! To begin using this site you will need to activate your account via the email we have just sent to your address.', 'bp-magic' ); ?></p>
					<?php else : ?>
						<p><?php _e( 'You have successfully created your account! Please log in using the username and password you have just created.', 'bp-magic' ); ?></p>
					<?php endif; ?>

					<?php do_action( 'bp_after_registration_confirmed' ); ?>

				<?php endif; // completed-confirmation signup step ?>

			<?php do_action( 'bp_custom_signup_steps' ); ?>

			</form>

		</div>

		<?php do_action( 'bp_after_register_page' ); ?>

	</div><!-- .padder -->
</div><!-- #content -->

<?php get_sidebar( 'buddypress' ); ?>

<script type="text/javascript">
	jQuery( document ).ready( function () {
		if ( jQuery( 'div#blog-details' ).length && !jQuery( 'div#blog-details' ).hasClass( 'show' ) )
			jQuery( 'div#blog-details' ).toggle();

		jQuery( 'input#signup_with_blog' ).click( function () {
			jQuery( 'div#blog-details' ).fadeOut().toggle();
		} );
	} );
</script>

<?php get_footer( 'buddypress' ); ?>