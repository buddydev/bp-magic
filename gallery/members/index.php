<?php bp_core_setup_message();
//sorry but gallery actions are called too late for the notice to be printed
?>
<?php get_header('buddypress') ?>

	<div id="content">
		<div class="padder">

			<?php do_action( 'bp_before_member_plugin_template' ) ?>

			<div id="item-header">
				<?php locate_template( array( 'members/single/member-header.php' ), true ) ?>
			</div>

	

			<div id="item-body">
			<?php
			
				
			if(bp_current_action()=="create")
			 locate_template( array( 'gallery/members/create.php' ), true ) ;
			else if(bp_current_action()=="manage")
			 locate_template( array( 'gallery/members/edit.php' ), true ) ;
			else if(bp_current_action()=="upload")
			 locate_template( array( 'gallery/single/media/upload-form.php' ), true ) ;
			else if(bp_is_single_media())
				 locate_template( array( 'gallery/members/single-media.php' ), true ) ;
			 else if(bp_is_single_gallery())
				 locate_template( array( 'gallery/members/single.php' ), true ) ;
                        else if(bp_is_my_group_galleries ())
                             locate_template( array( 'gallery/members/group-galleries.php' ), true ) ;
                        else
			 locate_template( array( 'gallery/members/home.php' ), true ) ;
			
			

			?>
				
			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_plugin_template' ) ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php get_sidebar('buddypress') ?>

	<?php do_action( 'bp_after_member_plugin_template' ) ?>

<?php get_footer('buddypress') ?>