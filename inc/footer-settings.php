<?php
/**
 * Footer customizer settings and functions
 * 
 * @package road-spice-master
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// 1.0 Custom Menu Walker for Footer Links
class Footer_Menu_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $output .= '<li><a href="' . esc_url($item->url) . '"><i class="fas fa-arrow-right me-2"></i>' . esc_html($item->title) . '</a></li>';
    }
}

// 2.0 Customizer Options
function road_spice_master_customize_footer($wp_customize) {
    // First add the section
    $wp_customize->add_section('footer_settings', array(
        'title' => __('Footer Settings - ROAD', 'road-spice-master'),
        'priority' => 120,
        'description' => __('Customize the appearance and content of your footer section.', 'road-spice-master'),
    ));

    // Footer Background Color
    $wp_customize->add_setting('footer_background_color', array(
        'default' => '#2c3e50',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'footer_background_color',
        array(
            'label' => __('Footer Background Color', 'road-spice-master'),
            'section' => 'footer_settings',
        )
    ));
    
    // Footer Logo
    $wp_customize->add_setting('footer_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'footer_logo',
        array(
            'label' => __('Footer Logo', 'road-spice-master'),
            'section' => 'footer_settings',
            'description' => __('Upload a logo for your footer section', 'road-spice-master'),
        )
    ));
    
    // Footer Description
    $wp_customize->add_setting('footer_description', array(
        'default' => 'Rights Organization for Advocacy and Development (R.O.A.D) is a non-governmental, non-profit organisation founded and registered in Kenya and Somalia in 2009 and 2012 respectively.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('footer_description', array(
        'label' => __('Footer Description', 'road-spice-master'),
        'section' => 'footer_settings',
        'type' => 'textarea',
    ));
    
    // Social Media URLs
    $social_platforms = array(
        'facebook' => array(
            'label' => 'Facebook URL',
            'icon' => 'facebook-f'
        ),
        'twitter' => array(
            'label' => 'Twitter URL',
            'icon' => 'twitter'
        ),
        'instagram' => array(
            'label' => 'Instagram URL',
            'icon' => 'instagram'
        ),
        'linkedin' => array(
            'label' => 'LinkedIn URL',
            'icon' => 'linkedin-in'
        ),
        'youtube' => array(
            'label' => 'YouTube URL',
            'icon' => 'youtube'
        )
    );
    
    foreach ($social_platforms as $platform => $data) {
        $wp_customize->add_setting($platform . '_url', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control($platform . '_url', array(
            'label' => __($data['label'], 'road-spice-master'),
            'section' => 'footer_settings',
            'type' => 'url',
            'description' => sprintf(__('Enter your %s URL', 'road-spice-master'), $platform),
        ));
    }
    
    // Footer Menu Columns
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('footer_column_' . $i . '_title', array(
            'default' => $i === 1 ? 'Quick Links' : ($i === 2 ? 'Our Programs' : 'Contact Us'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control('footer_column_' . $i . '_title', array(
            'label' => sprintf(__('Column %d Title', 'road-spice-master'), $i),
            'section' => 'footer_settings',
            'type' => 'text',
        ));
    }
    
    // Contact Information
    $contact_fields = array(
        'contact_address' => array(
            'label' => 'Address',
            'icon' => 'map-marker-alt'
        ),
        'contact_phone_1' => array(
            'label' => 'Phone Number 1',
            'icon' => 'phone'
        ),
        'contact_phone_2' => array(
            'label' => 'Phone Number 2',
            'icon' => 'phone'
        ),
        'contact_email' => array(
            'label' => 'Email Address',
            'icon' => 'envelope'
        )
    );
    
    foreach ($contact_fields as $field => $data) {
        $wp_customize->add_setting($field, array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control($field, array(
            'label' => __($data['label'], 'road-spice-master'),
            'section' => 'footer_settings',
            'type' => 'text',
            'description' => sprintf(__('Enter your %s', 'road-spice-master'), strtolower($data['label'])),
        ));
    }
    
    // Legal Links
    $legal_links = array(
        'privacy_policy_url' => 'Privacy Policy URL',
        'terms_of_service_url' => 'Terms of Service URL'
    );
    
    foreach ($legal_links as $link => $label) {
        $wp_customize->add_setting($link, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control($link, array(
            'label' => __($label, 'road-spice-master'),
            'section' => 'footer_settings',
            'type' => 'url',
        ));
    }
    
    // Add selective refresh support
    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('footer_content', array(
            'selector' => '#footer-section',
            'settings' => array(
                'footer_background_color',
                'footer_logo',
                'footer_description',
                // Add other settings that should trigger refresh
            ),
            'render_callback' => function() {
                // This will trigger the entire footer to refresh
                return true;
            }
        ));
    }
}
add_action('customize_register', 'road_spice_master_customize_footer');

// 3.0 Register Footer Menus
function road_spice_master_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'road-spice-master'),
        'footer_column_1' => __('Footer Column 1 (Quick Links)', 'road-spice-master'),
        'footer_column_2' => __('Footer Column 2 (Our Programs)', 'road-spice-master'),
        'footer_column_3' => __('Footer Column 3 (Contact Us)', 'road-spice-master'),
    ));
}
add_action('after_setup_theme', 'road_spice_master_register_menus');

// 4.0 Enqueue Styles and Scripts
function road_spice_master_enqueue_assets() {
 
    // Enqueue Font Awesome with version
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        array(),
        '6.5.0'
    );
    
    // Enqueue theme stylesheet with version
    wp_enqueue_style(
        'road-spice-master-style',
        get_stylesheet_uri(),
        array('bootstrap', 'font-awesome'),
        wp_get_theme()->get('Version')
    );
    
    // Enqueue Bootstrap JS Bundle with dependencies
    wp_enqueue_script(
        'bootstrap-bundle',
        'assets/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.4',
        true
    );
    
    // Enqueue custom JS with dependencies and version
    wp_enqueue_script(
        'road-spice-master-script',
        get_template_directory_uri() . '/assets/js/road-footer-script.js',
        array('jquery', 'bootstrap-bundle'),
        wp_get_theme()->get('Version'),
        true
    );
    
    // Add inline script for dynamic footer updates
    wp_add_inline_script(
        'road-spice-master-script',
        'const roadSpiceData = ' . json_encode(array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('road_spice_nonce')
        )),
        'before'
    );
}
add_action('wp_enqueue_scripts', 'road_spice_master_enqueue_assets');

// 5.0 Enqueue road-footer.css with proper dependencies
function road_spice_master_enqueue_footer_styles() {
    wp_enqueue_style(
        'road-spice-master-footer',
        get_template_directory_uri() . '/assets/css/road-footer.css',
        array('road-spice-master-style'),
        wp_get_theme()->get('Version')
    );
    
    // Add dynamic CSS for footer background color
    $footer_bg_color = get_theme_mod('footer_background_color', '#2c3e50');
    $custom_css = "
        #footer-section {
            background-color: {$footer_bg_color};
        }
    ";
    wp_add_inline_style('road-spice-master-footer', $custom_css);
}
add_action('wp_enqueue_scripts', 'road_spice_master_enqueue_footer_styles');

// 6.0 Customizer Preview JS
function road_spice_master_customize_preview_js() {
    wp_enqueue_script(
        'road-spice-master-customizer',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        array('customize-preview', 'jquery'),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('customize_preview_init', 'road_spice_master_customize_preview_js');