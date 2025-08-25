<?php
/**
 * AMT-Spice functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define theme version
define('AMT_SPICE_VERSION', '1.0.0');
function mytheme_widgets_init() {
    register_sidebar( array(
      'name'          => __( 'Blog Sidebar', 'mytheme' ),
      'id'            => 'blog-sidebar',
      'description'   => __( 'Widgets in this area will be shown on the blog sidebar.', 'mytheme' ),
      'before_widget' => '<div id="%1$s" class="widget %2$s card card-body mb-4">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3 class="h5 widget-title">',
      'after_title'   => '</h3>',
    ) );
  }
  add_action( 'widgets_init', 'mytheme_widgets_init' );

  class Custom_Search_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'custom_search_widget',
            __('Styled Search Form', 'textdomain'),
            array('description' => __('A custom styled blog search form.', 'textdomain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        ?>
        <form role="search" method="get" class="input-group mb-4" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text"
                   class="form-control rounded pe-5"
                   placeholder="<?php esc_attr_e('Search the blog...', 'textdomain'); ?>"
                   value="<?php echo get_search_query(); ?>"
                   name="s">
            <i class="bx bx-search position-absolute top-50 end-0 translate-middle-y me-3 fs-lg zindex-5"></i>
        </form>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        // No options needed
        echo '<p>' . __('Displays a styled search bar.', 'textdomain') . '</p>';
    }

    public function update($new_instance, $old_instance) {
        return [];
    }
}

function register_custom_search_widget() {
    register_widget('Custom_Search_Widget');
}
add_action('widgets_init', 'register_custom_search_widget');
  class Custom_Popular_Posts_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'custom_popular_posts_widget',
            __('Styled Popular Posts', 'textdomain'),
            array('description' => __('Displays popular posts using custom Bootstrap styling.', 'textdomain'))
        );
    }

    public function widget($args, $instance) {
        $title  = apply_filters('widget_title', $instance['title']);
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;

        echo $args['before_widget'];
        ?>
       
            <span class="position-absolute top-0 start-0 w-100 h-100 .bg-gradient-secondary opacity-10 rounded-3"></span>
            <div class="position-relative zindex-2">
                <?php if (!empty($title)) : ?>
                    <h3 class="h5"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>
                <ul class="list-unstyled mb-0">
                    <?php
                    $popular_posts = new WP_Query(array(
                        'posts_per_page' => $number,
                        'orderby'        => 'comment_count',
                        'order'          => 'DESC',
                        'post_status'    => 'publish',
                    ));

                    if ($popular_posts->have_posts()) :
                        while ($popular_posts->have_posts()) : $popular_posts->the_post();
                            $post_id = get_the_ID();
                            $likes = get_post_meta($post_id, 'post_likes', true);
                            $shares = get_post_meta($post_id, 'post_shares', true);
                            ?>
                            <li class="border-bottom pb-3 mb-3">
                                <h4 class="h6 mb-2">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                <div class="d-flex align-items-center text-muted pt-1">
                                    <div class="fs-xs border-end pe-3 me-3">
                                        <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                    </div>
                                    <div class="d-flex align-items-center me-3">
                                        <i class="bx bx-like fs-base me-1"></i>
                                        <span class="fs-xs"><?php echo $likes ? esc_html($likes) : 0; ?></span>
                                    </div>
                                    <div class="d-flex align-items-center me-3">
                                        <i class="bx bx-comment fs-base me-1"></i>
                                        <span class="fs-xs"><?php echo get_comments_number(); ?></span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-share-alt fs-base me-1"></i>
                                        <span class="fs-xs"><?php echo $shares ? esc_html($shares) : 0; ?></span>
                                    </div>
                                </div>
                            </li>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<li>' . __('No popular posts found.', 'textdomain') . '</li>';
                    endif;
                    ?>
                </ul>
            </div>
        
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title  = !empty($instance['title']) ? $instance['title'] : __('Popular posts', 'textdomain');
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_attr_e('Title:', 'textdomain'); ?>
            </label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
                <?php esc_attr_e('Number of posts to show:', 'textdomain'); ?>
            </label>
            <input class="tiny-text"
                   id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>"
                   type="number"
                   step="1"
                   min="1"
                   value="<?php echo esc_attr($number); ?>"
                   size="3">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        return [
            'title'  => sanitize_text_field($new_instance['title']),
            'number' => absint($new_instance['number']),
        ];
    }
}

function register_custom_popular_posts_widget() {
    register_widget('Custom_Popular_Posts_Widget');
}
add_action('widgets_init', 'register_custom_popular_posts_widget');


  class Custom_Categories_List_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'custom_categories_list_widget',
            __('Styled Categories List', 'textdomain'),
            array('description' => __('Displays categories in a styled Bootstrap card.', 'textdomain'))
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];
        ?>
        
            <?php if (!empty($title)) : ?>
                <h3 class="h5"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>

            <ul class="nav flex-column fs-sm">
                <li class="nav-item mb-1">
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="nav-link py-1 px-0 active">
                        All topics <span class="fw-normal opacity-60 ms-1">(<?php echo wp_count_posts()->publish; ?>)</span>
                    </a>
                </li>
                <?php
                $categories = get_categories(array(
                    'orderby' => 'name',
                    'order'   => 'ASC',
                ));
                foreach ($categories as $category) {
                    $cat_link = get_category_link($category->term_id);
                    $cat_name = esc_html($category->name);
                    $cat_count = $category->count;
                    ?>
                    <li class="nav-item mb-1">
                        <a href="<?php echo esc_url($cat_link); ?>" class="nav-link py-1 px-0">
                            <?php echo $cat_name; ?>
                            <span class="fw-normal opacity-60 ms-1">(<?php echo $cat_count; ?>)</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Categories', 'textdomain');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'textdomain'); ?></label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance          = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }
}

function register_custom_categories_list_widget() {
    register_widget('Custom_Categories_List_Widget');
}
add_action('widgets_init', 'register_custom_categories_list_widget');







function custom_comments_display($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; // Get the global comment object
  
    // Start the comment container (wraps each individual comment in a div)
    echo '<div class="py-4">';
    
    // Display comment's avatar and author info
    echo '<div class="d-flex align-items-center justify-content-between pb-2 mb-1">';
    echo '<div class="d-flex align-items-center me-3">';
    echo get_avatar($comment, 48, '', '', ['class' => 'rounded-circle']);
    echo '<div class="ps-3">';
    echo '<h6 class="fw-semibold mb-0">' . get_comment_author() . '</h6>';
    echo '<span class="fs-sm text-muted">' . get_comment_date() . ' at ' . get_comment_time() . '</span>';
    echo '</div>';
    echo '</div>';
    
    // Comment reply link
    echo '<a href="' . esc_url(get_comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth']]))) . '" class="nav-link fs-sm px-0">';
    echo '<i class="bx bx-share fs-lg me-2"></i>';
    echo 'Reply';
    echo '</a>';
    echo '</div>';
  
    // Display comment text
    echo '<p class="mb-0">' . get_comment_text() . '</p>';
  
    // End comment container
    echo '</div>';
  }
  
function estimated_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $minutes = ceil( $word_count / 200 );
    return $minutes . ' min';
}

function custom_breadcrumbs() {
    // Settings
    $separator = '<svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mx-1"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>';
    $home_title = 'Home';

    if (is_front_page()) {
        return;
    }

    echo '
    <style>.breadcrumb-item + .breadcrumb-item::before {
    display: none;
}</style>
    <nav class="container py-1 mb-lg-2 mt-lg-3" aria-label="breadcrumb"><ol class="breadcrumb mb-0">';

    // Home link
    echo '<li class="breadcrumb-item"><a href="' . home_url() . '">
        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 me-1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> ' . $home_title . '</a></li>';

    // Category or Single Post
    if (is_category() || is_single()) {
        $categories = get_the_category();
        if ($categories && !is_page()) {
            foreach ($categories as $category) {
                echo '<li class="breadcrumb-item"><a href="' . get_category_link($category->term_id) . '">'. $separator  . esc_html($category->name) . '</a></li>';
            }
        }
        if (is_single()) {
            echo '<li class="breadcrumb-item">' . $separator . get_the_title() . '</li>';
        }
    }

    // Tag Page
    elseif (is_tag()) {
        echo '<li class="breadcrumb-item active">' . $separator . single_tag_title('', false) . '</li>';
    }

    // Page
    elseif (is_page()) {
        $parent_id  = wp_get_post_parent_id(get_the_ID());
        if ($parent_id) {
            $breadcrumbs = [];
            while ($parent_id) {
                $page = get_post($parent_id);
                $breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = wp_get_post_parent_id($page->ID);
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            echo implode('', $breadcrumbs);
        }
        // Add current page
        echo '<li class="breadcrumb-item">' . $separator . get_the_title() . '</li>';
    }

    // Custom Post Type Archives, Author, 404, Search (optional)
    elseif (is_search()) {
        echo '<li class="breadcrumb-item">' . $separator . 'Search results for: "' . get_search_query() . '"</li>';
    } elseif (is_author()) {
        echo '<li class="breadcrumb-item">' . $separator . 'Articles by ' . get_the_author() . '</li>';
    } elseif (is_404()) {
        echo '<li class="breadcrumb-item">' . $separator . '404 Error</li>';
    }

    echo '</ol></nav>';
}



// Theme setup
function amt_spice_setup() {
    load_theme_textdomain('amt-spice', get_template_directory() . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo');
    
    // Register all menus
    //register_nav_menus(array(
   //     'primary' => __('Primary Menu', 'amt-spice'),
   //     'footer-1' => __('Footer Column 1', 'amt-spice'),
    //    'footer-2' => __('Footer Column 2', 'amt-spice'),
    //    'footer-3' => __('Footer Column 3', 'amt-spice'),
   ///     'sidebar-menu' => __('Sidebar Menu', 'amt-spice')
  //  ));
}
add_action('after_setup_theme', 'amt_spice_setup');

// ==========================AMTEnqueue scripts and styles
require_once get_template_directory() . '/inc/enqueue-styles-scripts.php';
function amt_spice_scripts() {
    // Bootstrap CSS
   
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );
    
    // Theme styles
    
    wp_enqueue_style('amt-spice-timeline', 
        get_template_directory_uri() . '/assets/css/timeline.css',
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_style('amt-spice-swiperbundle', 
        get_template_directory_uri() . '/assets/css/swiper-bundle.min.css',
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_style('amt-spice-thememin', 
        get_template_directory_uri() . '/assets/css/theme.min.css',
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_script('wp-util');
    wp_enqueue_script(
        'timeline-repeater-control',
        get_template_directory_uri() . '/assets/js/timeline-repeater-control.js',
        array('jquery', 'jquery-ui-sortable', 'customize-controls',"wp-util"),
        '1.0.0',
        true
    );
    
    
    wp_enqueue_style(
        'timeline-repeater-control',
        get_template_directory_uri() . '/assets/css/timeline-repeater-control.css',
        array(),
        '1.0.0'
    );
    wp_enqueue_style('amt-spice-style', get_stylesheet_uri());
    wp_enqueue_style('amt-spice-custom', 
        get_template_directory_uri() . '/assets/css/styles.css?'.rand(),
        array(),
        AMT_SPICE_VERSION
    );
    wp_enqueue_style('amt-spice-minbox', 
        get_template_directory_uri() . '/assets/css/minbox.css',
        array(),
        AMT_SPICE_VERSION
    );
    

            wp_enqueue_script('amt-spice-swiperinjs', 
            get_template_directory_uri() . '/assets/js/swiper-bundle.min.js',
            array(),
            AMT_SPICE_VERSION
        );
        wp_enqueue_script('amt-spice-swiperinitjs', 
        get_template_directory_uri() . '/assets/js/swiper-init.js',
        array(),
        AMT_SPICE_VERSION
    );

        
    wp_enqueue_script('amt-spice-thememinjs', 
        get_template_directory_uri() . '/assets/js/theme.min.js',
        array(),
        AMT_SPICE_VERSION
    );
    
 
    
    // Counter JS
    wp_enqueue_script('counter-js', 
        get_template_directory_uri() . '/assets/js/counter.js',
        array(),
        AMT_SPICE_VERSION,
        true
    );
    
    // Customizer preview JS
    if (is_customize_preview()) {
        wp_enqueue_script('amt-spice-customizer-preview', 
            get_template_directory_uri() . '/assets/js/customizer-preview.js',
            array('jquery', 'customize-preview'),
            AMT_SPICE_VERSION,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'amt_spice_scripts');




// Include required files
if (!class_exists('WP_Bootstrap_Navwalker')) {
    //require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
require_once get_template_directory() . '/inc/customizer.php'; // Customizer settings
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/template-functions.php';
// Include the breadcrumbs function from template-parts
require_once get_template_directory() . '/template-parts/breadcrumbs.php';

// Add custom classes to sidebar menu links
function add_menu_link_classes($atts, $item, $args) {
    if ($args->theme_location === 'sidebar-menu') {
        $atts['class'] = isset($atts['class']) 
            ? $atts['class'] . ' fw-s ' 
            : 'fw-s ';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_classes', 10, 3);

// JSON Sanitization callback
function amt_sanitize_json($input) {
    $decoded = json_decode($input, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        return $input;
    }
    return '';
}

// additions
function amt_spice_customize_preview_js() {
    wp_enqueue_script('amt_spice-customizer', get_stylesheet_directory_uri() . '/customizer.js', ['customize-preview'], null, true);
}
add_action('customize_preview_init', 'amt_spice_customize_preview_js');


//code deleted - dynamic style



// delete google font
/** 
function amt_spice_google_fonts() {
    $font = get_theme_mod('body_font', 'Roboto');
    $font_slug = str_replace(' ', '+', $font);
    wp_enqueue_style('google-fonts', "https://fonts.googleapis.com/css2?family={$font_slug}:wght@400;700&display=swap", false);
}
add_action('wp_enqueue_scripts', 'amt_spice_google_fonts');

function amt_sanitize_repeater($input) {
    $input_decoded = json_decode($input, true);
    if (is_array($input_decoded)) {
        return wp_json_encode($input_decoded);
    }
    return '';
}
*/



// ====discover section============
/**
 * Load Discover Section Customizer
 */
require get_template_directory() . '/inc/discover-settings.php';

/**
 * Include Discover Section Template
 */
function road_spice_discover_section() {
    get_template_part('template-parts/discover-section');
}

// Include Our Impact Settings
//require get_template_directory() . '/inc/our-impact-settings.php';

// about us Settings

require get_template_directory() . '/inc/about-us-settings.php';

require get_template_directory() . '/inc/our-rights-settings.php';

//require get_template_directory() . '/inc/focus-areas-settings.php';

// Then include your controls
//require_once get_template_directory() . '/inc/custom-controls.php';
// Load after WordPress is ready
add_action('after_setup_theme', function() {
    require_once get_template_directory() . '/inc/custom-controls.php';
    require_once get_template_directory() . '/inc/focus-areas-settings.php';
});


//=============start hero section carousel================
// Enqueue customizer preview JS

function roadspice_customize_preview_js() {
    wp_enqueue_script('roadspice-customizer', get_template_directory_uri() . '/assetsjs/hero-carousel-customizer.js', ['customize-preview'], null, true);
}
add_action('customize_preview_init', 'roadspice_customize_preview_js');

// Include Hero Carousel settings
require get_template_directory() . '/inc/hero-carousel-settings.php';
//=============end hero section carousel================
// Offcanvas mobile menu name settings
require get_template_directory() . '/inc/mobile-menu-settings.php';

//header settings
require get_template_directory() . '/inc/header-settings.php';

require_once get_template_directory() . '/inc/bootstrap-5-navwalker.php';
//all css and js
require_once get_template_directory() . '/inc/enqueue-styles-scripts.php';

   
// ==========Start Footer Settings=================================
/**
 * Load footer customization settings
 */
require get_template_directory() . '/inc/footer-settings.php';
// ==========End Footer Settings===================================

// Load customizer settings for sponsors section
//require get_template_directory() . '/inc/sponsors-settings.php';

//subscribe section
require get_template_directory() . '/inc/subscribe-settings.php';
// last update

require_once get_template_directory() . '/inc/reports.php';
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('reports-js', get_template_directory_uri() . '/js/reports.js', [], false, true);
});
//======end reports


// Load Customizer Settings
require get_template_directory() . '/inc/what-we-do-settings.php';

// Load Template in your main page (where you want it)
function road_spice_render_what_we_do_section() {
    get_template_part('template-parts/sections/what-we-do-section');
}
//end what we do


// contact section
require get_template_directory() . '/inc/contacts-settings.php';

// Include Impact Stories functionality
require get_template_directory() . '/inc/our-impact-stories-settings.php';
//require get_template_directory() . '/template-parts/impact-stories.php';

//website supported by
require get_template_directory() . '/inc/website-supported-by-settings.php';

// contact section
//require get_template_directory() . '/inc/contacts-settings.php';
// Load Customizer Settings
//require get_template_directory() . '/inc/what-we-do-settings.php';

//Start thematic areas page CSS

function thematic_section_page_css() {
    if (is_page_template('page-thematic-section.php')) { ?>
        <style>
            :root {
    --primary-color: #0e8e37;
    --secondary-color: #f3930b;
    --success-color: #198754;
    --danger-color: #dc3545;
    --warning-color: #ffc107;
    --info-color: #0dcaf0;
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --text-color: #333;
    --background-color: #f8faf8ff;
    --border-radius: 0.375rem;
    --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease-in-out;
    --card-yellow: rgba(255, 193, 15, 0.8);
    --stat-label-color: #044d8d;
}
/*
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: var(--text-color);
    background-color: var(--background-color);
    padding: 20px 0;
}
**/
.main-container {
    max-width: 1200px;
    margin: 0 auto;
}

.primary-title {
    font-weight: 800;
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 20px;
}
        
.section-title {
    font-weight: 800;
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}

.section-title::after {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background: var(--secondary-color);
    margin-top: 10px;
}

.stat-card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    height: 100%;
    transition: var(--transition);
    background-color: white;
    margin: 5px;
}

.stat-card .card-body {
    padding: 0.75rem;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.stat-number {
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
    font-size: 2rem;
}

.stat-label {
    color: var(--stat-label-color);
    margin-bottom: 0;
    font-size: 0.95rem;
    line-height: 1.2;
}

.content-card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    background-color: var(--light-color);
    margin-top: 20px;
}

.card-yellow {
    background-color: var(--card-yellow);
    color: #022f5c;
}

.card-white {
    background-color: var(--light-color);
    color: #212529;
}

.card-body-content {
    padding: 1.5rem;
}

.stats-row {
    margin-bottom: 5px;
}

.content-wrapper {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    align-items: flex-start;
}

.text-content {
    flex: 1 1 55%;
    min-width: 0;
}

.slider-container {
    flex: 0 1 350px;
    max-width: 450px;
    min-width: 240px;
    width: 100%;
    margin-left: auto;
    margin-right: 0;
    height: 300px;
    overflow: hidden;
    position: relative;
    background: transparent !important;
    box-sizing: border-box;
    padding: 0 !important;
}

.carousel-inner,
.carousel-item,
.slider-img {
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    box-sizing: border-box !important;
}
.carousel-inner {
    height: 100% !important;
}
.carousel-item {
    height: 100% !important;
}
.slider-img {
    height: 100% !important;
    object-fit: cover;
    object-position: center;
    border-radius: 6px;
    display: block;
}

.carousel-control-prev, 
.carousel-control-next {
    width: 5%;
    background-color: rgba(0,0,0,0.2);
    border-radius: 6px;
}

.carousel-control-prev:hover, 
.carousel-control-next:hover {
    background-color: rgba(0,0,0,0.4);
}

.carousel-indicators {
    bottom: -30px;
}

.carousel-indicators button {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: rgba(0,0,0,0.5);
}
.carousel-indicators button.active {
    background-color: var(--primary-color);
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
    .content-wrapper {
        flex-direction: column;
        gap: 1.5rem;
    }
    .slider-container {
        max-width: 100%;
        margin-left: 0;
        height: 220px;
    }
}

@media (max-width: 767.98px) {
    .section-title {
        font-size: 1.5rem;
    }
    .stat-card {
        margin-bottom: 10px;
    }
    .stat-number {
        font-size: 1.5rem;
    }
    .stat-label {
        font-size: 0.8rem;
    }
    .card-body-content {
        padding: 1rem;
    }
    .slider-container {
        height: 160px;
        margin-top: 15px;
    }
}

@media (min-width: 992px) {
    .section-title {
        font-size: 2.8rem;
    }
    .primary-title {
        font-size: 2.5rem;
    }
    .content-wrapper {
        flex-direction: row;
    }
    .text-content {
        flex: 0 0 60%;
        padding-right: 2rem;
    }
    .slider-container {
        flex: 0 0 40%;
        padding-left: 1rem;
        height: 400px;
    }
}
        </style>
    <?php }
}

add_action('wp_head', 'thematic_section_page_css');
// End thematic areas page CSS