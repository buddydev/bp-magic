<?php do_action( 'bp_before_galleries_loop' ) ?>
<?php if ( bp_has_galleries( bp_ajax_querystring( 'gallery' ) ) ) : ?>
	<div class="pagination">

		<div class="pag-count" id="gallery-dir-count">
			<?php bp_gallery_pagination_count();?>
		</div>

		<div class="pagination-links" id="gallery-dir-pag">
			<?php   bp_gallery_pagination();?>
		</div>

	</div>

	<?php do_action( 'bp_before_directory_galleries_list' ) ?>

	<ul id="galleries-list" class="item-list">
	<?php while ( bp_galleries() ) : bp_the_gallery(); ?>

		<li id="item_<?php bp_gallery_id();?>" class='list-item gallery-type-<?php bp_gallery_type();?>'>
			<div class="item-avatar">
				<a href="<?php bp_gallery_permalink();?>"><?php bp_gallery_cover_image("mini");?></a>
			</div>

			<div class="item">
				<div class="item-title" >
					<a href="<?php bp_gallery_permalink();?>"><?php bp_gallery_title();?> [<?php echo gallery_get_media_count(bp_get_gallery_id());?>]</a>
				</div>
				<div class="item-meta"><span class="activity"><?php bp_gallery_last_updated() ?></span></div>
                                <div class="uinfo"><?php printf(__("Created By %s","bp-gallery"),bp_core_get_userlink(bp_get_gallery_creator_id())) ;?></div>
				<?php do_action( 'bp_directory_galleries_item' ) ?>

			</div>

			<div class="action">
                            <div class='generic-button'><a href="<?php bp_gallery_permalink();?>"><?php _e("View","bp-gallery");?></a></div>

				<?php do_action( 'bp_directory_galleries_actions' ) ?>
			</div>

			<div class="clear"></div>
		</li>

	<?php endwhile; ?>
	</ul>

	<?php do_action( 'bp_after_directory_galleries_list' ) ?>

	

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( "Sorry, no galleries were found.", 'bp-gallery' ) ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_galleries_loop' ) ?>