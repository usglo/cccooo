<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 		
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
    <?php wp_head(); ?>
  </head>
<body <?php body_class(); ?>>
<div class="site">
<div class="container">
<?php do_action( 'pictorial_before_header' ); ?>
<div class="row" id="top-bar">
		<?php if (get_theme_mod( 'pictorial_logo_image' )) : ?>
		<div class="span6 logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_theme_mod( 'pictorial_logo_image' ); ?>"></a>
			<?php if ( get_theme_mod( 'pictorial_tagline_visibility' ) != 0 ) { ?>
			    <h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>
			<?php } ?>
		</div>
		<?php else : ?>
		<div class="span6 logo">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php if ( get_theme_mod( 'pictorial_tagline_visibility' ) != 0 ) { ?>
			    <h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>
			<?php } ?>
		</div>
		
		<?php endif; ?>

	    <?php if ( is_active_sidebar( 'header-widget' ) ) : ?>
            <div class="span6">
                <div class="account-banner">
                    <?php dynamic_sidebar( 'header-widget' ); ?>
		   		</div>
			</div>
	    <?php else : ?>
		<?php if ( get_theme_mod( 'pictorial_header_social_visibility' ) != 0 ) { ?>
		    <?php get_template_part( 'social-icons' ); ?>
		<?php } ?>
		<?php endif; // end sidebar widget area ?>
		
	</div>
<?php do_action( 'pictorial_after_header' ); ?>
</div>
<?php do_action( 'pictorial_before_navbar' ); ?>
<?php get_template_part( 'nav-top' ); ?>
<?php do_action( 'pictorial_after_navbar' ); ?>
<div class="container">
<?php do_action( 'pictorial_after_main_container' ); ?>   