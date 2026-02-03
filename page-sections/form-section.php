<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $section_class="form-section";

    // Header & Body Text
    include get_stylesheet_directory() . '/page-sections/section-fields/section-text.php';

    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Form Shortcode
    $form_section_style = get_sub_field('form_section_style') ?? 'form-right';
    $form_shortcode = get_sub_field('form_shortcode') ?? [];

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="form-section background--<?php echo $background_colour ?>"
         <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
         style="<?php if($background_image):?>background-image: url('<?php echo $background_image['url'] ?>'); <?endif;?>
         padding-top: <?php echo $padding_top ?>rem;
         padding-bottom: <?php echo $padding_bottom ?>rem;
         margin-top: <?php echo $margin_top ?>rem;
         margin-bottom: <?php echo $margin_bottom ?>rem"
>
    <div class="container style--<?php echo $form_section_style; ?>">
        <div class="form-section__text">
            <!-- Header -->
            <?php if ( $header ) {
                include get_stylesheet_directory() . '/components/section-header.php';
            } ?>

            <!-- WYSIWYG -->
            <?php if ( $wysiwyg_text ) {
                include get_stylesheet_directory() . '/components/section-wysiwyg.php';
            } ?>
        </div>

        <!-- Form -->
        <?php if($form_shortcode): ?>
        <div class="form-section__form">
            <?php echo do_shortcode( $form_shortcode ); ?>
        </div>
        <?php endif; ?>

    </div>
</section>
