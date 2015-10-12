<?php
do_action( 'bp_before_group_header' );
?>

<div id="item-actions">

<?php if ( bp_group_is_visible() ) : ?>

		<h3><?php _e( 'Group Admins', 'bp-magic' ); ?></h3>

		<?php
		bp_group_list_admins();

		do_action( 'bp_after_group_menu_admins' );

		if ( bp_group_has_moderators() ) :
			do_action( 'bp_before_group_menu_mods' );
			?>

				<h3><?php _e( 'Group Mods', 'bp-magic' ); ?></h3>

				<?php
				bp_group_list_mods();

				do_action( 'bp_after_group_menu_mods' );

			endif;

	endif;
	?>

</div><!-- #item-actions -->

<div id="item-header-info">
    <div id="item-header-meta">
		<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">

			<?php bp_group_avatar(); ?>

		</a>
        <h2><a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>"><?php bp_group_name(); ?></a></h2>
        <p><span class="highlight"><?php bp_group_type(); ?></span></p>
        <p><span class="activity"><?php printf( __( 'active %s', 'bp-magic' ), bp_get_group_last_active() ); ?></span></p>

	</div>    
</div><!-- #item-header-avatar -->

<div id="item-header-content">


	<?php do_action( 'bp_before_group_header_meta' ); ?>

		<div id="item-meta">

			<?php bp_group_description(); ?>

			<div id="item-buttons">

				<?php do_action( 'bp_group_header_actions' ); ?>

			</div><!-- #item-buttons -->

			<?php do_action( 'bp_group_header_meta' ); ?>

		</div>
	</div><!-- #item-header-content -->
<div class="clear"></div>
<?php
	do_action( 'bp_after_group_header' );
	do_action( 'template_notices' );
?>