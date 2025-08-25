<?php
/**
 * Template Name: Thematic Section Page
 * Description: Template for displaying a thematic section via shortcode, with dynamic ID.
 */

get_template_part('template-parts/header');

$thematic_section_id = get_post_meta(get_the_ID(), 'thematic_section_id', true);
if ($thematic_section_id) {
    echo do_shortcode('[thematic_section id="' . esc_attr($thematic_section_id) . '"]');
} else {
    echo '<p style="color:red;">No Thematic Section ID specified for this page.</p>';
}

get_template_part('template-parts/subscribe-section');
//get_template_part('template-parts/sponsors-section');
get_template_part('template-parts/discover-section');
get_footer();
?>