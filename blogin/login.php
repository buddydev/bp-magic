<?php do_action( 'login_form_setcookie' ); ?>

<?php get_header() ?>

<div id="content">
	<div class="padder">

		<?php do_action( 'bp_before_login_form' ) ?>

		<div class="page" id="login">
			<h3><?php _e( "Login Here", 'bl' ); ?></h3>
			<?php
				do_action( 'template_notices' );
				global $user_login;
			?>
			
			<?php do_action( 'login_form_login' ); ?>
			
			<!-- while changing this page, just make sure 2 things, keep the input names in form same -->
			<form name="loginform" id="loginform" action="<?php echo bl_get_login_link() ?>" method="post">
				<p>
					<label><?php _e( 'Username', 'bl' ) ?><br />
						<input type="text" name="log" id="user_login" class="input" value="<?php echo esc_attr( $user_login ); ?>" size="20" tabindex="10" />
					</label>
				</p>
				
				<p>
					<label><?php _e( 'Password', 'bl' ) ?><br />
						<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" />
					</label>
				</p>
				
				<p class="submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e( 'Login Now', 'bl' ); ?>" tabindex="100" />
					<?php global $interim_login; ?>
					
					<?php if ( $interim_login ) :	?>
						<input type="hidden" name="interim-login" value="1" />
					<?php  else : ?>
						<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $_REQUEST['redirect_to'] ); ?>" />
					<?php endif; ?>
					
				</p>
				<?php do_action( 'login_form' ); ?>
				
				<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> <?php esc_attr_e( 'Remember me on this computer', 'bl' ); ?></label></p>

			</form>


				<?php if ( ! $interim_login ): ?>
					<p id="nav">
						<?php if ( get_option( 'users_can_register' ) ) : ?>
							<a href="<?php echo site_url( BP_REGISTER_SLUG, 'login' ) ?>"><?php _e( 'Sign Up! ', 'bl' ) ?></a> | <span>or  Don't have an account?</span>
						<?php endif; ?>
						<a href="<?php echo bl_get_reset_pass_link() ?>" title="<?php _e( 'Password Lost and Found', 'bl' ) ?>"><?php _e( 'Forgot your password?', 'bl' ) ?></a>

					</p>
				<?php endif; ?>


			<script type="text/javascript">
				<?php if ( $user_login || $interim_login ) : ?>
						setTimeout( function () {
							try {
								d = document.getElementById( 'user_pass' );
								d.value = '';
								d.focus();
							} catch ( e ) {
							}
						}, 200 );
				<?php else : ?>
						try {
							document.getElementById( 'user_login' ).focus();
						} catch ( e ) {
						}
				<?php endif; ?>
			</script>

		</div>

		<?php do_action( 'bp_after_login_form' ) ?>

	</div><!-- .padder -->
</div><!-- #content -->

<?php //locate_template( array( 'sidebar.php' ), true )   ?>

<?php get_footer() ?>