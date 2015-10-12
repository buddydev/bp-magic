<div class="item-list-tabs no-ajax" id="subnav">
<ul>
	<?php //bp_get_options_nav() ?>
	<?php bp_user_gallery_admin_tabs();?>
</ul>
</div>
<div id="galleries">
<?php locate_template(array("gallery/single/edit.php"),true);?>	
</div>