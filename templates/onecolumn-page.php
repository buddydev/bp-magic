<?php
/*
 * Template Name: Page 2 column, no Right sidebar
 *
 * A custom page template without Right sidebar.
 */

get_header();
?>

<section id="content" class="one-column">
    <div class="padder ">

        <?php do_action('bp_before_blog_page'); ?>

        <div  id="blog-page" role="main">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post article'); ?>>
                        
                        <div class="post-content">
                            <h1 class="posttitle"><?php the_title(); ?></h1>
                            <p class="postmetadata"> 
                                <span class="post-utility alignright"><?php edit_post_link(__('Edit this entry', 'bp-magic')); ?></span>
                            </p>    
                            <div class="entry">

                                <?php the_content(__('<p class="read-more-generated">Read the rest of this page &rarr;</p>', 'bp-magic')); ?>

                                <?php wp_link_pages(array('before' => '<div class="page-link"><p>' . __('Pages: ', 'bp-magic'), 'after' => '</p></div>', 'next_or_number' => 'number')); ?>


                            </div>

                        </div>
                    </article>

                    <?php bpmagic_get_comment_template(); ?>

                <?php endwhile; ?>

            <?php endif; ?>

        </div><!-- .page -->

        <?php do_action('bp_after_blog_page'); ?>

    </div><!-- .padder -->
</section><!-- #content -->

<?php get_footer(); ?>