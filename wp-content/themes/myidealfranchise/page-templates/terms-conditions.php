<?php
// Template Name: Terms & Conditions
get_header();
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<section class="privacy">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="terms-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>