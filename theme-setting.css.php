<style type="text/css">
<?php 
	$bg_image=  bpmagic_get_option('site_background_image');
	$bg_image_repeat=bpmagic_get_option('site_background_repeat');
	$bg_color=bpmagic_get_option('site_background_color');


?>
<?php if(! empty( $bg_image ) ):?>
body{
    background-image: url(<?php echo $bg_image;?>);
    <?php if ( ! empty( $bg_image_repeat ) ):?>
        background-repeat:<?php echo $bg_image_repeat;?>;
    <?php endif;?>
}

<?php endif;?>
<?php if ( ! empty( $bg_color ) ):?>

body{
    background-color:<?php echo $bg_color;?>;
}
<?php endif; ?>
</style>