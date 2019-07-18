<?php

// Dequeue styles
add_action( 'wp_enqueue_styles', 'ijoxy_deregister_styles', 9999 );
add_action( 'wp_print_styles', 'ijoxy_deregister_styles', 9999 );
function ijoxy_deregister_styles() {
  if ( ! is_admin() ) {
    wp_dequeue_style( 'yoast-seo-adminbar' );
  }
}