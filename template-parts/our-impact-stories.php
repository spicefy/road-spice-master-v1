<?php
/**
 * Our Impact Stories Template Part
 */

$bg_color = get_theme_mod('our_impact_stories_bg_color', 'bg-success bg-opacity-10');
?>

<!-- Our Impact stories Section -->
<section id="our-impact-stories" class="py-3 py-md-5 <?php echo esc_attr($bg_color); ?>">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 mb-md-4">
      <h2 class="section-title mb-3 mb-md-4"><?php echo esc_html(get_theme_mod('our_impact_stories_title', 'Our Impact Stories')); ?></h2>
      <a href="<?php echo esc_url(get_theme_mod('our_impact_stories_view_all_link', '#')); ?>" id="view-all-btn" class="btn btn-success mt-2 mt-md-0 view-all-button">
        <span class="view-all-text"><?php echo esc_html(get_theme_mod('our_impact_stories_view_all_text', 'View all')); ?></span>
        <i class="fa-solid fa-arrow-right ms-2 view-all-arrow"></i>
      </a>
    </div>
    
    <div class="row g-4 px-2 px-md-0">
      <?php for ($i = 1; $i <= 3; $i++): ?>
        <?php if (get_theme_mod("our_impact_story_{$i}_title")): ?>
          <!-- Story <?php echo $i; ?> -->
          <div class="col-md-4 col-sm-6 col-12">
            <a href="<?php echo esc_url(get_theme_mod("our_impact_story_{$i}_link", '#')); ?>" class="text-decoration-none text-dark">
              <div class="card h-100 border-0 shadow-sm impact-card">
                <?php if ($image_url = get_theme_mod("our_impact_story_{$i}_image")): ?>
                  <img src="<?php echo esc_url($image_url); ?>" class="card-img-top img-fluid" alt="<?php echo esc_attr(get_theme_mod("our_impact_story_{$i}_title")); ?>">
                <?php endif; ?>
                <div class="card-body">
                  <h5 class="card-title impact-title"><?php echo esc_html(get_theme_mod("our_impact_story_{$i}_title")); ?></h5>
                  <div class="border-top border-success border-2 my-3 impact-divider"></div>
                  <a href="<?php echo esc_url(get_theme_mod("our_impact_story_{$i}_link", '#')); ?>" class="read-more-btn">
                    <span>READ MORE</span>
                    <i class="fa-solid fa-arrow-right ms-2 read-more-arrow"></i>
                  </a>
                </div>
              </div>
            </a>
          </div>
        <?php endif; ?>
      <?php endfor; ?>
    </div>
  </div>
</section>

<style>
  /* Card styling */
  .impact-card {
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .impact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
  }
  
  .impact-card .card-img-top {
    height: 200px;
    object-fit: cover;
  }
  
  .impact-title {
    color: #0e8e37;
    font-size: 1.1rem;
    font-weight: 600;
  }
  
  .impact-divider {
    border-color: #0e8e37 !important;
  }
  
  /* Read More button styling */
  .read-more-btn {
    color: #333;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
  }
  
  .read-more-arrow {
    transition: all 0.3s ease;
    color: inherit;
  }
  
  .read-more-btn:hover {
    color: #f3930b !important;
  }
  
  .read-more-btn:hover .read-more-arrow {
    transform: translateX(5px);
    color: #f3930b !important;
  }

  /* View All Button Animation */
  #view-all-btn {
    background-color: #0e8e37;
    border-color: #0e8e37;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .view-all-text {
    display: inline-block;
    transition: all 0.3s ease;
    color: white;
  }

  .view-all-arrow {
    transition: all 0.3s ease;
    color: white;
  }

  /* Hover Effects */
  #view-all-btn:hover {
    background-color: #0c7d32;
    border-color: #0c7d32;
  }

  #view-all-btn:hover .view-all-text {
    transform: translateX(-3px);
    color: white;
  }

  #view-all-btn:hover .view-all-arrow {
    transform: translateX(5px);
    color: white;
  }

  /* Pulse animation */
  @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
  }

  #view-all-btn:hover {
    animation: pulse 0.5s ease;
  }
</style>