<div class="item-list-tabs no-ajax" id="subnav">
<ul>
<?php bp_event_gallery_admin_tabs(); ?>
<?php $gallery=bp_get_single_gallery();?>
</ul>
</div>
<div class="gnav"><?php bp_gallery_bcomb();?>	</div>
<?php //do_action( 'bp_before_gallery_content' ) ?>
	<div id="galleries">
		<?php global $post,$bp;if(bp_has_galleries("owner_type=ep_event&owner_id=".$post->ID)):?>
			
			<?php while(bp_galleries()): bp_the_gallery() ;global $bp;?>
			
				<?php if(user_can_view_gallery(bp_get_gallery_id())):?>
				<div class="gallery-actions">
				<?php if ( user_can_delete_gallery($bp->loggedin_user->id,bp_get_gallery_id())): ?>
					<a href="<?php bp_gallery_edit_link();?>"><?php _e("Edit This gallery","bp-gallery");?></a>|
				<?php endif;?>
				<?php if(evt_is_user_registered($post->ID,$bp->loggedin_user->id)):?>
				<?php bp_gallery_add_media_link();?><br />
				<?php endif;?>
				
				</div>
				
				
			<?php 	locate_template( array( '/gallery/single/media/'.$gallery->gallery_type.'-loop.php','/gallery/single/media/media-loop.php' ), true );?>
				
						<br class="clear" />	
		
		<?php else:?>
			
				<p><?php _e(sprintf("This is a %s Gallery and You don't have adequate permissions to view them.",bp_get_gallery_status()),"bp-gallery");?></p>
			<?php endif;?>
		<?php endwhile;?>
			
		<?php bp_gallery_pagination_count();?><br />
		<?php   bp_gallery_pagination();?><br />
	<?php else:?>
	<p><?php _e("Perhaps! the Gallery does not exist or You don't have adequate permissions to view them.");?></p>
	<?php //bp_gallery_create_button();?>
	<?php endif;?>
	<br class="clear" />
</div>