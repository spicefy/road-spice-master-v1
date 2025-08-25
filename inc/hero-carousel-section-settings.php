<?php
/**
 * Hero Carousel Customizer Settings
 * 
 * @package spicefy-theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Hero Carousel section to Customizer
 */
function spicefy_hero_carousel_customize_register($wp_customize) {
    // Add Hero Carousel Section
    $wp_customize->add_section('spicefy_hero_carousel', array(
        'title'    => __('Hero Carousel', 'spicefy-theme'),
        'priority' => 30,
    ));

    // Enable/Disable Carousel
    $wp_customize->add_setting('spicefy_hero_carousel_enable', array(
        'default'           => true,
        'sanitize_callback' => 'spicefy_sanitize_checkbox',
    ));

    $wp_customize->add_control('spicefy_hero_carousel_enable', array(
        'label'    => __('Enable Hero Carousel', 'spicefy-theme'),
        'section'  => 'spicefy_hero_carousel',
        'type'     => 'checkbox',
    ));

    // Carousel Settings
    $wp_customize->add_setting('spicefy_hero_carousel_autoplay', array(
        'default'           => true,
        'sanitize_callback' => 'spicefy_sanitize_checkbox',
    ));

    $wp_customize->add_control('spicefy_hero_carousel_autoplay', array(
        'label'    => __('Enable Autoplay', 'spicefy-theme'),
        'section'  => 'spicefy_hero_carousel',
        'type'     => 'checkbox',
    ));

    $wp_customize->add_setting('spicefy_hero_carousel_interval', array(
        'default'           => 5000,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('spicefy_hero_carousel_interval', array(
        'label'       => __('Autoplay Interval (ms)', 'spicefy-theme'),
        'section'     => 'spicefy_hero_carousel',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1000,
            'max'  => 10000,
            'step' => 500,
        ),
    ));

    // Slide Settings (up to 8 slides)
    for ($i = 1; $i <= 8; $i++) {
        $wp_customize->add_setting("spicefy_hero_carousel_slide_{$i}_enable", array(
            'default'           => ($i <= 3),
            'sanitize_callback' => 'spicefy_sanitize_checkbox',
        ));

        $wp_customize->add_control("spicefy_hero_carousel_slide_{$i}_enable", array(
            'label'    => sprintf(__('Enable Slide %d', 'spicefy-theme'), $i),
            'section'  => 'spicefy_hero_carousel',
            'type'     => 'checkbox',
        ));

        $wp_customize->add_setting("spicefy_hero_carousel_slide_{$i}_bg", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "spicefy_hero_carousel_slide_{$i}_bg", array(
            'label'    => sprintf(__('Slide %d Background Image', 'spicefy-theme'), $i),
            'section'  => 'spicefy_hero_carousel',
        )));

        $wp_customize->add_setting("spicefy_hero_carousel_slide_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control("spicefy_hero_carousel_slide_{$i}_title", array(
            'label'    => sprintf(__('Slide %d Title', 'spicefy-theme'), $i),
            'section'  => 'spicefy_hero_carousel',
            'type'     => 'text',
        ));

        $wp_customize->add_setting("spicefy_hero_carousel_slide_{$i}_text", array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        ));

        $wp_customize->add_control("spicefy_hero_carousel_slide_{$i}_text", array(
            'label'    => sprintf(__('Slide %d Text', 'spicefy-theme'), $i),
            'section'  => 'spicefy_hero_carousel',
            'type'     => 'textarea',
        ));

        $wp_customize->add_setting("spicefy_hero_carousel_slide_{$i}_btn_text", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control("spicefy_hero_carousel_slide_{$i}_btn_text", array(
            'label'    => sprintf(__('Slide %d Button Text', 'spicefy-theme'), $i),
            'section'  => 'spicefy_hero_carousel',
            'type'     => 'text',
        ));

        $wp_customize->add_setting("spicefy_hero_carousel_slide_{$i}_btn_link", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("spicefy_hero_carousel_slide_{$i}_btn_link", array(
            'label'    => sprintf(__('Slide %d Button Link', 'spicefy-theme'), $i),
            'section'  => 'spicefy_hero_carousel',
            'type'     => 'url',
        ));
    }
}
//add_action('customize_register', 'spicefy_hero_carousel_customize_register');

/**
 * Sanitize checkbox values
 
function spicefy_sanitize_checkbox($input) {
    return (isset($input) && true == $input) ? true : false;
}
    */