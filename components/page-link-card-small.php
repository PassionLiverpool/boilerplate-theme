<?php
    $permalink = get_permalink( $blog_post->ID );
    $title = get_the_title( $blog_post->ID );
    $max_length = 60;
    $truncated_title = wp_html_excerpt( $title, $max_length ) . ( strlen( $title ) > $max_length ? '…' : '' );
    include ('featured-image.php');
?>

<li class="page-link-card page-link-card--small">
    <!-- Featured image -->
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
        <!-- Blog post title -->
        <h3 class="page-link-card__title"><?php echo esc_html( $truncated_title ); ?></h3>

        <!-- Read more button -->
        <a href="<?php echo esc_url( $permalink ); ?>" class="btn btn--primary">
            Read More <span class="screen-reader-text"> about <?php echo esc_html( $title ); ?></span>
        </a>
    </div>
</li>