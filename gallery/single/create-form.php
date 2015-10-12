<form name="bp-gallery-create-form" class="standard-form bp-gallery-create-form" enctype="multipart/form-data" method="post" id="gallery_create_form" action="<?php bp_gallery_create_form_action();?>">
		<div id="gallery-form-div">
			<p><?php _e("Create a","bp-gallery");?> <?php gallery_allowed_type_dd();?>
			</p>
			<p><?php _e("Gallery Title","bp-gallery");?><br /><input type="text" id="title" name="gallery_title" size="30" />
			</p>
			<p><span class="gallery-label"><?php _e("Description","bp-gallery");?></span><br />
			<textarea id="gallery_description" name="gallery_description"></textarea>
			</p>
				
			<div class="gallery-meta">
			<p><?php _e("Visibility","bp-gallery");?><?php gallery_valid_gallery_status_dd();?></p>
			<p><input type="submit" value='<?php _e("Save Gallery","bp-gallery");?>' name="save" id="gallery_save" />
			
			
			</div>
			<p>
			<?php wp_nonce_field( 'gallery_create_save', '_wpnonce-gallery_create_save' ) ?> 
			
			
		
		</div>
		<div id="gallery-update-div">
		</div>
		<br class="clear" />
		</form>