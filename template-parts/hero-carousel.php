<section class="hero-carousel">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $active_index = 0;
            for ($i = 1; $i <= 6; $i++) {
                $img = get_theme_mod("hero_slide_image_$i");
                if (!$img) continue;
                $active = ($active_index === 0) ? 'active' : '';
                echo "<button type='button' data-bs-target='#heroCarousel' data-bs-slide-to='$active_index' class='$active'></button>";
                $active_index++;
            }
            ?>
        </div>

        <div class="carousel-inner">
            <?php
            $first = true;
            for ($i = 1; $i <= 6; $i++):
                $img = get_theme_mod("hero_slide_image_$i");
                if (!$img) continue;
                $title = get_theme_mod("hero_slide_title_$i");
                $text = get_theme_mod("hero_slide_text_$i");
                $btn = get_theme_mod("hero_slide_button_$i");
                $btn_url = get_theme_mod("hero_slide_button_url_$i");
                $credit = get_theme_mod("hero_slide_credit_$i");
            ?>
                <div class="carousel-item <?php if ($first) { echo 'active'; $first = false; } ?>" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('<?php echo esc_url($img); ?>'); background-size: cover; background-position: center; height: 90vh;">
                    <div class="carousel-caption text-start">
                        <?php if ($title): ?><h1 class="hero-title"><?php echo esc_html($title); ?></h1><?php endif; ?>
                        <?php if ($text): ?><p class="hero-text"><?php echo esc_html($text); ?></p><?php endif; ?>
                        <?php if ($btn && $btn_url): ?>
                            <a class="btn btn-primary hero-btn" href="<?php echo esc_url($btn_url); ?>"><?php echo esc_html($btn); ?></a>
                        <?php endif; ?>
                        <?php if ($credit): ?><p class="credit-text mt-2"><?php echo esc_html($credit); ?></p><?php endif; ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<style>
/* Hero Carousel specific styles */
section.hero-carousel .carousel {
    width: 100%;
}
section.hero-carousel .carousel-inner {
    width: 100%;
}
section.hero-carousel .carousel-item {
    height: 600px;
    background-size: cover;
    background-position: center;
    position: relative;
}
section.hero-carousel .carousel-caption {
    position: absolute;
    left: 10%;
    top: 50%;
    transform: translateY(-50%);
    width: 80%;
    text-align: left;
    padding: 40px;
    border-radius: 5px;
    margin: 0;
    background-color: rgba(0, 0, 0, 0.6);
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    right: auto;
    bottom: auto;
}
section.hero-carousel .carousel-caption .hero-title {
    font-size: 3rem;
    font-weight: 600;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    width: 100%;
    color: #fff;
}
section.hero-carousel .carousel-caption .hero-text {
    font-size: 1.2rem;
    margin-bottom: 30px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    width: 100%;
    color: #fff;
}
section.hero-carousel .carousel-caption .hero-btn {
    background-color: #0e8e37;
    border: none;
    padding: 12px 30px;
    font-weight: bold;
    font-size: 1.1rem;
    border-radius: 30px;
    transition: all 0.3s ease;
    color: #fff;
}
section.hero-carousel .carousel-caption .hero-btn:hover {
    background-color: #f3930b;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

/* Override Bootstrap's carousel control colors */
section.hero-carousel .carousel-control-prev,
section.hero-carousel .carousel-control-next {
    width: 5%;
}
section.hero-carousel .carousel-control-prev-icon,
section.hero-carousel .carousel-control-next-icon {
    background-color: #0e8e37;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    background-size: 60%;
}
section.hero-carousel .carousel-control-prev:hover .carousel-control-prev-icon,
section.hero-carousel .carousel-control-next:hover .carousel-control-next-icon {
    background-color: #f3930b;
}

/* Custom indicators - override Bootstrap */
section.hero-carousel .carousel-indicators {
    margin-bottom: 20px;
}
section.hero-carousel .carousel-indicators [data-bs-target] {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #0e8e37;
    opacity: 0.7;
    border: none;
}
section.hero-carousel .carousel-indicators .active {
    background-color: #f3930b;
    opacity: 1;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
    section.hero-carousel .carousel-caption {
        width: 60%;
    }
    section.hero-carousel .carousel-caption .hero-title {
        font-size: 2.5rem;
    }
}

@media (max-width: 767.98px) {
    section.hero-carousel .carousel-item {
        height: 500px;
    }
    section.hero-carousel .carousel-caption {
        width: 80%;
        left: 10%;
        top: auto;
        bottom: 20px;
        transform: none;
        padding: 20px;
    }
    section.hero-carousel .carousel-caption .hero-title {
        font-size: 2rem;
        margin-bottom: 15px;
    }
    section.hero-carousel .carousel-caption .hero-text {
        font-size: 1rem;
        margin-bottom: 20px;
    }
}

@media (max-width: 575.98px) {
    section.hero-carousel .carousel-item {
        height: 400px;
    }
    section.hero-carousel .carousel-caption .hero-title {
        font-size: 1.5rem;
    }
    section.hero-carousel .carousel-caption .hero-text {
        font-size: 0.9rem;
    }
    section.hero-carousel .carousel-caption .hero-btn {
        padding: 10px 20px;
        font-size: 1rem;
    }
}
</style>