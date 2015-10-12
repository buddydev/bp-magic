<div class="item-list-tabs no-ajax" id="subnav">
	<ul>
		<?php if ( bp_is_my_profile() ) : ?>
			<?php bp_get_options_nav() ?>
		<?php endif; ?>

		<?php //if ( 'invites' != bp_current_action() ) : ?>
		
		<?php //endif; ?>
	</ul>
</div><!-- .item-list-tabs -->

	<div id="galleries">
				<?php do_action("gallery_before_content");?>

				<?php if(bp_has_galleries()):?>
					<?php while(bp_galleries()):bp_the_gallery() ;?>
							<div class='bp-gallery' id="gallery_<?php bp_gallery_id();?>">
								<div class='gallery-content'>
								<h3 class='gallery-title'><a href="<?php bp_gallery_permalink();?>"><?php bp_gallery_title();?>[<?php echo gallery_get_media_count(bp_get_gallery_id());?>]</a></h3>
								<?php // bp_gallery_description();?>
								<div class='gallery-cover'><a href="<?php bp_gallery_permalink();?>"><?php bp_gallery_cover_image("mini");?></a></div>

                                                                <br class="clear" />
								
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
