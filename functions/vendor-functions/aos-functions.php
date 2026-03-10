<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('wp_enqueue_scripts', 'enqueue_aos');
function enqueue_aos() {
  // AOS
  wp_enqueue_style(
    'aos-css',
    get_stylesheet_directory_uri() . '/assets/vendors/aos/aos.css',
    array(),
    '2.3.4'
  );

  wp_enqueue_script(
    'aos-js',
    get_stylesheet_directory_uri() . '/assets/vendors/aos/aos.js',
    array(),
    '2.3.4',
    true // load in footer
  );

  // Init AOS
  wp_add_inline_script(
    'aos-js',
    'document.addEventListener("DOMContentLoaded", function() { AOS.init(); });'
  );
}