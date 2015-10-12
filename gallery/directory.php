<?php get_header() ?>

	<div id="content">
		<div class="padder">

		<form action="" method="post" id="galleries-directory-form" class="dir-form">

			<h3><?php _e( 'Gallery Directory', 'bp-gallery' ) ?></h3>

			<?php do_action( 'bp_before_directory_gallery_content' ) ?>

                        <div id="gallery-dir-search" class="dir-search">
				<?php bp_gallery_directory_search_form() ?>
			</div><!-- #members-dir-search -->
                        
                        <div class="item-list-tabs">
				<ul>
					<li class="selected" id="gallery-all"><a href="<?php global $bp;echo get_permalink($bp->pages->gallery->id); ?>"><?php printf( __( 'All Galleries <span>%s</span>', 'bp-gallery' ), bp_get_total_gallery_count_for_dir() ) ?></a></li>

					<?php if ( is_user_logged_in() && function_exists( 'gallery_total_gallery_for_user' )  ) : ?>
						<li id="gallery-personal"><a href="<?php echo bp_loggedin_user_domain() . BP_GALLERY_SLUG . '/my-galleries/' ?>"><?php printf( __( 'My Galleries <span>%s</span>', 'bp-gallery' ),  gallery_total_gallery_for_user(bp_loggedin_user_id()) ) ?></a></li>
						<?php if(bp_is_active('groups')&&bp_is_gallery_enabled_for('groups')):?>
                                                    <li id="gallery-groups"><a href="<?php echo bp_loggedin_user_domain() . BP_GROUPS_SLUG . '/group-galleries/' ?>"><?php printf( __( 'My Group Galleries', 'bp-gallery' ) ) ?></a></li>
                                                <?php endif;?>
                                            <?php endif; ?>
					
                                        <?php do_action( 'bp_gallery_directory_member_types' ) ?>

					<li id="gallery-order-select" class="last filter">

						<?php _e( 'Filter By:', 'bp-gallery' ) ?>
						<select><option value=""><?php _e( 'All Galleries', 'bp-gallery' ) ?></option>
                                                    <?php $allowed=gallery_get_allowed_gallery_types();?>
                                                    <?php if(array_key_exists('photo',$allowed)):?>
							<option value="photo"><?php _e( 'Photo Gallery', 'bp-gallery' ) ?></option>
                                                    <?php endif;?>
                                                    <?php if(array_key_exists('audio',$allowed)):?>    
							<option value="audio"><?php _e( 'Audio Gallery', 'bp-gallery' ) ?></option>
                                                    <?php endif;?>
                                                    <?php if(array_key_exists('video',$allowed)):?>    
							<option value="video"><?php _e( 'Video Gallery', 'bp-gallery' ) ?></option>
                                                    <?php endif;?>
							

							<?php do_action( 'bp_gallery_directory_order_options' ) ?>
						</select>
					</li>
					
				</ul>
			</div><!-- .item-list-tabs -->

			<div id="galleries-dir-list" class="gallery dir-list">
				<?php locate_template( array( 'gallery/gallery-loop.php' ), true ) ?>
			</div><!-- #galleries-dir-list -->

			<?php do_action( 'bp_directory_gallery_content' ) ?>

			<?php wp_nonce_field( 'directory_galleries', '_wpnonce-gallery-filter' ) ?>

			<?php do_action( 'bp_after_directory_galleries_content' ) ?>

		</form><!-- #galleries-directory-form -->

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php locate_template( array( 'sidebar.php' ), true ) ?>

<?php get_footer() ?>