<?php
/**
 * The Template for displaying all single posts.
 *
 * @package pictorial
 */

get_header(); ?>
<?php do_action( 'pictorial_before_single_container' ); ?>
<div class="container">
<?php do_action( 'pictorial_after_single_container' ); ?>
	<div class="row" role="main">
        <?php do_action( 'pictorial_after_single_main' ); ?>
		<div class="span8">
        <?php do_action( 'pictorial_before_single_post' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>
			
			<?php get_template_part( 'author-bio' ); ?>
			
			<?php pictorial_content_nav( 'nav-below' ); ?>
            
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>
        
		<?php endwhile; // end of the loop. ?>
		<?php do_action( 'pictorial_after_signle_endwhile' ); ?>
        </div>
	<div class="span4">
        <?php get_sidebar(); ?>
    </div>		
		
	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>