<?php
    $permalink = get_permalink( $blog_post->ID );
    $title = get_the_title( $blog_post->ID );
    $excerpt = get_the_excerpt( $blog_post->ID );
    $truncated_title = wp_trim_words( $title, 15 );
    include ('featured-image.php');
?>

<li class="page-link-card page-link-card--large">
    <!-- Featured Image -->
    <a href="<?php echo esc_url( $permalink ); ?>" class="page-link-card__image">
        <span class="screen-reader-text"> Read more about <?php echo esc_html( $title ); ?></span>
        <?php
        if ( $featured_image ) {
            echo $featured_image;
        } else {
            echo $placeholder_html;
        }
        ?>
    </a>

    <div class="page-link-card__content">

        <!-- Title -->
        <h3 class="page-link-card__title">
            <?php echo esc_html( $truncated_title ); ?>
        </h3>

        <!-- Excerpt -->
        <?php if ($excerpt) : ?>
            <p class="page-link-card__excerpt">
                <?php echo esc_html( wp_trim_words( $excerpt, 40 ) ); ?>
            </p>
        <?php endif; ?>

        <!-- Read more button -->
        <a href="<?php echo esc_url( $permalink ); ?>" class="btn btn--primary">
            Read More <span class="screen-reader-text"> about <?php echo esc_html( $title ); ?></span>
        </a>
    </div>
</li>