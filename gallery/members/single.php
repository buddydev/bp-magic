<div class="item-list-tabs no-ajax" id="subnav">
	<ul>
	<?php //bp_get_options_nav() ?>
	<?php bp_user_gallery_admin_tabs();?>
	</ul>
	<?php $gallery=bp_get_single_gallery();?>
</div>
<div class="gnav"><?php bp_gallery_bcomb();?>	</div>
<?php //do_action( 'bp_before_gallery_content' ) ?>
	<div id="galleries">
	
		<?php if(bp_has_galleries()):?>
		
			<?php while(bp_galleries()):bp_the_gallery() ;?>
			<?php if(user_can_view_gallery(bp_get_gallery_id())):?>
				<?php if ( bp_is_my_profile()): ?>
			
					<div class="gallery-actions"><a href="<?php bp_gallery_edit_link();?>"> <?php _e("Edit This gallery","bp-gallery");?></a>|<?php bp_gallery_add_media_button($gallery);//depending on whether upload/add from web showuld be here  ?><br /></div>
				<?php endif;?>	
				<?php 	locate_template( array( '/gallery/single/media/'.$gallery->gallery_type.'-loop.php','/gallery/single/media/media-loop.php' ), true );?>
					<br class="clear" />

                                  <?php
                                   //include the form for commenting on the gallery ?>
                                  <div class="activity  single-media">
			<?php // include( locate_template( array( 'gallery/single/activity.php' ), false ) )/*un comment this line if you want all the activities of a gallery listed here*/  ?>
			</div>
                                 
			<?php else:?>
			
				<p><?php printf(__("This is a %s Gallery and You don't have adequate permissions to view them.","bp-gallery"),bp_get_gallery_status());?></p>
			<?php endif;?>	
		<?php previous_gallery_link();?>
		<?php next_gallery_link();?>
		
		<?php endwhile;?>
			
		
		
		
	<?php else:?>
	<p><?php _e("Perhaps! the Gallery does not exist or You don't have adequate permissions to view them.","bp-gallery");?></p>
	<?php //bp_gallery_create_button();?>
	<?php endif;?>
	<br class="clear" />
</div>