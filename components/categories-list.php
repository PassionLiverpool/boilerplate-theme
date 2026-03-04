<div class="categories container">
<ul class="categories__list">
    <li class="categories__item <?php echo is_home() ? 'current-category' : ''; ?>">
      <a href="<?php echo get_permalink( get_option('page_for_posts') ); ?>">All</a>
    </li>
    <?php
    $categories = get_categories([
        'orderby' => 'name',
        'order'   => 'ASC',
        'hide_empty' => true,
    ]);

    foreach ($categories as $category) :
        $category_link = get_category_link($category->term_id);
        $is_current = is_category($category->term_id);
        ?>
        <li class="categories__item <?php echo $is_current ? 'current-category' : ''; ?>">
            <a href="<?php echo esc_url($category_link); ?>" class="blog-categories__link">
                <?php echo esc_html($category->name); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
</div>