<?php
/*
Template Name: Login
*/
get_header();

// If already logged in, go to dashboard
if (is_user_logged_in()) {
    wp_safe_redirect(site_url('/dashboard'));
    exit;
}

$error = isset($_GET['error']) ? sanitize_text_field($_GET['error']) : '';
?>

<section class="login">
    <div class="container section">

        <?php
        // Display session-stored auth error (set by user-auth.php)
        if (!empty($_SESSION['auth_error'])) {
            echo '<div class="alert alert-error">' . esc_html($_SESSION['auth_error']) . '</div>';
            unset($_SESSION['auth_error']);
        }

        // Display registration success
        if (isset($_GET['registered']) && $_GET['registered'] == '1') : ?>
            <div class="alert alert-success">Registration successful! Please log in with your credentials.</div>
        <?php endif; ?>

        <?php if ($error === 'login_failed') : ?>
            <div class="alert alert-error">Invalid username or password.</div>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url(site_url('/user-login')); ?>">
            <h2 class="text-center">Sign In</h2>
            <p>Don't have an account?
                <a href="<?php echo esc_url(site_url('/registration') . '?redirect_to=' . urlencode($_GET['redirect_to'] ?? '')); ?>">
                    Create Your Free Account
                </a>
            </p>

            <label>Username or Email <span>*</span></label>
            <input type="text" name="username" required autocomplete="username">

            <label>Password <span>*</span></label>
            <input type="password" name="password" required autocomplete="current-password">

            <input type="hidden" name="redirect_to" value="<?php echo esc_attr($_GET['redirect_to'] ?? site_url('/dashboard')); ?>">

            <?php wp_nonce_field('mif_login_action', 'mif_login_nonce'); ?>

            <input type="submit" name="login_user" value="Login">
            <p><a href="<?php echo esc_url(wp_lostpassword_url()); ?>">Forgot your password?</a></p>
        </form>
    </div>
</section>

<?php get_footer(); ?>