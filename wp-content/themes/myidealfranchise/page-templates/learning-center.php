<?php
get_header();
// Template Name: Learning Center
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<!-- learning video Section -->
<section class="learning">
    <div class="container">
        <!-- Video Grid Section -->
        <section class="video-grid">
            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/Screenshot 2025-06-30 150327 2.png?height=200&width=300"
                        alt="What Is A Franchise">
                    <button class="play-button" aria-label="Play video">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </button>
                </div>
                <div class="video-title">What Is A Franchise?</div>
            </div>

            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/Screenshot 2025-06-30 150327 2(1).png?height=200&width=300"
                        alt="What Is A Franchise">
                    <button class="play-button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </button>
                </div>
                <div class="video-title">Franchisor Vs. Franchisee</div>
            </div>

            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/Screenshot 2025-06-30 150327 2(2).png?height=200&width=300"
                        alt="What Is A Franchise">
                    <button class="play-button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </button>
                </div>
                <div class="video-title">Types Of Franchise Models</div>
            </div>

            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/Screenshot 2025-06-30 150327 2(3).png?height=200&width=300"
                        alt="What Is A Franchise">
                    <button class="play-button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </button>
                </div>
                <div class="video-title">How To Buy A Franchise</div>
            </div>

            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/Screenshot 2025-06-30 150327 2(4).png?height=200&width=300"
                        alt="What Is A Franchise">
                    <button class="play-button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </button>
                </div>
                <div class="video-title">How To Sell A Franchise</div>
            </div>

            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/Screenshot 2025-06-30 150327 2(5).png?height=200&width=300"
                        alt="What Is A Franchise">
                    <button class="play-button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </button>
                </div>
                <div class="video-title">Franchise Financing Options</div>
            </div>
        </section>
    </div>
</section>

<!-- Content Section -->
<section class="featured-articles pb-5">
    <div class="container">
        <div class="row">
            <!-- Featured Articles -->
            <div class="col-md-8 featured-articles">
                <h2>Featured Articles</h2>
                <!-- Search Section -->
                <div class="search-section">
                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Search artical by subject or keyword">
                        <button id="searchBtn" class="search-btn">Search Articles</button>
                    </div>
                </div>
                <article class="article-card">
                    <div class="article-image">
                        <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/Rectangle 797.png?height=120&width=auto" alt="Business Growth">
                    </div>
                    <div class="article-content">
                        <h3>Business Growth vs. Exit Planning: Two Sides of the Same Coin</h3>
                        <p>As an owner, you're busy building your business, but what about planning your exit? The
                            question of selling your business now might be the furthest thing from your mind. But
                            what
                            if all roads are actually leading to the same destination?</p>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-image">
                        <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/Rectangle 797.png?height=120&width=auto" alt="Business Growth">
                    </div>
                    <div class="article-content">
                        <h3>Business Growth vs. Exit Planning: Two Sides of the Same Coin</h3>
                        <p>As an owner, you're busy building your business, but what about planning your exit? The
                            question of selling your business now might be the furthest thing from your mind. But
                            what
                            if all roads are actually leading to the same destination?</p>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-image">
                        <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/Rectangle 797.png?height=120&width=auto" alt="Business Growth">
                    </div>
                    <div class="article-content">
                        <h3>Business Growth vs. Exit Planning: Two Sides of the Same Coin</h3>
                        <p>As an owner, you're busy building your business, but what about planning your exit? The
                            question of selling your business now might be the furthest thing from your mind. But
                            what
                            if all roads are actually leading to the same destination?</p>
                    </div>
                </article>
                <article class="article-card">
                    <div class="article-image">
                        <img src="<?php echo get_template_directory_uri(  ); ?>/assets/images/Rectangle 797.png?height=120&width=auto" alt="Business Growth">
                    </div>
                    <div class="article-content">
                        <h3>Business Growth vs. Exit Planning: Two Sides of the Same Coin</h3>
                        <p>As an owner, you're busy building your business, but what about planning your exit? The
                            question of selling your business now might be the furthest thing from your mind. But
                            what
                            if all roads are actually leading to the same destination?</p>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4 sidebar">
                <!-- Business Tools -->
                <div class="sidebar-section">
                    <h3>Business Tools</h3>
                    <ul>
                        <li><a href="#">Franchise Buying Guide</a></li>
                        <li><a href="#">How to Get Funding</a></li>
                        <li><a href="#">Legal Checklist</a></li>
                        <li><a href="#">What to Ask Before You Buy</a></li>
                        <li><a href="#">Success Stories</a></li>
                        <li><a href="#">Glossary of Franchise Terms</a></li>
                        <li><a href="#">Video Tutorials & Webinars</a></li>
                        <li><a href="#">News & Trends</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div class="sidebar-section">
                    <h3>Resources</h3>
                    <ol>
                        <li><a href="#">Franchising Your Business</a></li>
                        <li><a href="#">Financial Resources</a></li>
                        <li><a href="#">Government Agencies and Resources</a></li>
                        <li><a href="#">Personnel, Recruiting and Ad Placement</a></li>
                        <li><a href="#">Marketing Resources</a></li>
                        <li><a href="#">Business Publications</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>