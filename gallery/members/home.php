<div class="item-list-tabs no-ajax" id="subnav">
<ul>
	
	<?php bp_user_gallery_admin_tabs();?>
</ul>
<?php global $bp; gallery_display_space_usage("user",$bp->displayed_user->id)?>
</div>
<div class="gnav"><?php bp_gallery_bcomb();?>	</div>

				<div id="galleries">
				<?php do_action("gallery_before_content");?>
			
				<?php if(bp_has_galleries()):?>
					<?php while(bp_galleries()):bp_the_gallery() ;?>
							<div class='bp-gallery gallery-type-<?php bp_gallery_type();?>' id="gallery_<?php bp_gallery_id();?>">
								<div class='gallery-content'>
								<h3 class='gallery-title'><a href="<?php bp_gallery_permalink();?>"><?php bp_gallery_title();?>[<?php echo gallery_get_media_count(bp_get_gallery_id());?>]</a></h3>
								<?php // bp_gallery_description();?>
								<div class='gallery-cover'><a href="<?php bp_gallery_permalink();?>"><?php bp_gallery_cover_image("mini");?></a></div>

                                                                <br class="clear" />
								<?php if(user_can_delete_gallery()):?>
								<div class='gallery-actions'>
								<?php bp_gallery_add_media_link();?><a href="<?php bp_gallery_edit_link();?>" class='edit'>[<?php _e("Edit","bp-gallery");?>]</a><a href='<?php bp_gallery_delete_link()?>' class='delete'>[x]<?php _e("delete","bp-gallery");?></a>
								<br class="clear" />
								</div>
								<?php endif;?>
                                                                
                                                                </div>
								
								<div class="bp_gallery_type type_icon_<?php echo bp_get_gallery_type();?>"><?php echo bp_get_gallery_type();?></div>
                                                                <div class="clear"></div>
							</div>
							<?php
							
				?>
					<?php endwhile;?>
			<br class="clear" />
					<?php bp_gallery_pagination_count();?><br />
					<?php   bp_gallery_pagination();?><br />
				<?php else:?>
					<p><?php bp_no_gallery_message();?>
					</p>
					<?php bp_gallery_create_button();?>
				<?php endif;?>
				
			
			<br class="clear" />
			</div>

				<?php do_action( 'bp_gallery_after_home_content' ) ?>