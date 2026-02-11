<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package Bootscore Child
 *
 * Theme Functions
 * 
 * @version 6.0.0
 */

// Prevent sidebar container markup
function disable_sidebar_widgets( $sidebars_widgets )
{
    if (is_single())
    {
        $sidebars_widgets = false;
    }   
    return $sidebars_widgets;
}
add_filter( 'sidebars_widgets', 'disable_sidebar_widgets' );


// Register custom image sizes
function custom_image_sizes() {
    // Add custom sizes: name, width, height, crop
    add_image_size( 'small-icon', 50, 50 ); 
    add_image_size( 'large-icon', 150, 150 ); 
    add_image_size( 'small-post-thumbnail', 300, 200, true );
    add_image_size( 'large-post-thumbnail', 400, 300, true ); 
}
add_action( 'after_setup_theme', 'custom_image_sizes' );

function mytheme_custom_sizes_dropdown( $sizes ) {
    return array_merge( $sizes, array(
        'small-icon'  => __( 'Small Icon' ),
        'large-icon' => __( 'Large Icon' ),
        'small-post-thumbnail'  => __( 'Small Post Thumbnail' ),
        'large-post-thumbnail'  => __( 'Large Post Thumbnail' ),
    ) );
}
add_filter( 'image_size_names_choose', 'mytheme_custom_sizes_dropdown' );