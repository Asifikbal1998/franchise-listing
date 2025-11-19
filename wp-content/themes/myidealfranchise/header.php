<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (is_front_page()) ?> <?php bloginfo('name'); ?>
        <?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- Header -->
    <header class="header">
        <!-- include main header with login & register button -->
        <?php echo get_template_part('template-parts/header-nav'); ?>
    </header>