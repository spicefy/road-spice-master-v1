<?php
/**
 * Contact Section Template
 */

$section_title = get_theme_mod('contact_section_title', 'Drop Us A Line');
$section_subtitle = get_theme_mod('contact_section_subtitle', 'Always There for You');
$button_text = get_theme_mod('contact_button_text', 'Send Email');
$contact_options = get_theme_mod('contact_options', "inquiry:General Inquiry\nsupport:Support\nfeedback:Feedback\npartnership:Partnership");
$options = explode("\n", $contact_options);
?>

<!-- Contact Section -->
<section class="contact-section-card text-center">
    <div class="container">
        <div class="row g-4">
            <!-- Send Us Mail -->
            <div class="col-md-4">
                <div class="p-4 border rounded shadow-sm h-100 card-box">
                    <div class="icon-box mb-3">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h5 class="fw-bold">Send Us Mail</h5>
                    <p class="mb-0">info@road.africa</p>
                </div>
            </div>

            <!-- Call Us Anytime -->
            <div class="col-md-4">
                <div class="p-4 border rounded shadow-sm h-100 card-box">
                    <div class="icon-box mb-3">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h5 class="fw-bold">Call Us Anytime</h5>
                    <p class="mb-0">(+254) 724201623</p>
                    <p>Toll Free: 0000</p>
                </div>
            </div>

            <!-- Visit Our Office -->
            <div class="col-md-4">
                <div class="p-4 border rounded shadow-sm h-100 card-box">
                    <div class="icon-box mb-3">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h5 class="fw-bold">Visit Our Office</h5>
                    <p class="mb-0">(Kenya Headquarters): Garissa Office</p>
                    <p>Sambul Mdina Hospital Road</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Email form contact section -->
<style>
    .email-contacts-section {
        padding: 4rem 1rem;
        background-color: #fff;
    }

    .section-title {
        text-align: center;
        margin-bottom: 2rem;
        color:#0e8e37;
    }

    .section-title h2 {
        text-align: center;
        font-weight: 700;
        font-size: 2.5rem;
    }

    .section-title p {
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
        color: #6c757d;
    }

    .underline {
        display: inline-block;
        width: 60px;
        height: 4px;
        background-color: #f3930b;
        border-radius: 2px;
        margin-top: 0.5rem;
    }

    .form-control,
    .form-select {
        border-radius: 0;
        border: 1px solid #ddd;
        padding: 1rem;
    }

    .btn-success {
        border-radius: 0;
        padding: 0.75rem 2rem;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }

    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
</style>
<style>
     .contact-section-card {
      background-color: #ffffff;
      padding: 3rem 0;
    }

    .icon-box {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 60px;
      height: 60px;
      border-radius: 15px;
      background-color: #f3930b;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .icon-box i {
      font-size: 1.8rem;
      color: #dc3545; /* Bootstrap's 'danger' red */
    }

    .card-box {
      transition: all 0.3s ease;
    }

    .card-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
    /*To make sure the hero section looks good on mobile*/
    @media (max-width: 768px) {
  .contact-hero {
    padding: 3rem 1rem;
  }

  
</style>

<section class="email-contacts-section">
    <div class="container">
        <div class="section-title text-center">
            <h2><?php echo esc_html($section_title); ?></h2>
            <p><?php echo esc_html($section_subtitle); ?></p>
            <div class="underline mx-auto"></div>
        </div>

        <?php if (isset($_GET['contact_status'])) : ?>
            <?php if ($_GET['contact_status'] === 'success') : ?>
                <div class="alert alert-success">
                    <?php _e('Thank you for your message! We will get back to you soon.', 'road-spice-master'); ?>
                </div>
            <?php elseif ($_GET['contact_status'] === 'error') : ?>
                <div class="alert alert-danger">
                    <?php _e('There was an error sending your message. Please try again later.', 'road-spice-master'); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <input type="hidden" name="action" value="road_spice_contact_form">
            <?php wp_nonce_field('road_spice_contact_action', 'road_spice_contact_nonce'); ?>
            
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <input type="text" class="form-control" name="contact_name" placeholder="<?php esc_attr_e('Full Name *', 'road-spice-master'); ?>" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" name="contact_email" placeholder="<?php esc_attr_e('Email *', 'road-spice-master'); ?>" required>
                </div>
                <div class="col-md-6">
                    <input type="tel" class="form-control" name="contact_phone" placeholder="<?php esc_attr_e('Phone *', 'road-spice-master'); ?>" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="contact_subject" placeholder="<?php esc_attr_e('Subject *', 'road-spice-master'); ?>" required>
                </div>
                <div class="col-md-6">
                    <select class="form-select" name="contact_action" required>
                        <option selected disabled><?php esc_html_e('Select Action', 'road-spice-master'); ?></option>
                        <?php foreach ($options as $option) : ?>
                            <?php 
                            $parts = explode(':', $option, 2);
                            if (count($parts) === 2) :
                                $value = esc_attr(trim($parts[0]));
                                $label = esc_html(trim($parts[1]));
                            ?>
                                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <textarea class="form-control" rows="5" name="contact_message" placeholder="<?php esc_attr_e('Message *', 'road-spice-master'); ?>" required></textarea>
                </div>
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-success"><?php echo esc_html($button_text); ?></button>
                </div>
            </div>
        </form>
    </div>
</section>