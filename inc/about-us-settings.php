<?php
// About Us Section Customizer Settings
function road_spice_about_us_customizer($wp_customize) {
    // Add About Us Section
    $wp_customize->add_section('road_spice_about_us_section', array(
        'title'    => __('About Us Section', 'road-spice-master'),
        'priority' => 30,
    ));

    // Section Title
    $wp_customize->add_setting('road_spice_about_us_title', array(
        'default'           => 'About Us',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('road_spice_about_us_title_control', array(
        'label'    => __('Section Title', 'road-spice-master'),
        'section'  => 'road_spice_about_us_section',
        'settings' => 'road_spice_about_us_title',
        'type'     => 'text',
    ));

    // Description Part 1
    $wp_customize->add_setting('road_spice_about_us_desc1', array(
        'default'           => '<strong>Rights Organization for Advocacy and Development (ROAD)</strong> is an indigenous and community-driven organization dedicated to serving the most marginalized populations.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('road_spice_about_us_desc1_control', array(
        'label'    => __('Description Part 1', 'road-spice-master'),
        'section'  => 'road_spice_about_us_section',
        'settings' => 'road_spice_about_us_desc1',
        'type'     => 'textarea',
    ));

    // Description Part 2
    $wp_customize->add_setting('road_spice_about_us_desc2', array(
        'default'           => 'With two decades of impactful engagement with pastoral communities in North-Eastern Kenya and Southern Somalia, we have grown from a local, volunteer-based entity into a respected national NGO with cross-border programming.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('road_spice_about_us_desc2_control', array(
        'label'    => __('Description Part 2', 'road-spice-master'),
        'section'  => 'road_spice_about_us_section',
        'settings' => 'road_spice_about_us_desc2',
        'type'     => 'textarea',
    ));

    // Button 1 Text
    $wp_customize->add_setting('road_spice_about_us_btn1_text', array(
        'default'           => 'Read More',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('road_spice_about_us_btn1_text_control', array(
        'label'    => __('Primary Button Text', 'road-spice-master'),
        'section'  => 'road_spice_about_us_section',
        'settings' => 'road_spice_about_us_btn1_text',
        'type'     => 'text',
    ));

    // Button 1 Link
    $wp_customize->add_setting('road_spice_about_us_btn1_link', array(
        'default'           => '#about',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('road_spice_about_us_btn1_link_control', array(
        'label'    => __('Primary Button Link', 'road-spice-master'),
        'section'  => 'road_spice_about_us_section',
        'settings' => 'road_spice_about_us_btn1_link',
        'type'     => 'url',
    ));

    // Button 2 Text
    $wp_customize->add_setting('road_spice_about_us_btn2_text', array(
        'default'           => 'Our Impact',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('road_spice_about_us_btn2_text_control', array(
        'label'    => __('Secondary Button Text', 'road-spice-master'),
        'section'  => 'road_spice_about_us_section',
        'settings' => 'road_spice_about_us_btn2_text',
        'type'     => 'text',
    ));

    // Button 2 Link
    $wp_customize->add_setting('road_spice_about_us_btn2_link', array(
        'default'           => '#about',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('road_spice_about_us_btn2_link_control', array(
        'label'    => __('Secondary Button Link', 'road-spice-master'),
        'section'  => 'road_spice_about_us_section',
        'settings' => 'road_spice_about_us_btn2_link',
        'type'     => 'url',
    ));

    // Image Upload
    $wp_customize->add_setting('road_spice_about_us_image', array(
        'default'           => set_url_scheme('https://road.africa/static/media/Picture-1.4e5b88351f096deb4735.jpg', 'https'),
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'road_spice_about_us_image_control',
        array(
            'label'       => __('About Us Image', 'road-spice-master'),
            'section'     => 'road_spice_about_us_section',
            'settings'    => 'road_spice_about_us_image',
            'description' => __('Recommended size: 800x600 pixels', 'road-spice-master'),
        )
    ));

    // Image Link
    $wp_customize->add_setting('road_spice_about_us_image_link', array(
        'default'           => set_url_scheme('https://road.africa', 'https'),
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('road_spice_about_us_image_link_control', array(
        'label'    => __('Image Link URL', 'road-spice-master'),
        'section'  => 'road_spice_about_us_section',
        'settings' => 'road_spice_about_us_image_link',
        'type'     => 'url',
    ));

    // Image Alt Text
    $wp_customize->add_setting('road_spice_about_us_image_alt', array(
        'default'           => 'Flood-affected household Somalia',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('road_spice_about_us_image_alt_control', array(
        'label'    => __('Image Alt Text', 'road-spice-master'),
        'section'  => 'road_spice_about_us_section',
        'settings' => 'road_spice_about_us_image_alt',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'road_spice_about_us_customizer');