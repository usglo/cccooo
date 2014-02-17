<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package pictorial
 */

get_header(); ?>

<div class="container">
	<div class="row" role="main">
        <div class="span8">
		<?php do_action( 'pictorial_before_content' ); ?>
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php get_template_part( 'content', 'home' ); ?>

			<?php endwhile; ?>
            <?php do_action( 'pictorial_after_endwhile' ); ?>
			<?php pictorial_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
		<div class="span4">
            <?php get_sidebar(); ?>
        </div>
	</div><!-- #primary -->

</div>

<?php get_footer(); ?>