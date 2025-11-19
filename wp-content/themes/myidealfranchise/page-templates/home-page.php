 <?php
    get_header();
    // Template Name: Home Page
    ?>

 <!-- hero slider -->
<!--  <section class="hero-slider hero-style"> -->
     <!-- Inclide search bar -->
     <!-- <?php echo get_template_part('template-parts/search-bar'); ?> -->

<!--      <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
         <div class="carousel-inner">
             <div class="carousel-item active">
                 <div class="kenburns-top">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/businessman-with-arms-crossed(1).jpg" class="" alt="...">
                 </div>
                 <div class="carousel-caption">
                     <h1>Grow Your Franchise with the Right Partners</h1>
                     <p>Discover the best franchises tailored to your goals, budget, and lifestyle.</p>
                     <a href="<?php echo site_url() ?>/search-franchises-for-sale/"><button class="cta-btn">Find Your Perfect Franchise</button></a>
                 </div>
             </div>
             <div class="carousel-item">
                 <div class="kenburns-top">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/businessman-with-arms-crossed(2).jpg" class="" alt="...">
                 </div>
                 <div class="carousel-caption">
                     <h1>Franchise Opportunities Tailored to Your Lifestyle</h1>
                     <p>Discover the best franchises tailored to your goals, budget, and lifestyle.</p>
                     <a href="<?php echo site_url() ?>/search-franchises-for-sale/"><button class="cta-btn">Find Your Perfect Franchise</button></a>
                 </div>
             </div>
             <div class="carousel-item">
                 <div class="kenburns-top">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/businessman-with-arms-crossed(3).jpg" class="" alt="...">
                 </div>
                 <div class="carousel-caption">
                     <h1>Reach Pre-Qualified Buyers Across the Country</h1>
                     <p>Discover the best franchises tailored to your goals, budget, and lifestyle.</p>
                     <a href="<?php echo site_url() ?>/search-franchises-for-sale/"><button class="cta-btn">Find Your Perfect Franchise</button></a>
                 </div>
             </div>
         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
             <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
             <span class="carousel-control-next-icon" aria-hidden="true"></span>
             <span class="visually-hidden">Next</span>
         </button>
     </div>
 </section> -->


<section class="hero-slider hero-style">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php if (have_rows('hero_slides')): ?>
                <?php $i = 0; while (have_rows('hero_slides')): the_row(); 
                    $image = get_sub_field('hero-img');
                    $title = get_sub_field('hero_title');
                    $desc = get_sub_field('hero_desc');
                    $btn = get_sub_field('hero_button_text');
                    $link = get_sub_field('hero_button_link');
                ?>
                <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                    <div class="kenburns-top">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>">
                    </div>

                    <div class="carousel-caption">
                        <h1><?php echo esc_html($title); ?></h1>
                        <p><?php echo esc_html($desc); ?></p>
                        
                        <?php if ($link): ?>
                            <a href="<?php echo esc_url($link); ?>">
                                <button class="cta-btn">
                                    <?php echo esc_html($btn); ?>
                                </button>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php $i++; endwhile; ?>
            <?php endif; ?>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>
</section>



 <!-- Why Choose Franchise Section -->
 <section class="why-choose">
     <div class="container">
         <div class="row why-choose-content">
             <div class="col-md-5 why-choose-image">
                 <img src="<?php echo get_template_directory_uri(); ?>/assets/images/businesswoman-explaining-infographic-elements-sheet-her-male-partner(1).png"
                     alt="Business Meeting">
             </div>
             <div class="col-md-7 why-choose-text">
                 <h2>Why Choose Franchise</h2>
                 <p>Choosing a franchise is one of the smartest ways to start your entrepreneurial journey with lower risk and
                     greater support. Unlike starting a business from scratch, franchising gives you access to a proven business
                     model, recognized brand, and ongoing training and mentorship from industry experts.</p>

                 <div class="feature-list">
                     <div class="feature-item" data-aos="fade-up" data-aos-duration="1000">
                         <div class="feature-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/blockchain 1.png" alt="" srcset=""></div>
                         <div class="feature-content">
                             <h3>Proven Business Model</h3>
                             <p>Franchises offer a tested and successful business system, reducing the risk of failure compared to
                                 starting from scratch.</p>
                         </div>
                     </div>
                     <div class="feature-item" data-aos="fade-up" data-aos-duration="1500">
                         <div class="feature-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-image.png" alt="" srcset=""></div>
                         <div class="feature-content">
                             <h3>Brand Recognition</h3>
                             <p>Partner with an established brand that already has customer trust and market presence, making it
                                 easier to attract customers from day one.</p>
                         </div>
                     </div>
                     <div class="feature-item" data-aos="fade-up" data-aos-duration="2000">
                         <div class="feature-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/training.png" alt="" srcset=""></div>
                         <div class="feature-content">
                             <h3>Training & Support</h3>
                             <p>Franchisors provide comprehensive training, operational guidance, and marketing support, even if you
                                 have no prior business experience.</p>
                         </div>
                     </div>
                     <div class="feature-item" data-aos="fade-up" data-aos-duration="2500">
                         <div class="feature-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/performance.png" alt="" srcset=""></div>
                         <div class="feature-content">
                             <h3>Faster Return on Investment</h3>
                             <p>With built-in systems and loyal customer bases, franchisees often start earning quicker than
                                 independent businesses.</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- Featured Franchise Categories -->
 <section class="featured-categories">
     <div class="container">
         <h2 class="section-title">Featured Franchise Categories</h2>
         <div class="row categories-grid">
             <div class="col-md-3" data-aos="fade-up" data-aos-duration="500">
                 <div class="category-card">
                     <div class="fcardcompaire">
                         <i class="fa-regular fa-share-from-square"></i>
                     </div>
                     <div class="category-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/image.png" alt="" srcset=""></div>
                     <h3>1-800-Radiator</h3>
                     <p>Sculpt your future with VP Fitness! Own a premium boutique gym with saunas, juice bars, and tailored
                         workouts.</p>
                     <div class="category-stats">
                         <div class="stat">
                             <h5 class="stat-number">Cash Required <span>$ 1,000,000</span></h5>
                         </div>
                     </div>
                     <button class="category-btn">
                         <input type="checkbox" id="logo1" name="logo1" value="logo">
                         <label for="logo1"> Request Free Info</label><br>
                     </button>
                 </div>
             </div>

             <div class="col-md-3" data-aos="fade-up" data-aos-duration="1000">
                 <div class="category-card">
                     <div class="fcardcompaire">
                         <i class="fa-regular fa-share-from-square"></i>
                     </div>
                     <div class="category-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/image (2).png" alt="" srcset=""></div>
                     <h3>1-800-Radiator</h3>
                     <p>Sculpt your future with VP Fitness! Own a premium boutique gym with saunas, juice bars, and tailored
                         workouts.</p>
                     <div class="category-stats">
                         <div class="stat">
                             <h5 class="stat-number">Cash Required <span>$ 1,000,000</span></h5>
                         </div>
                     </div>
                     <button class="category-btn">
                         <input type="checkbox" id="logo2" name="logo1" value="logo">
                         <label for="logo2"> Request Free Info</label><br>
                     </button>
                 </div>
             </div>

             <div class="col-md-3" data-aos="fade-up" data-aos-duration="1500">
                 <div class="category-card">
                     <div class="fcardcompaire">
                         <i class="fa-regular fa-share-from-square"></i>
                     </div>
                     <div class="category-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/image(1).png" alt="" srcset=""></div>
                     <h3>1-800-Radiator</h3>
                     <p>Sculpt your future with VP Fitness! Own a premium boutique gym with saunas, juice bars, and tailored
                         workouts.</p>
                     <div class="category-stats">
                         <div class="stat">
                             <h5 class="stat-number">Cash Required <span>$ 1,000,000</span></h5>
                         </div>
                     </div>
                     <button class="category-btn">
                         <input type="checkbox" id="logo3" name="logo3" value="logo">
                         <label for="logo3"> Request Free Info</label><br>
                     </button>
                 </div>
             </div>

             <div class="col-md-3" data-aos="fade-up" data-aos-duration="2000">
                 <div class="category-card">
                     <div class="fcardcompaire">
                         <i class="fa-regular fa-share-from-square"></i>
                     </div>
                     <div class="category-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/image(2).png" alt="" srcset=""></div>
                     <h3>1-800-Radiator</h3>
                     <p>Sculpt your future with VP Fitness! Own a premium boutique gym with saunas, juice bars, and tailored
                         workouts.</p>
                     <div class="category-stats">
                         <div class="stat">
                             <h5 class="stat-number">Cash Required <span>$ 1,000,000</span></h5>
                         </div>
                     </div>
                     <button class="category-btn">
                         <input type="checkbox" id="logo4" name="logo4" value="logo">
                         <label for="logo4"> Request Free Info</label><br>
                     </button>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- Compare Franchise Choices -->
 <section class="compare-section">
     <div class="container">
         <div class="row">
             <div class="col-md-6 compare-text">
                 <h2>Compare Franchise Choices</h2>
                 <p>Choosing the right franchise is a big decision — and comparing your options side-by-side is the smartest
                     way to find the best fit. Our powerful Franchise Comparison Tool lets you evaluate multiple brands across
                     key factors like:</p>
                 <ul class="compare-list">
                     <li><span>1.</span> Initial Investment & Ongoing Fees</li>
                     <li><span>2.</span> Earning Potential & Time to ROI</li>
                     <li><span>3.</span> Training & Support Provided</li>
                     <li><span>4.</span> Brand Reputation & Market Demand</li>
                     <li><span>5.</span> Ideal Franchisee Profile</li>
                     <li><span>6.</span> Available Locations & Expansion Opportunities</li>
                 </ul>
                 <p>With just a few clicks, you can shortlist franchises, add them to your comparison list, and view a clear,
                     side-by-side breakdown — helping you make an informed and confident decision.</p>
                 <button class="cta-button">Start Comparing Franchises</button>
             </div>
             <div class="col-md-6 compare-image">
                 <img src="<?php echo get_template_directory_uri(); ?>/assets/images/business-people-studying-statistic-report-indoors.png" alt="Business Analysis">
             </div>
         </div>
     </div>
 </section>

 <!-- Franchise Business Brokers -->
 <section class="brokers-section">
     <div class="container">
         <div class="row">
             <div class="col-md-5"></div>
             <div class="col-md-7 brokers-text">
                 <h2>Franchise Business Brokers</h2>
                 <h3>Expert Help to Find the Right Franchise — At No Cost to You</h3>
                 <p>Buying a franchise can feel overwhelming — but you don’t have to do it alone. Our certified Franchise
                     Business Brokers are here to guide you through every step of the process. From understanding your goals to
                     narrowing down the best-fit opportunities, brokers provide free, personalized support so you make smart,
                     confident decisions.</p>
                 <div class="broker-features">
                     <h4>What Our Brokers Do for You:</h4>
                     <ul>
                         <li> ✅ Understand your background, budget, and goals</li>
                         <li> ✅ Recommend top-performing franchises that match your profile</li>
                         <li> ✅ Share insider insights on earnings, support, and scalability</li>
                         <li> ✅ Help you prepare for meetings with franchisors</li>
                         <li> ✅ Connect you with legal, funding, and onboarding resources</li>
                     </ul>
                 </div>
                 <button class="cta-button">Connect with a Broker</button>
             </div>
         </div>
     </div>
 </section>

 <!-- Ready to Sell Your Franchise -->
 <section class="sell-franchise">
     <div class="container">
         <div class="row">
             <div class="col-md-10">
                 <h2 class="section-title">Ready to Sell Your Franchise</h2>
                 <p class="section-subtitle">If you're ready to take your franchise to the next level, we’re here to help.
                     Whether
                     you’re an emerging concept or an established national brand, our platform connects you with qualified,
                     motivated
                     buyers actively searching for their next business opportunity.</p>
             </div>
             <div class="col-md-2">

                 <div class="sell-cta">
                     <a href="<?php echo site_url() ?>/submit-franchise/"><button class="cta-button">List Your Franchise</button></a>
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-md-3" data-aos="fade-up" data-aos-duration="1000">
                 <div class="franchise-card">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/woman-painting-house-wall-full-shot.png" alt="Franchise Opportunity">
                     <div class="franchise-info">
                         <h3>MA-Residential And Commercial Property Painting</h3>
                         <div class="franchise-price">$1,800,000</div>
                         <button class="franchise-btn">View Details</button>
                     </div>
                 </div>
             </div>

             <div class="col-md-3" data-aos="fade-up" data-aos-duration="1500">
                 <div class="franchise-card">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/office-buildings-with-modern-architecture.png" alt="Franchise Opportunity">
                     <div class="franchise-info">
                         <h3>Multi-Unit Batteries Plus With Real Estate</h3>
                         <div class="franchise-price">$1,400,000</div>
                         <button class="franchise-btn">View Details</button>
                     </div>
                 </div>
             </div>

             <div class="col-md-3" data-aos="fade-up" data-aos-duration="2000">
                 <div class="franchise-card">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tiler-working-renovation-apartment.png" alt="Franchise Opportunity">
                     <div class="franchise-info">
                         <h3>Remodeling Franchise Covering Georgia</h3>
                         <div class="franchise-price">$2,000,000</div>
                         <button class="franchise-btn">View Details</button>
                     </div>
                 </div>
             </div>

             <div class="col-md-3" data-aos="fade-up" data-aos-duration="2500">
                 <div class="franchise-card">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cosmetologist-applying-mask-face-client-beauty-salon.png" alt="Franchise Opportunity">
                     <div class="franchise-info">
                         <h3>CO-Innovative and Exclusive Facials</h3>
                         <div class="franchise-price">$900,000</div>
                         <button class="franchise-btn">View Details</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- faq -->
 <section class="faq">
     <div class="container">
         <div class="row">
             <div class="col-md-6">
                 <div class="">
                     <h2 class="section-title">Why Our Franchise is Your Best Business Opportunity</h2>
                     <p class="section-subtitle">Ready to embark on a rewarding entrepreneurial journey? Join Future State and be
                         part of a legacy of success. Contact us to learn more about franchise opportunities, investment details,
                         <br> <br>

                         and how we can support you in achieving your business goals. Ready to embark on a rewarding
                         entrepreneurial journey? Join Future State and be part of a legacy of success.
                     </p>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="details" data-aos="fade-up" data-aos-duration="1000">
                     <details class="details__container">
                         <summary class="details__summary">
                             <!-- The title -->
                             <h2 class="details__title">How does franchising work?</h2>
                         </summary>
                     </details>
                     <!-- The content -->
                     <div class="details__desc">
                         <div class="details__desc-inner">
                             Our customers are at the heart of everything we do, and we strive to provide exceptional
                         </div>
                     </div>
                 </div>
                 <div class="details" data-aos="fade-up" data-aos-duration="1500">
                     <details class="details__container">
                         <summary class="details__summary">
                             <!-- The title -->
                             <h2 class="details__title">What are the benefits of franchising?</h2>
                         </summary>
                     </details>
                     <!-- The content -->
                     <div class="details__desc">
                         <div class="details__desc-inner">
                             Our customers are at the heart of everything we do, and we strive to provide exceptional
                         </div>
                     </div>
                 </div>
                 <div class="details" data-aos="fade-up" data-aos-duration="2000">
                     <details class="details__container">
                         <summary class="details__summary">
                             <!-- The title -->
                             <h2 class="details__title">Are franchise opportunities available?</h2>
                         </summary>
                     </details>
                     <!-- The content -->
                     <div class="details__desc">
                         <div class="details__desc-inner">
                             Our customers are at the heart of everything we do, and we strive to provide exceptional
                         </div>
                     </div>
                 </div>
                 <div class="details" data-aos="fade-up" data-aos-duration="2500">
                     <details class="details__container">
                         <summary class="details__summary">
                             <!-- The title -->
                             <h2 class="details__title">Are franchise opportunities available?</h2>
                         </summary>
                     </details>
                     <!-- The content -->
                     <div class="details__desc">
                         <div class="details__desc-inner">
                             Our customers are at the heart of everything we do, and we strive to provide exceptional
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- Start Your Journey -->
 <section class="journey-section">
     <div class="container">
         <div class="row">
             <div class="col-md-5">
                 <div class="journey-image">
                     <a id="play-video" class="video-play-button" href="#">
                         <span></span>
                     </a>
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/businesswoman-explaining-infographic-elements-sheet-her-male-partner(2).png"
                         alt="Franchise Success">
                 </div>
             </div>
             <div class="col-md-7">
                 <div class="journey-text">
                     <h2>Start Your Franchise Journey</h2>
                     <h3>Franchise Direct Will Help You Find the Perfect Franchise Opportunity</h3>
                     <p>Our comprehensive franchise marketplace connects you with over 3,000 franchise opportunities across all
                         industries and investment levels.</p>
                     <ul>
                         <li>• Connecting Franchises & Prospective Owners FREE</li>
                         <li>• Advice for Finance, Funding, and Legal</li>
                         <li>• Resources for successful franchise Operations</li>
                     </ul>
                     <button class="cta-button">Find the Right Franchise</button>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- CTA Banner -->
 <section class="cta-banner">
     <div class="container">
         <div class="row">
             <div class="col-md-9 cta-content">
                 <h2>Want personalized franchise recommendations?</h2>
                 <p>Finding the right franchise can be overwhelming—but you don’t have to do it alone.</p>
             </div>
             <div class="col-md-3 actioncta">
                 <button class="cta-button-alt"><a href="recommend.html" target="_blank"></a> Get Your Recommendations
                     Now</button>
             </div>
         </div>
     </div>
 </section>

 <?php get_footer(); ?>