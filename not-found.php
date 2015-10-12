<?php
/**
 * Template part used when there is no search result or for some reason, or the post can not be displayed
 * 
 */
?>
<div class="not-found">
    <h2 class="center"><?php _e( 'Nothing Found', 'bp-magic' ); ?></h2>
    <p class="center">
        <?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'bp-magic' ); ?>
    </p>

    <?php get_search_form(); ?>
</div>