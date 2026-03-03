<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $section_class="callout-section";

    // Header & Body Text
    include get_stylesheet_directory() . '/page-sections/section-fields/section-text.php';

    // Media
    $media_type = $content['media_type'] ?? 'none';
    $image = $content['image'] ?? '';
    $content_video = $content['video'] ?? '';
    $content_video_thumbnail = $content['video_thumbnail'] ?? '';

    // Appearance
    $callout_section_style = get_sub_field('callout_section_style') ?? 'media-bottom';
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="<?php echo $section_class ?>"
         <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
         style="padding-top: <?php echo $padding_top ?>rem;
         padding-bottom: <?php echo $padding_bottom ?>rem;
         margin-top: <?php echo $margin_top ?>rem;
         margin-bottom: <?php echo $margin_bottom ?>rem"
>
    <div class="container background--<?php echo $background_colour ?>" style="<?php if($background_image):?>background-image: url('<?php echo $background_image['url'] ?>');<?endif;?>">

        <!-- WYSIWYG and Buttons Introduction -->
        <?php include get_stylesheet_directory() . '/page-sections/section-fields/section-introduction.php'; ?>

        <!-- Media -->
        <?php if($image || $content_video): ?>
            <div class="<?php echo $section_class ?>__media">
                <!-- Image -->
                <?php if($media_type == "image"): ?>
                    <div class="<?php echo $section_class ?>__image">
                        <?php echo wp_get_attachment_image($image['id'], 'medium', false, array('loading'=>'lazy')); ?>
                    </div>
                <?php endif; ?>

                <!-- Video -->
                 <?php
                 if($media_type == "video"):
                ?>
                    <div class="<?php echo $section_class ?>__video">
                        <?php
                            $video = $content_video;
                            $video_thumbnail = $content_video_thumbnail;
                            include get_stylesheet_directory() . '/components/video.php';
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
