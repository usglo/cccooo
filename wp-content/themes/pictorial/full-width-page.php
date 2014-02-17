<?php
/**
 * Template Name: Full Width Page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package pictorial
 */

get_header(); ?>

<?php do_action( 'pictorial_before_fullwidth_main' ); ?>
	<div class="row" role="main">
	<?php do_action( 'pictorial_after_fullwidth_main' ); ?>
        <div class="span12">
            <?php do_action( 'pictorial_before_fullwidth_content' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
			<?php do_action( 'pictorial_after_fullwidth_endwhile' ); ?>
        </div>
	</div><!-- #content -->


<?php get_footer(); ?>
