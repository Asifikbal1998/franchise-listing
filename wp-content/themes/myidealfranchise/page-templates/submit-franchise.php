<?php
/*
Template Name: Submit Franchise
*/

if (!is_user_logged_in()) {
  $current_url = esc_url(home_url($_SERVER['REQUEST_URI']));
  $login_url = add_query_arg('redirect_to', urlencode($current_url), home_url('/user-login/'));
  wp_redirect($login_url);
  exit;
}

// Only proceed with the rest if user is logged in
get_header();
?>

<div class="container section franchise-form">
  <h2 class="text-center">Submit Your Franchise</h2>
  <?php include get_template_directory() . '/template-parts/form-submit-franchise.php'; ?>
</div>

<?php get_footer(); ?>