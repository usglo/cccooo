<?php
/**
 * pictorial functions and definitions
 *
 * @package pictorial
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'pictorial_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function pictorial_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on pictorial, use a find and replace
	 * to change 'pictorial' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pictorial', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 280, 136, true );
	add_image_size( 'pictorial-page-feature', 1230, 500, true ); //(cropped)
	add_image_size( 'pictorial-post-feature', 940, 320, true ); //(cropped)
	add_image_size( 'pictorial-post-standard', 940, 420, true ); //(cropped)

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'pictorial' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => '00c6c0',
		'default-image' => '',
	) );

}
endif; // pictorial_setup
add_action( 'after_setup_theme', 'pictorial_setup' );

// Lets load our custom functions and scripts now

require( get_template_directory() . '/inc/smart-widgets.php' );

/**
 * Register Lato Google font for Pictorial.
 *
 * @since Pictorial 1.0
 *
 * @return void
 */
function pictorial_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'pictorial' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles
 */
function pictorial_scripts() {
	global $wp_styles;
	// Bump this when changes are made to bust cache
    $version = '1.0.5';
	// CSS Scripts
	$protocol = is_ssl() ? 'https' : 'http';
	$query_args = array(
		'family' => 'Yanone+Kaffeesatz:200,300,400,700',
	);
	wp_enqueue_style( 'pictorial-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ) );
	// Add Lato font, used in the main stylesheet.
	//wp_enqueue_style( 'pictorial-lato', pictorial_font_url(), array(), null );
    		
	wp_enqueue_style('pictorial-style', get_template_directory_uri().'/css/style.css', false ,$version, 'all' );
	wp_enqueue_style('pictorial-bootstrap', get_template_directory_uri().'/css/app.css', false ,$version, 'all' );
    wp_enqueue_style('pictorial-responsive', get_template_directory_uri().'/css/app-responsive.css', false ,$version, 'all' );
	wp_enqueue_style('pictorial-custom', get_template_directory_uri().'/css/custom.css', false ,$version, 'all' );

	// Load style.css from child theme
    if (is_child_theme()) {
      wp_enqueue_style('pictorial_child', get_stylesheet_uri(), false, $version, null);
    }
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    	
	wp_enqueue_script('bootstrap.min.js', get_template_directory_uri().'/js/app.js', array('jquery'),$version, true );
	
	wp_enqueue_script( 'pictorial-bootstrapnav', get_template_directory_uri() . '/js/twitter-bootstrap-hover-dropdown.js', array(), $version, true );
    
	wp_enqueue_script('bootstrap.min.js', get_template_directory_uri().'/js/modernizr.custom.79639.js', array('jquery'),$version, false );
}
add_action( 'wp_enqueue_scripts', 'pictorial_scripts' );

/*  IE js header
/* ------------------------------------ */
function pictorial_ie_support_header() {
    echo '<!--[if lt IE 9]>'. "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>'. "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/selectivizr-min.js' ) . '"></script>'. "\n";
    echo '<![endif]-->'. "\n";
}
add_action( 'wp_head', 'pictorial_ie_support_header' );


/*  IE js footer
/* ------------------------------------ */
function pictorial_ie_support_footer() {
    echo '<!--[if lt IE 9]>'. "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/respond.min.js' ) . '"></script>'. "\n";
    echo '<![endif]-->'. "\n";
}
add_action( 'wp_footer', 'pictorial_ie_support_footer', 20 );


if ( !wp_is_mobile() ) {
  require get_template_directory() . '/inc/nav-menu-walker.php';
  } else {
  require get_template_directory() . '/inc/nav-mobile-walker.php';
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

// Lets do a separate excerpt length for the showcase recent post
function pictorial_showcase_excerpt () {
	$theContent = trim(strip_tags(get_the_content()));
		$output = str_replace( '"', '', $theContent);
		$output = str_replace( '\r\n', ' ', $output);
		$output = str_replace( '\n', ' ', $output);
			if (get_theme_mod( 'pictorial_showcase_excerpt_length' )) :
			$limit = get_theme_mod( 'pictorial_showcase_excerpt_length' );
			else : 
			$limit = '15';
			endif;
			$content = explode(' ', $output, $limit);
			array_pop($content);
		$content = implode(" ",$content)."  ";
	return strip_tags($content, ' ');
}

// Lets do a separate excerpt length for the alternative recent post widget
function pictorial_recentpost_excerpt () {
	$theContent = trim(strip_tags(get_the_content()));
		$output = str_replace( '"', '', $theContent);
		$output = str_replace( '\r\n', ' ', $output);
		$output = str_replace( '\n', ' ', $output);
			if (get_theme_mod( 'pictorial_recentpost_excerpt_length' )) :
			$limit = get_theme_mod( 'pictorial_recentpost_excerpt_length' );
			else : 
			$limit = '15';
			endif;
			$content = explode(' ', $output, $limit);
			array_pop($content);
		$content = implode(" ",$content)."  ";
	return strip_tags($content, ' ');
}

if ( ! function_exists( 'pictorial_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own pictorial_entry_meta() to override in a child theme.
 *
 * @since Pictorial 1.0.0
 *
 * @return void
 */
function pictorial_entry_meta() {

	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'pictorial' ) . '</span>';

	if ( ! has_post_format( 'aside' ) && ! has_post_format( 'link' ) && 'post' == get_post_type() )
		pictorial_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'pictorial' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'pictorial' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'pictorial' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'pictorial_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own pictorial_entry_date() to override in a child theme.
 *
 * @since Pictorial 1.0.0
 *
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string
 */
function pictorial_entry_date( $echo = true ) {
	$format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'pictorial' ): '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'pictorial' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

function pictorial_body_class( $classes ) {
	$background_color = get_background_color();

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	return $classes;
}
add_filter( 'body_class', 'pictorial_body_class' );

/**
 * Returns number of widgets in a widget position - used in the Header Showcase widget area.
 *
 * @since Pictorial 1.0.0
 */
function pictorial_header_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'header-showcase1' ) )
		$count++;

	if ( is_active_sidebar( 'header-showcase2' ) )
		$count++;

	if ( is_active_sidebar( 'header-showcase3' ) )
		$count++;
		
	if ( is_active_sidebar( 'header-showcase4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

/**
 * Returns number of widgets in a widget position - used in the Footer Showcase widget area.
 *
 * @since Pictorial 1.0.0
 */
function pictorial_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-showcase1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-showcase2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-showcase3' ) )
		$count++;
		
	if ( is_active_sidebar( 'footer-showcase4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}