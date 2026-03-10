<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('wp_enqueue_scripts', 'enqueue_swiper');
function enqueue_swiper() {
  // Swiper.js
  wp_register_style(
    'swiper',
    get_stylesheet_directory_uri() . '/assets/vendors/swiper/swiper-bundle.min.css',
    [],
    '11.0.5'
  );

  wp_register_script(
    'swiper',
    get_stylesheet_directory_uri() . '/assets/vendors/swiper/swiper-bundle.min.js',
    [],
    '11.0.5',
    true
  );

  wp_register_script(
    'swiper-init',
    get_stylesheet_directory_uri() . '/assets/js/swiper-init.js',
    ['swiper'],
    filemtime(get_stylesheet_directory() . '/assets/js/swiper-init.js'),
    true
  );
}

add_action('wp_enqueue_scripts', function() {

    if (is_page() || is_singular()) { // optional, load only on pages/posts
        global $post;

        if (have_rows('flexible_page_sections', $post->ID)) {
            while (have_rows('flexible_page_sections', $post->ID)) {
                the_row();

                if (get_row_layout() === 'image_gallery_section') {
                    // enqueue Swiper only if block exists
                    wp_enqueue_style('swiper');
                    wp_enqueue_script('swiper');
                    wp_enqueue_script('swiper-init');
                }
            }
        }
    }

}, 20);