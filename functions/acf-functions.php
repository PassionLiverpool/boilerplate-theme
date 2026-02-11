<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package Bootscore Child
 *
 * ACF Functions
 * 
 * @version 6.0.0
 */

// Disable both Gutenberg and the Classic editor for pages.
add_action( 'init', function() {
    remove_post_type_support( 'page', 'editor' );
    remove_post_type_support( 'team-member', 'editor' );
    remove_post_type_support( 'testimonial', 'editor' );
});

add_action( 'wp_enqueue_scripts', function() {
    if ( is_page() ) {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'global-styles' );
        wp_dequeue_style( 'classic-theme-styles' );
    }
}, 20 );

// Add labels to flexible content layouts
add_filter( 'acf/fields/flexible_content/layout_title', function( $title, $field, $layout, $i ) {

    $settings = get_sub_field( 'section_settings' );
    $section_label  = $settings['section_label'] ?? '';

    $content = get_sub_field( 'section_content' );
    if ($content) {
        $header = $content['header'] ?? '';
    } else {
        $header = get_sub_field('header');
    }

    if ( $section_label ) {
        $title .= ' – ' . esc_html( $section_label );
    } else if (!$section_label && $header) {
        $title .= ' – ' . esc_html( $header );
    }

    return $title;

}, 10, 4 );

// Exclude CPTs from link modal in acf
function exclude_cpt_from_link_modal( $query ) {
    $excluded_post_types = ['testimonial', 'team-member']; 

    if ( isset( $query['post_type'] ) && is_array( $query['post_type'] ) ) {
        foreach ( $excluded_post_types as $excluded_post_type ) {
            $key = array_search( $excluded_post_type, $query['post_type'] );
            if ( $key !== false ) {
                unset( $query['post_type'][ $key ] );
            }
        }
    }

    return $query;
}
add_filter( 'wp_link_query_args', 'exclude_cpt_from_link_modal' );

/*
 * Page section templates
 */
// Helper: return sections HTML for a given post ID (safe, does not alter main loop)
function get_theme_page_sections_html( $post_id = null ) {
    if ( ! function_exists( 'have_rows' ) ) {
        return ''; // ACF not active
    }
    $post_id = $post_id ? $post_id : get_the_ID();
    if ( ! $post_id ) {
        return '';
    }

    $html = '';

    // Use have_rows with $post_id so we don't touch the global loop
    if ( have_rows( 'flexible_page_sections', $post_id ) ) {
        while ( have_rows( 'flexible_page_sections', $post_id ) ) {
            the_row();
            $layout = str_replace( '_', '-', get_row_layout() );
            $template_path = locate_template( "page-sections/{$layout}.php" );
            if ( $template_path ) {
                ob_start();
                include $template_path;
                $html .= ob_get_clean();
            }
        }
    }

    return $html;
}

// Renderer: echo sections (call from templates)
function render_theme_page_sections( $post_id = null ) {
    echo get_theme_page_sections_html( $post_id );
}

/**
 * Output ACF site options scripts in the header
 */
add_action('wp_head', function() {
    $header_scripts = get_field('header_scripts', 'option');
    if ( $header_scripts ) {
        echo $header_scripts; // allows safe HTML/JS output
    }
});

/**
 * Output ACF site options scripts in the footer
 */
add_action('wp_footer', function() {
    $footer_scripts = get_field('footer_scripts', 'option');
    if ( $footer_scripts ) {
        echo $footer_scripts;
    }
});