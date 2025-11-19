<?php

/**
 * Franchise Submission Handler + Notices + Logs
 */

/**
 * Handle franchise form submission
 */
function handle_franchise_submission()
{
    if (!isset($_POST['submit_franchise_form'])) return;
    if (!isset($_POST['submit_franchise_nonce']) || !wp_verify_nonce($_POST['submit_franchise_nonce'], 'submit_franchise_nonce_action')) return;
    if (!is_user_logged_in()) return;

    $user_id = get_current_user_id();
    $title       = sanitize_text_field($_POST['franchise_name']);
    $description = wp_kses_post($_POST['franchise_description']);
    $status = 'success';
    $log_message = '';

    try {
        // Create the post (pending review)
        $post_id = wp_insert_post([
            'post_title'   => $title,
            'post_content' => $description,
            'post_type'    => 'franchise',
            'post_status'  => 'pending',
            'post_author'  => $user_id,
        ]);

        if (!$post_id || is_wp_error($post_id)) {
            throw new Exception(is_wp_error($post_id) ? $post_id->get_error_message() : 'Unknown error creating post');
        }

        // ACF fields mapping
        update_field('franchise_name', $title, $post_id);
        update_field('industry_name', sanitize_text_field($_POST['franchise_category']), $post_id);
        update_field('liquid_capital', sanitize_text_field($_POST['cash_required']), $post_id);
        update_field('min_investment', sanitize_text_field($_POST['min_investment']), $post_id);
        update_field('max_investment', sanitize_text_field($_POST['max_investment']), $post_id);
        update_field('new_worth', sanitize_text_field($_POST['net_worth_required']), $post_id);
        update_field('franchise_fees', sanitize_text_field($_POST['franchise_fees']), $post_id);
        update_field('total_number_of_units', sanitize_text_field($_POST['total_number_of_units']), $post_id);
        update_field('franchising_since', sanitize_text_field($_POST['franchising_since']), $post_id);
        update_field('corporate_headquarters', sanitize_text_field($_POST['corporate_headquarters']), $post_id);
        update_field('ceo_name', sanitize_text_field($_POST['ceo_name']), $post_id);
        update_field('training_and_support', sanitize_text_field($_POST['training_and_support']), $post_id);
        update_field('financing_available', sanitize_text_field($_POST['financing_available']), $post_id);
        update_field('website_url', esc_url_raw($_POST['franchise_website']), $post_id);

        // Upload logo
        if (!empty($_FILES['franchise_logo']['name'])) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';

            $uploaded = media_handle_upload('franchise_logo', $post_id);
            if (!is_wp_error($uploaded)) {
                update_field('franchise_logo', $uploaded, $post_id);
            } else {
                throw new Exception("Logo upload failed: " . $uploaded->get_error_message());
            }
        }

        // Save status + last submitted ID for dashboard messages
        update_user_meta($user_id, '_franchise_submission_status', 'pending');
        update_user_meta($user_id, '_last_submitted_franchise_id', $post_id);

        // Emails with logging
        $admin_email = get_option('admin_email');
        $user        = get_userdata($user_id);

        // Admin email
        $admin_subject = 'New Franchise Submitted';
        $admin_message = 'A new franchise "' . $title . '" has been submitted and is awaiting review.';
        if (wp_mail($admin_email, $admin_subject, $admin_message)) {
            create_franchise_log($user_id, $title, 'success', 'Admin email sent successfully.');
        } else {
            create_franchise_log($user_id, $title, 'failed', 'Admin email failed to send.');
        }

        // User email
        $user_subject = 'Franchise Submission Received';
        $user_message = 'Thank you for submitting your franchise "' . $title . '". Our team will review it shortly. You will be notified once it is published.';
        if (wp_mail($user->user_email, $user_subject, $user_message)) {
            create_franchise_log($user_id, $title, 'success', 'User confirmation email sent successfully.');
        } else {
            create_franchise_log($user_id, $title, 'failed', 'User confirmation email failed to send.');
        }

        // Redirect user to home page (stay on same page with thank you message)
        $redirect_url = add_query_arg([
            'franchise_submitted' => '1',
            'franchise_title'     => urlencode($title),
        ], home_url());

        wp_redirect($redirect_url);
        exit;
    } catch (Exception $e) {
        $status = 'failed';
        $log_message = $e->getMessage();

        // Redirect with error info
        $redirect_url = add_query_arg([
            'franchise_submitted' => '0',
            'error_message'       => urlencode($log_message),
        ], wp_get_referer());

        wp_redirect($redirect_url);
        exit;
    } finally {
        // Log submission itself
        create_franchise_log($user_id, $title, $status, $log_message);
    }
}
add_action('template_redirect', 'handle_franchise_submission');


/**
 * Show frontend thank you message after submission
 */
function show_franchise_submission_notice()
{
    if (isset($_GET['franchise_submitted'])) {
        $status = sanitize_text_field($_GET['franchise_submitted']);

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof Swal !== "undefined") {';

        if ($status == '1' && isset($_GET['franchise_title'])) {
            $title = esc_js(urldecode($_GET['franchise_title']));
            echo '
                Swal.fire({
                    title: "🎉 Franchise Submitted!",
                    html: "Thank you for submitting <strong>' . $title . '</strong>.<br>Our team will review it shortly and notify you once it’s published.",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK",
                    timer: 10000,
                    timerProgressBar: true
                });
            ';
        } elseif ($status == '0' && isset($_GET['error_message'])) {
            $error = esc_js(urldecode($_GET['error_message']));
            echo '
                Swal.fire({
                    title: "❌ Submission Failed",
                    html: "There was an error submitting your franchise:<br><small>' . $error . '</small>",
                    icon: "error",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "Try Again"
                });
            ';
        }

        echo '}
        });
        </script>';
    }
}
add_action('wp_footer', 'show_franchise_submission_notice');


/**
 * Notify user when admin publishes franchise
 */
function notify_user_on_publish($post_id, $post)
{
    if ($post->post_type !== 'franchise') return;
    if ($post->post_status !== 'publish') return;

    $author = get_userdata($post->post_author);
    if ($author && $author->user_email) {
        $subject = 'Your Franchise is Now Live!';
        $message = 'Congratulations! Your franchise "' . $post->post_title . '" has been published and is now live on our website.' . "\n\n" .
            'View it here: ' . get_permalink($post->ID);

        if (wp_mail($author->user_email, $subject, $message)) {
            create_franchise_log($post->post_author, $post->post_title, 'success', 'Publish notification email sent.');
        } else {
            create_franchise_log($post->post_author, $post->post_title, 'failed', 'Publish notification email failed.');
        }

        update_user_meta($post->post_author, '_franchise_submission_status', 'published');
        update_user_meta($post->post_author, '_last_published_franchise_id', $post->ID);

        // Log the publish event
        create_franchise_log($post->post_author, $post->post_title, 'published', 'Franchise published successfully.');
    }
}
add_action('publish_franchise', 'notify_user_on_publish', 10, 2);


/**
 * Register Franchise Log CPT
 */
function register_franchise_log_cpt()
{
    register_post_type('franchise_log', [
        'labels' => [
            'name'          => 'Franchise Logs',
            'singular_name' => 'Franchise Log',
        ],
        'public'      => false,
        'show_ui'     => true,
        'menu_icon'   => 'dashicons-list-view',
        'supports'    => ['title', 'editor'],
    ]);
}
add_action('init', 'register_franchise_log_cpt');


/**
 * Create a log entry
 */
function create_franchise_log($user_id, $franchise_name, $status, $message = '')
{
    $user = get_userdata($user_id);
    $log_title = ($status === 'success' ? '✅ Success' : ($status === 'failed' ? '❌ Failed' : 'ℹ️')) . ' - ' . sanitize_text_field($franchise_name);

    $log_content  = "User: " . ($user ? $user->user_email : 'Guest') . "\n";
    $log_content .= "Franchise: " . sanitize_text_field($franchise_name) . "\n";
    $log_content .= "Status: " . ucfirst($status) . "\n";
    $log_content .= "Message: " . ($message ?: 'N/A') . "\n";
    $log_content .= "Date: " . current_time('mysql') . "\n";

    wp_insert_post([
        'post_type'   => 'franchise_log',
        'post_title'  => $log_title,
        'post_content' => $log_content,
        'post_status' => 'publish',
    ]);
}
