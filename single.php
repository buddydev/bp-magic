<?php get_header(); ?>
<section id="content">
	<div class="padder">
		
		<?php do_action( 'bp_before_blog_single_post' ); ?>
		
		<?php if ( function_exists( 'breadcrumb_trail' ) ): ?>
			<div class="breadcrumbs">
				<?php breadcrumb_trail(); ?>
			</div>           
		<?php endif; ?>
		
		<div id="blog-single">
		<?php if ( have_posts() ) : ?>
		
			<?php while ( have_posts() ) : the_post(); ?>
			<?php global $post; ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
					<div class="post-content">
						<h1 class="posttitle"><?php the_title(); ?></h1>

						<p class="postmetadata">
							<?php printf( _x( '%1$s posted on <span>%2$s </span> <span>in %3$s</span>', 'single post top meta', 'bp-magic' ), bp_core_get_userlink( $post->post_author ), get_the_time( get_option( 'date_format' ) ), get_the_category_list( ', ' ) ); ?>
							<span class="post-utility alignright"><?php edit_post_link( __( 'Edit this entry', 'bp-magic' ) ); ?></span>
						</p>

						<div class="entry">
							<?php
								if ( has_post_thumbnail() ) :
									the_post_thumbnail( 'single-featured-image' );
								endif;
							?>

							<?php the_content( __( '<p class="read-more-generated">Read the rest of this entry &rarr;</p>', 'bp-magic' ) ); ?>

							<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages: ', 'bp-magic' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
						</div> <!-- end of entry -->

						<?php if ( ! is_attachment() ): ?>
							<p class="postmetadata">
								<?php the_tags( '<span class="tags">' . __( 'Tags: ', 'bp-magic' ), ', ', '</span><br />' ); ?>&nbsp;
								<span class="category"> <?php _e( 'Category: ', 'bp-magic' ); ?><?php echo get_the_category_list( ',' ); ?>&nbsp;</span>
							</p>
						<?php endif; ?>
							<!-- next/prev posts links -->            
						<div class="alignleft">
							<?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'bp-magic' ) . '</span> %title' ); ?>
						</div>
						
						<div class="alignright">
							<?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'bp-magic' ) . '</span>' ); ?>
						</div>

						</div><!-- end of post content -->

					</article>

					<?php bpmagic_get_comment_template(); ?>

				<?php endwhile; ?>

			<?php else: ?>
				<?php get_template_part( 'not-found' ); ?>
			<?php endif; ?>

		</div>

		<?php do_action( 'bp_after_blog_single_post' ); ?>

	</div><!-- .padder -->
</section><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>