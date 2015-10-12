<?php get_header() ?>

	<div id="content">
		<div class="padder">
			


			<div id="item-header">
				<?php bpcp_locate_template( array( 'type/single/type-header.php' ), true ) ?>
			</div><!-- #item-header -->

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_options_nav() ?>
					</ul>
				</div>
			</div><!-- /#item-nav -->

			<div id="item-body">
						<?php do_action( 'template_notices' ) ?>

				<?php do_action( 'bp_before_event_body' ) ?>
	<?php if(bp_is_gallery_home())
			 locate_template( array( 'gallery/event/home.php' ), true ) ;
			 
		else if(bp_is_gallery_create())
			locate_template( array( 'gallery/event/create.php' ), true ) ;
			 	
		else if(bp_is_gallery_edit())
			locate_template( array( 'gallery/event/edit.php' ), true ) ;
			 
		else if(bp_is_gallery_upload())
			locate_template( array( 'gallery/event/upload.php' ), true ) ;
		 else if(bp_is_single_media())
			
			locate_template( array( 'gallery/event/single-media.php' ), true ) ;
		 
		else if(bp_is_single_gallery())
			
			locate_template( array( 'gallery/event/single.php' ), true ) ;
		 
		 else { ?>
					<?php /* The group is not visible, show the status message */ ?>

					<?php do_action( 'bp_before_group_status_message' ) ?>

					<div id="message" class="info">
						<p><?php //bp_group_status_message() ?></p>
					</div>

					<?php do_action( 'bp_after_group_status_message' ) ?>
				<?php }; ?>
			</div><!-- #item-body -->
			
		</div><!-- .padder -->
	</div><!-- #content -->

	<?php locate_template( array( 'sidebar.php' ), true ) ?>

<?php get_footer() ?>
