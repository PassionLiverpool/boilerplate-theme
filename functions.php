<?php
/**
 * @package Bootscore Child
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Enqueue styles and scripts
 */
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles() {

    // Parent style
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css',
        [],
        filemtime(get_template_directory() . '/style.css')
    );

    // Child main CSS
    wp_enqueue_style(
        'main',
        get_stylesheet_directory_uri() . '/assets/css/main.min.css',
        ['parent-style'],
        filemtime(get_stylesheet_directory() . '/assets/css/main.min.css')
    );

    // Custom JS
    $custom_js_ver = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/js/custom.min.js'));
    wp_enqueue_script(
        'custom-js',
        get_stylesheet_directory_uri() . '/assets/js/custom.min.js',
        ['jquery'],
        $custom_js_ver,
        true
    );
}

/**
 * UTF-8
 */
add_action( 'init', function() {
    ini_set( 'default_charset', 'UTF-8' );
});

// Include other functions
require_once get_stylesheet_directory() . '/functions/vendor-functions/aos-functions.php';
require_once get_stylesheet_directory() . '/functions/vendor-functions/litelight-functions.php';
require_once get_stylesheet_directory() . '/functions/vendor-functions/modal-video-functions.php';
require_once get_stylesheet_directory() . '/functions/vendor-functions/swiper-functions.php';

require_once get_stylesheet_directory() . '/functions/acf-functions.php';
require_once get_stylesheet_directory() . '/functions/post-functions.php';
require_once get_stylesheet_directory() . '/functions/shortcode-functions.php';
require_once get_stylesheet_directory() . '/functions/theme-functions.php';