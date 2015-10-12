<div class="item-list-tabs no-ajax" id="subnav">  
<ul>
	<?php bp_group_gallery_admin_tabs(); ?>
</ul>
<span class="space-usage">
<?php gallery_display_space_usage("groups",null)?>
</span>
</div>

			<div id="galleries">
				
				<?php if( bp_has_galleries("orderby=date&sort_order=DESC&per_page=6") ) : ?>
					<?php while(bp_galleries()):bp_the_gallery() ;?>
							<div class='bp-gallery gallery-type-<?php bp_gallery_type();?>' id="gallery_<?php bp_gallery_id();?>">
								<div class='gallery-content'>
							
								<h3 class='gallery-title'><a href="<?php bp_gallery_permalink();?>"><?php bp_gallery_title();?></a></h3>
								<div class='gallery-cover'><a href="<?php bp_gallery_permalink();?>"><?php bp_gallery_cover_image("mini");?></a></div>
								<div class='gallery-description'><?php bp_gallery_description();?></div>								
								<br class="clear" />
								
                               
								<div class='gallery-actions'>
                                <?php if(user_can_delete_gallery()):?>
								<?php bp_gallery_add_media_link();?><a href="<?php bp_gallery_edit_link();?>" class='edit'>[<?php _e("Edit","bp-gallery");?>]</a><a href='<?php bp_gallery_delete_link()?>' class='delete'>[x]<?php _e("remove","bp-gallery");?></a>
								<?php else :
                                global $bp;
                                if(groups_is_user_member($bp->loggedin_user->id,$bp->groups->current_group->id)):?>
                                <?php bp_gallery_add_media_link();?>
                                <?php endif;?>
                                <?php endif;?>
                                </div>
							</div>
							</div>
							<?php ?>
					<?php endwhile;?>
			<br class="clear" />
					<?php bp_gallery_pagination_count();?><?php bp_gallery_pagination();?><br />
				<?php else:?>
					<p><?php bp_no_gallery_message();?></p>
					<?php bp_gallery_create_button();?>
				<?php endif;?>
				
			<br class="clear" />
			</div>

				<?php do_action( 'bp_directory_members_content' ) ?>