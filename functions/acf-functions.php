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

// Disable Gutenberg for all pages except the Gutenberg template
add_filter('use_block_editor_for_post', function ($use_block_editor, $post) {

    if ($post->post_type !== 'page') {
        return $use_block_editor;
    }

    $template = get_page_template_slug($post->ID);

    if ($template === 'page-templates/gutenberg.php') {
        return true; // Enable Gutenberg
    }

    return false; // Disable Gutenberg everywhere else

}, 10, 2);

// Hide classic editor on all pages except Gutenberg template
add_action('add_meta_boxes', function () {

    global $post;

    if (!$post || $post->post_type !== 'page') {
        return;
    }

    if (get_page_template_slug($post->ID) !== 'page-templates/gutenberg.php') {
        remove_post_type_support('page', 'editor');
    }

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

    $content = get_sub_field( 'section_content' );
    if ( $content ) {
        $header = $content['wysiwyg_text'] ?? '';
    } else {
        $header = get_sub_field( 'wysiwyg_text' );
    }

    // Determine source string
    $label_source = $header;

    if ( $label_source ) {

        // 1. Strip tags
        $label_source = wp_strip_all_tags( $label_source );

        // 2. Decode HTML entities
        $label_source = html_entity_decode( $label_source, ENT_QUOTES, 'UTF-8' );

        // 3. Trim whitespace
        $label_source = trim( $label_source );

        // 4. Limit to 50 characters safely
        if ( mb_strlen( $label_source ) > 75 ) {
            $label_source = mb_substr( $label_source, 0, 75 ) . '…';
        }

        // 5. Escape for output
        $title .= ' – ' . esc_html( $label_source );
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
    } else {
        ob_start();
        the_content();
        $content = ob_get_clean();

        echo '<div class="container">' . $content . '</div>';
    }

    return $html;
}

// Renderer: echo sections (call from templates)
function render_theme_page_sections( $post_id = null ) {
    echo get_theme_page_sections_html( $post_id );
}

// Disable wpautop for a specific WYSIWYG field
add_filter('acf/format_value/type=wysiwyg', function($value, $post_id, $field) {
    if ($field['name'] === 'wysiwyg_text') { // your field name
        // Return content as-is, without wpautop
        return $value;
    }
    return $value;
}, 10, 3);