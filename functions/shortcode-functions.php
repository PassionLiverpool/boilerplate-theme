<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package Bootscore Child
 *
 * Shortcode Functions
 * 
 * @version 6.0.0
 */

/**
 * Shortcode: [social_media]
 * Description: Displays the social media links from components/social-media.php
 */
function mytheme_social_media_shortcode( $atts ) {
    $atts = shortcode_atts(
        [
            'color' => 'black',
            'color' => 'white'
        ],
        $atts,
        'social_media'
    );
    
    // Make shortcode attributes available inside the included component
    $color = sanitize_text_field( $atts['color'] );

    ob_start(); // Start output buffering

    $component_path = get_stylesheet_directory() . '/components/social-media.php';

    if ( file_exists( $component_path ) ) {
        include $component_path;
    } else {
        echo '<!-- social-media.php not found -->';
    }

    return ob_get_clean(); // Return the buffered content
}
add_shortcode( 'social_media', 'mytheme_social_media_shortcode' );

/**
 * Shortcode: [business_logo]
 * Description: Displays the business logo as defined in the ACF options page
 */
function display_business_logo( $atts ) {
    // Shortcode attributes
    $atts = shortcode_atts( [
        'color' => 'color', // default
    ], $atts, 'business_logo' );

    $color = sanitize_text_field( $atts['color'] );

    // Get the group field
    $business_logo_group = get_field('business_logo', 'option');

    if ( ! $business_logo_group ) {
        return '';
    }

    // Extract logos from group
    $logo_white = $business_logo_group['business_logo_white'] ?? '';
    $logo_color = $business_logo_group['business_logo_color'] ?? '';

    // Choose logo based on attribute
    $logo = ($color === 'white') ? $logo_white : $logo_color;

    // If no image, return nothing
    if (empty($logo)) {
        return '';
    }

    // Output image (ACF returns array when image field is "Image Array")
    if (is_array($logo) && isset($logo['ID'])) {

        // Build a CSS class based on the selected color
        $class = 'business-logo--' . ($color === 'white' ? 'white' : 'color');

        return wp_get_attachment_image(
            $logo['ID'],
            'medium',
            false,
            [
                'class' => $class,
            ]
        );
    }
}
add_shortcode('business_logo', 'display_business_logo');

/**
 * Shortcode: [business_name]
 * Description: Displays the business name as defined in the ACF options page
 */
function display_business_name( $atts ) {
    $name = get_field('business_name', 'option');

    $atts = shortcode_atts(
        [
            'color' => 'black',
            'color' => 'white'
        ],
        $atts,
        'business_name'
    );
    
    // Make shortcode attributes available inside the included component
    $color = sanitize_text_field( $atts['color'] );

    ob_start(); // Start output buffering

    if (empty($name)) {
        return '';
    }

    return '<span class="business-name business-name--'.esc_html($color).'">'.esc_html($name).'</span>';
}
add_shortcode('business_name', 'display_business_name');

/**
 * Shortcode: [business_address]
 * Description: Displays the business address as defined in the ACF options page
 */
function display_business_address( $atts ) {
    $address = get_field('business_address', 'option');

    $atts = shortcode_atts(
        [
            'color' => 'black',
            'color' => 'white'
        ],
        $atts,
        'business_address'
    );
    
    // Make shortcode attributes available inside the included component
    $color = sanitize_text_field( $atts['color'] );

    ob_start(); // Start output buffering

    if (empty($address)) {
        return '';
    }

    return '<span class="business-address business-address--'.esc_html($color).'">'.wp_kses_post($address).'</span>';
}
add_shortcode('business_address', 'display_business_address');

/**
 * Shortcode: [business_opening_hours]
 * Description: Displays the opening hours as defined in the ACF options page
 */
function display_business_opening_hours( $atts ) {
    $opening_hours = get_field('business_opening_hours', 'option');

    $atts = shortcode_atts(
        [
            'color' => 'black',
            'color' => 'white'
        ],
        $atts,
        'business_opening_hours'
    );
    
    // Make shortcode attributes available inside the included component
    $color = sanitize_text_field( $atts['color'] );

    if (empty($opening_hours)) {
        return '';
    }
    return '<span class="business-opening-hours business-opening-hours--'.$color.'">'.wp_kses_post($opening_hours).'</span>';
}
add_shortcode('business_opening_hours', 'display_business_opening_hours');

/**
 * Shortcode: [business_phone_number]
 * Description: Displays the business phone number as defined in the ACF options page
 */
function display_business_phone_number($atts) {
    $phone_number = get_field('business_phone_number', 'option');

    $atts = shortcode_atts(
        [
            'color' => 'black',
            'color' => 'white'
        ],
        $atts,
        'business_phone_number'
    );
    
    // Make shortcode attributes available inside the included component
    $color = sanitize_text_field( $atts['color'] );

    if (empty($phone_number)) {
        return '';
    }

    return '<span class="business-phone-number business-phone-number--'.$color.'"><a href="tel:'.esc_attr($phone_number).'">'.esc_html($phone_number).'</a></span>';
}
add_shortcode('business_phone_number', 'display_business_phone_number');

/**
 * Shortcode: [business_email]
 * Description: Displays the business email as defined in the ACF options page
 */
function display_business_email($atts) {
    $email = get_field('business_email', 'option');

    $atts = shortcode_atts(
        [
            'color' => 'black',
            'color' => 'white'
        ],
        $atts,
        'business_email'
    );
    
    // Make shortcode attributes available inside the included component
    $color = sanitize_text_field( $atts['color'] );

    if (empty($email)) {
        return '';
    }

    return '<span class="business-email business-email--'.$color.'"><a href="mailto:'.esc_attr($email).'">'.esc_html($email).'</a></span>';
}
add_shortcode('business_email', 'display_business_email');