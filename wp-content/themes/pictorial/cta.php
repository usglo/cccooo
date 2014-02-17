
<div class="ui buttons">
    <?php if ( get_theme_mod( 'pictorial_intro_learn_button_text' ) ) : ?>
        <div class="ui button">
		    <a href="<?php echo esc_url(get_theme_mod( 'pictorial_intro_learn_button_url' )); ?>" target="<?php echo get_theme_mod( 'pictorial_learn_button_url_target' ); ?>" />
			<?php esc_html_e(get_theme_mod( 'pictorial_intro_learn_button_text' )); ?></a>
		</div>
    <?php else : ?>
        <div class="ui button">Learn More</div>
    <?php endif; ?>
	<div class="or"></div>
	<?php if ( get_theme_mod( 'pictorial_intro_signup_button_text' ) ) : ?>
        <div class="ui positive button">
		    <a href="<?php echo esc_url(get_theme_mod( 'pictorial_intro_signup_button_url' )); ?>" target="<?php echo get_theme_mod( 'pictorial_signup_button_url_target' ); ?>" />
			<?php esc_html_e(get_theme_mod( 'pictorial_intro_signup_button_text' )); ?></a>
		</div>
    <?php else : ?>
        <div class="ui positive button">Sign Up</div>
    <?php endif; ?>
</div>
