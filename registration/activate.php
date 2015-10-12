<?php get_header( 'buddypress' ); ?>

	<section id="content">
		<div class="padder">

            <?php do_action( 'bp_before_activation_page' ); ?>

            <div id="activate-page">

                <?php if ( bp_account_was_activated() ) : ?>

                    <h2 class="widgettitle"><?php _e( 'Account Activated', 'bp-magic' ); ?></h2>
                    <div class='bwhitepad'>
                        <?php do_action( 'template_notices' ); ?>
                        <?php do_action( 'bp_before_activate_content' ); ?>

                        <?php if ( isset( $_GET['e'] ) ) : ?>
                            <p><?php _e( 'Your account was activated successfully! Your account details have been sent to you in a separate email.', 'bp-magic' ); ?></p>
                        <?php else : ?>
                            <p><?php _e( 'Your account was activated successfully! You can now log in with the username and password you provided when you signed up.', 'bp-magic' ); ?></p>
                        <?php endif; ?>
                    </div>    
                <?php else : ?>

                    <h2><?php _e( 'Activate your Account', 'bp-magic' ); ?></h2>
                 
                    <div class='bwhitepad'>
                        
                    <?php do_action( 'template_notices' ); ?>
                    <?php do_action( 'bp_before_activate_content' ); ?>

                    <p><?php _e( 'Please provide a valid activation key.', 'bp-magic' ); ?></p>

                    <form action="" method="get" class="standard-form" id="activation-form">

                        <label for="key"><?php _e( 'Activation Key:', 'bp-magic' ); ?></label>
                        <input type="text" name="key" id="key" value="" />

                        <p class="submit">
                            <input type="submit" name="submit" value="<?php _e( 'Activate', 'bp-magic' ); ?>" />
                        </p>

                    </form>
                 </div>
			<?php endif; ?>

			<?php do_action( 'bp_after_activate_content' ); ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_activation_page' ); ?>

		</div><!-- .padder -->
	</section><!-- #content -->

	<?php get_sidebar( 'buddypress' ); ?>

<?php get_footer( 'buddypress' ); ?>
