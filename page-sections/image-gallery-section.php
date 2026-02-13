<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $section_class="image-gallery-section";

    // Header & Body Text
    include get_stylesheet_directory() . '/page-sections/section-fields/section-text.php';

    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Image Gallery
    $image_gallery = get_sub_field('image_gallery') ?? [];

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';

    // Enqueue Swiper assets if gallery is not empty
    if (!empty($image_gallery)) {
        wp_enqueue_style('swiper');
        wp_enqueue_script('swiper');
        wp_enqueue_script('swiper-init');
    }
?>

<section class="image-gallery-section background--<?php echo $background_colour ?>"
         <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
         style="<?php if($background_image):?>background-image: url('<?php echo $background_image['url'] ?>'); <?endif;?>
         padding-top: <?php echo $padding_top ?>rem;
         padding-bottom: <?php echo $padding_bottom ?>rem;
         margin-top: <?php echo $margin_top ?>rem;
         margin-bottom: <?php echo $margin_bottom ?>rem"
>
    <div class="container">
        <div class="image-gallery-section__content">
            <!-- Header -->
            <?php if ( $header ) {
                include get_stylesheet_directory() . '/components/section-header.php';
            } ?>

            <!-- WYSIWYG -->
            <?php if ( $wysiwyg_text ) {
                include get_stylesheet_directory() . '/components/section-wysiwyg.php';
            } ?>

            <!-- Gallery Images -->
            <ul class="image-gallery">
                <?php foreach ( $image_gallery as $image ) : 
                    $full = wp_get_attachment_image_src($image['id'], 'full')[0]; ?>
                    <li class="image-gallery__item">
                        <a href="#" onclick="return false;">
                            <img 
                                src="<?php echo esc_url( $image['sizes']['medium'] ); ?>" 
                                alt="<?php echo esc_attr( $image['alt'] ); ?>" 
                                data-full="<?php echo esc_url( $full ); ?>" 
                                class="gallery-image"
                                loading="lazy"
                            >
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Swiper on mobile -->
            <div class="swiper image-gallery-swiper image-gallery">
                <div class="swiper-wrapper">

                    <?php foreach ($image_gallery as $image) :
                    $full = wp_get_attachment_image_src($image['id'], 'full')[0];
                    ?>
                    <div class="swiper-slide image-gallery__item">
                        <img
                        src="<?php echo esc_url($image['sizes']['medium']); ?>"
                        alt="<?php echo esc_attr($image['alt']); ?>"
                        data-full="<?php echo esc_url($full); ?>"
                        loading="lazy"
                        decoding="async"
                        >
                    </div>
                    <?php endforeach; ?>

                </div>

                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
    </div>
</section>
