<?php
function pasdigital_enqueue_assets()
{
    // Enqueue default style.css
    wp_enqueue_style('default-style', get_stylesheet_uri());

    // Enqueue custom stylesheet
    wp_enqueue_style('theme-custom-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all');

    // Enqueue Boxicons
    wp_enqueue_style('boxicons', 'https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css', array(), '2.0.7');

    // Enqueue Font Awesome (using the more recent version)
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Enqueue Bootstrap cdn
    wp_enqueue_style('bootstrap-cdn', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), '6.4.0');

    // Enqueue AOS animation CSS
    wp_enqueue_style('aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), '2.3.1');


    // Enqueue jQuery (WordPress includes it by default)
    wp_enqueue_script('jquery');

    // Enqueue theme's main JavaScript file
    wp_enqueue_script('theme-custom-script', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0', true);

    wp_enqueue_script(
        'franchise-directory',
        get_stylesheet_directory_uri() . '/assets/js/franchise-directory.js',
        ['jquery'],
        '1.0.0',
        true
    );
    wp_localize_script('franchise-directory', 'FRANCHISE_DIR', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('franchise_dir_nonce'),
    ]);
    // Optional: small CSS fixups (remove if not needed)
    wp_add_inline_style('wp-block-library', '.franchise-directory__franchise-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}@media(max-width:991px){.franchise-directory__franchise-grid{grid-template-columns:repeat(2,1fr)}}@media(max-width:600px){.franchise-directory__franchise-grid{grid-template-columns:1fr}}');

    // Enqueue Popper.js (required for Bootstrap)
    wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array(), '2.9.2', true);

    // Enqueue Bootstrap JS
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('popper'), '5.0.2', true);

    // Enqueue AOS animation JS
    wp_enqueue_script('aos-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '2.3.1', true);

    //Add sweet alert js for alert messages
    wp_enqueue_script('sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', [], null, true);

    // Initialize AOS in the footer
    wp_add_inline_script('aos-js', 'AOS.init();');
}
add_action('wp_enqueue_scripts', 'pasdigital_enqueue_assets');
