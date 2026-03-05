<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    // Appearance
    $page_links_style = get_sub_field('page_links_style') ?? 'small';
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Blog posts
    $selected_pages = get_sub_field('selected_pages');

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="page-links-section background--<?php echo $background_colour ?>"
    <?php if ($html_id) echo "id='{$html_id}'"; ?>
    style="<?php echo esc_attr($style); ?>"
>
    <div class="container style--<?php echo $content_section_style; ?>">
        <div class="page-links-section__content">
        <!-- WYSIWYG and Buttons Introduction -->
        <?php
            get_template_part(
                'page-sections/section-fields/section-introduction',
                null,
                [
                    'section_class' => 'page-links-section',
                    'font_colour'   => $font_colour ?? 'black',
                    'content'       => null
                ]
            );
        ?>
            <!-- Query -->
             <?php
                $page_links = []; // Initialize empty array

                if(!empty($selected_pages)) {
                    // Display posts selected in ACF relationship field
                    $selected_ids = is_array($selected_pages) ? wp_list_pluck($selected_pages, 'ID') : [];

                    $args = [
                        'post_type'      => 'page',
                        'post_status'    => 'publish',
                        'post__in'       => $selected_ids,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ];

                    $page_links = get_posts($args);
                }
                wp_reset_postdata();
            ?>
            
            <!--  Page Links -->
            <?php if( $page_links ): ?>
                <ul class="page-links page-links--<?php echo $page_links_style; ?>">
                <?php foreach( $page_links as $page_link ): ?>
                    <?php include get_stylesheet_directory() . '/components/page-link-card-'.$page_links_style.'.php'; ?>
                <?php endforeach; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
