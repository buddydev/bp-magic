<div class="item-list-tabs no-ajax" id="subnav">
	<ul>
	<?php //bp_get_options_nav() ?>
	<?php bp_user_gallery_admin_tabs();
            $gallery=bp_get_single_gallery();?>
	</ul>
	
</div>
<div class="gnav"><?php bp_gallery_bcomb();?>	</div>
<?php //do_action( 'bp_before_gallery_content' ) ?>
	<div id="galleries">
	<?php	locate_template( array( 'gallery/single/media/'.$gallery->gallery_type.'-single.php','gallery/single/media/single.php' ), true ) ;?>

	</div>