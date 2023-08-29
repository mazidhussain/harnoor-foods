<?php
function scriptStyles()
{
    wp_enqueue_style('mainStyleSheet', get_stylesheet_uri(), [], 1.1);
}
add_action('wp_enqueue_scripts', 'scriptStyles');

/**
 * function to get image by providing it's name
 * it will try to get img from images folder
 * @param string $imgName : name of image 
 */
function get_img($imgName = 'logo.svg')
{
    $imgPath = get_stylesheet_directory_uri() . '/assets/images/' . $imgName;
    echo $imgPath;
}
// Add support for featured images
add_theme_support('post-thumbnails');

function custom_login_page()
{
    if (strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false) {
        wp_redirect(home_url('/login'));
        exit;
    }
}
add_action('init', 'custom_login_page');

function create_food_post_type() {
    $labels = array(
        'name' => 'Foods',
        'singular_name' => 'Food',
        'menu_name' => 'Foods',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Food',
        'edit' => 'Edit',
        'edit_item' => 'Edit Food',
        'new_item' => 'New Food',
        'view' => 'View',
        'view_item' => 'View Food',
        'search_items' => 'Search Foods',
        'not_found' => 'No Foods found',
        'not_found_in_trash' => 'No Foods found in Trash',
        'parent' => 'Parent Food'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'food'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array('food_category')
    );

    register_post_type('food', $args);
}
add_action('init', 'create_food_post_type');

function create_food_category_taxonomy() {
    $labels = array(
        'name' => 'Food Categories',
        'singular_name' => 'Food Category',
        'search_items' => 'Search Food Categories',
        'all_items' => 'All Food Categories',
        'edit_item' => 'Edit Food Category',
        'update_item' => 'Update Food Category',
        'add_new_item' => 'Add New Food Category',
        'new_item_name' => 'New Food Category Name',
        'menu_name' => 'Food Categories'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'food-category')
    );

    register_taxonomy('food_category', array('food'), $args);
}
add_action('init', 'create_food_category_taxonomy');
