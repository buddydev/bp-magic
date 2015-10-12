<?php

/**
 * BuddyPress - Users Blogs
 *

 */

?>

<div class="item-list-tabs" id="subnav" role="navigation">
	<ul>
		<?php bp_get_options_nav(); ?>		
	</ul>
	<div id="blogs-order-select" class="last filter">
			<label for="blogs-all"><?php _e( 'Order By:', 'bp-magic' ); ?></label>
			<select id="blogs-all">
				<option value="active"><?php _e( 'Last Active', 'bp-magic' ); ?></option>
				<option value="newest"><?php _e( 'Newest', 'bp-magic' ); ?></option>
				<option value="alphabetical"><?php _e( 'Alphabetical', 'bp-magic' ); ?></option>

				<?php do_action( 'bp_member_blog_order_options' ); ?>

			</select>
		</div>
</div><!-- .item-list-tabs -->

<?php do_action( 'bp_before_member_blogs_content' ); ?>

<div class="blogs myblogs" role="main">

	<?php locate_template( array( 'blogs/blogs-loop.php' ), true ); ?>

</div><!-- .blogs.myblogs -->

<?php do_action( 'bp_after_member_blogs_content' ); ?>
