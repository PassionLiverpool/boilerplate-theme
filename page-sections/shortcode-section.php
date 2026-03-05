<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // shortcode Shortcode
    $shortcode_section_style = get_sub_field('shortcode_section_style') ?? 'shortcode-right';
    $shortcode = get_sub_field('shortcode') ?? [];

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="shortcode-section background--<?php echo $background_colour ?>"
    <?php if ($html_id) echo "id='{$html_id}'"; ?>
    style="<?php echo esc_attr($style); ?>"
>
    <div class="container style--<?php echo $shortcode_section_style; ?>">

        <!-- WYSIWYG and Buttons Introduction -->
        <?php
            get_template_part(
                'page-sections/section-fields/section-introduction',
                null,
                [
                    'section_class' => 'shortcode-section',
                    'font_colour'   => $font_colour ?? 'black',
                    'content'       => null
                ]
            );
        ?>
        <!-- shortcode -->
        <?php if($shortcode): ?>
        <div class="shortcode-section__shortcode">
            <?php echo do_shortcode( $shortcode ); ?>
        </div>
        <?php endif; ?>

    </div>
</section>
