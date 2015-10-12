<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php
		//favicon
		//need to remove it for wp 4.3+
		if ( bpmagic_get_option( 'use_favicon' ) ) {
			$favicon_html = '';
			$favicon_src = bpmagic_get_option( 'favicon_src' );
			if ( empty( $favicon_src ) ) {
				$favicon_html = "<link rel='shortcut icon' href='" . get_template_directory_uri() . "/_inc/images/favicon.ico' />";
			} else {
				$file = wp_check_filetype( $favicon_src );
				$favicon_html = "<link rel='icon' type='image/" . $file['ext'] . "' href='{$favicon_src}' />";
			}

			if ( $favicon_html ) {
				echo $favicon_html;
			}
		}
		?>
		<?php bp_head(); ?>		
		<?php wp_head(); ?>
		<?php
			$scripts = bpmagic_get_option( 'header_scripts' );
			if ( ! empty( $scripts ) ) {
				echo $scripts;
			}
		?>  

		<?php //load IE specific css/js  ?>  
        
		<!--[if lt IE 9]>

			<script src="<?php echo get_template_directory_uri(); ?>/_inc/js/html5.js" type="text/javascript"></script>
			<script src="<?php echo get_template_directory_uri(); ?>/_inc/js/ie7/ie9.js" type="text/javascript"></script>
			<script src="<?php echo get_template_directory_uri(); ?>/_inc/js/ie7/ie7-squish.js" type="text/javascript"></script>     

        <![endif]-->

        <!--[if IE]>
            <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/ie.css" />
        <![endif]-->   

        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/ie7.css" />
        <![endif]-->
    </head>

    <body <?php body_class(); ?> >
		<?php do_action( 'bp_before_header' ); ?>
		<header id="top">
            <div class="inner">
                <!-- login/signup/account/notification/search box at the top -->
                <div id="search-notification-bar" class="clearfix">

                    <div id="search-bar" role="search" class="alignright">

                        <form action="<?php echo bp_search_form_action(); ?>" method="post" id="search-form" class="clearfix">
							<label for="search-terms" class="accessibly-hidden"><?php _e( 'Search for:', 'bp-magic' ); ?></label>
							<input type="text" id="search-terms" name="search-terms" value="<?php echo isset( $_REQUEST['s'] ) ? esc_attr( $_REQUEST['s'] ) : ''; ?>" placeholder="<?php _ex( 'Search', 'Top Search box placeholder', 'bp-magic' ); ?>"/>

							<?php echo bp_search_form_type_select(); ?>

							<input type="submit" name="search-submit" id="search-submit" value="<?php _e( 'Search', 'bp-magic' ); ?>" />

							<?php wp_nonce_field( 'bp_search_form' ); ?>

						</form><!-- #search-form -->

						<?php do_action( 'bp_search_login_bar' ); ?>

					</div><!-- #search-bar -->
					<div class="clearfix alignright header-top-nav">
						<ul>
							<?php if ( ! is_user_logged_in() ): ?>
								<li class="top-nav-main-item top-nav-item-first sigin-link-top"> <a href="<?php echo site_url( 'wp-login.php', 'login_post' ); ?>" class=""><?php _ex( 'Sign in', 'header top signin link', 'bp-magic' ); ?> </a></li>

								<?php if ( bp_get_signup_allowed() ) : ?>     
									<li class="top-nav-main-item top-nav-item-second signup-link-top"> <?php printf( __( '<a href="%s" title="Create an account" class="my-account">Register</a>', 'bp-magic' ), bp_get_signup_page() ); ?></li>
								<?php endif; ?>
							<?php else: ?> 
								<?php bpmagic_notifications_menu() ?>         
								
								<li class="top-nav-main-item top-nav-item-second  top-account-menu ">
	                                <a class='my-account' href=' <?php echo bp_loggedin_user_link() ?>' ><?php _e( 'My Account', 'bp-magic' ); ?></a>
										
									<?php if ( is_super_admin() || current_user_can( 'manage_options' ) ): ?>
										<ul>
											<li> <a href="<?php echo admin_url( '/' ); ?>"><?php _e( 'Dashboard', 'bp-magic' ); ?></a></li>
										</ul>
									<?php endif; ?>  
								</li>         
							<?php endif; ?>    
						</ul>

					</div>

				</div><!-- end of search notification bar -->
				<div id="navigation" role="navigation" class="clearfix">
					<?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'nav', 'theme_location' => 'primary', 'fallback_cb' => 'bpmagic_main_nav_fallback' ) ); ?>

				</div>

				<?php do_action( 'bp_header' ); ?>

			</div>
		</header><!-- #header -->

		<?php do_action( 'bp_after_header' ); ?>
		<?php do_action( 'bp_before_container' ); ?>

		<div id="container">

			<div class="clearfix inner">

				<?php get_sidebar( 'left' ); ?>

