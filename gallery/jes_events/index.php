<?php get_header() ?>
	<div id="content">
		<div class="padder" id="jes-padder">
			<?php if ( bp_jes_has_events() ) : while ( jes_bp_events() ) : bp_jes_the_event(); ?>

			<?php do_action( 'bp_before_event_home_content' ) ?>

			<div id="item-header">
				<?php locate_template( array( 'events/single/event-header.php' ), true ) ?>
			</div><!-- #item-header -->

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_options_nav() ?>

						<?php do_action( 'bp_event_options_nav' ) ?>
					</ul>
				</div>
			</div><!-- #item-nav -->

	<div style="clear:left;"></div>

			<div id="item-body">
						<?php do_action( 'template_notices' ) ?>

				<?php do_action( 'bp_before_event_body' ) ?>
	<?php if(bp_is_gallery_home())
			 locate_template( array( 'gallery/jes_events/home.php' ), true ) ;
			 
		else if(bp_is_gallery_create())
			locate_template( array( 'gallery/jes_events/create.php' ), true ) ;
			 	
		else if(bp_is_gallery_edit())
			locate_template( array( 'gallery/jes_events/edit.php' ), true ) ;
			 
		else if(bp_is_gallery_upload())
			locate_template( array( 'gallery/jes_events/upload.php' ), true ) ;
		 else if(bp_is_single_media())
			
			locate_template( array( 'gallery/jes_events/single-media.php' ), true ) ;
		 
		else if(bp_is_single_gallery())
			
			locate_template( array( 'gallery/jes_events/single.php' ), true ) ;
		 
		 else { ?>
					<?php /* The group is not visible, show the status message */ ?>

					<?php do_action( 'bp_before_event_status_message' ) ?>

					<div id="message" class="info">
						<p><?php //bp_group_status_message() ?></p>
					</div>

					<?php do_action( 'bp_after_event_status_message' ) ?>
				<?php }; ?>
			</div><!-- #item-body -->
			
	<?php do_action( 'bp_after_event_home_content' ) ?>

			<?php endwhile; endif; ?>
						
		</div><!-- .padder -->
	</div><!-- #content -->

	<?php locate_template( array( 'sidebar.php' ), true ) ?>

<?php get_footer() ?>