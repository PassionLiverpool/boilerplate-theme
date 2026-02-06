<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    // Text
    $hero_banner_text = get_sub_field('hero_banner_text');
    $header = get_field('header') ?? '';
    // If we are on a category archive, override with the category name
    if (is_category()) {
        $header = single_cat_title('', false);
    }

    $header_style = get_field('header_style') ?? 'h1';
    $wysiwyg_text = get_field('wysiwyg_text') ?? '';

    // Buttons
    $primary_button = get_field('hero_banner_primary_button_button');
    $secondary_button = get_field('hero_banner_secondary_button_button');

    // Appearance
    $hero_banner_style = get_field('hero_banner_style') ?? 'media-bottom';
    $font_colour = get_field('hero_banner_font_colour') ?? 'black';
    $background_colour = get_field('hero_banner_background_colour') ?? 'white';
    $background_image = get_field('hero_banner_background_image');
    $banner_video = get_field('hero_banner_video');
    $banner_poster_image = get_field('hero_banner_poster_image');

    // Settings
    $hide_hero_banner = get_field('hide_hero_banner') ?? false;
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<?php if ($hide_hero_banner == false): ?>
    <header class="hero-banner style--<?php echo $hero_banner_style; ?> <?php if($background_colour && $hero_banner_style=='primary'): ?>background--<?php echo $background_colour ?><?php endif; ?>"
            <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
    >
        <?php if($background_image && $hero_banner_style=='secondary'): ?>
            <img 
                src="<?php echo esc_url($background_image['url']); ?>" 
                alt="" 
                fetchpriority="high"
                class="hero-banner__bg-image"
            >
        <?php endif; ?>
        <div class="container style--<?php echo $hero_banner_style; ?>">

            <?php if ($header || $wysiwyg_text): ?>
                <!-- Text content -->
                <div class="hero-banner__text font--<?php echo $font_colour; ?>">
                    <!-- Header -->
                    <?php if ( $header ) : ?>
                        <<?php echo esc_attr( $header_style ); ?> class="hero-banner__header">
                            <?php echo wp_kses_post( $header ); ?>
                        </<?php echo esc_attr( $header_style ); ?>>
                    <?php endif; ?>

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
        <?php if ( $banner_video && $hero_banner_style == 'tertiary' ) : ?>
            <div class="hero-banner__video">
                <?php
                    $video = $banner_video;
                    $video_controls = get_field('video_controls');

                    $video_controls_attr = ($video_controls === 'full-controls') ? 'controls' : '';
                ?>

                <?php if($video_controls == 'audio-toggle-only'): ?>
                    <button class="audio-toggle is-muted" aria-pressed="false">
                        <span class="screen-reader-text">Toggle audio</span>
                    </button>
                <?php endif; ?>

                    <video
                        autoplay
                        muted
                        loop
                        playsinline
                        <?php echo $video_controls_attr; ?>
                        poster="<?php echo esc_url($banner_poster_image['url']); ?>"
                    >
                    <source src="<?php echo $video ?>" type="video/mp4">
                </video>    
            </div>
        <?php endif; ?>
    </header>
<?php endif; ?>