<?php
/**
 * Website Supported By Section - Customizer Settings
 */

if (!function_exists('road_spice_master_customize_register_supported_by')) {
    function road_spice_master_customize_register_supported_by($wp_customize) {
        // Add Section
        $wp_customize->add_section('road_spice_master_supported_by_section', array(
            'title'    => __('Website Supported By', 'road-spice-master'),
            'priority' => 160,
        ));

        // Left Logo Setting
        $wp_customize->add_setting('supported_by_left_logo', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'supported_by_left_logo', array(
            'label'    => __('Left Logo', 'road-spice-master'),
            'section'  => 'road_spice_master_supported_by_section',
            'settings' => 'supported_by_left_logo',
        )));

        // Left Logo Alt Text
        $wp_customize->add_setting('supported_by_left_alt', array(
            'default'           => __('Ministry of Foreign Affairs', 'road-spice-master'),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('supported_by_left_alt', array(
            'label'    => __('Left Logo Alt Text', 'road-spice-master'),
            'section'  => 'road_spice_master_supported_by_section',
            'type'     => 'text',
        ));

        // Text Content
        $wp_customize->add_setting('supported_by_text', array(
            'default'           => __('Website Development Supported by the DANIDA<br> Sustainability Model Programme (SMP)', 'road-spice-master'),
            'sanitize_callback' => 'wp_kses_post',
        ));

        $wp_customize->add_control('supported_by_text', array(
            'label'    => __('Support Text', 'road-spice-master'),
            'section'  => 'road_spice_master_supported_by_section',
            'type'     => 'textarea',
        ));

        // Right Logo Setting
        $wp_customize->add_setting('supported_by_right_logo', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'supported_by_right_logo', array(
            'label'    => __('Right Logo', 'road-spice-master'),
            'section'  => 'road_spice_master_supported_by_section',
            'settings' => 'supported_by_right_logo',
        )));

        // Right Logo Alt Text
        $wp_customize->add_setting('supported_by_right_alt', array(
            'default'           => __('Refugee Council', 'road-spice-master'),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('supported_by_right_alt', array(
            'label'    => __('Right Logo Alt Text', 'road-spice-master'),
            'section'  => 'road_spice_master_supported_by_section',
            'type'     => 'text',
        ));
    }
    add_action('customize_register', 'road_spice_master_customize_register_supported_by');
}