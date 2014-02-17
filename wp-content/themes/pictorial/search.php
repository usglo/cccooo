<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package pictorial
 */

get_header(); ?>

<div class="container">
	<div class="row" role="main">
        <div class="span8">
        <article id="post-<?php the_ID(); ?>" class="hentry">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'pictorial' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php pictorial_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>
        </article>
		</div>
		<div class="span4">
            <?php get_sidebar(); ?>
        </div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>