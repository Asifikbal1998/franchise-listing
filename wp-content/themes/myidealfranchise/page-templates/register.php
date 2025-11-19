<?php
/*
Template Name: Register
*/
get_header();

if (is_user_logged_in()) {
    wp_redirect(site_url('/dashboard'));
    exit;
}

if (!session_id()) session_start();
?>

<section class="register">
    <div class="container section" style="max-width: 600px; margin: auto;">
        <?php

        if (!empty($_SESSION['auth_errors'])):
            echo '<div class="alert alert-error" style="color: red;"><ul>';
            foreach ($_SESSION['auth_errors'] as $err) {
                echo '<li>' . nl2br(htmlspecialchars($err)) . '</li>';
            }
            echo '</ul></div>';
            unset($_SESSION['auth_errors']);
        endif;
        ?>

        <?php
        $old = $_SESSION['form_data'] ?? ['full_name' => '', 'email' => '', 'phone' => ''];
        ?>

        <form method="post">
            <h2 class="text-center">Create Your Free Account</h2>
            <p>Already have an account?
                <a href="<?php echo site_url('/user-login'); ?>?redirect_to=<?php echo urlencode($_GET['redirect_to'] ?? ''); ?>">Sign in here</a>
            </p>


            <label>Full Name <span>*</span></label>
            <input type="text" name="full_name" placeholder="Your full name" required value="<?= esc_attr($old['full_name']) ?>">

            <label>Email Address <span>*</span></label>
            <input type="email" name="email" placeholder="you@example.com" required value="<?= esc_attr($old['email']) ?>">

            <label>Phone Number <span>*</span></label>
            <input type="text" name="phone" placeholder="1234567890" required value="<?= esc_attr($old['phone']) ?>">

            <label>Password <span>*</span></label>
            <div style="position: relative;">
                <input type="password" name="password" id="password" placeholder="At least 8 characters" required style="padding-right: 40px;">
                <span onclick="togglePassword()" style="position: absolute; top: 8px; right: 10px; cursor: pointer;">👁️</span>
            </div>


            <input type="submit" name="register_user" value="Register" style="margin-top: 15px;">
        </form>
        <?php unset($_SESSION['form_data']); ?>
    </div>
</section>

<script>
    function togglePassword() {
        const input = document.getElementById("password");
        input.type = input.type === "password" ? "text" : "password";
    }
</script>

<?php get_footer(); ?>