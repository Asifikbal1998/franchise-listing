<nav>
    <!-- Checkbox for toggling menu -->
    <input type="checkbox" id="check" title="Toggle navigation menu">
    <!-- Menu icon -->
    <label for="check" class="checkbtn" aria-label="Toggle navigation menu">
        <i class="fas fa-bars"></i>
    </label>
    <!-- Site logo -->
    <div class="logo">
        <a href="<?php echo site_url(); ?>"><img src="<?php echo get_theme_mod('pas-digital_logo'); ?>" alt="Img"></a>
    </div>
    <!-- Navigation links -->

    <!-- <ul class="mb-0">
        
    </ul> -->
    <?php
    wp_nav_menu(array(
        'theme_location' => 'Primary Menu',
        'container'      => '',
        'container_class' => '',
        'container_id'      => '',
        'menu_class'     => 'mb-0',
        'manu_id'          => ''
    ));
    ?>
    <div class="navcta float-end m-auto">
        <!-- <a href="<?php echo site_url(); ?>/user-login/"><button>Sign In</button></a> -->
        <a href="<?php echo site_url(); ?>/submit-franchise/"><button>List Your Franchise</button></a>
        <!-- <a href="<?php echo site_url(); ?>/registration/"><button>Registration</button></a> -->
    </div>
</nav>