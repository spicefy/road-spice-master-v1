<?php
/**
 * Template Name: Reports 2 Page
 */
get_template_part('template-parts/header');
?>
<?php
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<section class="hero" style="background-image: url('<?php echo esc_url($featured_img_url); ?>');" aria-label="Economic Empowerment Section">
    <div class="hero-overlay d-flex align-items-center">
        <div class="container text-start">
            <h1 class="section-title display-4 fw-bold text-white"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<main id="primary" class="site-main">
  <div class="container text-start py-5">
    <?php echo do_shortcode('[display_reports]'); ?>
  </div>
</main>

<?php
get_footer();
