<?php

/*
| -------------------------------------------------------------------
| Registering Widget Sections
| -------------------------------------------------------------------
| */

/**
 * Register widgetized area and update sidebar with default widgets
 */
function pictorial_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Header Widget', 'pictorial' ),
		'id'            => 'header-widget',
		'description' => __( 'Displays to the right of the site title. Only 1 widget with no title - ideal for a banner ad.', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Showcase One - Above Content.', 'pictorial' ),
		'id' => 'header-showcase1',
		'description' => __( 'One of four above content showcase widget - ideal for use with the Pictorial - Alternative Recent Posts widget', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Two - Above Content.', 'pictorial' ),
		'id' => 'header-showcase2',
		'description' => __( 'One of four above content showcase widget - ideal for use with the Pictorial - Alternative Recent Posts widget', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Three - Above Content', 'pictorial' ),
		'id' => 'header-showcase3',
		'description' => __( 'One of four above content showcase widget - ideal for use with the Pictorial - Alternative Recent Posts widget', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Showcase Four - Above Content.', 'pictorial' ),
		'id' => 'header-showcase4',
		'description' => __( 'One of four above content showcase widget - use sparingly.', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'pictorial' ),
		'id'            => 'sidebar-main',
		'description' => __( 'Main sidebar - displays on the right of the content on all pages except the 404 page.', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( '404 Sidebar', 'pictorial' ),
		'id'            => 'sidebar-404',
		'description' => __( '404 sidebar - displays on the right of the 404 page content.', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'pictorial' ),
		'id' => 'footer-showcase1',
		'description' => __( 'An optional widget area for your site footer', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'pictorial' ),
		'id' => 'footer-showcase2',
		'description' => __( 'An optional widget area for your site footer', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'pictorial' ),
		'id' => 'footer-showcase3',
		'description' => __( 'An optional widget area for your site footer', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Area Four', 'pictorial' ),
		'id' => 'footer-showcase4',
		'description' => __( 'An optional widget area for your site footer.', 'pictorial' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'pictorial_widgets_init' );

include(get_template_directory() . '/inc/widgets/pictorial-recent-posts-alt.php');
include(get_template_directory() . '/inc/widgets/pictorial-recent-posts.php');

function load_pictorial_widgets() {
	register_widget("Pictorial_RecentPostWidgetAlt");
	register_widget("Pictorial_RecentPostWidget");
}
add_action("widgets_init", "load_pictorial_widgets");