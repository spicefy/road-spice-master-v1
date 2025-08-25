<?php
// Register Custom Post Type: Report
add_action('init', function () {
    register_post_type('report', [
        'labels' => [
            'name' => 'Reports',
            'singular_name' => 'Report',
            'add_new_item' => 'Add New Report',
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-media-document',
        'supports' => ['title', 'editor'],
    ]);
});

// Add Meta Boxes
add_action('add_meta_boxes', function () {
    add_meta_box('report_meta', 'Report Details', 'report_meta_callback', 'report', 'normal', 'high');
});

function report_meta_callback($post) {
    $type = get_post_meta($post->ID, 'report_type', true);
    $year = get_post_meta($post->ID, 'report_year', true);
    $file = get_post_meta($post->ID, 'report_file', true);
    wp_nonce_field('report_meta_nonce', 'report_meta_nonce_field');
    ?>
    <p><label>Report Year:</label><br>
        <input type="text" name="report_year" value="<?= esc_attr($year) ?>" style="width:100%;"></p>

    <p><label>Report Type:</label><br>
        <select name="report_type" style="width:100%;">
            <option value="annual" <?= selected($type, 'annual') ?>>Annual</option>
            <option value="quarterly" <?= selected($type, 'quarterly') ?>>Quarterly</option>
        </select></p>

    <p><label>Report File:</label><br>
        <input type="text" name="report_file" value="<?= esc_attr($file) ?>" style="width:80%;">
        <button class="upload_file_button button">Upload</button></p>
    <script>
    jQuery(document).ready(function ($) {
        $('.upload_file_button').click(function (e) {
            e.preventDefault();
            const button = $(this);
            const custom_uploader = wp.media({
                title: 'Select File',
                button: { text: 'Use this file' },
                multiple: false
            }).on('select', function () {
                const attachment = custom_uploader.state().get('selection').first().toJSON();
                button.prev('input').val(attachment.url);
            }).open();
        });
    });
    </script>
    <?php
}

// Save Meta
add_action('save_post', function ($post_id) {
    if (!isset($_POST['report_meta_nonce_field']) || !wp_verify_nonce($_POST['report_meta_nonce_field'], 'report_meta_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, 'report_type', sanitize_text_field($_POST['report_type']));
    update_post_meta($post_id, 'report_year', sanitize_text_field($_POST['report_year']));
    update_post_meta($post_id, 'report_file', esc_url_raw($_POST['report_file']));
});

// Shortcode to Display Reports
add_shortcode('display_reports', function () {
    ob_start();
    $types = ['annual' => 'Annual', 'quarterly' => 'Quarterly'];
    ?>
    <div class="container text-start py-5">
        <div class="d-flex justify-content-between mb-3">
            <h2>Reports</h2>
            <a href="#" class="btn btn-success" id="download-all-reports">
  Download All <i class="bi bi-download ms-2"></i>
</a>

        </div>

        <select id="report-year-filter" class="form-select mb-3" style="max-width: 200px;">
            <option value="">All Years</option>
            <?php
            $years = get_posts(['post_type' => 'report', 'numberposts' => -1, 'fields' => 'ids']);
            $unique_years = array_unique(array_map(fn($id) => get_post_meta($id, 'report_year', true), $years));
            foreach ($unique_years as $year) {
                if ($year) echo "<option value='$year'>$year</option>";
            }
            ?>
        </select>

        <ul class="nav nav-tabs mb-4" id="reportTabs">
            <?php foreach ($types as $slug => $label): ?>
                <li class="nav-item">
                    <button class="nav-link <?= $slug === 'annual' ? 'active' : '' ?>" data-bs-toggle="tab" data-bs-target="#<?= $slug ?>"><?= $label ?></button>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content">
            <?php foreach ($types as $slug => $label): ?>
                <div class="tab-pane fade <?= $slug === 'annual' ? 'show active' : '' ?>" id="<?= $slug ?>">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <?php
                        $query = new WP_Query([
                            'post_type' => 'report',
                            'posts_per_page' => -1,
                            'meta_query' => [[
                                'key' => 'report_type',
                                'value' => $slug
                            ]]
                        ]);
                        while ($query->have_posts()) : $query->the_post();
                            $file = get_post_meta(get_the_ID(), 'report_file', true);
                            $year = get_post_meta(get_the_ID(), 'report_year', true);
                        ?>
                            <div class="col report-card" data-year="<?= esc_attr($year) ?>">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= get_the_title() ?></h5>
                                        <p class="card-text"><?= get_the_excerpt() ?></p>
                                        <?php if ($file): ?>
                                            <a href="<?= esc_url($file) ?>" class="btn btn-outline-primary" target="_blank">Download<i class="fa-solid fa-download ms-2"></i></a>
                                            
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <script>
        document.getElementById('report-year-filter').addEventListener('change', function () {
            const selectedYear = this.value;
            document.querySelectorAll('.report-card').forEach(card => {
                const year = card.dataset.year;
                card.style.display = !selectedYear || selectedYear === year ? 'block' : 'none';
            });
        });
        </script>
    </div>
    <?php
    return ob_get_clean();
});

