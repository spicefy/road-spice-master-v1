<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package road-spice-master
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

        </div><!-- #content -->

        <footer id="footer-section" style="background-color: <?php echo esc_attr(get_theme_mod('footer_background_color', '#2c3e50')); ?>;">
            <div class="container">
                <div class="row">
                    <!-- Column 1: Logo & Description -->
                    <div class="col-lg-4 mb-4">
                        <?php if (get_theme_mod('footer_logo')) : ?>
                            <img src="<?php echo esc_url(get_theme_mod('footer_logo')); ?>" 
                                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>" 
                                 class="footer-logo img-fluid">
                        <?php endif; ?>
                        
                        <p class="footer-description">
                            <?php echo esc_html(get_theme_mod('footer_description', 'Rights Organization for Advocacy and Development (R.O.A.D) is a non-governmental, non-profit organisation founded and registered in Kenya and Somalia in 2009 and 2012 respectively.')); ?>
                        </p>
                        
                        <div class="social-icons">
                            <?php if (get_theme_mod('facebook_url')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('facebook_url')); ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('twitter_url')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('twitter_url')); ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('instagram_url')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('instagram_url')); ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('linkedin_url')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('linkedin_url')); ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('youtube_url')) : ?>
                                <a href="<?php echo esc_url(get_theme_mod('youtube_url')); ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Column 2-4: Menu Columns -->
                    <?php for ($i = 1; $i <= 3; $i++) : ?>
                        <?php if (has_nav_menu('footer_column_' . $i)) : ?>
                            <div class="col-lg-2 col-md-6 mb-4 footer-links">
                                <h5><?php echo esc_html(get_theme_mod('footer_column_' . $i . '_title', $i === 1 ? 'Quick Links' : ($i === 2 ? 'Our Programs' : 'Contact Us'))); ?></h5>
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'footer_column_' . $i,
                                    'menu_class' => '',
                                    'container' => false,
                                    'items_wrap' => '<ul class="footer-menu">%3$s</ul>',
                                    'walker' => new Footer_Menu_Walker(),
                                    'fallback_cb' => false
                                ));
                                ?>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <!-- Contact Info Column -->
                    <div class="col-lg-3 col-md-6 mb-4 footer-links">
                        <h5><?php echo esc_html(get_theme_mod('contact_column_title', 'Contact Us')); ?></h5>
                        <ul class="contact-info">
                            <?php if (get_theme_mod('contact_address')) : ?>
                                <li>
                                    <i class="fas fa-map-marker-alt me-2"></i> 
                                    <span><?php echo esc_html(get_theme_mod('contact_address', 'Garissa, Kenya')); ?></span>
                                </li>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('contact_phone_1')) : ?>
                                <li>
                                    <i class="fas fa-phone me-2"></i> 
                                    <span><?php echo esc_html(get_theme_mod('contact_phone_1', 'Kenya: 072 420 162')); ?></span>
                                </li>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('contact_phone_2')) : ?>
                                <li>
                                    <i class="fas fa-phone me-2"></i> 
                                    <span><?php echo esc_html(get_theme_mod('contact_phone_2', 'Somalia: 072 420 162')); ?></span>
                                </li>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('contact_email')) : ?>
                                <li>
                                    <i class="fas fa-envelope me-2"></i> 
                                    <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'info@road.africa')); ?>">
                                        <?php echo esc_html(get_theme_mod('contact_email', 'info@road.africa')); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
                <!-- Copyright Row -->
                <div class="row">
                    <div class="col-12 text-center copyright footer-links">
                        <p>
                            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.
                            
                            <?php if (get_theme_mod('privacy_policy_url')) : ?>
                                | <a href="<?php echo esc_url(get_theme_mod('privacy_policy_url')); ?>">Privacy Policy</a>
                            <?php endif; ?>
                            
                            <?php if (get_theme_mod('terms_of_service_url')) : ?>
                                | <a href="<?php echo esc_url(get_theme_mod('terms_of_service_url')); ?>">Terms of Service</a>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html>