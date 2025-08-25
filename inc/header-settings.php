<?php
/**
 * Header Customizer Settings
 * 
 * @package road-spice-master
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
function road_customize_register($wp_customize) {
  // Site Identity handled by WordPress core

  // Donate Button
  $wp_customize->add_setting('donate_text', ['default' => 'Donate >>']);
  $wp_customize->add_control('donate_text', ['label' => 'Donate Button Text', 'section' => 'title_tagline', 'type' => 'text']);

  $wp_customize->add_setting('donate_link', ['default' => '#']);
  $wp_customize->add_control('donate_link', ['label' => 'Donate Button Link', 'section' => 'title_tagline', 'type' => 'url']);

  // Utility Bar Contacts
  $wp_customize->add_setting('phone_kenya', ['default' => '072420162']);
  $wp_customize->add_control('phone_kenya', ['label' => 'Kenya Phone Number', 'section' => 'title_tagline', 'type' => 'text']);

  $wp_customize->add_setting('phone_somalia', ['default' => '0724201623']);
  $wp_customize->add_control('phone_somalia', ['label' => 'Somalia Phone Number', 'section' => 'title_tagline', 'type' => 'text']);

  $wp_customize->add_setting('email_contact', ['default' => 'info@road.africa']);
  $wp_customize->add_control('email_contact', ['label' => 'Contact Email', 'section' => 'title_tagline', 'type' => 'email']);

  // Social Links
  foreach (['facebook','twitter','instagram','linkedin','youtube'] as $network) {
    $wp_customize->add_setting("social_{$network}", ['default' => '#']);
    $wp_customize->add_control("social_{$network}", [
      'label' => ucfirst($network) . ' URL',
      'section' => 'title_tagline',
      'type' => 'url'
    ]);
  }

  // Navbar Position
  $wp_customize->add_setting('navbar_position', ['default' => 'sticky-top']);
  $wp_customize->add_control('navbar_position', [
    'label' => 'Navbar Position',
    'section' => 'title_tagline',
    'type' => 'select',
    'choices' => [
      '' => 'Normal',
      'fixed-top' => 'Fixed Top',
      'sticky-top' => 'Sticky Top'
    ]
  ]);
}
add_action('customize_register', 'road_customize_register');
