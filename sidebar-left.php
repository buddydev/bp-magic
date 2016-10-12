<div id="sidebar-left">
    <div id="logo">

		<?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ): ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</h1>
		<?php endif; ?>

    </div>
	
	<?php if ( is_user_logged_in() ) : ?>
	    <div  class="padder" id="user-info-login">
			<?php do_action( 'bp_before_sidebar_me' ); ?>
	        <div id="sidebar-me" class="clearfix">
				<a href="<?php echo bp_loggedin_user_domain(); ?>" class="user-avtar">
					<?php bp_loggedin_user_avatar( 'type=thumb&width=50&height=50' ); ?>
				</a>

				<div class="user-name">
					<strong><?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?></strong>									   
					<a class="logout sidebar-logout" href="<?php echo wp_logout_url( wp_guess_url() ); ?>"><?php _e( 'Log Out', 'bp-magic' ); ?></a>
				</div>

				<?php do_action( 'bp_sidebar_me' ); ?>


			</div><!-- end of sidebar me -->   
	    </div> <!--end of user-info-login box -->
	<?php endif; ?> 
    
	<div class="vanity-logo-bottom">&nbsp;   </div> <!-- for showing the triangular background -->
    <!-- let us put the user nav here -->
    <aside class="padder">
        <h1 class="accessibly-hidden"><?php _ex( 'Sidebar Nav', 'Left Sidebar title for outlining', 'bp-magic' ); ?></h1>
		<?php if ( is_user_logged_in() ) : ?>

			<div id="user-nav" class="user-nav">
				<ul>
					<?php bp_get_loggedin_user_nav(); ?>
				</ul>    
			</div>                

		<?php endif; ?>

		<?php do_action( 'bp_after_sidebar_me' ); ?>
		<?php
		/**
		 * Widgets in left Sidebar is optional
		 */
		?>
		<?php dynamic_sidebar( 'sidebar-left' ); ?>
	</aside><!-- sidebar inner -->
</div><!-- end of sidebar left --> 