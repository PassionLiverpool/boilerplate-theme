<?php
$social_media = get_field('business_social_media', 'option');

$platforms = [
    'instagram' => 'Instagram',
    'facebook'  => 'Facebook',
    'linkedin'  => 'LinkedIn',
    'twitter_x' => 'Twitter / X',
    'tiktok'    => 'TikTok',
    'youtube'   => 'YouTube',
];

$theme_uri = get_stylesheet_directory_uri() . '/assets/img/social-media/';
?>

<div class="social-media">
    <?php foreach ($platforms as $key => $name) : ?>
        <?php if (!empty($social_media[$key])) : ?>
            <a class="social-media__icon"
            href="<?php echo esc_url($social_media[$key]); ?>"
            target="_blank" rel="noopener noreferrer"
            aria-label="Follow us on <?php echo esc_attr($name); ?>">
                <img
                    class="social-media__<?php echo esc_attr($key); ?>"
                    src="<?php echo esc_url($theme_uri . $key . '-' . $color . '.svg'); ?>"
                    alt="<?php echo esc_attr($name); ?> Icon">
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
