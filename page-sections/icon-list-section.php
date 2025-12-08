<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $section_class="icon-list-section";

    // Header & Body Text
    include get_stylesheet_directory() . '/page-sections/section-fields/section-text.php';

    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Icon List
    $icon_list = get_sub_field('icon_list') ?? [];

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="icon-list-section background--<?php echo $background_colour ?>"
         <?php if($html_id): ?>id="<?php echo $html_id; ?>"<?php endif; ?>
         style="<?php if($background_image):?>background-image: url('<?php echo $background_image['url'] ?>'); <?endif;?>padding-top: <?php echo $padding_top ?>rem; padding-bottom: <?php echo $padding_bottom ?>rem"
>
    <div class="container">
        <div class="icon-list-section__content">
            <!-- Header -->
            <?php if ( $header ) {
                include get_stylesheet_directory() . '/components/section-header.php';
            } ?>

            <!-- WYSIWYG -->
            <?php if ( $wysiwyg_text ) {
                include get_stylesheet_directory() . '/components/section-wysiwyg.php';
            } ?>

            <!-- icon-list -->
            <?php
                if( have_rows('icon_list') ):
                    echo "<ul class='icon-list'>";
                    while( have_rows('icon_list') ) : the_row();
                        $icon_text = get_sub_field('icon_text');
            ?>

                <li class="icon-list-item">
                    <div class="icon-list-item__icon">
                        <?php 
                            $icon = get_sub_field('icon');
                            if( $icon ) {
                                echo wp_get_attachment_image(
                                    $icon['id'],
                                    'thumbnail',
                                    false, // $icon, usually false
                                    array(
                                        'loading' => 'lazy',
                                    )
                                );                            
                            }
                        ?>
                    </div>
                    <?php if ( $icon_text ) : ?>
                        <div class="icon-list-item__text">
                            <?php echo wp_kses_post( $icon_text ); ?>
                        </div>
                    <?php endif; ?>
                </li>
            <?php
                    // End loop.
                    endwhile;
                    echo "</div>";
                endif;
            ?>

    </div>
</section>
