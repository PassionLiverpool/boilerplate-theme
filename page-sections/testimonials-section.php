<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    // Appearance
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Team Members
    $testimonials = get_sub_field('testimonials');
    $display_all_testimonials = get_sub_field('display_all_testimonials') ?? false;

    // Determine which team members to display
    if ( $display_all_testimonials ) {
        $testimonials = get_posts([
            'post_type'      => 'testimonial',
            'posts_per_page' => -1, // All published
            'post_status'    => 'publish',
            'orderby'        => 'menu_order', // Optional, if using order
            'order'          => 'ASC',
        ]);
    }

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="testimonials-section background--<?php echo $background_colour ?>"
    <?php if ($html_id) echo "id='{$html_id}'"; ?>
    style="<?php echo esc_attr($style); ?>"
>
    <div class="container">
        <div class="testimonials-section__content">   
        <!-- WYSIWYG and Buttons Introduction -->
        <?php
            get_template_part(
                'page-sections/section-fields/section-introduction',
                null,
                [
                    'section_class' => 'testimonials-section',
                    'font_colour'   => $font_colour ?? 'black',
                    'content'       => null
                ]
            );
        ?>            
            <!--  Testimonials -->
            <?php if( $testimonials ): ?>
                <ul class="testimonials">
                <?php foreach( $testimonials as $testimonial ): ?>
                    <?php include get_stylesheet_directory() . '/components/testimonial-card.php'; ?>
                <?php endforeach; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
