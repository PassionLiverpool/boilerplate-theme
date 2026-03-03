<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $section_class="shortcode-section";

    // Header & Body Text
    include get_stylesheet_directory() . '/page-sections/section-fields/section-text.php';

    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // shortcode Shortcode
    $shortcode_section_style = get_sub_field('shortcode_section_style') ?? 'shortcode-right';
    $shortcode = get_sub_field('shortcode') ?? [];

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="<?php echo $section_class ?> background--<?php echo $background_colour ?>"
         <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
         style="<?php if($background_image):?>background-image: url('<?php echo $background_image['url'] ?>'); <?endif;?>
         padding-top: <?php echo $padding_top ?>rem;
         padding-bottom: <?php echo $padding_bottom ?>rem;
         margin-top: <?php echo $margin_top ?>rem;
         margin-bottom: <?php echo $margin_bottom ?>rem"
>
    <div class="container style--<?php echo $shortcode_section_style; ?>">

        <!-- WYSIWYG and Buttons Introduction -->
        <?php include get_stylesheet_directory() . '/page-sections/section-fields/section-introduction.php'; ?>

        <!-- shortcode -->
        <?php if($shortcode): ?>
        <div class="<?php echo $section_class ?>__shortcode">
            <?php echo do_shortcode( $shortcode ); ?>
        </div>
        <?php endif; ?>

    </div>
</section>
