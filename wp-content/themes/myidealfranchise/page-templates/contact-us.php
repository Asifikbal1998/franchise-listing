<?php
get_header();
// Template Name: Contact Us
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>


<section class="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Let's Get In Touch!</h2>
                <p>Fill in the form below and We'll get back to you soon.</p>

                <!-- <form id="contactForm">
                    <div class="form-group">
                        <input type="text" id="fullName" name="fullName" placeholder="Full Name" required>
                    </div>

                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                    </div>

                    <div class="form-group">
                        <textarea id="message" name="message" placeholder="Write your message here..."
                            required></textarea>
                    </div>

                    <button type="submit" class="submit-btn" id="submitBtn">Get In Touch</button>
                </form> -->

                <?php echo do_shortcode('[contact-form-7 id="1bb314c" title="Contact form for Contact"]') ?>


                <div class="contact-info">
                    <h3>Contact Info</h3>

                    <div class="contact-item">
                        <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div class="contact-details">
                            <h4>Email</h4>
                            <p>info@pasdgtal.com</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon"><i class="fa-solid fa-phone"></i></div>
                        <div class="contact-details">
                            <h4>Contact Number</h4>
                            <p>(+91) 7894561230 - (+91) 7896541230</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="contact-details">
                            <h4>Location</h4>
                            <p>Sector V, Saltlake City, Kolkata, 700091</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 image-section">
                <img class="w-100" src="<?php echo get_template_directory_uri(); ?>/assets/images/contact us image.png" alt="" srcset="">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="maps">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.2784824431915!2d88.42902937528922!3d22.56868547949448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89fc52ffeb67d%3A0x6835e02df63ff976!2sPAS%20Digital%20Technologies!5e0!3m2!1sen!2sin!4v1751876971830!5m2!1sen!2sin"
                    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>