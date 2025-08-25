<?php
/**
 * Our Impact Stories Customizer Settings
 */

function road_spice_customize_register_impact_stories($wp_customize) {
    // Add Our Impact Stories Section
    $wp_customize->add_section('our_impact_stories_section', array(
        'title'    => __('Our Impact Stories', 'road-spice-master'),
        'priority' => 120,
    ));

    // Section Title
    $wp_customize->add_setting('our_impact_stories_title', array(
        'default'           => 'Our Impact Stories',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('our_impact_stories_title', array(
        'label'    => __('Section Title', 'road-spice-master'),
        'section'  => 'our_impact_stories_section',
        'type'     => 'text',
    ));

    // View All Button Text
    $wp_customize->add_setting('our_impact_stories_view_all_text', array(
        'default'           => 'View all',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('our_impact_stories_view_all_text', array(
        'label'    => __('View All Button Text', 'road-spice-master'),
        'section'  => 'our_impact_stories_section',
        'type'     => 'text',
    ));

    // View All Button Link
    $wp_customize->add_setting('our_impact_stories_view_all_link', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('our_impact_stories_view_all_link', array(
        'label'    => __('View All Button Link', 'road-spice-master'),
        'section'  => 'our_impact_stories_section',
        'type'     => 'url',
    ));

    // Background Color
    $wp_customize->add_setting('our_impact_stories_bg_color', array(
        'default'           => 'bg-success bg-opacity-10',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('our_impact_stories_bg_color', array(
        'label'    => __('Background Color Class', 'road-spice-master'),
        'section'  => 'our_impact_stories_section',
        'type'     => 'text',
        'description' => __('Enter Bootstrap background color classes (e.g., bg-success bg-opacity-10)', 'road-spice-master'),
    ));

    // Add settings for 3 impact stories
    for ($i = 1; $i <= 3; $i++) {
        // Story Title
        $wp_customize->add_setting("our_impact_story_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ));

        $wp_customize->add_control("our_impact_story_{$i}_title", array(
            'label'    => sprintf(__('Story %d Title', 'road-spice-master'), $i),
            'section'  => 'our_impact_stories_section',
            'type'     => 'text',
        ));

        // Story Image
        $wp_customize->add_setting("our_impact_story_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "our_impact_story_{$i}_image",
            array(
                'label'    => sprintf(__('Story %d Image', 'road-spice-master'), $i),
                'section'  => 'our_impact_stories_section',
                'settings' => "our_impact_story_{$i}_image",
            )
        ));

        // Story Link
        $wp_customize->add_setting("our_impact_story_{$i}_link", array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("our_impact_story_{$i}_link", array(
            'label'    => sprintf(__('Story %d Link', 'road-spice-master'), $i),
            'section'  => 'our_impact_stories_section',
            'type'     => 'url',
        ));
    }

    // Live preview for title and button text
    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('our_impact_stories_title', array(
            'selector' => '#our-impact-stories .section-title',
            'render_callback' => function() {
                return get_theme_mod('our_impact_stories_title', 'Our Impact Stories');
            },
        ));

        $wp_customize->selective_refresh->add_partial('our_impact_stories_view_all_text', array(
            'selector' => '#view-all-btn .view-all-text',
            'render_callback' => function() {
                return get_theme_mod('our_impact_stories_view_all_text', 'View all');
            },
        ));
    }
}
add_action('customize_register', 'road_spice_customize_register_impact_stories');

/**
 * Enqueue live preview javascript for the customizer
 */
function road_spice_impact_stories_customizer_live_preview() {
    wp_enqueue_script(
        'road-spice-impact-stories-customizer',
        get_template_directory_uri() . '/js/our-impact-stories-customizer.js',
        array('jquery', 'customize-preview'),
        '',
        true
    );
}
add_action('customize_preview_init', 'road_spice_impact_stories_customizer_live_preview');