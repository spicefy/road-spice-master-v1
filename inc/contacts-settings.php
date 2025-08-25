<?php
/**
 * Contact Section Customizer Settings
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function road_spice_contact_customizer($wp_customize) {
    // Add Contact Section Panel
    $wp_customize->add_section('road_spice_contact_section', array(
        'title'    => __('Contact Section', 'road-spice-master'),
        'priority' => 120,
    ));

    // Section Title
    $wp_customize->add_setting('contact_section_title', array(
        'default'           => 'Drop Us A Line',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('contact_section_title', array(
        'label'    => __('Section Title', 'road-spice-master'),
        'section'  => 'road_spice_contact_section',
        'type'     => 'text',
    ));

    // Section Subtitle
    $wp_customize->add_setting('contact_section_subtitle', array(
        'default'           => 'Always There for You',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('contact_section_subtitle', array(
        'label'    => __('Section Subtitle', 'road-spice-master'),
        'section'  => 'road_spice_contact_section',
        'type'     => 'text',
    ));

    // Button Text
    $wp_customize->add_setting('contact_button_text', array(
        'default'           => 'Send Email',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('contact_button_text', array(
        'label'    => __('Button Text', 'road-spice-master'),
        'section'  => 'road_spice_contact_section',
        'type'     => 'text',
    ));

    // Recipient Email
    $wp_customize->add_setting('contact_recipient_email', array(
        'default'           => get_option('admin_email'),
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_recipient_email', array(
        'label'    => __('Recipient Email', 'road-spice-master'),
        'section'  => 'road_spice_contact_section',
        'type'     => 'email',
    ));

    // Contact Options
    $wp_customize->add_setting('contact_options', array(
        'default'           => "inquiry:General Inquiry\nsupport:Support\nfeedback:Feedback\npartnership:Partnership",
        'sanitize_callback' => 'road_spice_sanitize_contact_options',
    ));

    $wp_customize->add_control('contact_options', array(
        'label'    => __('Contact Options (one per line, format: value:label)', 'road-spice-master'),
        'section'  => 'road_spice_contact_section',
        'type'     => 'textarea',
    ));
}

add_action('customize_register', 'road_spice_contact_customizer');

function road_spice_sanitize_contact_options($input) {
    $output = array();
    $lines = explode("\n", $input);
    
    foreach ($lines as $line) {
        $parts = explode(':', $line, 2);
        if (count($parts) === 2) {
            $output[] = sanitize_text_field($parts[0]) . ':' . sanitize_text_field($parts[1]);
        }
    }
    
    return implode("\n", $output);
}

// Process contact form submission
function road_spice_handle_contact_form() {
    if (isset($_POST['road_spice_contact_nonce'])) {
        if (!wp_verify_nonce($_POST['road_spice_contact_nonce'], 'road_spice_contact_action')) {
            wp_die('Security check failed');
        }

        $name = sanitize_text_field($_POST['contact_name']);
        $email = sanitize_email($_POST['contact_email']);
        $phone = sanitize_text_field($_POST['contact_phone']);
        $subject = sanitize_text_field($_POST['contact_subject']);
        $action = sanitize_text_field($_POST['contact_action']);
        $message = sanitize_textarea_field($_POST['contact_message']);

        // Get contact options and find the selected label
        $contact_options = get_theme_mod('contact_options', "inquiry:General Inquiry\nsupport:Support\nfeedback:Feedback\npartnership:Partnership");
        $options = explode("\n", $contact_options);
        $action_label = '';
        
        foreach ($options as $option) {
            list($value, $label) = explode(':', $option, 2);
            if ($value === $action) {
                $action_label = $label;
                break;
            }
        }

        $full_subject = $subject . ' - ' . $action_label;
        $recipient = get_theme_mod('contact_recipient_email', get_option('admin_email'));
        
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $name . ' <' . $email . '>',
            'Reply-To: ' . $name . ' <' . $email . '>'
        );
        
        $email_content = "
            <html>
            <body>
                <h2>New Contact Form Submission</h2>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Phone:</strong> {$phone}</p>
                <p><strong>Subject:</strong> {$subject}</p>
                <p><strong>Action:</strong> {$action_label}</p>
                <p><strong>Message:</strong></p>
                <p>{$message}</p>
            </body>
            </html>
        ";
        
        $sent = wp_mail($recipient, $full_subject, $email_content, $headers);
        
        if ($sent) {
            wp_redirect(add_query_arg('contact_status', 'success', wp_get_referer()));
        } else {
            wp_redirect(add_query_arg('contact_status', 'error', wp_get_referer()));
        }
        
        exit;
    }
}

add_action('admin_post_nopriv_road_spice_contact_form', 'road_spice_handle_contact_form');
add_action('admin_post_road_spice_contact_form', 'road_spice_handle_contact_form');