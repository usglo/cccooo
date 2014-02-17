<?php
/* * *************************************************************************************************** */
// Create Theme Options page 
// Print required JS and CSS files
// Help for Theme Options page
/* * *************************************************************************************************** */

add_action('admin_menu', 'nimbus_add_theme_options_page');

function nimbus_add_theme_options_page() {

    // Create Theme Options page 

    $theme_options_page = add_theme_page(THEME_NAME . __(' Theme Options', 'nimbus'), THEME_NAME . __(' Theme Options', 'nimbus'), 'edit_theme_options', 'nimbus-options', 'nimbus_page_render');

    if (!$theme_options_page) {
        return;
    }

    // Print required JS and CSS files

    add_action('admin_print_styles-' . $theme_options_page, 'nimbus_options_styles');
    add_action('admin_print_scripts-' . $theme_options_page, 'nimbus_options_scripts');

}

/* **************************************************************************************************** */
// Enqueue admin JS
/* **************************************************************************************************** */

function nimbus_options_scripts() {

    wp_enqueue_script('jquery');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('jquery-form');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');

    wp_register_script('jquery_cookie', get_template_directory_uri() . '/nimbus/js/jquery.cookies.2.2.0.js', array('jquery'), '1.0');
    wp_enqueue_script('jquery_cookie');

    wp_register_script('options', get_template_directory_uri() . '/nimbus/js/options.js', array('jquery'), '1.0');
    wp_enqueue_script('options');

    wp_register_script('color-picker', get_template_directory_uri() . '/nimbus/js/colorpicker.js', array('jquery'), '1.0');
    wp_enqueue_script('color-picker');

    wp_register_script('options-upload', get_template_directory_uri() . '/nimbus/js/options_uploader.js', array('jquery', 'media-upload', 'thickbox'), '1.0');
    wp_enqueue_script('options-upload');

    wp_register_script('fancybox', get_template_directory_uri() . '/nimbus/js/jquery-fancybox-1-3-4.js', array('jquery'), '1.3.4');
    wp_enqueue_script('fancybox');
    
}

/* **************************************************************************************************** */
// Enqueue admin CSS
/* **************************************************************************************************** */

function nimbus_options_styles() {

    wp_enqueue_style('admin-style', get_template_directory_uri() . '/nimbus/css/option_page_style.css');
    wp_enqueue_style('color-picker', get_template_directory_uri() . '/nimbus/css/colorpicker.css');
    wp_enqueue_style('fancybox', get_template_directory_uri() . '/nimbus/css/jquery.fancybox-1.3.4.css');
    wp_enqueue_style('thickbox');
}

/* **************************************************************************************************** */
// Include Resources on init
/* **************************************************************************************************** */


add_action('admin_init', 'nimbus_require_resources');

function nimbus_require_resources() {

    require_once dirname(__FILE__) . '/options_engine.php';
    require_once dirname(__FILE__) . '/options_security.php';
}

/* **************************************************************************************************** */
// Register Settings on init
/* **************************************************************************************************** */

add_action('admin_init', 'nimbus_register_settings_on_init');

function nimbus_register_settings_on_init() {

    register_setting('nimbus_option_group', THEME_OPTIONS, 'nimbus_options_sanitize');

}

/* **************************************************************************************************** */
// Render options page
/* **************************************************************************************************** */

if (!function_exists('nimbus_page_render')) {

    function nimbus_page_render() {
        global $NIMBUS_OPTIONS_ARR;
        $options = $NIMBUS_OPTIONS_ARR;
        $display_tab_content = nimbus_field_engine();
        ?>

        <div id="options_wrapper">
            <div id="options_header">	
                <img id="panel_logo" src="<?php echo get_template_directory_uri(); ?>/nimbus/images/nimbus-panel.jpg" alt='Nimbus Panel'  />	
                <a href="<?php echo SALESPAGEURL; ?>?utm_source=simple&utm_medium=theme&utm_content=panel_banner&utm_campaign=simple"><img id="panel_banner" src="<?php echo get_template_directory_uri(); ?>/nimbus/images/become-member.jpg" alt='Become a Member'  /></a>
            </div>
            <div id="options_content">	
                <div id="tab_wrapper">	
                    <ul id="tabs">
                        <?php echo $display_tab_content['tab']; ?>
                    </ul>
                </div>
                <div id="form_wrapper">
                    <?php 
                    settings_errors(); 
                    ?>
                    <form action="options.php" method="post" id="nimbus_form">
                        <?php 
                        settings_fields('nimbus_option_group'); 
                        submit_button( 'Save', 'nimbus_button_blue', 'update', false, array( 'id' => 'update_options_top')); 
                        $reset_confirm = __('Are you sure you want to reset? ALL Settings Will Be Lost!', 'nimbus');
                        submit_button( 'Reset', 'nimbus_button_gray', 'reset', false, array( 'id' => 'reset_options_top', 'onclick' => 'return confirm( \'' . $reset_confirm . '\')'));
                        ?>
                        <a id="support_options_top" target="_blank" class="nimbus_button_orange" href="<?php echo SUPPORTINFOURL; ?>?utm_source=simple&utm_medium=theme&utm_content=suport_button&utm_campaign=simple">Support</a> 
                        <?php
                        foreach ($options as $option) {
                            if ($option['type'] == 'tab') {
                            $id = $option['url'];
                            ?>
                                <div id="<?php echo $id; ?>">
                                    <?php echo $display_tab_content[$id]; ?>
                                </div>
                            <?php
                            }
                        }
                        ?>     
                        <div class="clear20" id="dotted_ln"></div>
                        <?php 
                        submit_button( 'Save', 'nimbus_button_blue', 'update', false, array( 'id' => 'update_options')); 
                        $reset_confirm = __('Are you sure you want to reset? ALL Settings Will Be Lost!', 'nimbus');
                        submit_button( 'Reset', 'nimbus_button_gray', 'reset', false, array( 'id' => 'reset_options', 'onclick' => 'return confirm( \'' . $reset_confirm . '\')'));
                        ?>  
                        <a id="support_options_bottom" target="_blank" class="nimbus_button_orange" href="<?php echo SUPPORTINFOURL; ?>?utm_source=simple&utm_medium=theme&utm_content=suport_button&utm_campaign=simple">Support</a> 
                    </form>
                </div>
                <div class="clear20"></div>
            </div> 
        </div> 
        <div style="clear:both;"></div>

        <?php
    }

}



/* **************************************************************************************************** */
// On options form submit do:
/* **************************************************************************************************** */

function nimbus_options_sanitize($input) {

    global $NIMBUS_OPTIONS_ARR;

    // Do if selected reset button
    if (isset($_POST['reset'])) {
        $alert = __('Default options restored.', 'nimbus');
        add_settings_error('nimbus-options', 'restore_defaults', $alert, 'updated fade');
        return nimbus_return_defaults();
    }

    // Do if selected save button
    if (isset($_POST['update'])) {
        $clean = array();
        $options = $NIMBUS_OPTIONS_ARR;
        foreach ($options as $option) {
            if (!isset($option['id'], $option['type']) || ($option['type'] == 'tab') || ($option['type'] == 'item_html')) {
                continue;
            }
            $id = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($option['id']));
            
            // Set checkbox to false if it wasn't sent in the $_POST
            if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
                $input[$id] = false;
            }

            // Set each item in the multicheck to false if it wasn't sent in the $_POST
            if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
                foreach ( $option['options'] as $key => $value ) {
                    $input[$id][$key] = false;
                }
            }
            
            // Apply filters
            if (isset($input[$id])) {
                if (has_filter('nimbus_filter_' . $option['type'])) {
                    $clean[$id] = apply_filters('nimbus_filter_' . $option['type'], $input[$id], $option);
                } else {
                    $clean[$id] = $input[$id];
                }
            }
        }
        $alert = __('Options saved.', 'nimbus');
        add_settings_error('nimbus-options', 'save_options', $alert, 'updated fade');
        return $clean;
    } 
}

/* **************************************************************************************************** */
// Return default options
/* **************************************************************************************************** */

function nimbus_return_defaults() {
    global $NIMBUS_OPTIONS_ARR;
    $defaults_return = array();
    $options = $NIMBUS_OPTIONS_ARR;
    foreach ((array) $options as $option) {
        if (!isset($option['id'], $option['default'])) {
            continue;
        }
        $defaults_return[$option['id']] = $option['default'];
    }
    return $defaults_return;
}

/* * *************************************************************************************************** */
// Helper to return options.
/* * *************************************************************************************************** */

if (!function_exists('nimbus_get_option')) {
    function nimbus_get_option($option_data, $default_data = false) {
        global $NIMBUS_OPTIONS_ARR;
        $options = get_option(THEME_OPTIONS);
        $default_options = $NIMBUS_OPTIONS_ARR;
        if (isset($options[$option_data])) {
            return $options[$option_data];
        } else {
            $default = $default_options[$option_data]['default'];
            return $default;
        }
    }
}


/* **************************************************************************************************** */
// WP_head options.
/* **************************************************************************************************** */

add_action('wp_head', 'nimbus_options_to_head');

function nimbus_options_to_head() {

    global $NIMBUS_FONT_FACES, $NIMBUS_OPTIONS_ARR, $post;
    
    $get_fonts = $NIMBUS_FONT_FACES;
    $options = $NIMBUS_OPTIONS_ARR;
    
    foreach ($options as $option) {
        if (($option['type'] == "typography") || ($option['type'] == "font")  || ($option['type'] == "face")) {
            $$option['id'] = nimbus_get_option($option['id']);
        }    
    }
    $font_list = array();
    foreach ($options as $option) {
        if (($option['type'] == "typography") || ($option['type'] == "font")  || ($option['type'] == "face")) {
            $nimbus_get_face = nimbus_get_option($option['id']);
            array_push($font_list, $nimbus_get_face['face']);
        }    
    }
    $filtered_font_list = array_unique($font_list);
    foreach ($filtered_font_list as $key => $font) {
        if(isset($get_fonts[$font])){
            echo $get_fonts[$font]['import'];
            echo "\n";
        }
    }
    ?>

        <!-- Style from <?php echo THEME_NAME; ?> Theme Options. --> <?php echo "\n"; ?> 
    <style type="text/css"><?php echo "\n"; ?> 
    
        /* Body */
        
        body { font:<?php echo $body_style['style']; ?> <?php echo $body_style['size']; ?>/<?php echo $body_style['line']; ?> <?php echo $get_fonts[$body_style['face']]['fam']; ?>; color:<?php echo $body_style['color']; ?>;  text-transform:<?php echo $body_style['fonttrans']; ?>; background-color:#ffffff; } 
        
        /* Links*/
        
        a { color:<?php echo nimbus_get_option('link_color'); ?>; }
        a:hover, a:focus { color:<?php echo nimbus_get_option('link_hover_color'); ?>; }
        
        /* Headings*/
        
        h1, h1 a { font:<?php echo $h1_style['style']; ?> <?php echo $h1_style['size']; ?>/<?php echo $h1_style['line']; ?> <?php echo $get_fonts[$h1_style['face']]['fam']; ?>; color:<?php echo $h1_style['color']; ?>;  text-transform:<?php echo $h1_style['fonttrans']; ?>; } 
        h2, h2 a { font:<?php echo $h2_style['style']; ?> <?php echo $h2_style['size']; ?>/<?php echo $h2_style['line']; ?> <?php echo $get_fonts[$h2_style['face']]['fam']; ?>; color:<?php echo $h2_style['color']; ?>; text-transform:<?php echo $h2_style['fonttrans']; ?>; }
        h2 a:hover { color:<?php echo $h2_style['color']; ?>; }
        h3, h3 a { font:<?php echo $h3_style['style']; ?> <?php echo $h3_style['size']; ?>/<?php echo $h3_style['line']; ?> <?php echo $get_fonts[$h3_style['face']]['fam']; ?>; color:<?php echo $h3_style['color']; ?>;  text-transform:<?php echo $h3_style['fonttrans']; ?>; }
        h3 a:hover { color:<?php echo $h3_style['color']; ?>; }
        h4, h4 a { font:<?php echo $h4_style['style']; ?> <?php echo $h4_style['size']; ?>/<?php echo $h4_style['line']; ?> <?php echo $get_fonts[$h4_style['face']]['fam']; ?>; color:<?php echo $h4_style['color']; ?>;  text-transform:<?php echo $h4_style['fonttrans']; ?>;}
        h4 a:hover { color:<?php echo $h4_style['color']; ?>; }
        h5, h5 a { font:<?php echo $h5_style['style']; ?> <?php echo $h5_style['size']; ?>/<?php echo $h5_style['line']; ?> <?php echo $get_fonts[$h5_style['face']]['fam']; ?>; color:<?php echo $h5_style['color']; ?>;  text-transform:<?php echo $h5_style['fonttrans']; ?>;}
        h5 a:hover { color:<?php echo $h5_style['color']; ?>; }
        h6, h6 a { font:<?php echo $h6_style['style']; ?> <?php echo $h6_style['size']; ?>/<?php echo $h6_style['line']; ?> <?php echo $get_fonts[$h6_style['face']]['fam']; ?>; color:<?php echo $h6_style['color']; ?>;  text-transform:<?php echo $h6_style['fonttrans']; ?>;}
        h6 a:hover { color:<?php echo $h6_style['color']; ?>; }        
        
        /* Tables */
        
        th, ul.css-tabs a, div.accordion h2, h2.hide_show_title span { font:<?php echo $th_style['style']; ?> <?php echo $th_style['size']; ?>/<?php echo $th_style['line']; ?> <?php echo $get_fonts[$th_style['face']]['fam']; ?>; color:<?php echo $th_style['color']; ?>;  text-transform:<?php echo $th_style['fonttrans']; ?>;}
        td, td a, td a:hover { font:<?php echo $td_style['style']; ?> <?php echo $td_style['size']; ?>/<?php echo $td_style['line']; ?> <?php echo $get_fonts[$td_style['face']]['fam']; ?>; color:<?php echo $td_style['color']; ?>;  text-transform:<?php echo $td_style['fonttrans']; ?>;}
        caption { font:<?php echo $tc_style['style']; ?> <?php echo $tc_style['size']; ?>/<?php echo $tc_style['line']; ?> <?php echo $get_fonts[$tc_style['face']]['fam']; ?>; color:<?php echo $tc_style['color']; ?>;  text-transform:<?php echo $tc_style['fonttrans']; ?>;}
        
        /* Sidebar */
        
        div.widget h3, #wp-calendar caption, .widgettitle, .widgettitle a, #footer_row > div > div.footer_widgets .widgettitle a, h3.social_title { font:<?php echo $sidebar_title_style['style']; ?> <?php echo $sidebar_title_style['size']; ?>/<?php echo $sidebar_title_style['line']; ?> <?php echo $get_fonts[$sidebar_title_style['face']]['fam']; ?>; color:<?php echo $sidebar_title_style['color']; ?>;  text-transform:<?php echo $sidebar_title_style['fonttrans']; ?>; border-bottom:1px dotted #cccccc;}
        #footer_row > div > div.footer_widgets .widgettitle a { border:none; }
        #s { font:<?php echo $nimbus_search_style['style']; ?> <?php echo $nimbus_search_style['size']; ?>/<?php echo $nimbus_search_style['line']; ?> <?php echo $get_fonts[$nimbus_search_style['face']]['fam']; ?>; color:<?php echo $nimbus_search_style['color']; ?>;  text-transform:<?php echo $nimbus_search_style['fonttrans']; ?>; }
        .sidebar p, .sidebar a, .sidebar li, .sidebar td, .sidebar td a, .sidebar td a:hover { font:<?php echo $nimbus_sidebar_text_style['style']; ?> <?php echo $nimbus_sidebar_text_style['size']; ?>/<?php echo $nimbus_sidebar_text_style['line']; ?> <?php echo $get_fonts[$nimbus_sidebar_text_style['face']]['fam']; ?>; color:<?php echo $nimbus_sidebar_text_style['color']; ?>;  text-transform:<?php echo $nimbus_sidebar_text_style['fonttrans']; ?>; }
         .sidebar a:hover { color:<?php echo $nimbus_sidebar_text_style['color']; ?>; }
         
         
         
        
        /* Header */
        
        .text_logo, .text_logo a { font:<?php echo $nimbus_logo_style['style']; ?> <?php echo $nimbus_logo_style['size']; ?>/<?php echo $nimbus_logo_style['line']; ?> <?php echo $get_fonts[$nimbus_logo_style['face']]['fam']; ?>; color:<?php echo $nimbus_logo_style['color']; ?>;  text-transform:<?php echo $nimbus_logo_style['fonttrans']; ?>;  text-shadow: 1px 1px 0px <?php echo nimbus_get_option('nimbus_logo_text_shadow_color'); ?>; }
        
        <?php 
        
        // set variables if alternate frontpage template
        
        $unique_template = trim(get_post_meta($post->ID, '_wp_page_template', TRUE));
        if (($unique_template == 'alt_frontpage.php') && (trim(get_post_meta( $post->ID, 'full_width_banner_url', true ) != ""))) {
            $nimbus_full_width_banner = get_post_meta( $post->ID, 'full_width_banner_url', true );
        // set variables if front-page   
        } else if ((get_option('page_on_front') == $post->ID) && (trim(nimbus_get_option('nimbus_full_width_banner')) != "")) {
            $nimbus_full_width_banner = nimbus_get_option('nimbus_full_width_banner');
        }
        
        if (nimbus_get_option('nimbus_banner_option') == 'image_full_fixed') {
            // If set to full width fixed banner but no banner is set
            if (empty($nimbus_full_width_banner) && (nimbus_get_option('reminder_images') == "on")) {
            ?>
                header #fixed_banner { background-image: url(<?php echo get_template_directory_uri(); ?>/images/preview/crater-lake.jpg); }
            <?php
            
            // If set to full width fixed banner and banner is set
            } else {
            ?>
                header #fixed_banner { background-image: url(<?php echo $nimbus_full_width_banner; ?>); }
            <?php
            }
        }

        ?>
        
        
        /* Footer */
        
        #footer_row { background:<?php echo nimbus_get_option('nimbus_footer_bg_color'); ?>; } 
        #footer_row > div > div.footer_widgets p, #footer_row > div > div.footer_widgets a, #footer_row > div > div.footer_widgets li { font:<?php echo $nimbus_footer_text_style['style']; ?> <?php echo $nimbus_footer_text_style['size']; ?>/<?php echo $nimbus_footer_text_style['line']; ?> <?php echo $get_fonts[$nimbus_footer_text_style['face']]['fam']; ?>; color:<?php echo $nimbus_footer_text_style['color']; ?>;  text-transform:<?php echo $nimbus_footer_text_style['fonttrans']; ?>; } 
        #credit, #credit a, #copyright, #copyright a { font:<?php echo $nimbus_copyright_style['style']; ?> <?php echo $nimbus_copyright_style['size']; ?>/<?php echo $nimbus_copyright_style['line']; ?> <?php echo $get_fonts[$nimbus_copyright_style['face']]['fam']; ?>; color:<?php echo $nimbus_copyright_style['color']; ?>;  text-transform:<?php echo $nimbus_copyright_style['fonttrans']; ?>; }
        
        /* Menu */
        
        #menu_row { background-color:<?php echo nimbus_get_option('nimbus_menu_bg_color'); ?>; }
        <?php
        if ( is_admin_bar_showing() ) {
        ?>
            header #fixed_banner { background-position: center 28px; }
        <?php 
        }
        ?>
        <?php
        // re-style if menu set to display at top ##Needs Attention
        if (nimbus_get_option('nimbus_menu_location') == 'top') {
        ?>
            @media (min-width: 767px) {
                #menu_row { position: fixed; top: 0px; right: 0px; left: 0px; }
                header { padding-top:40px; }
                header .nimbus_1140_420 { margin: 45px 0 0; }
                header .nimbus_1130_410 { margin: 45px 0 0; }
                #frontpage_featured_row { padding: 50px 0 60px 0; }
            } 
            <?php
            if ( is_admin_bar_showing() ) {
            ?>                    
                header #menu_row { margin-top: 28px; }
                @media (min-width: 767px) {
                    header { padding-top:45px; }
                }
                @media (max-width: 767px) {
                    header { padding-top:60px; }
                }                
            <?php 
            }
            ?>             
        <?php
        }
        ?>
        
        
        .navbar-default .navbar-nav > li > a, .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus, .nav>li>a:hover, .nav>li>a:focus, header #menu_row .container .fallback_cb > ul > li > a { font:<?php echo $nimbus_menu_style['style']; ?> <?php echo $nimbus_menu_style['size']; ?>/<?php echo $nimbus_menu_style['line']; ?> <?php echo $get_fonts[$nimbus_menu_style['face']]['fam']; ?>; color:<?php echo $nimbus_menu_style['color']; ?>!important;  text-transform:<?php echo $nimbus_menu_style['fonttrans']; ?>; }
        .nav .caret, .navbar-default .navbar-nav>.dropdown>a .caret,.navbar-default .navbar-nav>.dropdown>a .caret, .navbar-default .navbar-nav>.dropdown.active>a .caret, .navbar-default .navbar-nav>.open>a .caret, .navbar-default .navbar-nav>.open>a:hover .caret, .navbar-default .navbar-nav>.open>a:focus .caret, .nav a:hover .caret {  border-top-color: <?php echo $nimbus_menu_style['color']; ?>!important; border-bottom-color: <?php echo $nimbus_menu_style['color']; ?>!important; }
        .navbar-default .navbar-nav > li li a, header #menu_row .container .fallback_cb > ul > li > ul > li > a { font:<?php echo $nimbus_sub_menu_style['style']; ?> <?php echo $nimbus_sub_menu_style['size']; ?>/<?php echo $nimbus_sub_menu_style['line']; ?> <?php echo $get_fonts[$nimbus_sub_menu_style['face']]['fam']; ?>; color:<?php echo $nimbus_sub_menu_style['color']; ?>;  text-transform:<?php echo $nimbus_sub_menu_style['fonttrans']; ?>; }
        #menu_row .dropdown-menu, header #menu_row .container .fallback_cb > ul > li > ul  { background-color:<?php echo nimbus_get_option('nimbus_dd_backgound_color'); ?>; -webkit-box-shadow: 0px 0px 35px 0px <?php echo nimbus_get_option('nimbus_dd_box_color'); ?>; -moz-box-shadow: 0px 0px 35px 0px <?php echo nimbus_get_option('nimbus_dd_box_color'); ?>; box-shadow: 0px 0px 35px 0px <?php echo nimbus_get_option('nimbus_dd_box_color'); ?>; }
        .navbar-default .navbar-nav > li li a:hover, header #menu_row .container .fallback_cb > ul > li > ul li a:hover { background-color:<?php echo nimbus_get_option('nimbus_dd_hover_color'); ?>; }
        .navbar-default .navbar-nav > li li, header #menu_row .container .fallback_cb > ul > li > ul li { border-bottom:1px dotted <?php echo nimbus_get_option('nimbus_dd_border_bottom_color'); ?>; }
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus, header #menu_row .container .fallback_cb > ul > li > a:hover { background-color:<?php echo nimbus_get_option('nimbus_menu_hover_color'); ?>; }
        .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus, header #menu_row .container .fallback_cb > ul > li.current_page_item > a { background-color:<?php echo nimbus_get_option('nimbus_menu_active_color'); ?>; }
        .dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus, header #menu_row .container .fallback_cb > ul > li > ul > li.current_page_item a:hover { color:<?php echo $nimbus_sub_menu_style['color']; ?>; background-color:<?php echo nimbus_get_option('nimbus_dd_hover_color'); ?>; }
        .navbar-default .navbar-nav > li > a:hover, header #menu_row .container .fallback_cb > ul > li > a:hover { background-color:<?php echo nimbus_get_option('nimbus_menu_hover_color'); ?>; }
        
        /* Frontpage */
       
        #frontpage_blog_row { background:<?php echo nimbus_get_option('nimbus_fp_blog_bg_color'); ?>; }
        #frontpage_featured_row { background:<?php echo nimbus_get_option('nimbus_fp_featured_content_bg_color'); ?>; }
        #frontpage_content_row { background:<?php echo nimbus_get_option('nimbus_fp_content_bg_color'); ?>; }
        #frontpage_content_row > div > div > .sidebar > div { background:<?php echo nimbus_get_option('nimbus_fp_content_sidebar_bg_color'); ?>; }
        
        /* Blog */ 
        
        p.blog_meta, p.blog_meta a, .taxonomy, .taxonomy a { font:<?php echo $nimbus_blog_meta_line['style']; ?> <?php echo $nimbus_blog_meta_line['size']; ?>/<?php echo $nimbus_blog_meta_line['line']; ?> <?php echo $get_fonts[$nimbus_blog_meta_line['face']]['fam']; ?>; color:<?php echo $nimbus_blog_meta_line['color']; ?>;  text-transform:<?php echo $nimbus_blog_meta_line['fonttrans']; ?>; } 
        .blog_small_wrap { border-bottom:1px <?php echo nimbus_get_option('nimbus_blog_border_type'); ?> <?php echo nimbus_get_option('nimbus_blog_border_color'); ?>; }
        .taxonomy { border-bottom:1px <?php echo nimbus_get_option('nimbus_blog_border_type'); ?> <?php echo nimbus_get_option('nimbus_blog_border_color'); ?>; border-top:1px <?php echo nimbus_get_option('nimbus_blog_border_type'); ?> <?php echo nimbus_get_option('nimbus_blog_border_color'); ?>; }
        .bio_wrap { border:1px <?php echo nimbus_get_option('nimbus_blog_border_type'); ?> <?php echo nimbus_get_option('nimbus_blog_border_color'); ?>; }
        .bio_wrap .col-md-10 p { font:<?php echo $nimbus_author_bio['style']; ?> <?php echo $nimbus_author_bio['size']; ?>/<?php echo $nimbus_author_bio['line']; ?> <?php echo $get_fonts[$nimbus_author_bio['face']]['fam']; ?>; color:<?php echo $nimbus_author_bio['color']; ?>;  text-transform:<?php echo $nimbus_author_bio['fonttrans']; ?>; }
        .wp_link_pages > a > span { color:<?php echo nimbus_get_option('link_color'); ?>; }
        .wp_link_pages > a:hover { border:1px <?php echo nimbus_get_option('nimbus_blog_border_type'); ?> <?php echo nimbus_get_option('nimbus_blog_border_color'); ?>; }
        .comment_wrap { border-bottom:1px <?php echo nimbus_get_option('nimbus_blog_border_type'); ?> <?php echo nimbus_get_option('nimbus_blog_border_color'); ?>; }
        .excerpt { font:<?php echo $nimbus_excerpt_style['style']; ?> <?php echo $nimbus_excerpt_style['size']; ?>/<?php echo $nimbus_excerpt_style['line']; ?> <?php echo $get_fonts[$nimbus_excerpt_style['face']]['fam']; ?>; color:<?php echo $nimbus_excerpt_style['color']; ?>;  text-transform:<?php echo $nimbus_excerpt_style['fonttrans']; ?>; }
       
        /* Odds n Ends */
        
        code, pre, var { font-family:<?php echo $get_fonts[$code_style['face']]['fam']; ?>; color:<?php echo $code_style['color']; ?>; }
        blockquote, div.quote p, div.quote a, blockquote p { font:<?php echo $blockquote_style['style']; ?> <?php echo $blockquote_style['size']; ?>/<?php echo $blockquote_style['line']; ?> <?php echo $get_fonts[$blockquote_style['face']]['fam']; ?>; color:<?php echo $blockquote_style['color']; ?>;  text-transform:<?php echo $blockquote_style['fonttrans']; ?>; font-size: <?php echo $blockquote_style['size']; ?>; font-weight: <?php echo $blockquote_style['style']; ?>; line-height: <?php echo $blockquote_style['line']; ?>; }
        .editable blockquote { border-left:4px solid <?php echo nimbus_get_option('nimbus_blockquote_border_color'); ?>;  }
        .pullquote_left p, .pullquote_right p { font:<?php echo $pullquote_style['style']; ?> <?php echo $pullquote_style['size']; ?>/<?php echo $pullquote_style['line']; ?> <?php echo $get_fonts[$pullquote_style['face']]['fam']; ?>; color:<?php echo $pullquote_style['color']; ?>;  text-transform:<?php echo $pullquote_style['fonttrans']; ?>;  }
        #wp-calendar a { color:<?php echo nimbus_get_option('link_color'); ?>; }
         
        /* Responsive */
        
        @media (max-width: 767px) {
            #ribbon_wrap { background:transparent; }
            <?php
            if ( !is_admin_bar_showing() ) {
            ?>
                body{ padding-top:40px; }
            <?php 
            }
            ?>
        }
        
        /* Custom*/
        
        <?php echo nimbus_get_option('custom_css') ?>
        @media (max-width: 767px) {
        header #menu_row .container .navbar-collapse .navbar-nav > li li a { background-color:<?php echo nimbus_get_option('nimbus_menu_hover_color'); ?>; color:<?php echo $nimbus_menu_style['color']; ?>; }
        .navbar-default .navbar-toggle { background-color:<?php echo nimbus_get_option('nimbus_mobile_dd_toggle_color'); ?>; border-color: <?php echo nimbus_get_option('nimbus_mobile_dd_toggle_border_color'); ?>; }
        .navbar-default .navbar-toggle .icon-bar { background-color:<?php echo nimbus_get_option('nimbus_mobile_dd_toggle_detail_color'); ?>; }

        }
        @media (min-width: 768px) and (max-width: 979px) {

        }
        @media (min-width: 980px)and (max-width: 1200px) {
        <?php if (nimbus_get_option('nimbus_banner_option') == 'image_full_fixed') { ?>
        header #fixed_banner { height:400px; }
        <?php } ?>
        
   
        }
        @media (min-width: 1200px) {
   
        }
        
        <?php echo "\n"; ?> 
    </style>
    <?php
    echo "\n";
}

/* **************************************************************************************************** */
// Optional Scripts
/* **************************************************************************************************** */

add_action('wp_enqueue_scripts', 'nimbus_optional_scripts');

function nimbus_optional_scripts() {

    if (!is_admin()) {

        $scripts_multi = nimbus_get_option('scripts_multicheck');

        if (!empty($scripts_multi['mootools']))  {

            wp_register_script('mootools_g', 'https://ajax.googleapis.com/ajax/libs/mootools/1.4.1/mootools-yui-compressed.js', array(), '1.4.1');
            wp_enqueue_script('mootools_g');
        }

        if (!empty($scripts_multi['prototype']))  {

            wp_register_script('prototype_g', 'https://ajax.googleapis.com/ajax/libs/prototype/1.7.0.0/prototype.js', array(), '1.7.0.0');
            wp_enqueue_script('prototype_g');
        }

        if (!empty($scripts_multi['scriptaculous']))  {

            wp_register_script('scriptaculous_g', 'https://ajax.googleapis.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js', array(), '1.7.0.0');
            wp_enqueue_script('scriptaculous_g');
        }

        
        if (!empty($scripts_multi['dojo']))  {

            wp_register_script('dojo_g', 'https://ajax.googleapis.com/ajax/libs/dojo/1.6.1/dojo/dojo.xd.js.uncompressed.js', array(), '1.7.0.0');
            wp_enqueue_script('dojo_g');
        }
    }
}

/* **************************************************************************************************** */
// WP_head Textarea from Scripts Tab
/* **************************************************************************************************** */

add_action('wp_head', 'nimbus_scripts_to_head');

function nimbus_scripts_to_head() {

    echo nimbus_get_option('scripts_head');
}

/* **************************************************************************************************** */
// WP_footer Textarea from Scripts Tab
/* **************************************************************************************************** */

add_action('wp_footer', 'nimbus_scripts_to_footer');

function nimbus_scripts_to_footer() {

    echo nimbus_get_option('scripts_foot');
}

/* **************************************************************************************************** */
// Scripts Top Content
/* **************************************************************************************************** */

function nimbus_scripts_content_top() {

    echo nimbus_get_option('scripts_top_content');
}

/* **************************************************************************************************** */
// Scripts Bottom Content
/* **************************************************************************************************** */

function nimbus_scripts_content_bottom() {

    echo nimbus_get_option('scripts_bottom_content');
}


