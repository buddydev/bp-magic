<form  id="gallery_media_upload_form" action="<?php bp_gallery_media_upload_form_action();?>" method="post" enctype="multipart/form-data">
        <div id="from-my-comuter">
			<div class="guploading" style="display:none;"></div>
			<input type="hidden" name="auth_cookie" value="<?php if ( is_ssl() ) echo $_COOKIE[SECURE_AUTH_COOKIE]; else echo $_COOKIE[AUTH_COOKIE]; ?>" id="auth_cookie" />
			<?php wp_nonce_field( 'save_gallery_media','_wpnonce-save-gallery-image' ) ?> 
			<br />
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo gallery_get_max_media_size(true);?>" /><!-- change -->

			<input type="file" name="file" id="file" class="validate[required]" />
                        <?php if(bp_get_single_gallery()):?>
                        <input type="hidden" name="_wp_http_referer" value="<?php echo  bp_get_media_upload_link(bp_get_single_gallery());?>" />
			<?php endif;?>
                        <br />
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
			<div id="swfupload-control">
                            <p id="queuestatus" ></p>
                            <ol id="log"></ol>
                        </div>
                        <p> <?php $gallery=bp_get_single_gallery();
                            $size=gallery_get_max_media_size(false);
                            if($size>1000)//greater than 1 MB
                                $size=($size/1000)." MB";
                            else
                                $size=$size." KB";
                        printf(__("You can upload any file of type %s. The maximum file size should not exceed %s .","bp-gallery"),gallery_get_verbose_explanation_for_extension($gallery->gallery_type),$size);?>
			<p><input type="submit" name="save-media" id="bulk_upload_media_submit" value="<?php _e('Upload & Save','bp-gallery');?>" />
                        </p>
			
		</div>
    
		<div class="update_media_upload" id="update_media_upload">
		
		</div>
		<br class="clear" />
	</form>