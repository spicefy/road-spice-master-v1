(function($) {
    // Section Title
    wp.customize('discover_section_title', function(value) {
        value.bind(function(newval) {
            $('.discover-section .section-title').text(newval);
        });
    });

    // Button Text and Links
    for (var i = 1; i <= 4; i++) {
        // Button Text
        (function(index) {
            wp.customize('discover_button_' + index + '_text', function(value) {
                value.bind(function(newval) {
                    $('.discover-section .discover-btn:nth-child(' + index + ')').text(newval);
                });
            });
        })(i);

        // Button Link
        (function(index) {
            wp.customize('discover_button_' + index + '_link', function(value) {
                value.bind(function(newval) {
                    $('.discover-section .discover-btn-wrapper:nth-child(' + index + ') a').attr('href', newval);
                });
            });
        })(i);
    }
})(jQuery);