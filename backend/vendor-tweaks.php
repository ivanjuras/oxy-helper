<?php

// Gravity Forms - Fix the tab index
add_filter( 'gform_tabindex', 'ijoxy_gform_tabindexer', 10, 2 );
function ijoxy_gform_tabindexer( $tab_index, $form = false ) {
  $starting_index = 1000;
  add_filter( 'gform_tabindex_' . $form['id'], 'ijoxy_gform_tabindexer' );
  return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}

// WooCommerce - Remove scripts from non-WooCommerce pages
add_action( 'wp_enqueue_scripts', 'ijoxy_manage_woocommerce_styles', 99 );
function ijoxy_manage_woocommerce_styles() {
  remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

  if ( function_exists( 'is_woocommerce' ) ) {
    if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
      wp_dequeue_style( 'woocommerce_frontend_styles' );
      wp_dequeue_style( 'woocommerce_fancybox_styles' );
      wp_dequeue_style( 'woocommerce_chosen_styles' );
      wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
      wp_dequeue_script( 'wc_price_slider' );
      wp_dequeue_script( 'wc-single-product' );
      wp_dequeue_script( 'wc-add-to-cart' );
      wp_dequeue_script( 'wc-cart-fragments' );
      wp_dequeue_script( 'wc-checkout' );
      wp_dequeue_script( 'wc-add-to-cart-variation' );
      wp_dequeue_script( 'wc-single-product' );
      wp_dequeue_script( 'wc-cart' );
      wp_dequeue_script( 'wc-chosen' );
      wp_dequeue_script( 'woocommerce' );
      wp_dequeue_script( 'prettyPhoto' );
      wp_dequeue_script( 'prettyPhoto-init' );
      wp_dequeue_script( 'jquery-blockui' );
      wp_dequeue_script( 'jquery-placeholder' );
      wp_dequeue_script( 'fancybox' );
      wp_dequeue_script( 'jqueryui' );
    }
  }
}