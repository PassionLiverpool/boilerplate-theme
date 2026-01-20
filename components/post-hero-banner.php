<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    // Appearance
    $banner_image_id = get_post_thumbnail_id(get_the_ID());
    $placeholder_image = get_field('placeholder_blog_post_image', 'option');

?>

<section class="post-hero-banner">
    <div class="post-hero-banner__info">
        <div class="post-hero-banner__text">
            <!-- Post Title -->
            <h1 class="post-hero-banner__header">
                <?php echo the_title(); ?>
            </h1>
        </div>

        <div class="post-hero-banner__categories">
            <?php bootscore_category_badge(); ?>
        </div>
    </div>
    <?php
    if($banner_image_id):
        echo wp_get_attachment_image(
            $banner_image_id,
            'full',
            false,
            array(
                'loading' => 'lazy',
                'class'   => 'post-hero-banner__image'
            )
        );
    elseif ($placeholder_image):
        echo wp_get_attachment_image(
            $placeholder_image['id'],
            'full',
            false,
            array(
                'loading' => 'lazy',
                'class'   => 'post-hero-banner__image'
            )
        );
    endif; ?>
</section>

<section class="post-hero-banner__meta">
    <div class="container">
        <span>Published <?php echo get_the_date('j M Y'); ?></span>

        <!-- AddToAny Share Buttons -->
        <span>
            Share: 
            <?php if (function_exists('ADDTOANY_SHARE_SAVE_KIT')) {
                ADDTOANY_SHARE_SAVE_KIT();
            } ?>
        </span>

    </div>
</section>