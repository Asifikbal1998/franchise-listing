<?php
/**
 * Handles user registration and login processing
 *
 * NOTE: Do NOT call session_start() here. functions.php starts session centrally.
 */

/**
 * Registration handler
 */
function handle_user_registration()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['register_user'])) return;

    // Optional: nonce check if you added a nonce to your registration form
    if ( isset($_POST['mif_register_nonce']) && ! wp_verify_nonce( $_POST['mif_register_nonce'], 'mif_register_action' ) ) {
        $_SESSION['auth_errors'] = ['Invalid registration request.'];
        error_log('[MIF] Invalid registration nonce.');
        wp_safe_redirect(wp_get_referer() ?: site_url('/registration'));
        exit;
    }

    // Sanitize inputs
    $full_name = sanitize_text_field($_POST['full_name'] ?? '');
    $email     = sanitize_email($_POST['email'] ?? '');
    $phone     = preg_replace('/\D/', '', $_POST['phone'] ?? '');
    $password  = $_POST['password'] ?? '';
    $username  = $email;

    // Store input for repopulating on error
    $_SESSION['form_data'] = [
        'full_name' => $full_name,
        'email'     => $email,
        'phone'     => $phone,
    ];

    $errors = [];

    // Validation
    if (empty($full_name) || empty($email) || empty($phone) || empty($password)) {
        $errors[] = 'All fields are required.';
    }

    if (!is_email($email)) {
        $errors[] = 'Invalid email address.';
    }

    if (strlen($full_name) < 3) {
        $errors[] = 'Full name must be at least 3 characters.';
    }

    if (!preg_match('/^\d{10}$/', $phone)) {
        $errors[] = 'Phone number must be exactly 10 digits.';
    }

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $password)) {
        $errors[] = 'Password must be at least 8 characters long and include an upper, lower, number, and special char.';
    }

    if ( username_exists($username) || email_exists($email) ) {
        $errors[] = 'An account with this email already exists.';
    }

    // If any validation errors, redirect back
    if (!empty($errors)) {
        $_SESSION['auth_errors'] = $errors;
        error_log('[MIF] Registration validation errors: ' . implode(', ', $errors));
        wp_safe_redirect(wp_get_referer() ?: site_url('/registration'));
        exit;
    }

    // Create user
    $user_id = wp_create_user($username, $password, $email);

    if (!is_wp_error($user_id)) {
        wp_update_user([
            'ID'           => $user_id,
            'display_name' => $full_name,
            'first_name'   => $full_name,
        ]);

        update_user_meta($user_id, 'phone', $phone);
        update_user_meta($user_id, 'is_franchise_client', '1');

        // Clear session data
        unset($_SESSION['form_data']);
        unset($_SESSION['auth_errors']);

        // Redirect to login page with success flag and optional redirect_to
        $redirect_to = isset($_GET['redirect_to']) ? esc_url_raw($_GET['redirect_to']) : '';
        $target = site_url('/user-login?registered=1');
        if ($redirect_to) $target .= '&redirect_to=' . urlencode($redirect_to);
        wp_safe_redirect($target);
        exit;
    } else {
        $_SESSION['auth_errors'] = ['Registration failed. Please try again.'];
        error_log('[MIF] Registration failed: ' . $user_id->get_error_message());
        wp_safe_redirect(wp_get_referer() ?: site_url('/registration'));
        exit;
    }
}

/**
 * Login handler
 */
function handle_user_login()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['login_user'])) return;

    // Optional nonce check if present
    if ( isset($_POST['mif_login_nonce']) && ! wp_verify_nonce( $_POST['mif_login_nonce'], 'mif_login_action' ) ) {
        $_SESSION['auth_error'] = 'Invalid request.';
        error_log('[MIF] Invalid login nonce.');
        wp_safe_redirect(site_url('/user-login?error=login_failed'));
        exit;
    }

    $input = sanitize_text_field($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $redirect_to = !empty($_POST['redirect_to']) ? esc_url_raw($_POST['redirect_to']) : site_url('/submit-franchise');

    if (empty($input) || empty($password)) {
        $_SESSION['auth_error'] = 'Please enter username/email and password.';
        wp_safe_redirect(site_url('/user-login?error=login_failed'));
        exit;
    }

    // Resolve username if user typed email
    $user = get_user_by('login', $input);
    if (!$user) {
        $user = get_user_by('email', $input);
    }

    if (!$user) {
        $_SESSION['auth_error'] = 'Email or username is not registered.';
        error_log('[MIF] Login failed - user not found for: ' . $input);
        wp_safe_redirect(site_url('/user-login?error=login_failed'));
        exit;
    }

    $creds = [
        'user_login'    => $user->user_login, // ensure correct WP username
        'user_password' => $password,
        'remember'      => true,
    ];

    $user_signon = wp_signon($creds, is_ssl());

    if (!is_wp_error($user_signon)) {
        // Clear previous error
        if (!empty($_SESSION['auth_error'])) unset($_SESSION['auth_error']);

        wp_set_current_user($user_signon->ID);
        wp_set_auth_cookie($user_signon->ID);

        // Safety: allow only internal redirects
        if (0 !== strpos($redirect_to, site_url())) {
            $redirect_to = site_url('/dashboard');
        }

        wp_safe_redirect($redirect_to);
        exit;
    } else {
        $_SESSION['auth_error'] = 'Incorrect password. Please try again.';
        error_log('[MIF] wp_signon failed for user: ' . $user->user_login . ' - ' . $user_signon->get_error_message());
        wp_safe_redirect(site_url('/user-login?error=login_failed'));
        exit;
    }
}

// Attach both handlers to template_redirect (runs before output)
add_action('template_redirect', 'handle_user_registration');
add_action('template_redirect', 'handle_user_login');