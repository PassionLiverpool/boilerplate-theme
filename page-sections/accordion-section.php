<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $section_class="accordion-section";

    // Header & Body Text
    include get_stylesheet_directory() . '/page-sections/section-fields/section-text.php';

    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Video Gallery
    $video_gallery = get_sub_field('video_gallery') ?? [];

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="accordion-section background--<?php echo $background_colour ?>"
         <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
         style="<?php if($background_image):?>background-image: url('<?php echo $background_image['url'] ?>'); <?endif;?>padding-top: <?php echo $padding_top ?>rem; padding-bottom: <?php echo $padding_bottom ?>rem"
>
    <div class="container">
        <div class="accordion-section__content alignment--<?php echo $text_alignment ?>">
            <!-- Header -->
            <?php if ( $header ) {
                include get_stylesheet_directory() . '/components/section-header.php';
            } ?>

            <!-- WYSIWYG -->
            <?php if ( $wysiwyg_text ) {
                include get_stylesheet_directory() . '/components/section-wysiwyg.php';
            } ?>

            <!-- Accordion -->
            <?php
                if( have_rows('accordion') ):
                    echo "<div class='accordion'>";
                    $i = 0; // initialize counter
                    while( have_rows('accordion') ) : the_row();
                        $accordion_header = get_sub_field('accordion_header');
                        $accordion_body = get_sub_field('accordion_body');
                        $i++; // increment counter
                        $collapse_id = 'collapse-' . $i;
                        $heading_id = 'heading-' . $i;
            ?>

                <div class="accordion-item">
                    <h3 class="accordion-header" id="<?php echo esc_attr( $heading_id ); ?>">
                        <button class="accordion-button <?php echo $i !== 1 ? 'collapsed' : ''; ?>" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>" 
                                aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>" 
                                aria-controls="<?php echo esc_attr( $collapse_id ); ?>">
                            <?php echo esc_html( $accordion_header ); ?>
                        </button>
                    </h3>
                    <div id="<?php echo esc_attr( $collapse_id ); ?>" 
                        class="accordion-collapse collapse <?php echo $i === 1 ? 'show' : ''; ?>" 
                        aria-labelledby="<?php echo esc_attr( $heading_id ); ?>" 
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php echo wp_kses_post( $accordion_body ); ?>
                        </div>
                    </div>
                </div>
            <?php
                    // End loop.
                    endwhile;
                    echo "</div>";
                endif;
            ?>

    </div>
</section>
