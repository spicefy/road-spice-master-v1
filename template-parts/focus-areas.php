<?php
/**
 * Focus Areas Section Template
 * 
 * @package road-spice-master
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Default values
$default_central_image = get_template_directory_uri() . '/images/road2.png';
$default_focus_items = [
    [
        'icon' => '🚰',
        'text' => 'WATER, SANITATION, & HYGIENE (WASH)',
        'link' => '#wash',
        'title' => 'Water, Sanitation, and Hygiene (WASH)'
    ],
    [
        'icon' => '🩺',
        'text' => 'HEALTH & WELL-BEING',
        'link' => '#health',
        'title' => 'Health and Well-being'
    ],
    [
        'icon' => '🍲',
        'text' => 'FOOD SECURITY & LIVELIHOODS',
        'link' => '#food-security',
        'title' => 'Food Security and Livelihoods'
    ],
    [
        'icon' => '💸',
        'text' => 'ECONOMIC EMPOWERMENT',
        'link' => '#economic-empowerment',
        'title' => 'Economic Empowerment'
    ],
    [
        'icon' => '📘',
        'text' => 'EDUCATION & VOCATIONAL TRAINING',
        'link' => '#education',
        'title' => 'Education and Vocational Training'
    ],
    [
        'icon' => '🌍',
        'text' => 'CLIMATE CHANGE ADAPTATION',
        'link' => '#climate',
        'title' => 'Climate Change Adaptation'
    ]
];

$default_list_items = [
    ['text' => 'Economic Empowerment', 'link' => '#economic-empowerment'],
    ['text' => 'Education and Vocational Training', 'link' => '#education'],
    ['text' => 'Health and Well-being', 'link' => '#health'],
    ['text' => 'Food Security and Livelihoods', 'link' => '#food-security'],
    ['text' => 'Water, Sanitation, and Hygiene (WASH)', 'link' => '#wash'],
    ['text' => 'Climate Change Adaptation and Natural Resource Management', 'link' => '#climate']
];

// Get theme mods with fallbacks
$section_title = get_theme_mod('focus_areas_title', 'Working Towards Empowering Vulnerable Communities');
$desc1 = get_theme_mod('focus_areas_desc1', 'At <strong>Rights Organization for Advocacy and Development (ROAD)</strong>, we are dedicated to building resilience and improving livelihoods in Kenya and the Horn of Africa. Our sustainable development initiatives empower marginalized communities to create lasting change.');
$desc2 = get_theme_mod('focus_areas_desc2', 'We focus on high-impact interventions across multiple sectors to address the most pressing needs of vulnerable populations in arid and semi-arid regions.');
$central_image = get_theme_mod('focus_areas_central_image', $default_central_image);
$focus_areas_items = json_decode(get_theme_mod('focus_areas_items', json_encode($default_focus_items)), true);
$focus_list_items = json_decode(get_theme_mod('focus_list_items', json_encode($default_list_items)), true);

// Ensure we have arrays
$focus_areas_items = is_array($focus_areas_items) ? $focus_areas_items : $default_focus_items;
$focus_list_items = is_array($focus_list_items) ? $focus_list_items : $default_list_items;
?>

<!-- Focus Areas Section Start -->
<section class="focus-areas-section bg-grey">
  <div class="container text-start">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <?php if ($section_title) : ?>
          <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <?php if ($desc1) : ?>
          <p class="section-description"><?php echo wp_kses_post($desc1); ?></p>
        <?php endif; ?>

        <?php if ($desc2) : ?>
          <p class="section-description"><?php echo wp_kses_post($desc2); ?></p>
        <?php endif; ?>

        <?php if (!empty($focus_list_items)) : ?>
          <ol class="focus-list">
            <?php foreach ($focus_list_items as $item) : ?>
              <li>
                <a href="<?php echo esc_url($item['link']); ?>">
                  <?php echo esc_html($item['text']); ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ol>
        <?php endif; ?>
      </div>
      <div class="col-lg-6">
        <div class="solar-system-container">
          <div class="solar-system">
            <?php if ($central_image) : ?>
              <img src="<?php echo esc_url($central_image); ?>" 
                   alt="<?php esc_attr_e('ROAD Focus Areas Visualization', 'road-spice-master'); ?>" 
                   class="central-image">
            <?php endif; ?>

            <?php foreach ($focus_areas_items as $item) : ?>
              <a href="<?php echo esc_url($item['link']); ?>" 
                 class="section-icon bg-<?php echo sanitize_title($item['title']); ?> planet" 
                 title="<?php echo esc_attr($item['title']); ?>">
                <div class="icon-img"><?php echo esc_html($item['icon']); ?></div>
                <?php echo esc_html($item['text']); ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Focus Areas Section End -->