<form  id="gallery_media_upload_form" action="<?php bp_gallery_media_upload_form_action();?>" method="post" enctype="multipart/form-data">
            <div id="from-remote-url">
                <div class="guploading" style="display:none;"></div>
		<p><?php
			//$type=bp_gallery_get_current_gallery_type();

		if(bp_is_single_gallery()):?>
			<input type="hidden" name="galleries-list" id="galleries-list" value="<?php echo bp_get_single_gallery_id();?>" />
		<?php else:
                       global $bp;

			echo bp_list_galleries_dropdown($bp->gallery->gallery_type);
			endif;
		?>
                </p>
                <?php wp_nonce_field( 'save_gallery_media_from_web','_wpnonce-save-gallery-media-from-web' ) ?>
                <p><?php _e("Visibility","bp-gallery");?><?php gallery_valid_gallery_status_dd(false);?></p>
               <p> <?php  $gallery=bp_get_single_gallery();printf(__("Please enter a Url from %s  and click add","bp-gallery"),bp_gallery_get_allowed_external_service($gallery->gallery_type));?></p>
              <p>  <input type="text" name="web_url" id="gallery_web_url" value="" /></p>
            <p><input type="submit" name="gallery-save-from-web" id="gallery_save_from_web" value="<?php _e('Add','bp-gallery');?>" />
            </p>

		</div>
   
		<div class="update_media_upload" id="update_media_upload">

		</div>
		<br class="clear" />
	</form>