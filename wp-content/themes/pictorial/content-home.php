<?php
/**
 * @package pictorial
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->
	
	<div class="summary-thumbnail">
		<a href="<?php the_permalink(); ?>">
		    <?php the_post_thumbnail( 'pictorial-post-feature' ); ?>
		</a>	
	</div>
	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php pictorial_entry_meta(); ?>
			<span class="read-more"><a href="<?php the_permalink(); ?>">Read The Full Article &raquo;</a></span>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		<div class="entry-summary">
		<?php the_excerpt(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages: ', 'pictorial' ),
				'after'  => '</div>',
			) );
		?>
	    </div><!-- .entry-summary -->
		
	<div class="clearfix"></div>    
				
</article><!-- #post-## -->