<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}

function road_spice_master_customize_mobile_menu($wp_customize) {
  $wp_customize->add_setting('custom_blog_name', [
    'default' => '',
    'transport' => 'refresh',
  ]);

  $wp_customize->add_control('custom_blog_name', [
    'label' => __('Custom Blog Name', 'road-spice-master'),
    'section' => 'title_tagline',
    'type' => 'text',
  ]);
}
add_action('customize_register', 'road_spice_master_customize_mobile_menu');
