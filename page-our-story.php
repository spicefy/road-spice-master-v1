<?php
/**
 * Template Name:Our Story Page
 * This template is used to display the "Our Story" page.
 */
get_template_part('template-parts/header');
?>

   <?php get_template_part('template-parts/sections/our-story'); 
    // Hero Section
    get_template_part('template-parts/hero-carousel');
    ?>
  </div>
</main>

<?php
get_footer();

