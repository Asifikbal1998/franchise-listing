<?php
get_header();
// Template Name: Franchisor
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="main-content">
    <div class="container">
        <div class="content-grid">
            <div class="content-text">
                <h2 class="main-heading">
                    Expand Your Franchise Brand with Qualified Leads & Maximum Visibility
                </h2>
                <p class="description">
                    Looking to grow your franchise network with serious, motivated buyers? Our platform is built to
                    help franchisors like you attract the right investors, maximize brand exposure, and convert more
                    leads into franchisees — faster and smarter.
                </p>
            </div>
            <div class="content-image">
                <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/business-people-studying-statistic-report-indoors(1).png"
                    alt="Business professionals working on documents" class="main-image">
            </div>
        </div>
    </div>
</section>

<section class="info-sections">
    <div class="container">
        <div class="info-grid">
            <div class="info-card">
                <h3>Why List With Us</h3>
                <ul>
                    <li>Appear in top search results for your industry or location</li>
                    <li>Show off your brand through a high-impact profile page with video, photos, and testimonials
                    </li>
                    <li>Use our built-in lead capture forms and performance tools</li>
                    <li>Get support from a dedicated account manager</li>
                </ul>
                <p class="small-text">Listing your franchise with us means you’re visible where serious buyers are
                    already looking.</p>
            </div>
            <div class="info-card">
                <h3>Franchise Lead Quality</h3>
                <h4>We focus on quality, not quantity. Our audience includes:
                </h4>
                <ul>
                    <li>Pre-qualified buyers with set investment goals</li>
                    <li>Professionals transitioning into entrepreneurship</li>
                    <li>Investors, veterans, women in business, and global buyers</li>
                    <li>Verified users who’ve shown interest in your category</li>
                </ul>
                <p>You’ll get real-time notifications, lead tracking tools, and CRM integration options to manage
                    every inquiry efficiently.</p>
            </div>
        </div>
    </div>
</section>

<section class="casestudy">
    <div class="container">
        <h2>Franchise Case Studies</h2>
        <p class="casestudy-subtitle">Discover how other brands have scaled successfully using our platform:</p>
        <div class="casestudy-grid">
            <div class="casestudy_card fade-in">
                <h4>FreshClean Home Services grew from 8 to 35 units in 12 months</h4>
            </div>
            <div class="casestudy_card fade-in">
                <h4>BurgerBarn Express received 400+ leads in 3 weeks</h4>
            </div>
            <div class="casestudy_card fade-in">
                <h4>Elite Painting Pro found top-tier partners using our quiz-to-apply system</h4>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>