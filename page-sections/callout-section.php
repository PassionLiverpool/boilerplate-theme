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

    // Buttons
    $primary_button = $content['content_section_primary_button_button'];
    $secondary_button = $content['content_section_secondary_button_button'];

    // Appearance
    $callout_section_style = get_sub_field('callout_section_style') ?? 'media-bottom';
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="callout-section"
         <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
         style="padding-top: <?php echo $padding_top ?>rem; padding-bottom: <?php echo $padding_bottom ?>rem"
>
    <div class="container background--<?php echo $background_colour ?>" style="<?php if($background_image):?>background-image: url('<?php echo $background_image['url'] ?>');<?endif;?>">

        <!-- Text content -->
        <div class="callout-section__text alignment--<?php echo $text_alignment ?>">
            <!-- Header -->
            <?php if ( $header ) {
                include get_stylesheet_directory() . '/components/section-header.php';
            } ?>

            <!-- WYSIWYG -->
            <?php if ( $wysiwyg_text ) {
                include get_stylesheet_directory() . '/components/section-wysiwyg.php';
            } ?>

            <!-- Buttons -->
            <?php if($primary_button || $secondary_button): ?>
                <div class="callout-section__buttons">
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
        
        <!-- Media -->
        <?php if($image || $content_video): ?>
            <div class="callout-section__media">
                <!-- Image -->
                <?php if($media_type == "image"): ?>
                    <div class="callout-section__image">
                        <?php echo wp_get_attachment_image($image['id'], 'medium', false, array('loading'=>'lazy')); ?>
                    </div>
                <?php endif; ?>

                <!-- Video -->
                 <?php
                 if($media_type == "video"):
                ?>
                    <div class="callout-section__video">
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
