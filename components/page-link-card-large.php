<?php
    $permalink = get_permalink( $blog_post->ID );
    $title = get_the_title( $blog_post->ID );
    $excerpt = get_the_excerpt( $blog_post->ID );
    $truncated_title = wp_trim_words( $title, 15 );
    include ('featured-image.php');
?>

<li class="page-link page-link--large">
    <!-- Featured Image -->
    <a href="<?php echo esc_url( $permalink ); ?>" class="page-link__image">
        <span class="screen-reader-text"> Read more about <?php echo esc_html( $title ); ?></span>
        <?php
        if ( $featured_image ) {
            echo $featured_image;
        } else {
            echo $placeholder_html;
        }
        ?>
    </a>

    <div class="page-link__content">

        <!-- Category -->
        <div class="page-link__categories">
            <?php
            $categories = get_the_category( $blog_post->ID );
            if ( ! empty( $categories ) ) {
                foreach ( $categories as $category ) {
                    $category_link = get_category_link( $category->term_id );
                    echo '<a href="' . esc_url( $category_link ) . '" class="page-link__category">'
                        . esc_html( $category->name ) .
                        '</a> ';
                }
            }
            ?>
        </div>

        <!-- Title -->
        <h3 class="page-link__title">
            <?php echo esc_html( $truncated_title ); ?>
        </h3>

        <!-- Excerpt -->
        <?php if ($excerpt) : ?>
            <p class="page-link__excerpt">
                <?php echo esc_html( wp_trim_words( $excerpt, 40 ) ); ?>
            </p>
        <?php endif; ?>

        <!-- Read more button -->
        <a href="<?php echo esc_url( $permalink ); ?>" class="btn btn--primary">
            Read More <span class="screen-reader-text"> about <?php echo esc_html( $title ); ?></span>
        </a>
    </div>
</li>