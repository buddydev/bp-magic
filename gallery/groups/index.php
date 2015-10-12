<?php bp_core_setup_message();
//sorry but gallery actions are called too late for the notice to be printed
?>
<?php get_header('buddypress') ?>

	<div id="content">
		<div class="padder">
			<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>
                      
			<?php do_action( 'bp_before_group_home_content' ) ?>

			<div id="item-header">
				<?php locate_template( array( 'groups/single/group-header.php' ), true ) ?>
			</div>

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="sub-nav">
					<ul>
						<?php bp_get_options_nav() ?>

						<?php do_action( 'bp_group_options_nav' ) ?>
					</ul>
				</div>
			</div>
                        
                        
			<div id="item-body">
				<?php //do_action( 'template_notices' ) ?>

				<?php do_action( 'bp_before_group_body' ) ?>
	<?php if(bp_is_gallery_home())
			 locate_template( array( 'gallery/groups/home.php' ), true ) ;
			 
		else if(bp_is_gallery_create())
			locate_template( array( 'gallery/groups/create.php' ), true ) ;
			 	
		else if(bp_is_gallery_edit())
			locate_template( array( 'gallery/groups/edit.php' ), true ) ;
			 
		else if(bp_is_gallery_upload())
			locate_template( array( 'gallery/groups/upload.php' ), true ) ;
		 else if(bp_is_single_media())
			
			locate_template( array( 'gallery/groups/single-media.php' ), true ) ;
		 
		else if(bp_is_single_gallery())
			
			locate_template( array( 'gallery/groups/single.php' ), true ) ;
		 
		 else { ?>
					<?php /* The group is not visible, show the status message */ ?>

					<?php do_action( 'bp_before_group_status_message' ) ?>

					<div id="message" class="info">
						<p><?php bp_group_status_message() ?></p>
					</div>

					<?php do_action( 'bp_after_group_status_message' ) ?>
				<?php }; ?>

				<?php do_action( 'bp_after_group_body' ) ?>
			</div>

			<?php do_action( 'bp_after_group_home_content' ) ?>

			<?php endwhile; endif; ?>
		</div><!-- .padder -->
	</div><!-- #content -->

	<?php get_sidebar('buddypress') ?>

<?php get_footer('buddypress') ?>
