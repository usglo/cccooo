<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package pictorial
 */

get_header(); ?>

<?php do_action( 'pictorial_before_page_main' ); ?>
	<div class="row" role="main">
	<?php do_action( 'pictorial_after_page_main' ); ?>
        <div class="span8">
		<?php do_action( 'pictorial_before_intro' ); ?>
        <?php if ( get_theme_mod( 'pictorial_home_intro_visibility' ) != 1 ) { ?>
	        <?php if ( is_front_page() ) : ?>
                <div class="home-intro">
                    <?php get_template_part( 'intro' ); ?>
                    <?php get_template_part( 'cta' ); ?>
                </div>
	        <?php endif; ?>
	    <?php } ?>
	    <?php do_action( 'pictorial_after_intro' ); ?>
	    <div id="showcase">
		<?php do_action( 'pictorial_before_in_showcase' ); ?>
            <?php if ( is_front_page() ) : ?>
                <?php get_sidebar( 'header' ); ?>
	        <?php endif; ?>
        <?php do_action( 'pictorial_after_in_showcase' ); ?>
		</div>
		    <?php do_action( 'pictorial_before_page_content' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
			<?php do_action( 'pictorial_after_page_endwhile' ); ?>
        </div>
		<div class="span4">
            <?php get_sidebar(); ?>
        </div>
	</div><!-- #content -->


<?php get_footer(); ?>
