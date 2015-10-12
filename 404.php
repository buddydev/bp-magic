<?php get_header(); ?>

<section id="content">
    <div class="padder">
		
		<?php do_action( 'template_notices' ); ?>
        
		<div class="page" id="blog-latest" role="main">
			<?php do_action( 'bp_before_404' ); ?>
            
			<div id="post-0" class="post page-404 error404 not-found" role="main">
            
				<h2 class="posttitle"><?php _e( "Page not found", 'bp-magic' ); ?></h2>

                <p><?php _e( "We're sorry, but we can't find the page that you're looking for. Perhaps searching will help.", 'bp-magic' ); ?></p>
				<?php get_search_form(); ?>

				<?php do_action( 'bp_404' ); ?>
            
			</div>

			<?php do_action( 'bp_after_404' ); ?>
        </div>   
    
	</div><!-- .padder -->
</section><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>