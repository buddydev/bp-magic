<?php
/**
 * Posts Loop
 * Used to show posts on archive pages/search result pages/home page
 */
?>
<div class="clearfix post-list">
	
    <?php while ( have_posts() ) : the_post(); ?>
        <?php do_action( 'bp_before_blog_post' ); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('article article-item'); ?>>
            <header>
                <h1 class="posttitle">
                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'bp-magic' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    <?php if ( is_sticky() ) : ?>
                            <span class="sticky-post"><?php _ex( 'Featured', 'Sticky post', 'bp-magic' ); ?></span>
                    <?php endif; ?>
                </h1>

                <div class="postmetadata ">
                    <p><?php printf( _x( '%s posted on <span>%s </span>', 'Post written by...', 'bp-magic' ), bp_core_get_userlink( $post->post_author ), get_the_date() ); ?></p>
                    <span class="post-utility alignright"><?php edit_post_link( __( 'Edit this entry', 'bp-magic' ) ); ?></span>
                </div>
            </header>

            <div class="post-content">
                <div class="entry clearfix">
                    <?php	if ( has_post_thumbnail() ) {
								the_post_thumbnail('featured-image');
							}
                    ?>       
                    <p><?php  echo wp_trim_words(get_the_content(),'30');?></p>

                    <?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages: ', 'bp-magic' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>

                </div>

                <p class="postmetadata">
                    <?php the_tags( '<span class="tags">' . __( 'Tags: ', 'bp-magic' ), ', ', '</span>' ); ?>
                </p>
            </div>
            <footer class="clearfix">

                <div class="readmore">
                    <a href="<?php the_permalink();?>" title="<?php _e('Continue reading ','bp-magic'); the_title_attribute();?>">
                        <?php _e('Continue reading ','bp-magic');?>
                    </a>
                </div>
                <div  class="comments-info">
                    <span class="comment-count">
                        <?php comments_number('0', '1', '(%)' );?>
                    </span>
                </div>
            </footer>            

        </article>

<?php do_action( 'bp_after_blog_post' ); ?>

<?php endwhile; ?>
</div>