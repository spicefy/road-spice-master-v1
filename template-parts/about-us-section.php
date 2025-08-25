<!-- About us Section start -->
<section id="about-us-section" class="about-us-section py-5 bg-light">
    <div class="container">
        <div class="row g-4 d-flex align-items-stretch">
            
            
            <!-- Text Column -->
            <div class="col-lg-6 d-flex flex-column text-start">
                
                <div>
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('road_spice_about_us_title', 'About Us')); ?></h2>
                    <div class="section-description">
                        <?php echo wp_kses_post(get_theme_mod('road_spice_about_us_desc1', '<strong>Rights Organization for Advocacy and Development (ROAD)</strong> is an indigenous and community-driven organization dedicated to serving the most marginalized populations.')); ?>
                    </div>
                    <div class="section-description">
                        <?php echo wp_kses_post(get_theme_mod('road_spice_about_us_desc2', 'With two decades of impactful engagement with pastoral communities in North-Eastern Kenya and Southern Somalia, we have grown from a local, volunteer-based entity into a respected national NGO with cross-border programming.')); ?>
                    </div>
                    
                    <div class="button-group mt-3">
                        <?php if (get_theme_mod('road_spice_about_us_btn1_text', 'Read More')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('road_spice_about_us_btn1_link', '#about')); ?>" class="btn btn-success rounded-pill me-2">
                                <?php echo esc_html(get_theme_mod('road_spice_about_us_btn1_text', 'Read More')); ?> 
                                <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_theme_mod('road_spice_about_us_btn2_text', 'Our Impact')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('road_spice_about_us_btn2_link', '#about')); ?>" class="btn btn-outline-success rounded-pill">
                                <?php echo esc_html(get_theme_mod('road_spice_about_us_btn2_text', 'Our Impact')); ?> 
                                <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Image Column -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center ">
                <?php 
                $about_image = get_theme_mod('road_spice_about_us_image');
                if ($about_image) : 
                    $image_link = esc_url(get_theme_mod('road_spice_about_us_image_link', 'https://road.africa'));
                    $image_alt = esc_attr(get_theme_mod('road_spice_about_us_image_alt', 'Flood-affected household Somalia'));
                ?>
                    <div class="about-image-wrapper">
                        <a href="<?php echo $image_link; ?>" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo esc_url($about_image); ?>" 
                                 alt="<?php echo $image_alt; ?>" 
                                 class="img-fluid rounded shadow"
                                 loading="lazy">
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        
        </div>
    </div>
</section>