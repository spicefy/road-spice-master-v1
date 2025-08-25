<?php
/**
 * Focus Areas Section Customizer Settings
 * 
 * @package road-spice-master
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function road_spice_focus_areas_customizer($wp_customize) {
    // Add Focus Areas Section
    $wp_customize->add_section('focus_areas_section', array(
        'title'    => __('Focus Areas Section', 'road-spice-master'),
        'priority' => 120,
        'description' => __('Customize the Focus Areas section displayed on the homepage.', 'road-spice-master'),
    ));

    // Default values
    $default_focus_items = array(
        array(
            'icon' => '🚰',
            'text' => 'WATER, SANITATION, & HYGIENE (WASH)',
            'link' => '#wash',
            'title' => 'Water, Sanitation, and Hygiene (WASH)'
        ),
        array(
            'icon' => '🩺',
            'text' => 'HEALTH & WELL-BEING',
            'link' => '#health',
            'title' => 'Health and Well-being'
        ),
        array(
            'icon' => '🍲',
            'text' => 'FOOD SECURITY & LIVELIHOODS',
            'link' => '#food-security',
            'title' => 'Food Security and Livelihoods'
        ),
        array(
            'icon' => '💸',
            'text' => 'ECONOMIC EMPOWERMENT',
            'link' => '#economic-empowerment',
            'title' => 'Economic Empowerment'
        ),
        array(
            'icon' => '📘',
            'text' => 'EDUCATION & VOCATIONAL TRAINING',
            'link' => '#education',
            'title' => 'Education and Vocational Training'
        ),
        array(
            'icon' => '🌍',
            'text' => 'CLIMATE CHANGE ADAPTATION',
            'link' => '#climate',
            'title' => 'Climate Change Adaptation'
        )
    );

    $default_list_items = array(
        array('text' => 'Economic Empowerment', 'link' => '#economic-empowerment'),
        array('text' => 'Education and Vocational Training', 'link' => '#education'),
        array('text' => 'Health and Well-being', 'link' => '#health'),
        array('text' => 'Food Security and Livelihoods', 'link' => '#food-security'),
        array('text' => 'Water, Sanitation, and Hygiene (WASH)', 'link' => '#wash'),
        array('text' => 'Climate Change Adaptation and Natural Resource Management', 'link' => '#climate')
    );

    // Section Title
    $wp_customize->add_setting('focus_areas_title', array(
        'default'           => __('Working Towards Empowering Vulnerable Communities', 'road-spice-master'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('focus_areas_title_control', array(
        'label'       => __('Section Title', 'road-spice-master'),
        'description' => __('The main heading for the Focus Areas section.', 'road-spice-master'),
        'section'     => 'focus_areas_section',
        'settings'    => 'focus_areas_title',
        'type'        => 'text',
    ));

    // Description Paragraph 1
    $wp_customize->add_setting('focus_areas_desc1', array(
        'default'           => __('At <strong>Rights Organization for Advocacy and Development (ROAD)</strong>, we are dedicated to building resilience and improving livelihoods in Kenya and the Horn of Africa. Our sustainable development initiatives empower marginalized communities to create lasting change.', 'road-spice-master'),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('focus_areas_desc1_control', array(
        'label'       => __('Description Paragraph 1', 'road-spice-master'),
        'description' => __('First paragraph of descriptive text.', 'road-spice-master'),
        'section'     => 'focus_areas_section',
        'settings'    => 'focus_areas_desc1',
        'type'       => 'textarea',
    ));

    // Description Paragraph 2
    $wp_customize->add_setting('focus_areas_desc2', array(
        'default'           => __('We focus on high-impact interventions across multiple sectors to address the most pressing needs of vulnerable populations in arid and semi-arid regions.', 'road-spice-master'),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('focus_areas_desc2_control', array(
        'label'       => __('Description Paragraph 2', 'road-spice-master'),
        'description' => __('Second paragraph of descriptive text.', 'road-spice-master'),
        'section'     => 'focus_areas_section',
        'settings'    => 'focus_areas_desc2',
        'type'       => 'textarea',
    ));

    // Central Image
    $wp_customize->add_setting('focus_areas_central_image', array(
        'default'           => get_template_directory_uri() . '/assets/images/road2.png',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'focus_areas_central_image_control', array(
        'label'       => __('Central Image', 'road-spice-master'),
        'description' => __('The main image displayed in the center of the focus areas.', 'road-spice-master'),
        'section'     => 'focus_areas_section',
        'settings'    => 'focus_areas_central_image',
    )));

    // Focus Areas Repeater
    $wp_customize->add_setting('focus_areas_items', array(
    'default'           => wp_json_encode($default_focus_items),
    'sanitize_callback' => 'sanitize_repeater_data',
    'transport'         => 'postMessage',
));


    $wp_customize->add_control(new Skyrocket_Repeater_Control($wp_customize, 'focus_areas_items_control', array(
        'label'       => __('Focus Areas Items', 'road-spice-master'),
        'description' => __('Add and arrange the focus area items that appear around the central image.', 'road-spice-master'),
        'section'     => 'focus_areas_section',
        'settings'    => 'focus_areas_items',
        'row_label'   => array(
            'type'  => 'field',
            'value' => __('Focus Area', 'road-spice-master'),
            'field' => 'text',
        ),
        'fields' => array(
            'icon' => array(
                'type'        => 'text',
                'label'       => __('Icon (emoji or text)', 'road-spice-master'),
                'description' => __('Enter an emoji or icon class.', 'road-spice-master'),
                'default'     => '',
            ),
            'text' => array(
                'type'        => 'text',
                'label'       => __('Text', 'road-spice-master'),
                'description' => __('The text displayed for this focus area.', 'road-spice-master'),
                'default'     => '',
            ),
            'link' => array(
                'type'        => 'text',
                'label'       => __('Link', 'road-spice-master'),
                'description' => __('Where this item should link to.', 'road-spice-master'),
                'default'     => '#',
            ),
            'title' => array(
                'type'        => 'text',
                'label'       => __('Title Attribute', 'road-spice-master'),
                'description' => __('The title/tooltip text shown on hover.', 'road-spice-master'),
                'default'     => '',
            ),
        )
    )));

    // Focus List Items (for the ordered list)
    $wp_customize->add_setting('focus_list_items', array(
    'default'           => wp_json_encode($default_list_items),
    'sanitize_callback' => 'sanitize_repeater_data',
    'transport'         => 'postMessage',
));


    $wp_customize->add_control(new Skyrocket_Repeater_Control($wp_customize, 'focus_list_items_control', array(
        'label'       => __('Focus List Items', 'road-spice-master'),
        'description' => __('Items that appear in the bulleted list section.', 'road-spice-master'),
        'section'     => 'focus_areas_section',
        'settings'    => 'focus_list_items',
        'row_label'   => array(
            'type'  => 'field',
            'value' => __('List Item', 'road-spice-master'),
            'field' => 'text',
        ),
        'fields' => array(
            'text' => array(
                'type'        => 'text',
                'label'       => __('Text', 'road-spice-master'),
                'description' => __('The text displayed for this list item.', 'road-spice-master'),
                'default'     => '',
            ),
            'link' => array(
                'type'        => 'text',
                'label'       => __('Link', 'road-spice-master'),
                'description' => __('Where this item should link to.', 'road-spice-master'),
                'default'     => '#',
            ),
        )
    )));
}

// Sanitize repeater data
function sanitize_repeater_data($input) {
    $input_decoded = json_decode($input, true);
    
    if (!empty($input_decoded)) {
        foreach ($input_decoded as $box_key => $box) {
            foreach ($box as $key => $value) {
                $input_decoded[$box_key][$key] = wp_kses_post(force_balance_tags($value));
            }
        }
        return json_encode($input_decoded);
    }
    
    return $input;
}

add_action('customize_register', 'road_spice_focus_areas_customizer');

// Enqueue scripts for customizer preview
function road_spice_focus_areas_customizer_preview() {
    wp_enqueue_script(
        'road-spice-focus-areas-customizer',
        get_template_directory_uri() . '/assets/js/admin/focus-areas-customizer.js',
        array('jquery', 'customize-preview', 'customize-selective-refresh'),
        filemtime(get_template_directory() . '/assets/js/admin/focus-areas-customizer.js'),
        true
    );
    
    // Localize script with default values
    wp_localize_script('road-spice-focus-areas-customizer', 'focusAreasDefaults', array(
        'centralImage' => get_template_directory_uri() . '/assets/images/road2.png'
    ));
}
add_action('customize_preview_init', 'road_spice_focus_areas_customizer_preview');

// Enqueue admin styles for customizer
function road_spice_focus_areas_admin_styles() {
    wp_enqueue_style(
        'road-spice-focus-areas-admin',
        get_template_directory_uri() . '/assets/css/admin/focus-areas-admin.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/admin/focus-areas-admin.css')
    );
}
add_action('customize_controls_enqueue_scripts', 'road_spice_focus_areas_admin_styles');

// Enqueue frontend styles and scripts
function road_spice_focus_areas_frontend_assets() {
    if (is_page_template('template-focus-areas.php') || is_front_page() || has_block('road-spice/focus-areas')) {
        wp_enqueue_style(
            'road-spice-focus-areas',
            get_template_directory_uri() . '/assets/css/focus-areas.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/focus-areas.css')
        );
        
        wp_enqueue_script(
            'road-spice-focus-areas',
            get_template_directory_uri() . '/assets/js/focus-areas.js',
            array('jquery'),
            filemtime(get_template_directory() . '/assets/js/focus-areas-customizer.js'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'road_spice_focus_areas_frontend_assets');