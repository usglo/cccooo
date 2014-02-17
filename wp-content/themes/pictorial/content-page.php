<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package pictorial
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( get_theme_mod( 'pictorial_page_title_visibility' ) != 1 ) { ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
    <?php } ?>
	<div class="summary-thumbnail">
		<a href="<?php the_permalink(); ?>">
		    <?php the_post_thumbnail( 'pictorial-post-feature' ); ?>
		</a>	
	</div>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div id="pagination" class="btn-group>' . __( 'Pages:', 'pictorial' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'pictorial' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
