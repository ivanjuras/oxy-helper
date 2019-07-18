<?php

add_action( 'wp_enqueue_scripts', 'ijoxy_load_font_awesome' );
function ijoxy_load_font_awesome() {
      wp_enqueue_script( 'font-awesome-free', 'https://kit.fontawesome.com/7b4f743cdb.js' );
}