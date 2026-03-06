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

    // Modal video
    wp_enqueue_script(
        'modal-video',
        get_stylesheet_directory_uri() . '/assets/vendors/modal-video/jquery-modal-video.min.js',
        ['jquery'],
        '2.4.8',
        true
    );
    wp_enqueue_style(
        'modal-video',
        get_stylesheet_directory_uri() . '/assets/vendors/modal-video/modal-video.min.css',
        [],
        '2.4.8'
    );

    // LiteLight CSS only
    wp_enqueue_style(
        'litelight-css',
        get_stylesheet_directory_uri() . '/assets/vendors/litelight/lite-light.min.css',
        [],
        '1.0'
    );

    // AOS
    wp_enqueue_style(
        'aos-css',
        get_stylesheet_directory_uri() . '/assets/vendors/aos/aos.css',
        [],
        '2.3.4'
    );
    wp_enqueue_script(
        'aos-js',
        get_stylesheet_directory_uri() . '/assets/vendors/aos/aos.js',
        [],
        '2.3.4',
        true
    );
    wp_add_inline_script(
        'aos-js',
        'document.addEventListener("DOMContentLoaded", function() { AOS.init(); });'
    );

    // Swiper
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

/**
 * UTF-8
 */
add_action( 'init', function() {
    ini_set( 'default_charset', 'UTF-8' );
});

// Include other functions
require_once get_stylesheet_directory() . '/functions/acf-functions.php';
require_once get_stylesheet_directory() . '/functions/post-functions.php';
require_once get_stylesheet_directory() . '/functions/shortcode-functions.php';
require_once get_stylesheet_directory() . '/functions/theme-functions.php';