<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    if ( is_home() && ! is_front_page() ) {
        $posts_page_id = get_option('page_for_posts');
    } else {
        $posts_page_id = get_the_ID();
    }

    // Text
    // If we are on a category archive, override with the category name

    $wysiwyg_text = get_field('wysiwyg_text', $posts_page_id) ?? '';
    
    if(isset($wysiwyg_text) && !empty($wysiwyg_text)) {
        $wysiwyg_text = $wysiwyg_text;
    } elseif (is_category()) {
        $wysiwyg_text = '<h1>' . single_cat_title('', false) . '</h1>';
    } else if (is_home()) {
        $wysiwyg_text = '<h1>' . get_the_title(get_option('page_for_posts')) . '</h1>';
    } else {
        $wysiwyg_text = "Page";
    }

    // Buttons
    $primary_button = get_field('hero_banner_primary_button_button', $posts_page_id);
    $secondary_button = get_field('hero_banner_secondary_button_button', $posts_page_id);

    // Appearance
    $hero_banner_style = get_field('hero_banner_style', $posts_page_id) ?? 'media-bottom';
    $font_colour = get_field('hero_banner_font_colour', $posts_page_id) ?? 'black';
    $background_colour = get_field('hero_banner_background_colour', $posts_page_id) ?? 'white';
    $background_image_desktop = get_field('hero_banner_background_image_desktop', $posts_page_id);
    $background_image_mobile = get_field('hero_banner_background_image_mobile', $posts_page_id);
    $banner_video = get_field('hero_banner_video', $posts_page_id);
    $banner_poster_image = get_field('hero_banner_poster_image', $posts_page_id);

    // Settings
    $hide_hero_banner = get_field('hide_hero_banner', $posts_page_id) ?? false;
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<?php if ($hide_hero_banner == false): ?>
    <header class="hero-banner style--<?php echo $hero_banner_style; ?> <?php if($background_colour && $hero_banner_style=='simple'): ?>background--<?php echo $background_colour ?><?php endif; ?>"
            <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
    >
        <?php if ($background_image_desktop && $hero_banner_style === 'secondary'): ?>
            <picture class="hero-banner__bg-image">
                <source
                srcset="<?php echo esc_url($background_image_mobile['url']); ?>"
                media="(max-width: 767px)"
                >
                <img
                src="<?php echo esc_url($background_image_desktop['url']); ?>"
                alt=""
                fetchpriority="high"
                decoding="async"
                >
            </picture>
        <?php endif; ?>

        <div class="container style--<?php echo $hero_banner_style; ?>">

            <?php if ($wysiwyg_text): ?>
                <!-- Text content -->
                <div class="hero-banner__text font--<?php echo $font_colour; ?>">

                    <!-- WYSIWYG -->
                    <?php if ( $wysiwyg_text ) : ?>
                        <div class="hero-banner__wysiwyg">
                            <?php echo wp_kses_post( $wysiwyg_text ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Buttons -->
                    <?php if($primary_button || $secondary_button): ?>
                        <div class="hero-banner__buttons">
                            <?php if($primary_button): ?>
                                <?php
                                    $button = $primary_button;
                                    include get_stylesheet_directory() . '/components/button.php';
                                ?>
                            <?php endif; ?>
                            <?php if($secondary_button): ?>
                                <?php
                                    $button = $secondary_button;
                                    include get_stylesheet_directory() . '/components/button.php';
                                ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Video -->
        <?php if ( $banner_video && $hero_banner_style == 'video' ) : ?>
            <div class="hero-banner__video">
                <?php
                    $video = $banner_video;
                    $enable_audio_toggle = get_field('enable_audio_toggle');
                ?>

                <?php if($enable_audio_toggle == true): ?>
                    <button class="audio-toggle is-muted" aria-pressed="false">
                        <span class="screen-reader-text">Toggle audio</span>
                    </button>
                <?php endif; ?>

                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    fetchpriority="high"
                    poster="<?php echo esc_url( wp_get_attachment_image_url( $banner_poster_image['ID'], 'large' ) ); ?>"
                >
                    <source src="<?php echo $video ?>" type="video/mp4">
                </video>    
            </div>
        <?php endif; ?>
        
    </header>
<?php endif; ?>