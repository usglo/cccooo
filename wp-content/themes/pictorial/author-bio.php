    <div class="author-bio">
		<div class="bio-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'128'); ?></div>
			<p class="bio-name"><?php the_author_meta('display_name'); ?></p>
			<p class="bio-desc"><?php the_author_meta('description'); ?></p>
		<div class="clear"></div>
		<div class="author-links">
	        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author">More By <?php the_author_meta('display_name'); ?></a>

	        <?php if ( get_the_author_meta( 'gplus' ) ) : ?>
	            <a href="https://plus.google.com/u/0/+<?php echo esc_url(get_the_author_meta( 'gplus' )); ?>" target="_blank">Google+</a>
	        <?php endif; ?>
			
			<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
	            <a href="http://twitter.com/<?php echo esc_url(get_the_author_meta( 'twitter' )); ?>" target="_blank">Twitter</a>
	        <?php endif; ?>

			<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
	            <a href="https://facebook.com/<?php echo esc_url(get_the_author_meta( 'facebook' )); ?>" target="_blank">Facebook</a>
            <?php endif; ?>

			<?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
	            <a href="http://linkedin.com/in/<?php echo esc_url(get_the_author_meta( 'linkedin' )); ?>" target="_blank">LinkedIn</a>
            <?php endif; ?>
			
			<?php if ( get_the_author_meta( 'pinterest' ) ) : ?>
	            <a href="http://www.pinterest.com/<?php echo esc_url(get_the_author_meta( 'pinterest' )); ?>" target="_blank">Pinterest</a>
            <?php endif; ?>
        </div>
    </div>