<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('wp_enqueue_scripts', 'enqueue_litelight');
function enqueue_litelight() {
    // LiteLight CSS only
    wp_enqueue_style(
        'litelight-css',
        get_stylesheet_directory_uri() . '/assets/vendors/litelight/lite-light.min.css',
        [],
        '1.0'
    );
}

/**
 * Output LiteLight module before closing </body>
 */
add_action('wp_footer', function() {
    ?>
    <script type="module">
    import { init } from '<?php echo esc_url(get_stylesheet_directory_uri() . "/assets/vendors/litelight/lite-light.min.js"); ?>';

    document.addEventListener('DOMContentLoaded', () => {
        init({
            keyboard: true,
            loop: true
        });
    });
    </script>
    <?php
}, 100);