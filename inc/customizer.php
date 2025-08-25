<?php
/**
 * AMT-Spice Customizer functionality
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}




function amt_spice_customize_register($wp_customize) {


// Add section for Navigation Settings
$wp_customize->add_section( 'nav_typography_section', array(
    'title'       => __( 'Navigation Typography', 'amt-spice' ),
    'priority'    => 30,
    'description' => __( 'Change font size for the navigation menu.', 'amt-spice' ),
) );

// Add setting for Nav Font Size
$wp_customize->add_setting( 'nav_font_size', array(
    'default'           => '16px',
    'sanitize_callback' => 'sanitize_text_field',
) );

// Add control for Nav Font Size
$wp_customize->add_control( 'nav_font_size_control', array(
    'label'    => __( 'Navigation Font Size (e.g., 16px, 1em)', 'amt-spice' ),
    'section'  => 'nav_typography_section',
    'settings' => 'nav_font_size',
    'type'     => 'text',
) );

// Font Weight Setting
$wp_customize->add_setting( 'nav_font_weight', array(
    'default'           => '400',
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'nav_font_weight_control', array(
    'label'    => __( 'Navigation Font Weight (e.g., 400, 700, bold)', 'amt-spice' ),
    'section'  => 'nav_typography_section',
    'settings' => 'nav_font_weight',
    'type'     => 'text',
) );

    //page header



    $wp_customize->add_section('custom_page_header_section', array(
        'title' => __('Page Header Settings', 'amt-spice'),
        'priority' => 30,
    ));

    // Background Color
    $wp_customize->add_setting('page_header_bg_color', array(
        'default' => '#2c3e50',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'page_header_bg_color', array(
        'label' => __('Background Color', 'amt-spice'),
        'section' => 'custom_page_header_section',
        'settings' => 'page_header_bg_color',
    )));

    // Text Color
    $wp_customize->add_setting('page_header_text_color', array(
        'default' => '#ffffff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'page_header_text_color', array(
        'label' => __('Text Color', 'amt-spice'),
        'section' => 'custom_page_header_section',
        'settings' => 'page_header_text_color',
    )));

    // Padding
    $wp_customize->add_setting('page_header_padding', array(
        'default' => '40px',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('page_header_padding', array(
        'label' => __('Header Padding', 'amt-spice'),
        'section' => 'custom_page_header_section',
        'settings' => 'page_header_padding',
        'type' => 'text',
    ));

    $wp_customize->add_setting('page_header_image_max_height', array(
        'default' => '300px',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('page_header_image_max_height', array(
        'label' => __('Featured Image Max Height (e.g. 300px)', 'amt-spice'),
        'section' => 'custom_page_header_section',
        'type' => 'text',
    ));

    // Add Theme Options Panel
    $wp_customize->add_panel('amt_theme_options', array(
        'title' => __('AMT-Spice Theme Options', 'amt-spice'),
        'priority' => 1,
    ));
    
    // Header Section
    $wp_customize->add_section('amt_header', array(
        'title' => __('Header Settings', 'amt-spice'),
        'panel' => 'amt_theme_options',
        'priority' => 10,
    ));
    
    // Setting for Page Title
    $wp_customize->add_setting('demography_page_title', array(
        'default'   => 'LOVEMATTERS AFRICA',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('demography_page_title_control', array(
        'label'    => __('Page Title', 'amt-spice'),
        'section'  => 'demography_page_section',
        'settings' => 'demography_page_title',
        'type'     => 'text',
    ));

    // Setting for Page Description
    $wp_customize->add_setting('demography_page_description', array(
        'default'   => 'Blush-free facts and stories about love, sex, and relationships',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('demography_page_description_control', array(
        'label'    => __('Page Description', 'amt-spice'),
        'section'  => 'demography_page_section',
        'settings' => 'demography_page_description',
        'type'     => 'textarea',
    ));

    // Setting for Primary Audience Description
    $wp_customize->add_setting('primary_audience_description', array(
        'default'   => 'Young people 18-35 years old in all their diversity.',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('primary_audience_description_control', array(
        'label'    => __('Primary Audience Description', 'amt-spice'),
        'section'  => 'demography_page_section',
        'settings' => 'primary_audience_description',
        'type'     => 'textarea',
    ));

    // Setting for Secondary Audience Description
    $wp_customize->add_setting('secondary_audience_description', array(
        'default'   => 'Parents, guardians, and key decision-makers.',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('secondary_audience_description_control', array(
        'label'    => __('Secondary Audience Description', 'amt-spice'),
        'section'  => 'demography_page_section',
        'settings' => 'secondary_audience_description',
        'type'     => 'textarea',
    ));

    

	// Add Control for Navbar Position
$wp_customize->add_control('navbar_position', [
    'label' => __('Navbar Position', 'amt_spice'),
    'section' => 'colors', // or create your own section if you prefer
    'type' => 'select',
    'choices' => [
        'normal' => __('Normal', 'amt_spice'),
        'fixed-top' => __('Fixed Top', 'amt_spice'),
		'sticky-top' => __('Sticky Top', 'amt_spice'),
    ],
]);
}

// In inc/customizer.php

  

        
// new page with customizer start
// new-page-with-sidebar.php

if (!function_exists('amt_customize_register')) :
function amt_customize_register($wp_customize) {
    // Create a new section in the Customizer
    $wp_customize->add_section('amt_theme_options', array(
        'title'    => __('Theme Options', 'amt-spice'),
        'priority' => 30,
    ));

    // Default Header Image
    $wp_customize->add_setting('amt_page_header_image', array(
        'default' => get_template_directory_uri() . '/assets/images/default-header.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'amt_page_header_image',
        array(
            'label'    => __('Default Header Image', 'amt-spice'),
            'section'  => 'amt_theme_options',
            'settings' => 'amt_page_header_image'
        )
    ));

    // Default Sidebar Title
    $wp_customize->add_setting('amt_default_sidebar_title', array(
        'default' => 'About Us',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('amt_default_sidebar_title', array(
        'label'    => __('Default Sidebar Title', 'amt-spice'),
        'section'  => 'amt_theme_options',
        'type'     => 'text',
    ));
}
endif;
add_action('customize_register', 'amt_customize_register');
    
// END new page with customizer
