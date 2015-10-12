<div id="gallery-organize">
	<div id="gallery-header">
		<?php single_gallery_admin_tabs();?>
     </div>

<?php
///we will always have this for some ga;llery
global $gallery;
$gallery=$bp->gallery->current_gallery;

//find all media for this gallery
 if(bp_gallery_has_medias()):?>

		
<form action="" method="post">
<?php while(bp_gallery_medias()):bp_gallery_the_media() ;?>
			<div class='edit-media' id="gallery_media_<?php bp_media_id();?>">
							<div class='media-cover'><?php bp_media_html();?>
							</div>
							
							<div class='edit-info'>
							<input type="text" name="media_title[<?php bp_media_id();?>]" value="<?php bp_media_title();?>">
							<br />
							<textarea name="media_description[<?php bp_media_id();?>]" ><?php  bp_media_description();?></textarea>
							<br />
							<?php gallery_valid_gallery_status_dd(false);?>
							
							</div>
							<br class="clear" />
			</div>
	<?php endwhile;
?>
		    <br class="clear" />
			<input type="submit" name="save" value="<?php _e('Save','bp-gallery');?>" />
			</form>
<?php endif;
?>	
</div>