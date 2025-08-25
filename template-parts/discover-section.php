<?php
/**
 * Discover Section Template
 * 
 * @package road-spice-master
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<!-- Discover Section -->
<section class="discover-section">
    <div class="container text-start">
        <h2 class="section-title"><?php echo esc_html(get_theme_mod('discover_section_title', 'Discover Our Organization')); ?></h2>
        <div class="row justify-content-center mt-4">
            <?php for ($i = 1; $i <= 4; $i++) : ?>
                <div class="col-12 col-sm-6 col-md-3 mb-3 discover-btn-wrapper">
                    <a href="<?php echo esc_url(get_theme_mod("discover_button_{$i}_link", '#')); ?>">
                        <button class="discover-btn">
                            <?php echo esc_html(get_theme_mod("discover_button_{$i}_text", "Button {$i}")); ?>
                        </button>
                    </a>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>