<?php
/**
 * Discover Section Customizer Settings
 * 
 * @package road-spice-master
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Add Discover section to the WordPress Customizer
 */
function road_spice_discover_customizer($wp_customize) {
    // Add Discover Section Panel
    $wp_customize->add_section('road_spice_discover_section', array(
        'title'    => __('Discover Section - ROAD', 'road-spice-master'),
        'priority' => 120,
    ));

    // Section Title
    $wp_customize->add_setting('discover_section_title', array(
        'default'           => 'Discover Our Organization',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('discover_section_title_control', array(
        'label'    => __('Section Title', 'road-spice-master'),
        'section'  => 'road_spice_discover_section',
        'settings' => 'discover_section_title',
        'type'     => 'text',
    ));

    // Button Settings (4 buttons)
    for ($i = 1; $i <= 4; $i++) {
        // Button Text
        $wp_customize->add_setting("discover_button_{$i}_text", array(
            'default'           => $i == 1 ? 'Meet our Beneficiaries' : 
                                  ($i == 2 ? 'Why ROAD Africa?' : 
                                  ($i == 3 ? 'Videos' : 'Get Involved')),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ));

        $wp_customize->add_control("discover_button_{$i}_text_control", array(
            'label'    => sprintf(__('Button %d Text', 'road-spice-master'), $i),
            'section'  => 'road_spice_discover_section',
            'settings' => "discover_button_{$i}_text",
            'type'     => 'text',
        ));

        // Button Link
        $wp_customize->add_setting("discover_button_{$i}_link", array(
            'default'           => $i == 1 ? '#beneficiaries' : 
                                  ($i == 2 ? '#why-road-africa' : 
                                  ($i == 3 ? '#videos' : '#get-involved')),
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        ));

        $wp_customize->add_control("discover_button_{$i}_link_control", array(
            'label'    => sprintf(__('Button %d Link', 'road-spice-master'), $i),
            'section'  => 'road_spice_discover_section',
            'settings' => "discover_button_{$i}_link",
            'type'     => 'text',
        ));
    }
}
add_action('customize_register', 'road_spice_discover_customizer');

/**
 * Live preview for Discover section
 */
function road_spice_discover_live_preview() {
    wp_enqueue_script(
        'road-spice-discover-customizer',
        get_template_directory_uri() . '/assets/js/discover-customizer.js',
        array('jquery', 'customize-preview'),
        '',
        true
    );
}
add_action('customize_preview_init', 'road_spice_discover_live_preview');

// ========Start ==enqueue discover section CSS discover-section.css
/**
 * Enqueue Discover Section CSS
 */
function road_spice_enqueue_discover_styles() {
    // Register and enqueue discover-section.css
    wp_register_style(
        'road-spice-discover-section',
        get_template_directory_uri() . '/assets/css/discover-section.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/discover-section.css') // Version based on file modification time
    );
    
    // Only enqueue on pages where the section appears
    if (is_front_page() || is_page_template('template-with-discover.php')) {
        wp_enqueue_style('road-spice-discover-section');
    }
}
add_action('wp_enqueue_scripts', 'road_spice_enqueue_discover_styles');
// ========End ==enqueue discover section CSS discover-section.css