<?php
// enqueue-styles-scripts.php

// Enqueue styles
function road_spice_master_enqueue_styles() {
    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style('discover', get_template_directory_uri() . '/assets/css/discover.css', array(), $theme_version);
    wp_enqueue_style('style8', get_template_directory_uri() . '/assets/css/styles.css', array(), $theme_version);
    wp_enqueue_style('latest-projects-carousel', get_template_directory_uri() . '/assets/css/latest-projects-carousel.css', array(), $theme_version);
    wp_enqueue_style('focus-area', get_template_directory_uri() . '/assets/css/focus-area.css', array(), $theme_version);
    
    wp_enqueue_style('donation1', get_template_directory_uri() . '/assets/css/donation1.css', array(), $theme_version);
    wp_enqueue_style('impact-counter', get_template_directory_uri() . '/assets/css/impact-counter.css', array(), $theme_version);
    wp_enqueue_style('thematic-areas-hero-image', get_template_directory_uri() . '/assets/css/thematic-areas-hero-image.css', array(), $theme_version);
}
add_action('wp_enqueue_scripts', 'road_spice_master_enqueue_styles');


// ==Start===Enqueue scripts==========road-menu-toggler.js
function road_spice_master_enqueue_scripts() {
    wp_enqueue_script(
        'road-menu-toggler',
        get_template_directory_uri() . '/assets/js/road-menu-toggler.js',
        array(), // Add 'jquery' if needed
        filemtime(get_template_directory() . '/assets/js/road-menu-toggler.js'),
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'road_spice_master_enqueue_scripts');
// == End==Enqueue scripts==========road-menu-toggler.js