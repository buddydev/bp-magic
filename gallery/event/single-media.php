<div class="item-list-tabs no-ajax" id="subnav">
<ul>
<?php bp_event_gallery_admin_tabs(); ?>
</ul>
</div>
<div class="gnav"><?php bp_gallery_bcomb();?>	</div>
<?php //do_action( 'bp_before_gallery_content' ) ?>
	<div id="galleries">
	<?php	locate_template( array( 'gallery/single/media/single.php' ), true ) ;?>

	</div>