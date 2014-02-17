<?php
/**
 * pictorial Theme Customizer
 *
 * @package pictorial
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pictorial_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->add_section( 'pictorial_general_options' , array(
       'title'      => __('Sitewide General Options','pictorial'),
       'priority'   => 30,
    ) );
	
	$wp_customize->add_section( 'pictorial_home_intro_options' , array(
    'title'      => __('Home Intro Options','pictorial'),
    'priority'   => 32,
   ) );
	
	// Setting group for social icons
    $wp_customize->add_section( 'pictorial_social_options' , array(
		'title'      => __('Social Options','pictorial'),
		'priority'   => 33,
    ) );
	
	// Begin Sitewide General Settings
	//  Logo Image Upload
    $wp_customize->add_setting('pictorial_logo_image', array(
        'default-image'  => '',
		'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'pictorial_logo_image', array(
        'label'    => __('Header Logo Image', 'pictorial'),
        'section'  => 'title_tagline',
		'priority' => 1,
        'settings' => 'pictorial_logo_image',
    )));
	
	$wp_customize->add_setting(
        'pictorial_tagline_visibility'
    );

    $wp_customize->add_control(
        'pictorial_tagline_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Show Tagline below Site Title/Logo?', 'pictorial'),
        'section'  => 'title_tagline',
		'priority' => 99,
        )
    );
	
	$wp_customize->add_setting(
		'pictorial_page_title_visibility'
    );

    $wp_customize->add_control(
		'pictorial_page_title_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide Title On Pages?', 'pictorial'),
        'section'  => 'pictorial_general_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
		'pictorial_feed_title_visibility'
    );

    $wp_customize->add_control(
		'pictorial_feed_title_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide the "latest Posts" title?', 'pictorial'),
        'section'  => 'pictorial_general_options',
		'priority' => 2,
        )
    );
	
	$wp_customize->add_setting(
    'pictorial_feed_title',
    array(
        'default' => 'Latest Posts',
		'sanitize_callback' => 'sanitize_text_field'
    ));
	
	$wp_customize->add_control(
    'pictorial_feed_title',
    array(
        'label'     => __('Enter Custom Feed Title', 'pictorial'),
        'section'   => 'pictorial_general_options',
		'priority'  => 3,
        'type'      => 'text',
    ));
	
	$wp_customize->add_setting(
		'pictorial_attachment_commentform_visibility'
    );

    $wp_customize->add_control(
		'pictorial_attachment_commentform_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide Comment Form on the Attachment page', 'pictorial'),
        'section'  => 'pictorial_general_options',
		'priority' => 4,
        )
    );
	
	// Begin Home Intro Settings
	$wp_customize->add_setting(
        'pictorial_home_intro_visibility'
    );

    $wp_customize->add_control(
        'pictorial_home_intro_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide the home page intro section?', 'pictorial'),
        'section'  => 'pictorial_home_intro_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
    'pictorial_intro_title_visibility'
    );

    $wp_customize->add_control(
    'pictorial_intro_title_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide Intro Title?', 'pictorial'),
        'section'  => 'pictorial_home_intro_options',
		'priority' => 2,
        )
    );
	
	$wp_customize->add_setting(
    'pictorial_intro_title',
    array(
        'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
    ));
	
	$wp_customize->add_control(
    'pictorial_intro_title',
    array(
        'label'     => __('Enter Intro Title here - make it short & catchy!', 'pictorial'),
        'section'   => 'pictorial_home_intro_options',
		'priority'  => 3,
        'type'      => 'text',
    ));
	
	/**
       * Adds textarea support to the theme customizer
    */
    class Pictorial_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';
 
            public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
        }
    }
	
	$wp_customize->add_setting( 
	    'pictorial_intro_text'
    );		

    $wp_customize->add_control(
        new Pictorial_Customize_Textarea_Control(
            $wp_customize,
            'pictorial_intro_text',
        array(
            'label' => 'Home Intro Text',
            'section' => 'pictorial_home_intro_options',
			'priority'  => 4,
            'settings' => 'pictorial_intro_text',
        )
        )
    );
	
	$wp_customize->add_setting(
    'pictorial_intro_button_visibility'
    );

    $wp_customize->add_control(
    'pictorial_intro_button_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide CTA Buttons?', 'pictorial'),
        'section'  => 'pictorial_home_intro_options',
		'priority' => 5,
        )
    );
		
	$wp_customize->add_setting(
        'pictorial_intro_learn_button_text',
    array(
        'default' => __('Learn more', 'pictorial'),
		'sanitize_callback' => 'sanitize_text_field'
    ));
	
	$wp_customize->add_control(
        'pictorial_intro_learn_button_text',
    array(
        'label'     => __('Home Intro Button Text', 'pictorial'),
        'section'   => 'pictorial_home_intro_options',
		'priority'  => 6,
        'type'      => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_intro_learn_button_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_intro_learn_button_url',
    array(
        'label'    => __('Home Intro Learn Button Link', 'pictorial'),
        'section'  => 'pictorial_home_intro_options',
		'priority' => 7,
        'type'     => 'text',
    ));
	
	$wp_customize->add_setting( 'pictorial_learn_button_url_target', array(
		'default' => '_self',
	) );
	
	$wp_customize->add_control( 'pictorial_learn_button_url_target', array(
    'label'   => __( 'Learn More Url Window Target', 'pictorial' ),
    'section' => 'pictorial_home_intro_options',
	'priority' => 8,
    'type'    => 'radio',
        'choices' => array(
            '_self'  => __( 'Open Link In Same Tab', 'pictorial' ),
			'_blank'   => __( 'Open Link In New Tab', 'pictorial' ),
        ),
    ));
	
	$wp_customize->add_setting(
    'pictorial_intro_signup_button_text',
    array(
        'default' => __('Sign Up', 'pictorial'),
		'sanitize_callback' => 'sanitize_text_field'
    ));
	
	$wp_customize->add_control(
    'pictorial_intro_signup_button_text',
    array(
        'label'     => __('Home Intro Signup Button Text', 'pictorial'),
        'section'   => 'pictorial_home_intro_options',
		'priority'  => 9,
        'type'      => 'text',
    ));
	
	$wp_customize->add_setting(
    'pictorial_intro_signup_button_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
    'pictorial_intro_signup_button_url',
    array(
        'label'    => __('Home Intro Signup Button Link', 'pictorial'),
        'section'  => 'pictorial_home_intro_options',
		'priority' => 10,
        'type'     => 'text',
    ));
	
	$wp_customize->add_setting( 'pictorial_signup_button_url_target', array(
		'default' => '_self',
	) );
	
	$wp_customize->add_control( 'pictorial_signup_button_url_target', array(
    'label'   => __( 'Sign Up Url Window Target', 'pictorial' ),
    'section' => 'pictorial_home_intro_options',
	'priority' => 11,
    'type'    => 'radio',
        'choices' => array(
            '_self'  => __( 'Open Link In Same Tab', 'pictorial' ),
			'_blank'   => __( 'Open Link In New Tab', 'pictorial' ),
        ),
    ));
		
	// == Social Links Icons Section == //
    // Begin Social Icons	
	$wp_customize->add_setting(
        'pictorial_header_social_visibility'
    );

    $wp_customize->add_control(
        'pictorial_header_social_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Show Header Social Icons?','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
        'pictorial_sidebar_social_visibility'
    );

    $wp_customize->add_control(
        'pictorial_sidebar_social_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Show Sidebar Social Icons?','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 2,
        )
    );
	$wp_customize->add_setting(
        'pictorial_sidebar_social_title',
    array(
		'default' => 'Connect With Us',
		'sanitize_callback' => 'sanitize_text_field'
    ));
	
	$wp_customize->add_control(
        'pictorial_sidebar_social_title',
    array(
        'label' => __('Sidebar Social Title','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 3,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_facebook_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_facebook_url',
    array(
        'label' => __('Facebook URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 4,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_gplus_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_gplus_url',
    array(
        'label' => __('Google+ URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 5,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_twitter_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_twitter_url',
    array(
        'label' => __('Twitter URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 6,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_pinterest_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_pinterest_url',
    array(
        'label' => __('Pinterest URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 7,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_instagram_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_instagram_url',
    array(
        'label' => __('Instagram URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 8,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_linkedin_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_linkedin_url',
    array(
        'label' => __('LinkedIn URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 9,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_youtube_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_youtube_url',
    array(
        'label' => __('YouTube URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 10,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_flicker_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_flicker_url',
    array(
        'label' => __('Flicker URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 11,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_wordpress_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_wordpress_url',
    array(
        'label' => __('WordPress URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 12,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_github_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
        'pictorial_github_url',
    array(
        'label' => __('GitHub URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 13,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'pictorial_dribbble_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
		'pictorial_dribbble_url',
    array(
        'label' => __('Dribbble URL','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 14,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
		'pictorial_rss_url'
    );

    $wp_customize->add_control(
		'pictorial_rss_url',
    array(
        'type' => 'checkbox',
        'label' => __('Use Default RSS Feed url?', 'pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 15,
        )
    );
	
	$wp_customize->add_setting(
		'pictorial_custom_rss_url',
    array(
        'default' => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
	
	$wp_customize->add_control(
		'pictorial_custom_rss_url',
    array(
        'label' => __('Alternative Custom RSS Feed URL - leave blank if above default url checked!','pictorial'),
        'section' => 'pictorial_social_options',
		'priority' => 16,
        'type' => 'text',
    ));
}
add_action( 'customize_register', 'pictorial_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pictorial_customize_preview_js() {
	wp_enqueue_script( 'pictorial_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'pictorial_customize_preview_js' );
