<?php
function register_franchise_post_type()
{
    register_post_type('franchise', [
        'labels' => [
            'name' => 'Franchises',
            'singular_name' => 'Franchise',
            'add_new' => 'Add New Franchise',
            'add_new_item' => 'Add New Franchise',
            'edit_item' => 'Edit Franchise',
            'new_item' => 'New Franchise',
            'view_item' => 'View Franchise',
            'search_items' => 'Search Franchises',
            'not_found' => 'No franchises found',
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-store',
        'supports' => ['title', 'editor', 'thumbnail', 'author'],
        'rewrite' => ['slug' => 'franchises'],
        'capability_type' => 'post',
    ]);
}
add_action('init', 'register_franchise_post_type');

// Register Franchise Category taxonomy
function register_franchise_taxonomies()
{
    register_taxonomy('franchise_category', ['franchise'], [
        'labels' => [
            'name' => 'Categories',
            'singular_name' => 'Category',
            'search_items' => 'Search Categories',
            'all_items' => 'All Categories',
            'edit_item' => 'Edit Category',
            'update_item' => 'Update Category',
            'add_new_item' => 'Add New Category',
            'new_item_name' => 'New Category Name',
            'menu_name' => 'Categories',
        ],
        'hierarchical' => true, // Set to false if you want tags-style instead of categories
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'franchise-category'],
    ]);
    register_taxonomy('franchise_location', ['franchise'], [
        'labels' => ['name' => 'Locations', 'singular_name' => 'Location'],
        'hierarchical' => false, // like tags
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'location'],
    ]);
}
add_action('init', 'register_franchise_taxonomies');
