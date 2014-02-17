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

<div class="row" role="main">
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
    <?php do_action( 'pictorial_before_content' ); ?>	
	<?php if ( get_theme_mod( 'pictorial_feed_title_visibility' ) != 1 ) { ?>
	<?php if ( get_theme_mod( 'pictorial_feed_title' ) ) : ?>
	<h1 class="latest-entry-title"><?php esc_html_e(get_theme_mod( 'pictorial_feed_title' )); ?></h1>
	<?php else : ?>
	<h1 class="latest-entry-title">Latest Posts</h1>
	<?php endif; ?>
	<?php } ?>
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
            <?php if ( is_home() ) : // Only display Excerpts if front page is latest posts ?>
				<?php get_template_part( 'content', 'home' ); ?>
			<?php else : ?>
				<?php
					get_template_part( 'content', 'page' );
				?>
            <?php endif; ?>
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
</div>

<?php get_footer(); ?>