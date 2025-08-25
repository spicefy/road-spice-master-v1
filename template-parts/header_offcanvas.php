<?php
/**
 * The header for the ROAD theme.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Utility Bar -->
<div class="utility-bar py-2">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8 utility-contact">
        <span><i class="fas fa-phone"></i> <?php echo get_theme_mod('phone_kenya', ' Kenya No: 072420162'); ?></span>
        <span><i class="fas fa-phone"></i> <?php echo get_theme_mod('phone_somalia', 'Somalia No: 0724201623'); ?></span>
        <span><i class="fas fa-envelope"></i> <?php echo get_theme_mod('email_contact', 'info@road.africa'); ?></span>
      </div>
      <div class="col-md-4 social-icons-top text-md-end">
        <?php foreach (['facebook','twitter','instagram','linkedin','youtube'] as $social): 
          $url = get_theme_mod("social_{$social}", '#');
          if ($url): ?>
            <a href="<?php echo esc_url($url); ?>"><i class="fab fa-<?php echo esc_attr($social); ?>"></i></a>
        <?php endif; endforeach; ?>
      </div>
    </div>
  </div>
</div>

<!-- Navbar -->
<?php 
$navbar_position = get_theme_mod('navbar_position', 'sticky-top'); // '', 'fixed-top', 'sticky-top'
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light opacity-85 <?php echo esc_attr($navbar_position); ?>">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="<?php echo home_url(); ?>">
      <?php 
        if (has_custom_logo()) {
          the_custom_logo();
        } else {
          bloginfo('name');
        }
      ?>
    </a>

    <!-- Offcanvas Toggle Button (Mobile Only) -->
    <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Toggle navigation">
      <i class="fa-solid fa-bars fa-lg"></i>
    </button>

    <!-- Offcanvas Menu (Mobile Only) -->
    <div class="offcanvas text-start offcanvas-end d-lg-none" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileMenuLabel"><?php bloginfo('name'); ?></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'navbar-nav',
            'fallback_cb' => '__return_false',
            'depth' => 2,
            'walker' => new Bootstrap_Navwalker(),
          ]);
        ?>

        <a href="<?php echo esc_url(get_theme_mod('donate_link', '#')); ?>" class="btn btn-outline-danger w-100 btn-lg mt-3">
          <?php echo esc_html(get_theme_mod('donate_text', 'Donate')); ?>
          <i class="fas fa-angle-double-right ms-2"></i>
        </a>
      </div>
    </div>

    <!-- Desktop Menu (visible only on lg and above) -->
    <div class="collapse navbar-collapse d-none d-lg-flex" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container' => false,
            'items_wrap' => '%3$s', // avoid extra <ul>
            'fallback_cb' => '__return_false',
            'depth' => 2,
            'walker' => new Bootstrap_Navwalker(),
          ]);
        ?>

        <!-- Donate Button as nav-item -->
        <li class="nav-item ms-lg-2 my-2 my-lg-0">
          <a href="<?php echo esc_url(get_theme_mod('donate_link', '#')); ?>" class="btn btn-outline-danger btn-lg px-4">
           <?php echo esc_html(get_theme_mod('donate_text', 'Donate')); ?><i class="fas fa-angle-double-right ms-2"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
