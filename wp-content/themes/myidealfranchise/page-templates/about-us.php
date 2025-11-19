<?php
get_header();
// Template Name: About Us
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
                    Empowering Entrepreneurs.<br>
                    Connecting Franchise Brands.<br>
                    Changing Lives.
                </h2>
                <p class="description">
                    We Believe That Business Ownership Should Be Accessible, Transparent,
                    And Achievable. Whether You're A First-Time Franchisee Or An Established
                    Franchisor Looking To Scale, Our Platform Exists To Make Franchise
                    Discovery — And Growth — Smarter, Faster, And More Personal.
                </p>

                <div class="mission-section">
                    <h3>Our Mission</h3>
                    <p>To Empower Individuals To Become Business Owners And Help Franchise Brands Grow With
                        Integrity.</p>

                    <h4>We Do This By Delivering:</h4>
                    <ul class="features-list">
                        <li>✓ Matching And Discovery Tools</li>
                        <li>✓ Verified Franchise Opportunities Across Diverse Industries</li>
                        <li>✓ Real-Time Support And Education For Buyers</li>
                        <li>✓ Scalable Lead Generation And Marketing For Franchisors</li>
                    </ul>
                </div>
            </div>
            <div class="content-image">
                <img src="<?php echo get_template_directory_uri(  ) ?>/assets/images/business-people-studying-statistic-report-indoors.png" alt="Business professionals working on documents"
                    class="main-image">
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works">
    <div class="container">
        <h2>How It Works</h2>
        <div class="steps-grid">
            <div class="step">
                <div class="step-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14,2 14,8 20,8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                        <polyline points="10,9 9,9 8,9" />
                    </svg>
                </div>
                <h3>Explore Opportunities</h3>
                <p>Browse franchises by category, investment, or popularity.</p>
            </div>
            <div class="step">
                <div class="step-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </div>
                <h3>Get Matched</h3>
                <p>Take our smart quiz to discover your ideal fit.</p>
            </div>
            <div class="step">
                <div class="step-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                    </svg>
                </div>
                <h3>Connect & Apply</h3>
                <p>Talk to franchise reps, apply, and get funding help.</p>
            </div>
        </div>
    </div>
</section>

<!-- Press & Media / Our Team Section -->
<section class="info-sections">
    <div class="container">
        <div class="info-grid">
            <div class="info-card">
                <h3>Press & Media</h3>
                <p>Want To Feature Our Platform, Access Franchise Data, Or Schedule An Interview?</p>
                <h4>We're Available For:</h4>
                <ul>
                    <li>Market Insights And Trends</li>
                    <li>Franchise Success Stories</li>
                    <li>Expert Commentary On The Business Opportunity Space</li>
                </ul>
                <p class="small-text">As Seen In: Entrepreneur, Franchise Times, Business Insider, And More</p>
            </div>
            <div class="info-card">
                <h3>Our Team</h3>
                <p>We're A Passionate Group Of Entrepreneurs, Franchise Experts, Marketers, Developers, And Support
                    Specialists Who Care Deeply About Helping People Change Their Lives Through Business Ownership.
                </p>
                <h4>We Bring:</h4>
                <ul>
                    <li>Decades Of Combined Experience In Franchising, Technology, And Lead Generation</li>
                    <li>A Commitment To Transparency, Diversity, And Service</li>
                    <li>A Startup Mindset With Big Impact Goals</li>
                </ul>
                <p>Whether You're A Franchisor, Buyer, Or Broker — Our Team Is Here To Support Your Growth.</p>
            </div>
        </div>
    </div>
</section>

<!-- Partnerships Section -->
<section class="partnerships">
    <div class="container">
        <h2>Partnerships</h2>
        <p class="partnerships-subtitle">Let's Build Together.</p>
        <div class="partnerships-grid">
            <div class="partnership-card fade-in">
                <h4>Franchise Consultants & Brokers</h4>
            </div>
            <div class="partnership-card fade-in">
                <h4>Industry Associations</h4>
            </div>
            <div class="partnership-card fade-in">
                <h4>Funding & Legal Service Providers</h4>
            </div>
            <div class="partnership-card fade-in">
                <h4>Marketing And SaaS Tools</h4>
            </div>
            <div class="partnership-card fade-in">
                <h4>Entrepreneurship Programs</h4>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>