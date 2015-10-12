<?php do_action( 'bp_before_sidebar' ); ?>

<aside id="sidebar" role="complementary">
    <h1 class="accessibly-hidden"><?php _e( 'Sidebar Right', 'bp-magic' );?></h1>
    <div class="padder">

		<?php do_action( 'bp_inside_before_sidebar' ); ?>
		<?php do_action( 'bp_before_sidebar_me' ); ?>

        <div id="sidebar-displayed-user">
			<?php if ( bp_is_user() ): ?>
				<div class="displayed-user-menu-header clearfix">
					<a href="<?php echo bp_displayed_user_domain(); ?>" class="displayed-user-avatar-thumb">
						<?php bp_displayed_user_avatar( 'type=thumb&width=40&height=40' ); ?>
					</a>

					<h4><?php echo bp_core_get_userlink( bp_displayed_user_id() ); ?></h4>

				</div>   
				<div  class="item-list-tabs no-ajax user-nav" id="object-nav">
					<ul>
						<?php bp_get_displayed_user_nav(); ?>
						<?php do_action( 'bp_member_options_nav' ); ?>
					</ul>    
				</div>        
				<?php do_action( 'bp_sidebar_me' ); ?>
			<?php endif; ?>   
        </div>

		<?php do_action( 'bp_after_sidebar_me' ); ?>
		<?php if ( is_user_logged_in() ) : ?>
			<?php if ( bp_is_active( 'messages' ) ) : ?>
				<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
			<?php endif; ?>

		<?php else : ?>

			<?php do_action( 'bp_before_sidebar_login_form' ); ?>

			<?php if ( bp_get_signup_allowed() ) : ?>
				<p id="login-text">
					<?php printf( __( 'Please <a href="%s" title="Create an account">create an account</a> to get started.', 'bp-magic' ), bp_get_signup_page() ); ?>
				</p>
			<?php endif; ?>

	        <form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo site_url( 'wp-login.php', 'login_post' ); ?>" method="post">
	            <label>
					<?php _e( 'Username', 'bp-magic' ); ?>
	                <br />
	                <input type="text" name="log" id="sidebar-user-login" class="input" value="<?php if ( isset( $user_login ) ) echo esc_attr( stripslashes( $user_login ) ); ?>" tabindex="97" />
	            </label>
	            <label>
					<?php _e( 'Password', 'bp-magic' ); ?>
	                <br />
	                <input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" tabindex="98" />
	            </label>

	            <p class="forgetmenot">
	                <label>
	                    <input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" tabindex="99" /> 
						<?php _e( 'Remember Me', 'bp-magic' ); ?>
	                </label>
	            </p>

				<?php do_action( 'bp_sidebar_login_form' ); ?>
	            <input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e( 'Log In', 'bp-magic' ); ?>" tabindex="100" />

	        </form>

			<?php do_action( 'bp_after_sidebar_login_form' ); ?>

		<?php endif; ?>

		<?php 
		/* Show forum tags on the forums directory */
		 if ( bp_is_active( 'forums' ) && function_exists( 'bp_forums_tag_heat_map' ) && bp_is_forums_component() && bp_is_directory() ) :
		?>
			<div id="forum-directory-tags" class="widget tags">
				<h3 class="widgettitle"><?php _e( 'Forum Topic Tags', 'bp-magic' ); ?></h3>
				<div id="tag-text"><?php bp_forums_tag_heat_map(); ?></div>
			</div>
		<?php endif; ?>

		<?php dynamic_sidebar( 'sidebar' ); ?>

		<?php do_action( 'bp_inside_after_sidebar' ); ?>

    </div><!-- .padder -->
</aside><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ); ?>