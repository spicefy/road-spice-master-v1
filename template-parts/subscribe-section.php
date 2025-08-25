<?php
$bg_image = get_theme_mod('subscribe_bg_image', 'https://road.africa/static/media/road-int.57b356465d7f8e31be02.jpg');
$title = get_theme_mod('subscribe_title', 'Subscribe for more updates');
$description = get_theme_mod('subscribe_description', 'Subscribe to this blog and receive notifications of new posts and updates by email.');
$button_label = get_theme_mod('subscribe_button_label', 'Sign Up');
$button_url = get_theme_mod('subscribe_button_url', '#');
?>

<section class="subscribe-hero" aria-label="Subscribe Section" style="background: url('<?php echo esc_url($bg_image); ?>') no-repeat center center/cover;">
    <div class="hero-overlay d-flex align-items-center" style="background-color: rgba(0, 0, 0, 0.6);">
        <div class="container text-center text-white py-5">
            <h1 class="section-title"><?php echo esc_html($title); ?></h1>
            <p class="lead mb-4"><?php echo esc_html($description); ?></p>
            <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary btn-lg px-5">
                <?php echo esc_html($button_label); ?> <i class="fa-solid fa-arrow-right ms-2"></i>

            </a>
        </div>
    </div>
</section>

<style>

    /* CSS Reset */
.subscribe-hero {
  background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
              url('https://road.africa/static/media/Picture-1.4e5b88351f096deb4735.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  height: 60vh;
  min-height: 100px;
  display: flex;
  align-items: center;
  position: relative;
}

.subscribe-hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  display: flex;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.4);
}

.subscribe-hero {
    height: 50vh;
    min-height: 350px;
}

.subscribe-card-img-top {
    height: 200px;
    object-fit: cover;
    width: 100%;
}
  
@media (max-width: 575.98px) {
  .subscribe-hero {
    height: 35vh;
    min-height: 250px;
  }
}
</style>