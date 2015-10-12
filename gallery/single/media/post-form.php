<?php if(bp_is_active("activity")):?>
<form action="<?php bp_activity_post_form_action() ?>" method="post" id="whats-new-form" name="whats-new-form">

	<?php do_action( 'bp_before_activity_post_form' ) ?>

	<div id="whats-new-avatar">
		<a href="<?php echo bp_loggedin_user_domain() ?>">
			<?php bp_loggedin_user_avatar( 'width=60&height=60' ) ?>
		</a>
	</div>

	<h5>
		
		<?php printf( __( "Wanna Say something %s?", 'bp-gallery' ), gallery_get_loggedin_user_first_name() ) ?>
		
	</h5>

	<div id="whats-new-content">
		<div id="whats-new-textarea">
			<textarea name="whats-new" id="whats-new" value="" /><?php if ( isset( $_GET['r'] ) ) : ?>@<?php echo esc_attr( $_GET['r'] ) ?> <?php endif; ?></textarea>
		</div>

		<div id="whats-new-options">
			<div id="whats-new-submit">
				<span class="ajax-loader"></span> &nbsp;
				<input type="submit" name="gallery-new-comments-submit" id="gallery-new-comments-submit" value="<?php _e( 'Comment', 'bp-gallery' ) ?>" />
			</div>
			<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="gallery" />
			<input type="hidden" id="whats-new-post-object_component" name="whats-new-post-object_component" value="<?php  echo gallery_get_current_object_type();?>" />
				
			<input type="hidden" id="whats-new-post-in" name="whats-new-post-in" value="<?php if(bp_is_single_media())echo bp_get_single_media_id(); else echo bp_get_single_gallery_id(); ?>" />
			<input type="hidden" id="component-to-be-commented" name="component-to-be-commented" value="<?php if(bp_is_single_media())echo "media"; else echo "gallery"; ?>" />
			<?php do_action( 'bp_activity_post_form_options' ) ?>

		</div><!-- #whats-new-options -->
	</div><!-- #whats-new-content -->

	<?php wp_nonce_field( 'post_update', '_wpnonce_post_update' ); ?>
	<?php do_action( 'bp_after_activity_post_form' ) ?>

</form><!-- #whats-new-form -->
<?php endif;?>