<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}    
    $content = get_sub_field('section_content');
    
    // Media
    $media_type = $content['media_type'] ?? 'none';
    $image = $content['image'] ?? '';
    $content_video = $content['video'] ?? '';
    $content_video_thumbnail = $content['video_thumbnail'] ?? '';

    // Appearance
    $content_section_style = get_sub_field('content_section_style') ?? 'media-bottom';
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="content-section background--<?php echo $background_colour ?>"
    <?php if ($html_id) echo "id='{$html_id}'"; ?>
    style="<?php echo esc_attr($style); ?>"
>
    <div class="container style--<?php echo $content_section_style; ?>">

        <!-- WYSIWYG and Buttons Introduction -->
        <?php
            get_template_part(
                'page-sections/section-fields/section-introduction',
                null,
                [
                    'section_class' => 'content-section',
                    'font_colour'   => $font_colour ?? 'black',
                    'content'       => get_sub_field('section_content')
                ]
            );
        ?>
 
        <!-- Media -->
        <?php if(($image || $content_video) && $content_section_style != 'text-only'): ?>
            <div class="content-section__media">
                <!-- Image -->
                <?php if($media_type == "image"): ?>
                    <div class="content-section__image">
                        <?php echo wp_get_attachment_image($image['id'], 'medium', false, array('loading'=>'lazy')); ?>
                    </div>
                <?php endif; ?>

                <!-- Video -->
                 <?php
                 if($media_type == "video"):
                ?>
                    <div class="content-section__video">
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
