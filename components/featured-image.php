<?php
// Get ACF image (returns array or false)
$placeholder_image = get_field( 'placeholder_blog_post_image', 'option' );
$id = $blog_post->ID ?? $page_link->ID;

if ( $placeholder_image && isset( $placeholder_image['id'] ) ) {
    // Use ACF image
    $placeholder_html = wp_get_attachment_image(
        $placeholder_image['id'],
        'medium',
        false,
        [ 'loading' => 'lazy' ]
    );
} else {
    // Fallback to theme image
    $placeholder_url = get_stylesheet_directory_uri() . '/assets/img/placeholder-images/placeholder-image.jpg';

    $placeholder_html = sprintf(
        '<img src="%s" alt="" loading="lazy" />',
        esc_url( $placeholder_url )
    );
}

$featured_image = get_the_post_thumbnail(
    $id,
    'medium',
    false,
    [ 'loading' => 'lazy' ]
);

?>