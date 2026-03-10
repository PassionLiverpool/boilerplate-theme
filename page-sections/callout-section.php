<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $args = ['disable_background' => true];

    // Media
    $media_type = $content['media_type'] ?? 'none';
    $image = $content['image'] ?? '';
    $content_video = $content['video'] ?? '';
    $content_video_thumbnail = $content['video_thumbnail'] ?? '';

    // Appearance
    $callout_section_style = get_sub_field('callout_section_style') ?? 'media-bottom';
    $disable_background = true;
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';
    unset($disable_background);
    
    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="callout-section"
    <?php if ($html_id) echo "id='{$html_id}'"; ?>
    style="<?php echo esc_attr($style); ?>"
>
    <div class="container background--<?php echo $background_colour ?>" style="<?php if($background_image):?>background-image: url('<?php echo $background_image['url'] ?>');<?php endif; ?>">

        <!-- WYSIWYG and Buttons Introduction -->
        <?php
            get_template_part(
                'page-sections/section-fields/section-introduction',
                null,
                [
                    'section_class' => 'callout-section',
                    'font_colour'   => $font_colour ?? 'black',
                    'content'       => null
                ]
            );
        ?>
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
