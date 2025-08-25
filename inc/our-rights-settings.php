<?php
/**
 * Our Rights section customizer settings
 * 
 * @package road-spice-master
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function road_spice_register_our_rights_settings($wp_customize) {
    // Add Our Rights Section
    $wp_customize->add_section('our_rights_section', array(
        'title'    => __('Our Rights Section', 'road-spice-master'),
        'priority' => 120,
    ));

    // Section Title
    $wp_customize->add_setting('our_rights_title', array(
        'default'           => 'Our Rights-Based Approach to Development',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('our_rights_title_control', array(
        'label'    => __('Section Title', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_title',
        'type'     => 'text',
    ));

    // Description Paragraph 1
    $wp_customize->add_setting('our_rights_desc1', array(
        'default'           => 'As our name suggests, we approach development from a rights-based perspective. We believe that all human beings are entitled, without discrimination, to their fundamental human rights - civil, political, social, and cultural. Access to quality and affordable water, sanitation, health services, food, education and other basic needs are fundamental human rights for all.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('our_rights_desc1_control', array(
        'label'    => __('Description Paragraph 1', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_desc1',
        'type'     => 'textarea',
    ));

    // Description Paragraph 2
    $wp_customize->add_setting('our_rights_desc2', array(
        'default'           => 'These rights are recognized in all the key international human rights instruments such as the Universal Declaration of Human Rights; the International Covenant on Civil and Political Rights; the International Covenant on Economic, Social and Cultural Rights; and the African Charter on Human and People\'s Rights. Kenya and the countries in the Horn of Africa are signatories to, and are bound by, these human rights instruments.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('our_rights_desc2_control', array(
        'label'    => __('Description Paragraph 2', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_desc2',
        'type'     => 'textarea',
    ));

    // Button Text
    $wp_customize->add_setting('our_rights_button_text', array(
        'default'           => 'Read More about our Thematic areas',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('our_rights_button_text_control', array(
        'label'    => __('Button Text', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_button_text',
        'type'     => 'text',
    ));

    // Button Link
    $wp_customize->add_setting('our_rights_button_link', array(
        'default'           => './what-we-do.php',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('our_rights_button_link_control', array(
        'label'    => __('Button Link', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_button_link',
        'type'     => 'url',
    ));

    // Top Image
    $wp_customize->add_setting('our_rights_top_image', array(
        'default'           => 'https://road.africa/static/media/road-int.57b356465d7f8e31be02.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'our_rights_top_image_control', array(
        'label'    => __('Top Image', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_top_image',
    )));

    // Top Image Link
    $wp_customize->add_setting('our_rights_top_image_link', array(
        'default'           => 'https://road.africa',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('our_rights_top_image_link_control', array(
        'label'    => __('Top Image Link', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_top_image_link',
        'type'     => 'url',
    ));

    // Top Image Alt Text
    $wp_customize->add_setting('our_rights_top_image_alt', array(
        'default'           => 'Flood-affected household Somalia',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('our_rights_top_image_alt_control', array(
        'label'    => __('Top Image Alt Text', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_top_image_alt',
        'type'     => 'text',
    ));

    // Bottom Image
    $wp_customize->add_setting('our_rights_bottom_image', array(
        'default'           => 'https://road.africa/static/media/Deriswanag.bff0e0a3a9a217d3b61e.jpeg',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'our_rights_bottom_image_control', array(
        'label'    => __('Bottom Image', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_bottom_image',
    )));

    // Bottom Image Link
    $wp_customize->add_setting('our_rights_bottom_image_link', array(
        'default'           => 'https://road.africa',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('our_rights_bottom_image_link_control', array(
        'label'    => __('Bottom Image Link', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_bottom_image_link',
        'type'     => 'url',
    ));

    // Bottom Image Alt Text
    $wp_customize->add_setting('our_rights_bottom_image_alt', array(
        'default'           => 'Flood-affected household Somalia',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('our_rights_bottom_image_alt_control', array(
        'label'    => __('Bottom Image Alt Text', 'road-spice-master'),
        'section'  => 'our_rights_section',
        'settings' => 'our_rights_bottom_image_alt',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'road_spice_register_our_rights_settings');

// Add partial refresh for live preview
function road_spice_our_rights_partial_refresh($wp_customize) {
    // Abort if selective refresh is not available.
    if (!isset($wp_customize->selective_refresh)) {
        return;
    }

    $wp_customize->selective_refresh->add_partial('our_rights_title', array(
        'selector' => '#our-rights .section-title',
        'settings' => array('our_rights_title'),
        'render_callback' => function() {
            return get_theme_mod('our_rights_title');
        },
    ));

    $wp_customize->selective_refresh->add_partial('our_rights_desc1', array(
        'selector' => '#our-rights .section-description:first-of-type',
        'settings' => array('our_rights_desc1'),
        'render_callback' => function() {
            return '<p class="section-description">' . get_theme_mod('our_rights_desc1') . '</p>';
        },
    ));

    $wp_customize->selective_refresh->add_partial('our_rights_desc2', array(
        'selector' => '#our-rights .section-description:nth-of-type(2)',
        'settings' => array('our_rights_desc2'),
        'render_callback' => function() {
            return '<p class="section-description">' . get_theme_mod('our_rights_desc2') . '</p>';
        },
    ));

    $wp_customize->selective_refresh->add_partial('our_rights_button', array(
        'selector' => '#our-rights .btn',
        'settings' => array('our_rights_button_text', 'our_rights_button_link'),
        'render_callback' => function() {
            return '<a href="' . esc_url(get_theme_mod('our_rights_button_link')) . '" class="btn btn-outline-success btn-lg rounded-pill mt-3">' . 
                   esc_html(get_theme_mod('our_rights_button_text')) . '<i class="bi bi-arrow-right ms-2"></i></a>';
        },
    ));
}
add_action('customize_register', 'road_spice_our_rights_partial_refresh');