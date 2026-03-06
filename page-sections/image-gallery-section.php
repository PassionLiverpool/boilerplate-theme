<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Image Gallery
    $image_gallery = get_sub_field('image_gallery') ?? [];
    $image_gallery_mode = get_sub_field('image_gallery_mode') ?? 'grid';

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
    <?php if ($html_id) echo "id='{$html_id}'"; ?>
    style="<?php echo esc_attr($style); ?>"
>
    <div class="container">
        <div class="image-gallery-section__content">
        <!-- WYSIWYG and Buttons Introduction -->
        <?php
            get_template_part(
                'page-sections/section-fields/section-introduction',
                null,
                [
                    'section_class' => 'image-gallery-section',
                    'font_colour'   => $font_colour ?? 'black',
                    'content'       => null
                ]
            );
        ?>

        <?php if($image_gallery_mode == "grid"): ?>
            <!-- Gallery Images Grid -->
            <ul class="image-gallery">
                <?php foreach ( $image_gallery as $image ) : 
                    $full = wp_get_attachment_image_src($image['id'], 'full')[0]; ?>
                    <li class="image-gallery__item">
                            <img 
                                src="<?php echo esc_url( $image['sizes']['medium'] ); ?>" 
                                alt="<?php echo esc_attr( $image['alt'] ); ?>" 
                                data-lightbox="<?php echo esc_url( $full ); ?>" 
                                class="gallery-image"
                                loading="lazy"
                            >
                    </li>
                <?php endforeach; ?>
            </ul>
        
        <?php elseif($image_gallery_mode == "swiper"): ?>
            <!-- Image Gallery Swiper -->
            <div class="swiper image-gallery-swiper">
                <div class="swiper-wrapper">

                    <?php foreach ($image_gallery as $image) :
                    $full = wp_get_attachment_image_src($image['id'], 'full')[0];
                    ?>
                    <div class="swiper-slide image-gallery__item">
                        <img
                        src="<?php echo esc_url($image['sizes']['medium']); ?>"
                        alt="<?php echo esc_attr($image['alt']); ?>"
                        data-lightbox="<?php echo esc_url($full); ?>"
                        loading="lazy"
                        decoding="async"
                        >
                    </div>
                    <?php endforeach; ?>

                </div>

                <div class="swiper-pagination"></div>
            </div>
        <?php endif; ?>

        </div>
    </div>
</section>
