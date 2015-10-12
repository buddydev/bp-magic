<?php
/**
 * Template used to display the search result for WordPress posts
 */
?>
<?php get_header(); ?>

<section id="content">
    <div class="padder">
		<?php do_action( 'bp_before_blog_search' ); ?>

        <h1 class="pagetitle"><?php printf( __( 'Search Results for %s', 'bp-magic' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

        <div id="blog-search" role="main">
			<?php if ( have_posts() ) : ?>
				<?php get_template_part( 'loop', 'search' ); ?>

				<div class='pagination'>
					<?php bpmagic_paginate(); ?>
				</div>  

			<?php else : ?>
				<?php get_template_part( 'not-found' ); ?>
			<?php endif; ?>

        </div><!-- end of #blog-search -->

		<?php do_action( 'bp_after_blog_search' ); ?>

    </div><!-- .padder -->
</section><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>