<?php

/**
 * @package Bootscore Child
 *
 * @version 6.0.0
 */


// Exit if accessed directly
defined('ABSPATH') || exit;


/**
 * Enqueue scripts and styles
 */
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles() {

  // Compiled main.css
  $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/css/main.min.css'));
  // Parent first
  wp_enqueue_style(
      'parent-style',
      get_template_directory_uri() . '/style.css',
      array(),
      filemtime(get_template_directory() . '/style.css')
  );

  // Child css
  wp_enqueue_style(
      'main',
      get_stylesheet_directory_uri() . '/assets/css/main.min.css',
      array('parent-style'),
      filemtime(get_stylesheet_directory() . '/assets/css/main.min.css')
  );

  //modal video - jquery
  wp_enqueue_script(
      'modal-video',
      get_stylesheet_directory_uri() . '/assets/js/modal-video/jquery-modal-video.min.js',
      array('jquery'),
      '2.4.8',
      array(
          'strategy'  => 'defer',
          'in_footer' => true
      )
  );
	wp_enqueue_style('modal-video', get_stylesheet_directory_uri() . '/assets/js/modal-video/modal-video.min.css', array(), '2.4.8', $media = 'all');
  
  // BasicLightbox
  wp_enqueue_script(
    'basiclightbox',
    get_stylesheet_directory_uri() . '/assets/vendor/basiclightbox/basicLightbox.min.js',
    array(),
    '5.0.4',
    true // load in footer
  );

  wp_enqueue_style(
    'basiclightbox',
    get_stylesheet_directory_uri() . '/assets/vendor/basiclightbox/basicLightbox.min.css',
    array(),
    '5.0.4'
  );

  // AOS
  wp_enqueue_style(
    'aos-css',
    get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.css',
    array(),
    '2.3.4'
  );

  wp_enqueue_script(
    'aos-js',
    get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.js',
    array(),
    '2.3.4',
    true // load in footer
  );

  // Init AOS
  wp_add_inline_script(
    'aos-js',
    'document.addEventListener("DOMContentLoaded", function() { AOS.init(); });'
  );

  // custom.js
  // Get modification time. Enqueue file with modification date to prevent browser from loading cached scripts when file content changes. 
  $modificated_CustomJS = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/js/custom.min.js'));
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.min.js', array('jquery'), $modificated_CustomJS, array('strategy'  => 'defer', 'in_footer' => true));
}

add_action( 'init', function() {
    ini_set( 'default_charset', 'UTF-8' );
});

require_once get_stylesheet_directory() . '/functions/acf-functions.php';
require_once get_stylesheet_directory() . '/functions/post-functions.php';
require_once get_stylesheet_directory() . '/functions/shortcode-functions.php';
require_once get_stylesheet_directory() . '/functions/theme-functions.php';