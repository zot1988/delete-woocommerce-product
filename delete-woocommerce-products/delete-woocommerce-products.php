<?php
/**
* Plugin Name: Delete Woocommerce Products
* Description: This plugin allows you to delete all woocommerce products from the database
* Version: 1.0.0
*/

add_action('init', 'include_plugin_content');

function include_plugin_content()
{
    add_action( 'plugins_loaded','enqueue_dwp_scripts');
    add_action( 'plugins_loaded','enqueue_dwp_styles');
    wp_register_script( 'dwp-script', plugins_url( 'js/delete-woocommerce-products.js', __FILE__ ), array('jquery'), null, true );
    wp_register_style( 'dwp-style', plugins_url( 'css/delete-woocommerce-products.css' ,__FILE__) );
    wp_enqueue_script( 'dwp-script' );
    wp_enqueue_style( 'dwp-style' );
    wp_localize_script( 'dwp-script', 'dwp_ajax', array( 'ajax_url' => admin_url('admin-ajax.php')) );
    add_action( 'admin_menu', 'dwp_show_tab');
    add_action( 'wp_ajax_delete_product', 'delete_product');
    include 'main.php';
}