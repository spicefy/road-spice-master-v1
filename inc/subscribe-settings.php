<?php
function road_spice_customize_subscribe_section($wp_customize) {

    // Section
    $wp_customize->add_section('subscribe_section', [
        'title'    => __('Subscribe Section', 'road-spice-master'),
        'priority' => 170,
    ]);

    // Background Image
    $wp_customize->add_setting('subscribe_bg_image', [
        'default' => 'https://road.africa/static/media/road-int.57b356465d7f8e31be02.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'subscribe_bg_image', [
        'label'    => __('Background Image', 'road-spice-master'),
        'section'  => 'subscribe_section',
    ]));

    // Title
    $wp_customize->add_setting('subscribe_title', [
        'default' => 'Subscribe for more updates',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('subscribe_title', [
        'label'   => __('Title', 'road-spice-master'),
        'section' => 'subscribe_section',
        'type'    => 'text',
    ]);

    // Description
    $wp_customize->add_setting('subscribe_description', [
        'default' => 'Subscribe to this blog and receive notifications of new posts and updates by email.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('subscribe_description', [
        'label'   => __('Description', 'road-spice-master'),
        'section' => 'subscribe_section',
        'type'    => 'textarea',
    ]);

    // Button Label
    $wp_customize->add_setting('subscribe_button_label', [
        'default' => 'Sign Up »',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('subscribe_button_label', [
        'label'   => __('Button Label', 'road-spice-master'),
        'section' => 'subscribe_section',
        'type'    => 'text',
    ]);

    // Button URL
    $wp_customize->add_setting('subscribe_button_url', [
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('subscribe_button_url', [
        'label'   => __('Button URL', 'road-spice-master'),
        'section' => 'subscribe_section',
        'type'    => 'url',
    ]);
}
add_action('customize_register', 'road_spice_customize_subscribe_section');
