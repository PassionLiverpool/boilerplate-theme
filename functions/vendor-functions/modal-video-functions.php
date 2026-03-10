<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('wp_enqueue_scripts', 'enqueue_modal_video');
function enqueue_modal_video() {
  //modal video - jquery
  wp_enqueue_script(
      'modal-video',
      get_stylesheet_directory_uri() . '/assets/vendors/modal-video/jquery-modal-video.min.js',
      array('jquery'),
      '2.4.8',
      array(
          'strategy'  => 'defer',
          'in_footer' => true
      )
  );

  wp_enqueue_style('modal-video', get_stylesheet_directory_uri() . '/assets/vendors/modal-video/modal-video.min.css', array(), '2.4.8', $media = 'all');
}