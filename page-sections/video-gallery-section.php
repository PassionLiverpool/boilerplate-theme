<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $section_class="video-gallery-section";

    // Header & Body Text
    include get_stylesheet_directory() . '/page-sections/section-fields/section-text.php';

    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Video Gallery
    $video_gallery = get_sub_field('video_gallery') ?? [];

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="video-gallery-section background--<?php echo $background_colour ?>"
         <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
         style="<?php if($background_image):?>background-image: url('<?php echo $background_image['url'] ?>'); <?endif;?>
         padding-top: <?php echo $padding_top ?>rem;
         padding-bottom: <?php echo $padding_bottom ?>rem;
         margin-top: <?php echo $margin_top ?>rem;
         margin-bottom: <?php echo $margin_bottom ?>rem"
>
    <div class="container">
        <div class="video-gallery-section__content">
            <!-- Header -->
            <?php if ( $header ) {
                include get_stylesheet_directory() . '/components/section-header.php';
            } ?>

            <!-- WYSIWYG -->
            <?php if ( $wysiwyg_text ) {
                include get_stylesheet_directory() . '/components/section-wysiwyg.php';
            } ?>

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

    </div>
</section>
