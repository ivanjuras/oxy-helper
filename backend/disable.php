<?php

// Disable rel='shortlink' and shortlink HTTP header
add_filter( 'after_setup_theme', 'ijoxy_remove_shortlink' );
function ijoxy_remove_shortlink() {
  remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
  remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
}


// Disable embeds
add_action( 'init', 'ijoxy_remove_embeds' );
function ijoxy_remove_embeds() {
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
}


// Disable emojis
add_action( 'init', 'ijoxy_disable_emojis' );
function ijoxy_disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'ijoxy_disable_emojis_tinymce' );
  add_filter( 'wp_resource_hints', 'ijoxy_disable_emojis_remove_dns_prefetch', 10, 2 );
}
   
function ijoxy_disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
   
function ijoxy_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
    $urls = array_diff( $urls, array( $emoji_svg_url ) );
  }

  return $urls;
}


// Disable jQuery Migrate
add_action( 'wp_default_scripts', 'ijoxy_dequeue_jquery_migrate' );
function ijoxy_dequeue_jquery_migrate( $scripts ) {
  if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
    $scripts->registered['jquery']->deps = array_diff(
      $scripts->registered['jquery']->deps,
      [ 'jquery-migrate' ]
    );
  }
}


// Disable embeds
add_action( 'wp_footer', 'ijoxy_disable_embeds' );
function ijoxy_disable_embeds(){
  wp_dequeue_script( 'wp-embed' );
}


// Remove RSD rel link tag
remove_action ( 'wp_head', 'rsd_link' );


// Remove Windows Live Writer tag
remove_action( 'wp_head', 'wlwmanifest_link');


// Remove WP Generator tag
remove_action( 'wp_head', 'wp_generator' );