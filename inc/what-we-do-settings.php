<?php
function road_spice_customize_what_we_do($wp_customize) {
    // Add Section
    $wp_customize->add_section('what_we_do_section', [
        'title'    => __('What We Do Section', 'road-spice-master'),
        'priority' => 30,
    ]);

    // Section visibility toggle
    $wp_customize->add_setting('what_we_do_visible', ['default' => true]);
    $wp_customize->add_control('what_we_do_visible', [
        'label'   => __('Show "What We Do" Section', 'road-spice-master'),
        'section' => 'what_we_do_section',
        'type'    => 'checkbox',
    ]);

    // Gradient Start Color
    $wp_customize->add_setting('what_we_do_gradient_start', [
        'default'           => '#2c2f74',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'what_we_do_gradient_start', [
        'label'   => __('Gradient Start Color', 'road-spice-master'),
        'section' => 'what_we_do_section',
    ]));

    // Gradient End Color
    $wp_customize->add_setting('what_we_do_gradient_end', [
        'default'           => '#1a1c3a',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'what_we_do_gradient_end', [
        'label'   => __('Gradient End Color', 'road-spice-master'),
        'section' => 'what_we_do_section',
    ]));

    // Background Image (optional)
    $wp_customize->add_setting('what_we_do_background_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'what_we_do_background_image', [
        'label'   => __('Background Image', 'road-spice-master'),
        'section' => 'what_we_do_section',
    ]));

    // Section titles
    $wp_customize->add_setting('what_we_do_title', ['default' => 'How We Do It']);
    $wp_customize->add_control('what_we_do_title', [
        'label'   => __('Main Title', 'road-spice-master'),
        'section' => 'what_we_do_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('what_we_do_subtitle', ['default' => 'Working Towards Empowering Vulnerable Communities']);
    $wp_customize->add_control('what_we_do_subtitle', [
        'label'   => __('Subtitle', 'road-spice-master'),
        'section' => 'what_we_do_section',
        'type'    => 'text',
    ]);

    // Font Awesome icon list
    $fa_icons = [
        'fa-solid fa-briefcase'       => 'Briefcase',
        'fa-solid fa-heart'           => 'Heart',
        'fa-solid fa-graduation-cap'  => 'Graduation Cap',
        'fa-solid fa-chart-line'      => 'Chart Line',
        'fa-solid fa-hands-helping'   => 'Helping Hands',
        'fa-solid fa-seedling'        => 'Seedling',
        'fa-solid fa-water'           => 'Water',
        'fa-solid fa-globe-africa'    => 'Globe Africa',
    ];

    // Services
    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting("what_we_do_service_icon_$i", ['default' => 'fa-solid fa-briefcase']);
        $wp_customize->add_control("what_we_do_service_icon_$i", [
            'label'   => __("Service $i Icon", 'road-spice-master'),
            'section' => 'what_we_do_section',
            'type'    => 'select',
            'choices' => $fa_icons,
        ]);

        $wp_customize->add_setting("what_we_do_service_title_$i", ['default' => "Service $i"]);
        $wp_customize->add_control("what_we_do_service_title_$i", [
            'label'   => __("Service $i Title", 'road-spice-master'),
            'section' => 'what_we_do_section',
            'type'    => 'text',
        ]);

        $wp_customize->add_setting("what_we_do_service_desc_$i", ['default' => "Service $i description."]);
        $wp_customize->add_control("what_we_do_service_desc_$i", [
            'label'   => __("Service $i Description", 'road-spice-master'),
            'section' => 'what_we_do_section',
            'type'    => 'textarea',
        ]);
    }

    // Videos (YouTube IDs only)
    for ($v = 1; $v <= 3; $v++) {
        $wp_customize->add_setting("what_we_do_video_id_$v", ['default' => '']);
        $wp_customize->add_control("what_we_do_video_id_$v", [
            'label'   => __("YouTube Video ID $v", 'road-spice-master'),
            'section' => 'what_we_do_section',
            'type'    => 'text',
        ]);
    }
}
add_action('customize_register', 'road_spice_customize_what_we_do');
