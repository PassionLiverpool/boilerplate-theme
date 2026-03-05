<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    // Appearance
    $blog_posts_style = get_sub_field('blog_posts_style') ?? 'small';
    include get_stylesheet_directory() . '/page-sections/section-fields/section-appearance.php';

    // Blog posts
    $number_of_blog_posts = get_sub_field('number_of_blog_posts') ?? 3;
    $posts_to_display = get_sub_field('posts_to_display') ?? 'all-posts';
    $posts_category = get_sub_field('posts_category') ?? [];
    $selected_blog_posts = get_sub_field('selected_blog_posts');

    $link_to_blog_archive = get_sub_field('link_to_blog_archive') ?? false;

    // Settings
    include get_stylesheet_directory() . '/page-sections/section-fields/section-settings.php';
?>

<section class="blog-posts-section background--<?php echo $background_colour ?>"
    <?php if ($html_id) echo "id='{$html_id}'"; ?>
    style="<?php echo esc_attr($style); ?>"
>
    <div class="container style--<?php echo $content_section_style; ?>">
        <div class="blog-posts-section__content">
        <!-- WYSIWYG and Buttons Introduction -->
        <?php
            get_template_part(
                'page-sections/section-fields/section-introduction',
                null,
                [
                    'section_class' => 'blog-posts-section',
                    'font_colour'   => $font_colour ?? 'black',
                    'content'       => null
                ]
            );
        ?>
            <!-- Query -->
             <?php
                $blog_posts = []; // Initialize empty array

                if ($posts_to_display === 'all-posts') {
                    // Most recent posts across all categories
                    $args = [
                        'post_type'      => 'post',
                        'posts_per_page' => $number_of_blog_posts,
                        'post_status'    => 'publish',
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ];

                    $blog_posts = get_posts($args);
                } elseif ($posts_to_display === 'certain-categories' && !empty($posts_category)) {
                    // Filter posts by categories (ACF taxonomy field returns array of term IDs or objects)
                    $category_ids = [];

                    foreach ($posts_category as $cat) {
                        if (is_array($cat) && isset($cat['term_id'])) {
                            $category_ids[] = $cat['term_id'];
                        } elseif (is_object($cat) && isset($cat->term_id)) {
                            $category_ids[] = $cat->term_id;
                        } else {
                            $category_ids[] = $cat; // fallback if term ID already stored
                        }
                    }

                    $args = [
                        'post_type'      => 'post',
                        'posts_per_page' => $number_of_blog_posts,
                        'post_status'    => 'publish',
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'tax_query'      => [
                            [
                                'taxonomy' => 'category',
                                'field'    => 'term_id',
                                'terms'    => $category_ids,
                            ]
                        ],
                    ];

                    $blog_posts = get_posts($args);

                } elseif ($posts_to_display === 'selected-posts' && !empty($selected_blog_posts)) {
                    // Display posts selected in ACF relationship field
                    $selected_ids = is_array($selected_blog_posts) ? wp_list_pluck($selected_blog_posts, 'ID') : [];
                    
                    $args = [
                        'post_type'      => 'post',
                        'post__in'       => $selected_ids,
                        'posts_per_page' => $number_of_blog_posts,
                        'post_status'    => 'publish',
                        'orderby'        => 'post__in', // Keep the order as selected in ACF
                    ];

                    $blog_posts = get_posts($args);
                }

                // Optional: reset post data after your loop
                wp_reset_postdata();
            ?>
            
            <!--  Blog Posts -->
            <?php if( $blog_posts ): ?>
                <ul class="blog-posts blog-posts--<?php echo $blog_posts_style; ?>">
                <?php foreach( $blog_posts as $blog_post ): ?>
                    <?php include get_stylesheet_directory() . '/components/blog-post-card-'.$blog_posts_style.'.php'; ?>
                <?php endforeach; ?>
                </ul>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>

            <?php if($link_to_blog_archive): ?>
                <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn--primary blog-posts-section__archive-link">
                    View All Blog Posts
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
