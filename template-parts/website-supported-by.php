<?php
/**
 * Website Supported By Section
 */
$left_logo = get_theme_mod('supported_by_left_logo');
$left_alt = get_theme_mod('supported_by_left_alt', __('Ministry of Foreign Affairs', 'road-spice-master'));
$text = get_theme_mod('supported_by_text', __('Website Development Supported by the DANIDA<br> Sustainability Model Programme (SMP)', 'road-spice-master'));
$right_logo = get_theme_mod('supported_by_right_logo');
$right_alt = get_theme_mod('supported_by_right_alt', __('Refugee Council', 'road-spice-master'));

if ($left_logo || $text || $right_logo) :
?>
<section id="website-supported-by" class="py-4 bg-light">
  <div class="container">
    <div class="row text-center text-md-start justify-content-center align-items-center">

      <!-- Left Logo -->
      <?php if ($left_logo) : ?>
      <div class="col-12 col-md-4 order-2 order-md-1 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
        <img 
          src="<?php echo esc_url($left_logo); ?>" 
          alt="<?php echo esc_attr($left_alt); ?>" 
          class="img-fluid" 
          style="max-height: 70px;">
      </div>
      <?php endif; ?>

      <!-- Center Text -->
      <?php if ($text) : ?>
      <div class="col-12 col-md-4 order-1 order-md-2 mb-3 mb-md-0">
        <p class="mb-2 fw-bold text-success text-center">
          <?php echo wp_kses_post($text); ?>
        </p>
      </div>
      <?php endif; ?>

      <!-- Right Logo -->
      <?php if ($right_logo) : ?>
      <div class="col-12 col-md-4 order-3 d-flex justify-content-center justify-content-md-end">
        <img 
          src="<?php echo esc_url($right_logo); ?>" 
          alt="<?php echo esc_attr($right_alt); ?>" 
          class="img-fluid" 
          style="max-height: 70px;">
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>
<?php endif; ?>