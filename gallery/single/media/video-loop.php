<?php if(bp_gallery_has_medias("page=0")):?>
<div class="player_wrapper">
		
<?php while(bp_gallery_medias()):bp_gallery_the_media() ;
//skip remote media from flowplayer
?>
<div <?php bp_media_css();?> id="gallery_media_<?php bp_media_id();?>">
				<div class="media-content">
			
					<h3 class="media-title"><a href="<?php bp_media_permalink();?>" alt="<?php  bp_media_title();?>"><?php  bp_media_title();?></a></h3>
					<?php if(bp_media_is_remote ()):?>
                                        <?php bp_media_html();?>
							
                                        <?php else:
                                            $size= gallery_get_media_size_settings("video");
                                            ?>
											
                                         <video src="<?php bp_media_full_src()?> " type="video/<?php echo gallery_get_file_extension_from_media(bp_get_the_media());?>" width="<?php echo $size['thumb']['width'];?>" height="<?php echo $size['thumb']['height'];?>" controls="controls" preload="none" > </video>
                                       
                                       <?php endif;?> 					<br class="clear" />

					<p class="media-description"><?php  bp_media_description();?></p>
					<div class='edit-delete'><a href="<?php bp_media_permalink();?>" class='mcomments'><?php _e("comments","bp-gallery");?>(<?php global $medias_template; echo gallery_get_media_comment_count($medias_template->media->id);?>)</a>
					<?php global $bp; if(user_can_delete_gallery($bp->loggedin_user->id,$bp->gallery->current_gallery)):?>
					<a href="<?php bp_media_edit_link()?> " class='edit'>[<?php _e("edit","bp-gallery");?>]</a><a href="<?php bp_media_delete_link();?>" class='delete'>[x]<?php _e("remove","bp-gallery");?></a>
					<?php endif;?>
					</div>
					</div>
					<?php

					gallery_media_editable_content($medias_template->media);



					?>
			</div>
			
		
			<?php endwhile;?>


	

</div>
<br clear="all" />
<div id="gallery-comments" class="activity  single-media">
    
</div>
<br clear="all" />
	
		
		
	<?php else: ?>

		<div id="message" class="info">
			<p><?php _e( ":( we don't have anything here.", "bp-gallery" ) ?></p>
		</div>

	<?php endif;?>


