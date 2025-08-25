<?php
/**
 * Our Rights section template
 * 
 * @package road-spice-master
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<!--our rights section Start-->
<section id="our-rights" class="py-5 bg-info bg-opacity-10">
    <div class="container text-start">
        <div class="row align-items-center">
            <!-- Text Content Column (Left) -->
            <div class="col-lg-6 pe-lg-4">
                <h2 class="section-title"><?php echo esc_html(get_theme_mod('our_rights_title', 'Our Rights-Based Approach to Development')); ?></h2>
                <p class="section-description">
                    <?php echo wp_kses_post(get_theme_mod('our_rights_desc1', 'As our name suggests, we approach development from a rights-based perspective. We believe that all human beings are entitled, without discrimination, to their fundamental human rights - civil, political, social, and cultural. Access to quality and affordable water, sanitation, health services, food, education and other basic needs are fundamental human rights for all.')); ?>
                </p>
                <p class="section-description">
                    <?php echo wp_kses_post(get_theme_mod('our_rights_desc2', 'These rights are recognized in all the key international human rights instruments such as the Universal Declaration of Human Rights; the International Covenant on Civil and Political Rights; the International Covenant on Economic, Social and Cultural Rights; and the African Charter on Human and People\'s Rights. Kenya and the countries in the Horn of Africa are signatories to, and are bound by, these human rights instruments.')); ?>
                </p>
                <a href="<?php echo esc_url(get_theme_mod('our_rights_button_link', './what-we-do.php')); ?>" class="btn btn-outline-success btn-lg rounded-pill mt-3">
                    <?php echo esc_html(get_theme_mod('our_rights_button_text', 'Read More about our Thematic areas')); ?><i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Images Column (Right) - Two rows -->
            <div class="col-lg-6 ps-lg-4 mt-4 mt-lg-0">
                <!-- Top Image -->
                <div class="mb-4 text-center">
                    <a href="<?php echo esc_url(get_theme_mod('our_rights_top_image_link', 'https://road.africa')); ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo esc_url(get_theme_mod('our_rights_top_image', 'https://road.africa/static/media/road-int.57b356465d7f8e31be02.jpg')); ?>" 
                            alt="<?php echo esc_attr(get_theme_mod('our_rights_top_image_alt', 'Flood-affected household Somalia')); ?>" 
                            class="about-img img-thumbnail rounded shadow w-100">
                    </a>
                </div>
                
                <!-- Bottom Image -->
                <div class="text-center">
                    <a href="<?php echo esc_url(get_theme_mod('our_rights_bottom_image_link', 'https://road.africa')); ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo esc_url(get_theme_mod('our_rights_bottom_image', 'https://road.africa/static/media/Deriswanag.bff0e0a3a9a217d3b61e.jpeg')); ?>" 
                            alt="<?php echo esc_attr(get_theme_mod('our_rights_bottom_image_alt', 'Flood-affected household Somalia')); ?>" 
                            class="about-img img-thumbnail rounded shadow w-100">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>