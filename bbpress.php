<?php
/**
 * The wrapper page template used for bbpress pages layout
 * 
 */
?>
<?php get_header(); ?>

<div id="content">
    <div class="padder">

		<?php //do_action('bp_before_blog_page'); ?>

        <div class="bb-pages " id="blog-page" role="main">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
						<div class="post-content">
							<h1 class="posttitle"><?php the_title(); ?></h1>
							<div class="entry">
								<?php the_content( __( '<p class="read-more-generated">Read the rest of this page &rarr;</p>', 'bp-magic' ) ); ?>

							</div>
						</div>
					</article>

					<?php bpmagic_get_comment_template(); ?>

				<?php endwhile;
			endif; ?>

        </div><!-- .bb-pages -->

		<?php do_action( 'bp_after_blog_page' ); ?>

    </div><!-- .padder -->
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>