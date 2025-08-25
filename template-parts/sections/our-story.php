<?php
/**
 * Our Story Section Template
 * 
 * @package RoadSpiceMaster
 */

// Get all customizer settings
$our_story_title = get_theme_mod('our_story_title', 'Our Story');
$our_story_content = get_theme_mod('our_story_content', '<strong>Rights Organization for Advocacy and Development (ROAD)</strong> is an indigenous and community-driven organization dedicated to serving the most marginalized populations. With two decades of impactful engagement with pastoral communities in North-Eastern Kenya and Southern Somalia, we have grown from a local, volunteer-based entity into a respected national NGO with cross-border programming.');
$vision_title = get_theme_mod('vision_title', 'OUR VISION');
$vision_content = get_theme_mod('vision_content', 'Empowered communities in Kenya and the Horn of Africa with sustainable livelihoods and emergency response strategies.');
$mission_title = get_theme_mod('mission_title', 'OUR MISSION');
$mission_content = get_theme_mod('mission_content', 'Improve social services, economic opportunities, disaster preparedness, and livelihoods for vulnerable communities in Kenya and the Horn of Africa.');
$values_title = get_theme_mod('values_title', 'CORE VALUES');
$values_content = get_theme_mod('values_content', 'These values anchor our work:
1. <strong>Transparency and accountability:</strong> We uphold the highest standards of transparency and accountability.
2. <strong>Efficiency and effectiveness:</strong> We always seek to maximize value for the resources we hold.
3. <strong>Respectful partnership:</strong> We are committed to mutually respectful partnerships.
4. <strong>Inclusivity:</strong> We include all in our work.
5. <strong>Empowerment:</strong> We build capacity of organizations.
6. <strong>Sustainability:</strong> We prioritize activities that communities can continue.');
$geo_focus_title = get_theme_mod('geo_focus_title', 'Geographic Focus');
$geo_focus_content = get_theme_mod('geo_focus_content', 'ROAD\'s geographic focus is on Kenya and the Horn of Africa, with a particular emphasis on Arid and Semi-Arid Lands. While our work has primarily been concentrated in Northern Kenya and Southern Somalia.');
?>

<!-- Our Story Section -->
<section id="our-story" class="py-5 bg-light">
  <div class="container text-start">
    <h2 class="section-title"><?php echo esc_html($our_story_title); ?></h2>
    
    <?php if ($our_story_content) : ?>
      <div class="our-story-content">
        <?php echo wpautop(wp_kses_post($our_story_content)); ?>
      </div>
    <?php endif; ?>

    <div class="border border-warning rounded-3 p-4 mt-5 bg-white">
      <?php if ($vision_title && $vision_content) : ?>
        <h5 class="fw-bold text-success"><?php echo esc_html($vision_title); ?></h5>
        <p><?php echo wp_kses_post($vision_content); ?></p>
      <?php endif; ?>

      <?php if ($mission_title && $mission_content) : ?>
        <h5 class="fw-bold text-success mt-4"><?php echo esc_html($mission_title); ?></h5>
        <p><?php echo wp_kses_post($mission_content); ?></p>
      <?php endif; ?>

      <?php if ($values_title && $values_content) : ?>
        <h5 class="fw-bold text-success mt-4"><?php echo esc_html($values_title); ?></h5>
        <div><?php echo wpautop(wp_kses_post($values_content)); ?></div>
      <?php endif; ?>
    </div>

    <?php if ($geo_focus_title && $geo_focus_content) : ?>
      <div class="border border-warning rounded-3 p-4 mt-5 bg-white">
        <h5 class="fw-bold text-success"><?php echo esc_html($geo_focus_title); ?></h5>
        <p><?php echo wp_kses_post($geo_focus_content); ?></p>
      </div>
    <?php endif; ?>
  </div>
</section>