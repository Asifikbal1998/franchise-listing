<?php
// functions.php

add_theme_support('post-thumbnails');

// THEME STUFF
include_once('includes/menus.php');
include_once('includes/enqueue-scripts.php');
include_once('includes/theme-function.php');
require_once('includes/custom-post-types.php');
require_once('includes/form-handlers.php');
require_once('includes/user-auth.php'); // keep includes; user-auth no longer starts sessions

// Disable Gutenberg
add_filter('use_block_editor_for_post', '__return_false');

// CF7: Remove <p> wrapper
add_filter('wpcf7_autop_or_not', '__return_false');

// Excerpt limit
add_filter('excerpt_length', function ($len) {
    return 12;
});

/**
 * Start PHP session safely (one place).
 * We attach to 'init' so headers haven't been sent yet.
 */
function mif_start_session() {
    if ( php_sapi_name() === 'cli' ) return;
    if ( ! session_id() ) {
        // Suppress warnings but still attempt to start session
        @session_start();
    }
}
add_action( 'init', 'mif_start_session', 1 );

/**
 * Helper: render a single franchise card (reusable both in template & AJAX)
 */
function render_franchise_card(WP_Post $post): string
{
    $id = $post->ID;

    // ACF / meta fields
    $logo              = get_field('franchise_logo', $id); // could be ID/array/url
    $cash_required     = get_field('liquid_capital', $id);
    $excerpt           = has_excerpt($id) ? get_the_excerpt($id) : wp_trim_words(strip_shortcodes($post->post_content), 24);

    // Normalize logo output
    $logo_html = '';
    if ($logo) {
        if (is_numeric($logo)) {
            $logo_html = wp_get_attachment_image($logo, 'medium', false, ['class' => 'franchise-directory__franchise-logo-image', 'loading' => 'lazy']);
        } elseif (is_array($logo) && !empty($logo['ID'])) {
            $logo_html = wp_get_attachment_image($logo['ID'], 'medium', false, ['class' => 'franchise-directory__franchise-logo-image', 'loading' => 'lazy']);
        } elseif (is_string($logo)) {
            $logo_html = '<img src="' . esc_url($logo) . '" alt="' . esc_attr(get_the_title($id)) . ' logo" class="franchise-directory__franchise-logo-image" loading="lazy">';
        }
    }

    ob_start(); ?>
    <article class="franchise-directory__franchise-card">
        <a href="<?php echo esc_url(get_permalink($id)); ?>"><div class="fcardcompaire"><i class="fa-regular fa-share-from-square"></i></div>

        <a class="franchise-directory__franchise-logo" href="<?php echo esc_url(get_permalink($id)); ?>">
            <?php echo $logo_html ?: get_the_post_thumbnail($id, 'medium', ['class' => 'franchise-directory__franchise-logo-image', 'loading' => 'lazy']); ?>
        </a>

        <h3 class="franchise-directory__franchise-title">
            <a href="<?php echo esc_url(get_permalink($id)); ?>"><?php echo esc_html(get_the_title($id)); ?></a>
        </h3>

        <p class="franchise-directory__franchise-description"><?php echo esc_html($excerpt); ?></p>

        <?php if (!empty($cash_required)) : ?>
            <h5>Cash Required <span><?php echo esc_html(is_numeric($cash_required) ? '$ ' . number_format((float)$cash_required) : $cash_required); ?></span></h5>
        <?php endif; ?>

        <a class="franchise-directory__franchise-button franchise-directory-js-add-to-list popmake-1658" href="#">
            Request Info
        </a>
    </article>
<?php
    return trim(ob_get_clean());
}

/**
 * Build the WP_Query args from incoming filters
 */
function build_franchise_query_args(array $p): array
{
    $paged     = max(1, (int)($p['page'] ?? 1));
    $per_page  = max(1, min(30, (int)($p['per_page'] ?? 12)));
    $s         = sanitize_text_field($p['q'] ?? '');
    $category  = sanitize_text_field($p['category'] ?? '');
    $state     = sanitize_text_field($p['state'] ?? ''); // meta text (change to taxonomy if you have one)
    $investment     = sanitize_text_field($p['investment'] ?? ''); // dropdown ranges
    $order     = 'DESC';
    $orderby   = 'date';

    $args = [
        'post_type'      => 'franchise',
        'post_status'    => 'publish',
        's'              => $s,
        'orderby'        => $orderby,
        'order'          => $order,
        'paged'          => $paged,
        'posts_per_page' => $per_page,
    ];

    // Category (from custom field 'industry_name')
    if (!empty($category)) {
        $args['meta_query'][] = [
            'key'     => 'industry_name',
            'value'   => $category,
            'compare' => 'LIKE',
        ];
    }

    // Cash to Investment (compare with custom field 'cash_required')
    if (!empty($investment)) {
        $args['meta_query'][] = [
            'key'     => 'liquid_capital',
            'value'   => (int) $investment,
            'type'    => 'NUMERIC',
            'compare' => '<=',
        ];
    }

    return $args;
}

/**
 * AJAX: filter/paginate/search franchises
 */
add_action('wp_ajax_franchise_filter',        'handle_franchise_filter_ajax');
add_action('wp_ajax_nopriv_franchise_filter', 'handle_franchise_filter_ajax');

function handle_franchise_filter_ajax()
{
    check_ajax_referer('franchise_dir_nonce', 'nonce');

    $params = wp_unslash($_POST);
    $args   = build_franchise_query_args($params);

    $q = new WP_Query($args);

    $cards_html = '';
    if ($q->have_posts()) {
        while ($q->have_posts()) {
            $q->the_post();
            $cards_html .= render_franchise_card($q->post);
        }
        wp_reset_postdata();
    } else {
        $cards_html = '<div class="franchise-directory__no-results">No franchises match your filters.</div>';
    }

    $total     = (int)$q->found_posts;
    $per_page  = (int)$args['posts_per_page'];
    $page      = (int)$args['paged'];
    $pages     = max(1, (int)$q->max_num_pages);

    wp_send_json_success([
        'html'         => $cards_html,
        'total'        => $total,
        'page'         => $page,
        'pages'        => $pages,
        'pagination'   => [
            'from' => ($total > 0) ? (($page - 1) * $per_page + 1) : 0,
            'to'   => min($page * $per_page, $total),
        ],
    ]);
}

######### Create custom DB table (runs once per theme load if not exists) single franchise form submission logic start ###########

// ---- CREATE TABLE (as before) ----
function create_franchise_leads_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'franchise_leads';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            firstname varchar(100) NOT NULL,
            lastname varchar(100) NOT NULL,
            email varchar(100) NOT NULL,
            phone varchar(50) NOT NULL,
            zipcode varchar(20) NOT NULL,
            franchisename varchar(255) NOT NULL,
            capital varchar(100) NOT NULL,
            timeframe varchar(100) NOT NULL,
            location varchar(255) NOT NULL,
            submitted_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
add_action('after_setup_theme', 'create_franchise_leads_table');

// ---- HANDLE FORM SUBMISSION ----
add_action('admin_post_nopriv_submit_franchise_form', 'handle_franchise_form');
add_action('admin_post_submit_franchise_form', 'handle_franchise_form');

function handle_franchise_form()
{
    // Nonce check
    if (
        ! isset($_POST['franchise_form_nonce']) ||
        ! wp_verify_nonce($_POST['franchise_form_nonce'], 'franchise_form_action')
    ) {
        wp_die('Security check failed.');
    }

    // Honeypot check
    if (!empty($_POST['company_name'])) {
        $_SESSION['form_errors'] = ["Spam detected."];
        wp_safe_redirect(wp_get_referer());
        exit;
    }

    // ---- reCAPTCHA v3 check ----
    $recaptcha_secret = "6LeAJrcrAAAAAJljbq-FrpOBvhK1J06B0acycWUb"; // replace with your secret key
    $recaptcha_response = sanitize_text_field($_POST['g-recaptcha-response'] ?? '');

    $verify = wp_remote_post("https://www.google.com/recaptcha/api/siteverify", [
        'body' => [
            'secret'   => $recaptcha_secret,
            'response' => $recaptcha_response,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ]
    ]);

    $captcha_success = json_decode(wp_remote_retrieve_body($verify), true);

    if (empty($captcha_success['success']) || $captcha_success['score'] < 0.5) {
        $_SESSION['form_errors'] = ["Suspicious activity detected. Please try again."];
        $_SESSION['form_old']    = $_POST;
        wp_safe_redirect(wp_get_referer());
        exit;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'franchise_leads';

    // Sanitize input
    $data = [
        'firstname'     => sanitize_text_field($_POST['firstname'] ?? ''),
        'lastname'      => sanitize_text_field($_POST['lastname'] ?? ''),
        'email'         => sanitize_email($_POST['email'] ?? ''),
        'phone'         => preg_replace('/\D/', '', $_POST['phonenumber'] ?? ''), // digits only
        'zipcode'       => sanitize_text_field($_POST['zipcode'] ?? ''),
        'franchisename' => sanitize_text_field($_POST['franchisename'] ?? ''),
        'capital'       => sanitize_text_field($_POST['availablecapital'] ?? ''),
        'timeframe'     => sanitize_text_field($_POST['timeframe'] ?? ''),
        'location'      => sanitize_text_field($_POST['desiredlocation'] ?? ''),
    ];

    // Validation
    $errors = [];

    if (strlen($data['firstname']) < 3) {
        $errors[] = "First name must be at least 3 characters.";
    }
    if (strlen($data['lastname']) < 3) {
        $errors[] = "Last name must be at least 3 characters.";
    }
    if (! is_email($data['email'])) {
        $errors[] = "Please enter a valid email address.";
    }
    if (! preg_match('/^\d{10}$/', $data['phone'])) {
        $errors[] = "Phone number must be exactly 10 digits.";
    }
    if (! preg_match('/^\d{5}$/', $data['zipcode'])) {
        $errors[] = "Zip code must be 5 digits.";
    }
    if (empty($data['capital'])) {
        $errors[] = "Please select available capital.";
    }
    if (empty($data['timeframe'])) {
        $errors[] = "Please select timeframe to invest.";
    }
    if (empty($data['location'])) {
        $errors[] = "Please select desired location.";
    }

    if (! empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_old']    = $data;
        wp_safe_redirect(wp_get_referer());
        exit;
    }

    // Insert into DB
    $inserted = $wpdb->insert($table_name, $data);

    if ($inserted) {
        // send email
        $to      = get_option('admin_email');
        $subject = "New Franchise Request from {$data['firstname']} {$data['lastname']}";
        $message = "A new lead submitted the franchise form:\n\n" .
            "Name: {$data['firstname']} {$data['lastname']}\n" .
            "Email: {$data['email']}\n" .
            "Phone: {$data['phone']}\n" .
            "Zip Code: {$data['zipcode']}\n" .
            "Franchise: {$data['franchisename']}\n" .
            "Capital: {$data['capital']}\n" .
            "Timeframe: {$data['timeframe']}\n" .
            "Desired Location: {$data['location']}\n";

        wp_mail($to, $subject, $message);

        $_SESSION['form_success'] = "Your request has been submitted successfully. Our team will reach out soon.";
        unset($_SESSION['form_old']);
    } else {
        $_SESSION['form_errors'] = ["Something went wrong. Please try again."];
        $_SESSION['form_old']    = $data;
    }

    wp_safe_redirect(wp_get_referer());
    exit;
}


// ---- ADMIN MENU (FIXED VERSION) ----
add_action('admin_menu', function () {
    // First, check if the table exists and user has permission
    if (!current_user_can('manage_options')) {
        return;
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'franchise_leads';
    
    // Check if table exists before adding menu
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        return; // Don't add menu if table doesn't exist
    }
    
    add_menu_page(
        'Franchise Leads',
        'Franchise Leads',
        'manage_options', // Only users who can manage options can see this
        'franchise-leads',
        'render_franchise_leads_page',
        'dashicons-groups',
        20
    );
});

function render_franchise_leads_page() {
    // Double-check capabilities
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'franchise_leads';
    
    // Safe database query with error handling
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at DESC");
    
    echo '<div class="wrap"><h1>Franchise Leads</h1>';
    
    if ($wpdb->last_error) {
        echo '<div class="error"><p>Database error: ' . esc_html($wpdb->last_error) . '</p></div>';
    }
    
    if ($results) {
        echo '<table class="widefat"><thead><tr>
            <th>SL</th><th>Name</th><th>Email</th><th>Phone</th><th>Zipcode</th>
            <th>Franchise</th><th>Capital</th><th>Timeframe</th><th>Location</th><th>Submitted At</th>
        </tr></thead><tbody>';
        
        foreach ($results as $key => $row) {
            // Fix: Check if capital is numeric before formatting
            $capital_display = (is_numeric($row->capital)) ? '$' . number_format(floatval($row->capital)) : $row->capital;
            $id = $key + 1;
            
            // Safe date handling
            try {
                $serverTime = new DateTime($row->submitted_at, new DateTimeZone('UTC'));
                $serverTime->setTimezone(new DateTimeZone('Asia/Kolkata'));
                $istDate = $serverTime->format('d-m-Y');
            } catch (Exception $e) {
                $istDate = $row->submitted_at; // Fallback to raw date
            }
            
            echo "<tr>
                <td>{$id}</td>
                <td>" . esc_html($row->firstname . ' ' . $row->lastname) . "</td>
                <td>" . esc_html($row->email) . "</td>
                <td>" . esc_html($row->phone) . "</td>
                <td>" . esc_html($row->zipcode) . "</td>
                <td>" . esc_html($row->franchisename) . "</td>
                <td>" . esc_html($capital_display) . "</td>
                <td>" . esc_html($row->timeframe) . "</td>
                <td>" . esc_html($row->location) . "</td>
                <td>" . esc_html($istDate) . "</td>
            </tr>";
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No leads yet.</p>';
    }
    echo '</div>';
}
######### Create custom DB table (runs once per theme load if not exists) single franchise form submission logic end ###########