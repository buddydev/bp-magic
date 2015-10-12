<div class="item-list-tabs no-ajax" id="subnav">
<ul>
<?php //bp_get_options_nav() ?>
<?php bp_user_gallery_admin_tabs();?>
</ul>
</div>
<div id="galleries">
	<?php do_action("gallery_before_create_content");?>
	<?php locate_template( array( '/gallery/single/create-form.php' ), true );
				?>
<?php do_action( 'bp_after_gallery_create_content' ) ?>
</div><!--end of bp-gallery-->