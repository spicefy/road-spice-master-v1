<?php
function roadspice_customize_hero_carousel($wp_customize) {
    $wp_customize->add_section('hero_carousel_section', [
        'title' => __('Hero Carousel - ROAD', 'road-spice-master'),
        'priority' => 30,
    ]);

    for ($i = 1; $i <= 6; $i++) {
        // Image
        $wp_customize->add_setting("hero_slide_image_$i", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "hero_slide_image_$i", [
            'label' => __("Slide $i Image", 'road-spice-master'),
            'section' => 'hero_carousel_section',
            'settings' => "hero_slide_image_$i",
        ]));

        // Title
        $wp_customize->add_setting("hero_slide_title_$i", [
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ]);
        $wp_customize->add_control("hero_slide_title_$i", [
            'label' => __("Slide $i Title", 'road-spice-master'),
            'section' => 'hero_carousel_section',
            'type' => 'text',
        ]);

        // Text
        $wp_customize->add_setting("hero_slide_text_$i", [
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ]);
        $wp_customize->add_control("hero_slide_text_$i", [
            'label' => __("Slide $i Text", 'road-spice-master'),
            'section' => 'hero_carousel_section',
            'type' => 'textarea',
        ]);

        // Button text
        $wp_customize->add_setting("hero_slide_button_$i", [
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage',
        ]);
        $wp_customize->add_control("hero_slide_button_$i", [
            'label' => __("Slide $i Button Text", 'road-spice-master'),
            'section' => 'hero_carousel_section',
            'type' => 'text',
        ]);

        // Button URL
        $wp_customize->add_setting("hero_slide_button_url_$i", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control("hero_slide_button_url_$i", [
            'label' => __("Slide $i Button URL", 'road-spice-master'),
            'section' => 'hero_carousel_section',
            'type' => 'url',
        ]);

        // Credit text
        $wp_customize->add_setting("hero_slide_credit_$i", [
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("hero_slide_credit_$i", [
            'label' => __("Slide $i Credit Text", 'road-spice-master'),
            'section' => 'hero_carousel_section',
            'type' => 'text',
        ]);
    }
}

add_action('customize_register', 'roadspice_customize_hero_carousel');
// enque css
function roadspice_enqueue_scripts() {
    wp_enqueue_style('roadspice-hero-carousel', get_template_directory_uri() . '/assets/css/hero-carousel.css', [], null);
}
add_action('wp_enqueue_scripts', 'roadspice_enqueue_scripts');
