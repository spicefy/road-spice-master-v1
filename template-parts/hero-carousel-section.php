<?php
/**
 * Hero Carousel Template Part
 * 
 * @package road-spice-master
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Get carousel settings
$autoplay = get_theme_mod('hero_carousel_autoplay', true) ? 'true' : 'false';
$interval = get_theme_mod('hero_carousel_interval', 5000);

// Count active slides
$active_slides = 0;
for ($i = 1; $i <= 8; $i++) {
    if (get_theme_mod("hero_carousel_slide_{$i}_enable", $i <= 3) && 
        get_theme_mod("hero_carousel_slide_{$i}_bg", '')) {
        $active_slides++;
    }
}

// Don't show if no active slides
if ($active_slides === 0) {
    return;
}
?>

<!-- Hero Carousel Section -->
<section class="hero-carousel">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="<?php echo $autoplay; ?>" <?php echo $autoplay === 'true' ? 'data-bs-interval="' . esc_attr($interval) . '"' : ''; ?>>
        <?php if ($active_slides > 1) : ?>
            <div class="carousel-indicators">
                <?php for ($i = 0; $i < $active_slides; $i++) : ?>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo $i; ?>" <?php echo $i === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="<?php printf(__('Slide %d', 'road-spice-master'), $i + 1); ?>"></button>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
        
        <div class="carousel-inner">
            <?php 
            $slide_count = 0;
            for ($i = 1; $i <= 8; $i++) :
                if (get_theme_mod("hero_carousel_slide_{$i}_enable", $i <= 3) && get_theme_mod("hero_carousel_slide_{$i}_bg", '')) :
                    $slide_count++;
                    $bg_image = get_theme_mod("hero_carousel_slide_{$i}_bg", '');
                    $title = get_theme_mod("hero_carousel_slide_{$i}_title", '');
                    $text = get_theme_mod("hero_carousel_slide_{$i}_text", '');
                    $btn_text = get_theme_mod("hero_carousel_slide_{$i}_btn_text", '');
                    $btn_link = get_theme_mod("hero_carousel_slide_{$i}_btn_link", '');
            ?>
                <div class="carousel-item <?php echo $slide_count === 1 ? 'active' : ''; ?>" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo esc_url($bg_image); ?>');">
                    <div class="carousel-caption">
                        <?php if ($title) : ?>
                            <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
                        <?php endif; ?>
                        
                        <?php if ($text) : ?>
                            <p class="hero-text"><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($btn_text && $btn_link) : ?>
                            <a href="<?php echo esc_url($btn_link); ?>" class="btn hero-btn"><?php echo esc_html($btn_text); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php 
                endif;
            endfor; 
            ?>
        </div>
        
        <?php if ($active_slides > 1) : ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="<?php esc_attr_e('Previous', 'road-spice-master'); ?>">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?php esc_html_e('Previous', 'road-spice-master'); ?></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="<?php esc_attr_e('Next', 'road-spice-master'); ?>">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?php esc_html_e('Next', 'road-spice-master'); ?></span>
            </button>
        <?php endif; ?>
    </div>
</section>

<style>

/* Hero Carousel Styles - More specific selectors to override Bootstrap */
section.hero-carousel {
    position: relative;
    z-index: 1;
    margin-top: -60px;
    padding-top: 60px;
    width: 100vw;
    left: 50%;
    right: auto;
    margin-left: -50vw;
    margin-right: 0;
    box-sizing: border-box;
    overflow-x: hidden;
}

/* Ensure navbar has higher z-index */
.navbar {
    position: relative;
    z-index: 2;
}

/* Hero Carousel specific styles */
section.hero-carousel .carousel {
    width: 100%;
}
section.hero-carousel .carousel-inner {
    width: 100%;
}
section.hero-carousel .carousel-item {
    height: 600px;
    background-size: cover;
    background-position: center;
    position: relative;
}
section.hero-carousel .carousel-caption {
    position: absolute;
    left: 10%;
    top: 50%;
    transform: translateY(-50%);
    width: 80%;
    text-align: left;
    padding: 40px;
    border-radius: 5px;
    margin: 0;
    background-color: rgba(0, 0, 0, 0.6);
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    right: auto;
    bottom: auto;
}
section.hero-carousel .carousel-caption .hero-title {
    font-size: 3rem;
    font-weight: 600;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    width: 100%;
    color: #fff;
}
section.hero-carousel .carousel-caption .hero-text {
    font-size: 1.2rem;
    margin-bottom: 30px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    width: 100%;
    color: #fff;
}
section.hero-carousel .carousel-caption .hero-btn {
    background-color: #0e8e37;
    border: none;
    padding: 12px 30px;
    font-weight: bold;
    font-size: 1.1rem;
    border-radius: 30px;
    transition: all 0.3s ease;
    color: #fff;
}
section.hero-carousel .carousel-caption .hero-btn:hover {
    background-color: #f3930b;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

/* Override Bootstrap's carousel control colors */
section.hero-carousel .carousel-control-prev,
section.hero-carousel .carousel-control-next {
    width: 5%;
}
section.hero-carousel .carousel-control-prev-icon,
section.hero-carousel .carousel-control-next-icon {
    background-color: #0e8e37;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    background-size: 60%;
}
section.hero-carousel .carousel-control-prev:hover .carousel-control-prev-icon,
section.hero-carousel .carousel-control-next:hover .carousel-control-next-icon {
    background-color: #f3930b;
}

/* Custom indicators - override Bootstrap */
section.hero-carousel .carousel-indicators {
    margin-bottom: 20px;
}
section.hero-carousel .carousel-indicators [data-bs-target] {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #0e8e37;
    opacity: 0.7;
    border: none;
}
section.hero-carousel .carousel-indicators .active {
    background-color: #f3930b;
    opacity: 1;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
    section.hero-carousel .carousel-caption {
        width: 60%;
    }
    section.hero-carousel .carousel-caption .hero-title {
        font-size: 2.5rem;
    }
}

@media (max-width: 767.98px) {
    section.hero-carousel .carousel-item {
        height: 500px;
    }
    section.hero-carousel .carousel-caption {
        width: 80%;
        left: 10%;
        top: auto;
        bottom: 20px;
        transform: none;
        padding: 20px;
    }
    section.hero-carousel .carousel-caption .hero-title {
        font-size: 2rem;
        margin-bottom: 15px;
    }
    section.hero-carousel .carousel-caption .hero-text {
        font-size: 1rem;
        margin-bottom: 20px;
    }
}

@media (max-width: 575.98px) {
    section.hero-carousel .carousel-item {
        height: 400px;
    }
    section.hero-carousel .carousel-caption .hero-title {
        font-size: 1.5rem;
    }
    section.hero-carousel .carousel-caption .hero-text {
        font-size: 0.9rem;
    }
    section.hero-carousel .carousel-caption .hero-btn {
        padding: 10px 20px;
        font-size: 1rem;
    }
}
</style>