<?php
/**
 * Impact Stories Display Functionality
 * 
 * @package road-spice-master
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Register shortcode
function road_spice_impact_stories_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 3,
        'category' => '',
        'orderby' => 'date',
        'order' => 'DESC'
    ), $atts);
    
    $args = array(
        'post_type' => 'impact_stories',
        'posts_per_page' => $atts['count'],
        'orderby' => $atts['orderby'],
        'order' => $atts['order']
    );
    
    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'impact_story_category',
                'field' => 'slug',
                'terms' => $atts['category']
            )
        );
    }
    
    $query = new WP_Query($args);
    
    ob_start();
    
    if ($query->have_posts()) : ?>
    <section id="our-impact-stories" class="py-3 py-md-5 bg-success bg-opacity-10">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 mb-md-4">
                <h2 class="section-title mb-3 mb-md-4"><?php _e('Our Impact Stories', 'road-spice-master'); ?></h2>
                <a href="<?php echo get_post_type_archive_link('impact_stories'); ?>" id="view-all-btn" class="btn btn-success mt-2 mt-md-0 view-all-button">
                    <span class="view-all-text"><?php _e('View all', 'road-spice-master'); ?></span>
                    <i class="fa-solid fa-arrow-right ms-2 view-all-arrow"></i>
                </a>
            </div>
            
            <div class="row g-4 px-2 px-md-0">
                <?php while ($query->have_posts()) : $query->the_post(); 
                    $external_url = get_post_meta(get_the_ID(), '_impact_story_external_url', true);
                    $button_text = get_post_meta(get_the_ID(), '_impact_story_button_text', true);
                    $link = !empty($external_url) ? $external_url : get_the_permalink();
                    $btn_text = !empty($button_text) ? $button_text : __('READ MORE', 'road-spice-master');
                ?>
                <div class="col-md-4 col-sm-6 col-12">
                    <a href="<?php echo esc_url($link); ?>" class="text-decoration-none text-dark">
                        <div class="card h-100 border-0 shadow-sm impact-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('large'); ?>" class="card-img-top img-fluid" alt="<?php echo esc_attr(get_the_title()); ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title impact-title"><?php the_title(); ?></h5>
                                <?php if (has_excerpt()) : ?>
                                    <p class="card-text"><?php echo get_the_excerpt(); ?></p>
                                <?php endif; ?>
                                <div class="border-top border-success border-2 my-3 impact-divider"></div>
                                <a href="<?php echo esc_url($link); ?>" class="read-more-btn">
                                    <span><?php echo esc_html($btn_text); ?></span>
                                    <i class="fa-solid fa-arrow-right ms-2 read-more-arrow"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif;
    
    return ob_get_clean();
}
add_shortcode('impact_stories', 'road_spice_impact_stories_shortcode');

// Enqueue necessary assets
function road_spice_impact_stories_assets() {
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // Custom CSS
    wp_enqueue_style('road-spice-impact-stories', get_template_directory_uri() . '/assets/css/impact-stories.css', array(), filemtime(get_template_directory() . '/assets/css/impact-stories.css'));
}
add_action('wp_enqueue_scripts', 'road_spice_impact_stories_assets');
