<div id="medias">
		<?php if(bp_gallery_has_medias()):?>
                    <?php if(user_can_view_current_media(bp_get_single_media_id())):?>
			<?php while(bp_gallery_medias()):bp_gallery_the_media() ;?>
			<?php previous_gallery_media_link("<span class='prev'>&laquo; %link </span>");?>
			<?php next_gallery_media_link("<span class='next'>%link &raquo;</span>");?>
			<br class="clear" />
				<div class='single-media' id="gallery_media_<?php bp_media_id();?>">
				<h3 class='media-title'><?php  bp_media_title();?></h3>
				<?php if(bp_media_is_remote ()):?>
                                        <?php bp_media_html();?>

                                        <?php else:
                                            $size= gallery_get_media_size_settings("video");
                                            ?>
                                        <video src="<?php bp_media_full_src()?> " type="video/<?php echo gallery_get_file_extension_from_media(bp_get_the_media());?>" width="<?php echo $size['larger']['width'];?>" height="<?php echo $size['larger']['height'];?>" > </video>
                                       <?php endif;?> 

				<p><?php  bp_media_description();?></p>



			 </div><!-- end of single media div -->

		<!-- for media comments -->
			<div class="activity  single-media">
			<?php include( locate_template( array( 'gallery/single/media/activity.php' ), false ) ) ?>
			</div>
	<?php endwhile;?>

	<?php else:?>
                <p><?php printf(__("This is a private media and you don't have adequate permissions to view it.","bp-gallery"));?></p>
           <?php endif;?>

	<?php else: ?>

		<div id="message" class="info">
			<p><?php _e( "Sorry, but we don't have anything here :(.", 'bp-gallery' ) ?></p>
		</div>

	<?php endif;?>

<br class="clear" />

<div id="navigation">
<?php //previous_gallery_link();?>
<?php //next_gallery_link();?>
</div>
</div><!-- end of medias -->
