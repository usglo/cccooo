<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package pictorial
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
				
		<?php if ( ! dynamic_sidebar( 'sidebar-404' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'pictorial' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'pictorial' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
		<?php if ( get_theme_mod( 'pictorial_sidebar_social_visibility' ) != 0 ) { ?>
            <aside id="social-widget" class="widget">
		        <?php if (get_theme_mod( 'pictorial_sidebar_social_title' )) : ?>
		            <h1 class="widget-title"><?php echo get_theme_mod( 'pictorial_sidebar_social_title' ) ;?></h1>
		        <?php endif; ?>
		        <?php get_template_part( 'social-widget' ); ?>
            </aside>
		<?php } ?>
	</div><!-- #secondary -->
