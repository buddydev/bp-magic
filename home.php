<?php get_header(); ?>
<!-- put the slider here -->
<section id="content">
    <h1 class="accessibly-hidden"><?php _ex( 'Recent Posts', 'Section Title for Home Page Posts', 'bp-magic' ); ?></h1> 
    
	<div class="padder">
		<?php do_action( 'template_notices' ); ?>
		<?php do_action( 'bp_before_blog_home' ); ?>
		
		<?php //auto support for skitter slideshow ?>
		<?php if ( function_exists( 'show_skitter' ) ): ?>
			<div id="slideshow">
				<?php show_skitter(); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'home-top-widget-area' ) && bpmagic_get_option( 'show_home_top_widget_area' ) ) : ?>
			<div id="home-top-widget-area" class="widget-area clearfix">
				<?php dynamic_sidebar( 'home-top-widget-area' ); ?>
			</div><!-- #first .widget-area -->

		<?php endif; ?>

		<?php if ( bpmagic_get_option( 'show_posts_on_home' ) ) : ?>
			<?php
			//check type of posts to list
			$type_to_show = bpmagic_get_option( 'show_what_posts_on_home' );
			if ( $type_to_show == 'category' ) {
				//need to update the wp_query

				$cats = (array) bpmagic_get_option( 'home_page_posts_category' );
				query_posts( array( 'category__in' => $cats ) );
			}
			?>
			<?php do_action( 'bpmagic_before_home_posts' ); ?>

	        <div class="clearfix" id="blog-latest">
				<?php if ( have_posts() ) : ?>

					<?php do_action( 'bpmagic_before_posts_loop' ); ?>

					<?php get_template_part( 'loop', 'posts' ); ?>

					<?php do_action( 'bpmagic_after_posts_loop' ); ?>

					<div class='pagination'>
						<?php bpmagic_paginate(); ?>
					</div>    
				<?php else : ?>

					<?php get_template_part( 'not-found' ); ?>

				<?php endif; ?>
	        </div>

			<?php do_action( 'bp_after_blog_home' ); ?>

		<?php wp_reset_query(); ?>
		
	<?php endif; //show,hide posts on home page ?>

	<?php if ( is_active_sidebar( 'home-bottom-widget-area' ) && bpmagic_get_option( 'show_home_bottom_widget_area' ) ) : ?>
		<div id="home-bottom-widget-area" class="widget-area clearfix">
			<?php dynamic_sidebar( 'home-bottom-widget-area' ); ?>
		</div><!-- #first .widget-area -->
	<?php endif; ?>         
    </div><!-- .padder -->
</section><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>