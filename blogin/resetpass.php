<?php get_header() ?>

<div id="content">
	<div class="padder">

		<?php do_action( 'bp_before_password_reset' ) ?>

		<div class="page" id="blog-latest">
			<h3><?php _e( "Resetting Password!", 'bl' ); ?></h3>

			<?php
				do_action( 'template_notices' );
				global $user_login;
			?>
			
			<form name="lostpasswordform" id="lostpasswordform" action="<?php echo bl_get_reset_pass_link() ?>" method="post">
				<p>
					<label><?php _e( 'Username or E-mail:', 'bl' ) ?><br />
						<input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr( $user_login ); ?>" size="20" tabindex="10" />
					</label>
				</p>
				<?php do_action( 'lostpassword_form' ); ?>
				
				<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e( 'Get New Password', 'bl' ); ?>" tabindex="100" /></p>
			</form>

			<p id="nav">
				<?php if ( get_option( 'users_can_register' ) ) : ?>
					<a href="<?php echo bl_get_login_link() ?>"><?php _e( 'Log in', 'bl' ) ?></a> |
					<a href="<?php echo bp_get_signup_page(); ?>"><?php _e( 'Register', 'bl' ) ?></a>
				<?php else : ?>
					<a href="<?php echo bl_get_login_link() ?>"><?php _e( 'Log in', 'bl' ) ?></a>
				<?php endif; ?>
			</p>
			<script type="text/javascript">
				try {
					document.getElementById( 'user_login' ).focus();
				} catch ( e ) {
				}
			</script>

		</div>

		<?php do_action( 'bp_after_password_reset' ) ?>

	</div><!-- .padder -->
</div><!-- #content -->

<?php locate_template( array( 'sidebar.php' ), true ) ?>

<?php get_footer() ?>