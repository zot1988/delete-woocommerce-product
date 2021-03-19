<?php


function dwp_show_tab()
{
    add_menu_page(
        __('DWP plugin', 'dwp_plugin'),
        __('DWP plugin', 'dwp_plugin'),
        'manage_options',
        'dwp_plugin',
        'show_content',
        'dashicons-trash'
    );
}

function show_content() {
    include 'view.html';
}


$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'create_action':
        generate_products();
        break;
    case 'delete_action' :
        delete_products();
        break;
    case 'delete_sql_action':
        delete_product_sql();
        break;
    default : '';
}

function generate_products() {
    $count = (isset($_POST['count']) && $_POST['count'] > 0 ) ? $_POST['count'] : 10;
    if ($_POST['action'] != 'create_action') return;
    for ($i=0; $i < $count; $i++) {
        $product = new WC_Product();
        $product->set_name('test_'.$i);
        $product->save();
        add_post_meta($product->get_id(), 'test1', 'test1');
        add_post_meta($product->get_id(), 'test2', 'test2');
    }
    die();
}

function delete_products() {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
    );
    $loop = new WP_Query( $args );
    foreach ($loop->posts as $post) {
        $product = wc_get_product($post->ID);
        $product->delete(true);
    }
    die();
}

function delete_product_sql() {
    global $wpdb;
    $sql_postmeta = "DELETE FROM wp_postmeta WHERE post_id IN (SELECT ID FROM wp_posts WHERE post_type = 'product');";
    $sql_posts = "DELETE FROM wp_posts WHERE post_type = 'product';";
    $wpdb->get_results($sql_postmeta);
    $wpdb->get_results($sql_posts);
    die();
}
