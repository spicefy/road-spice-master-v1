<?php
/**
 * The main template file
 */

get_template_part('template-parts/header'); // Load custom header
?>

<main id="primary" class="page-wrapper">
    <?php
    // Hero Section
    
    get_template_part('template-parts/hero-carousel');

    // Intro Section
    get_template_part('template-parts/focus-areas');
    
    // Intro Section
    get_template_part('template-parts/our-rights');
    
    // Services Section
    get_template_part('template-parts/about-us-section');

    // Chat Support Section
    get_template_part('template-parts/our-impact-stories'); //our-impact.php
    
    
    // Discover Section
    get_template_part('template-parts/discover-section'); //calls tepmlate-parts/discover-section.php

    //website supported by
   get_template_part('template-parts/website-supported-by');
    //sponsors section
    //get_template_part('template-parts/sponsors-section'); 

    //subscribe section
    //get_template_part('template-parts/subscribe-section');

    

    
    // Blog posts
    if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_type());
        endwhile;
        
        the_posts_navigation();
    else :
        get_template_part('template-parts/content', 'none');
    endif;
    ?>
</main>

<?php get_template_part('footer'); //footer.php?> 

<?php wp_footer(); ?>
