</div><!-- .inner -->
</div> <!-- #container -->

<?php do_action( 'bp_after_container' ); ?>
<?php do_action( 'bp_before_footer' ); ?>

<footer id="footer" >
	
	<?php if ( bpmagic_get_option( 'show_footer_top_widget_area' ) && is_active_sidebar( 'footer-widget-full-col-top' ) ) : ?>
		<div  class="footer-widgets-top">
			<div class="inner">
				<div class="footer-widget-area clearfix" role="complementary">
					<div id="footer-widgets-top" class="widget-area">
						<?php dynamic_sidebar( 'footer-widget-full-col-top' ); ?>
					</div><!-- #footer-widget-full-col-top -->
				</div><!-- .footer-widget-area -->
			</div>

		</div> 
	<?php endif; ?> 
	
	<?php if ( bpmagic_get_option( 'show_footer_3col_widget_area' ) && ( is_active_sidebar( 'first-footer-widget-area' ) || is_active_sidebar( 'second-footer-widget-area' ) || is_active_sidebar( 'third-footer-widget-area' )) ) : ?>
		<div class="footer-widgets-top">
			<div class="inner">
				<div class="footer-widget-area clearfix" role="complementary">

					<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
						<div id="first" class="widget-area">
							<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
						</div><!-- #first .widget-area -->

					<?php endif; ?>

					<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
						<div id="second" class="widget-area">
							<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
						</div><!-- #second .widget-area -->
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
						<div id="third" class="widget-area">
							<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
						</div><!-- #third .widget-area -->
					<?php endif; ?>
				</div><!-- #footer-widget-area -->
			</div><!-- end of .inner --> 

		</div><!-- end of #footer-widgets-top -->
	<?php endif; ?>

	<?php if ( bpmagic_get_option( 'show_footer_bottom_widget_area' ) && is_active_sidebar( 'footer-widget-full-col-bottom' ) ) : ?>
		<div  class="footer-widgets-bottom">
			<div class="inner">
				<div class="footer-widget-area clearfix" role="complementary">
					<div id="fourth" class="widget-area">
						<?php dynamic_sidebar( 'footer-widget-full-col-bottom' ); ?>
					</div><!-- #footer-widget-full-col-bottom -->
				</div><!-- .footer-widget-area -->
			</div>

		</div> 
	<?php endif; ?> 

	<?php do_action( 'bp_in_footer' ); ?>

    <div id="credits" role="contentinfo">
        <div class="inner">
			<?php do_action( 'bpmagic_credits' ); ?>
			<?php echo bpmagic_get_option( 'copyright_text' ); ?>
        </div>       
    </div> 
</footer><!-- #footer -->

<?php do_action( 'bp_after_footer' ); ?>
<?php wp_footer(); ?>

</body>
</html>