</div>
<?php do_action( 'pictorial_before_footer' ); ?>
<footer id="colophon" class="site-footer" role="contentinfo">
   
    <?php get_sidebar( 'footer' ); ?>
    <?php do_action( 'pictorial_after_footer_widgets' ); ?>
	<div class="site-info">
		<?php do_action( 'pictorial_before_footer_credits' ); ?>
		<?php do_action( 'pictorial_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'pictorial' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'pictorial' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'pictorial' ), 'Pictorial', '<a href="http://www.wpstrapcode.com" rel="designer">WP Strap Code</a>' ); ?>
	<?php do_action( 'pictorial_after_footer_credits' ); ?>
	</div><!-- .site-info -->

</footer><!-- #colophon -->
<?php do_action( 'pictorial_after_footer' ); ?>
</div>
</div><!-- .site -->	
	<?php wp_footer(); ?>
	</body>
</html>