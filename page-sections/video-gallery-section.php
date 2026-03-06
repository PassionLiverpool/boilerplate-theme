<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Video Gallery
    $video_gallery = get_sub_field('video_gallery') ?? [];

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="video-gallery-section background--<?php echo $background_colour ?>"
    <?php if ($html_id) echo "id='{$html_id}'"; ?>
    style="<?php echo esc_attr($style); ?>"
>
    <div class="container">
        <div class="video-gallery-section__content">

        <!-- WYSIWYG and Buttons Introduction -->
        <?php
            get_template_part(
                'page-sections/section-fields/section-introduction',
                null,
                [
                    'section_class' => 'video-gallery-section',
                    'font_colour'   => $font_colour ?? 'black',
                    'content'       => null
                ]
            );
        ?>
            <!-- Gallery Videos -->
            <ul class="video-gallery">
                <?php foreach ( $video_gallery as $video_item ) : 
                    $video_url = $video_item['video'];
                    $video_thumbnail = $video_item['video_thumbnail'];
                ?>
                    <li class="video-gallery__item">
                        <?php 
                        $video = $video_url;
                        include get_stylesheet_directory() . '/components/video.php'; 
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Swiper on mobile -->
            <div class="swiper video-gallery-swiper">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($video_gallery as $video_item) :
                        $video_url = $video_item['video'];
                        $video_thumbnail = $video_item['video_thumbnail'];
                    ?>
                        <div class="swiper-slide video-gallery__item">
                            <?php 
                            $video = $video_url;
                            include get_stylesheet_directory() . '/components/video.php'; 
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
