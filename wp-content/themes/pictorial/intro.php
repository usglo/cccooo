<?php if ( get_theme_mod( 'pictorial_intro_title_visibility' ) != 1 ) { ?>
    <?php if ( get_theme_mod( 'pictorial_intro_title' ) ) : ?>
        <h2><?php esc_html_e(get_theme_mod( 'pictorial_intro_title' )); ?></h2>
    <?php else : ?>
        <h2>Replace This With Your Catchy Intro Title!</h2>
    <?php endif; ?>
<?php } ?>

<?php if ( get_theme_mod( 'pictorial_intro_text' ) ) : ?>
    <p><?php echo get_theme_mod( 'pictorial_intro_text' ); ?></p>
<?php else : ?>
    <p>This is an introduction section of the theme - the content for this section can be changed via the theme's customizer. Add text, an image or a video to grab all that important reader attention!</p>
<?php endif; ?>
