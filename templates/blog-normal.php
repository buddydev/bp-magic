<?php
/**
 * Template Name: Blog Page without Grid Layout
 */
?>
<?php get_header(); ?>
<!-- put the slider here -->
<section id="content">
    <h1 class="pagetitle"><?php echo single_post_title() ?></h1> 
    <div class="padder">

		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>

		<?php if ( function_exists( 'show_skitter' ) && bpmagic_get_option( 'show_slider_on_blog_home_page' ) ): ?>
			<div id="slideshow">
				<?php show_skitter(); ?>
			</div>
		<?php endif; ?>

        <div class="clearfix" id="blog-latest">
			<?php
			global $wp_query;

			$args = array( 'post_type' => 'post', 'paged' => get_query_var( 'paged' ) );

			query_posts( $args );

			$wp_query->is_archive = true;
			$wp_query->is_page = false;
			?>
			<?php if ( have_posts() ) : ?>

				<?php do_action( 'bpmagic_before_posts_loop' ); ?>

				<?php get_template_part( 'loop', 'posts' ); ?>

				<div class='pagination'>
					<?php bpmagic_paginate(); ?>
				</div> 

				<?php do_action( 'bpmagic_after_posts_loop' ); ?>

			<?php else : ?>

				<?php get_template_part( 'not-found' ); ?>

			<?php endif; ?>
			<?php wp_reset_query(); ?> 
        </div>

		<?php do_action( 'bp_after_blog_home' ); ?>

    </div><!-- .padder -->
</section><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>