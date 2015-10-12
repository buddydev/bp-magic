<?php get_header(); ?>

<section id="content">

    <?php if ( function_exists('breadcrumb_trail')): ?>
        <div class="breadcrumbs">
            <?php breadcrumb_trail(); ?>
        </div>
    <?php else : ?>
        <div class="breadcrumbs">
            <?php
            global $post, $posts;
            $post = $posts[0]; // Hack. Set $post so that the_date() works.
            $desc = category_description();

            if (is_category()): ?>
                <h1 class="pagetitle archive-category"><?php printf(__('Viewing posts filed in <span class="alttext">%s</span>','bp-magic'), single_cat_title(false, false));?></h1>
                <?php if ($desc): ?>
                    <div class="category-description"><?php echo $desc; ?></div>
                <?php endif; ?>
            <?php elseif (is_tag()): ?>
                <h1 class="pagetitle archive-tag"><?php printf(__('Posts tagged %s', 'bp-magic'), '<span class="alttext">' . single_cat_title('', false) . '</span>'); ?></h1>
            <?php elseif (is_day()): ?>
                <h1 class="pagetitle archive-day"><?php printf(__('Archive for %s', 'bp-magic'), '<span class="alttext">' . get_the_time(get_option('date_format')) . '</span>'); ?></h1>
            <?php elseif (is_month()): ?>
                <h1 class="pagetitle archive-month"><?php printf(__('Archive for %s', 'bp-magic'), '<span class="alttext">' . get_the_time(__('F, Y', 'bp-magic')) . '</span>'); ?></h1>
            <?php elseif (is_year()): ?>
                <h1 class="pagetitle archive-year"><?php printf(__('Archive for year %s', 'bp-magic'), '<span class="alttext">' . get_the_time(__('Y', 'bp-magic')) . '</span>'); ?></h1>
            <?php elseif (is_author()): ?>
                <h1 class="pagetitle archive-author"><?php printf('Author archive | All posts written by <span class="alttext">%s</span>', get_the_author_meta('display_name', get_queried_object_id())); ?></h1>
            <?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])): ?>
                <h1 class="pagetitle"><?php _e('Blog Archives', 'bp-magic'); ?></h1>
            <?php endif; ?>
        </div>
    <?php endif; ?>


    <div class="padder">
        <?php do_action('bp_before_blog_home'); ?>
        <?php do_action('template_notices'); ?>

        <div  class="clearfix" id="blog-latest" role="main">
            
			<?php if ( have_posts() ) : ?>
                <?php do_action('bpmagic_before_posts_loop'); ?>
                
                <?php get_template_part('loop', 'posts'); ?>
                
                <?php do_action('bpmagic_after_posts_loop'); ?>

                <div class='pagination'>
                    <?php bpmagic_paginate(); ?>
                </div>  

            <?php else : ?>
                <?php get_template_part('not-found'); ?>
            <?php endif; ?>
        </div>

        <?php do_action('bp_after_blog_home'); ?>

    </div><!-- .padder -->
</section><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>