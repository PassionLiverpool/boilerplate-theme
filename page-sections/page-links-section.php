<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $section_class="page-links-section";

    // Header & Body Text
    include get_stylesheet_directory() . '/page-sections/section-fields/section-text.php';

    // Appearance
    $page_links_style = get_sub_field('page_links_style') ?? 'small';
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Blog posts
    $selected_pages = get_sub_field('selected_pages');

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
    <div class="container style--<?php echo $content_section_style; ?>">
        <div class="page-links-section__content">
            <!-- Header -->
            <?php if ( $header ) {
                include get_stylesheet_directory() . '/components/section-header.php';
            } ?>

            <!-- WYSIWYG -->
            <?php if ( $wysiwyg_text ) {
                include get_stylesheet_directory() . '/components/section-wysiwyg.php';
            } ?>

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
                <?php foreach( $page_links as $blog_post ): ?>
                    <?php include get_stylesheet_directory() . '/components/page-link-card-'.$page_links_style.'.php'; ?>
                <?php endforeach; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>

    </div>
</section>
