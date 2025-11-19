<?php
/* Template Name: Franchises */
get_header();
?>

<section class="hero">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<section class="franchise-directory-home-section">
    <div class="container franchise-directory">
        <div class="franchise-directory__container">
            <!-- Main -->
            <main class="franchise-directory__main-content">
                <header class="franchise-directory__page-header">
                    <h1 class="franchise-directory__page-title franchise-directory-js-page-title">
                        Find your perfect franchise by filtering through industries, locations, and investment levels or search directly by franchise name.
                    </h1>
                </header>

                <!-- Filter Row -->
                <section class="franchise-directory__filter-section">
                    <div class="franchise-directory__filter-controls">
                        <!-- Category select -->
                        <div class="franchise-directory__filter-group">
                            <select class="franchise-directory__filter-select" id="fd-category">
                                <option value="">All Categories</option>
                                <?php
                                global $wpdb;
                                $categories = $wpdb->get_col("
                                    SELECT DISTINCT meta_value 
                                    FROM $wpdb->postmeta 
                                    WHERE meta_key = 'industry_name'
                                    AND meta_value != ''
                                ");
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        echo '<option value="' . esc_attr($category) . '">' . esc_html($category) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- US State -->
                        <div class="franchise-directory__filter-group">
                            <select class="franchise-directory__filter-select" id="fd-state">
                                <option value="" selected>All US State</option>
                                <option disabled>------------</option>
                                <?php
                                $states = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"];
                                foreach ($states as $state) {
                                    echo '<option value="' . esc_attr($state) . '">' . esc_html($state) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Investment -->
                        <div class="franchise-directory__filter-group">
                            <select class="franchise-directory__filter-select" id="fd-investment">
                                <option value="">Cash to Investment</option>
                                <option value="25000">Up to $25,000</option>
                                <option value="50000">Up to $50,000</option>
                                <option value="100000">Up to $100,000</option>
                                <option value="250000">Up to $250,000</option>
                                <option value="500000">Up to $500,000</option>
                                <option value="1000000">Up to $1,000,000</option>
                                <option value="5000000">Up to $5,000,000</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Search Row -->
                <div class="search-row">
                    <input type="text" id="fd-search" placeholder="Search By Franchise Name">
                    <button id="fd-search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                <!-- Results Grid -->
                <section class="franchise-directory__franchise-grid" id="fd-grid">
                    <?php
                    $init_args = build_franchise_query_args(['page' => 1, 'per_page' => 12]);
                    $init_q = new WP_Query($init_args);
                    if ($init_q->have_posts()) :
                        while ($init_q->have_posts()) : $init_q->the_post();
                            echo render_franchise_card($init_q->post);
                        endwhile;
                        wp_reset_postdata();
                    else:
                        echo '<div class="franchise-directory__no-results">No franchises found.</div>';
                    endif;
                    ?>
                </section>

                <!-- Pagination -->
                <?php
                $total  = (int)($init_q->found_posts ?? 0);
                $pages  = (int)($init_q->max_num_pages ?? 1);
                $from   = $total ? 1 : 0;
                $to     = min(12, $total);
                ?>
                <section class="franchise-directory__pagination" id="fd-pagination-wrap" data-pages="<?php echo esc_attr($pages); ?>">
                    <div class="franchise-directory__pagination-info" id="fd-pagination-info">
                        <?php echo esc_html(sprintf('%d - %d of %d results', $from, $to, $total)); ?>
                    </div>
                    <div class="franchise-directory__pagination-controls" id="fd-pagination">
                        <?php if ($pages > 1): ?>
                            <button class="franchise-directory__pagination-button" data-page="prev">‹</button>
                            <?php for ($i = 1; $i <= $pages; $i++): ?>
                                <button class="franchise-directory__pagination-button <?php echo $i === 1 ? 'franchise-directory__pagination-button--active' : ''; ?>" data-page="<?php echo $i; ?>"><?php echo $i; ?></button>
                            <?php endfor; ?>
                            <button class="franchise-directory__pagination-button" data-page="next">›</button>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- Hidden state -->
                <input type="hidden" id="fd-current-page" value="1">
                <input type="hidden" id="fd-per-page" value="12">
                <input type="hidden" id="fd-budget" value="">
            </main>
        </div>
    </div>
</section>


<?php get_footer(); ?>