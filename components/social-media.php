<?php
$social_media_rows = get_field('social_media', 'option'); // Flexible content
$theme_uri = get_stylesheet_directory_uri() . '/assets/img/social-media/';
$color = $color ?? 'white';
?>

<?php if ($social_media_rows): ?>
    <div class="social-media">
        <?php foreach ($social_media_rows as $row): ?>
            <?php
            // The layout name corresponds to the platform slug
            $platform_key = $row['acf_fc_layout']; // e.g., 'instagram', 'facebook', etc.

            // Get the link subfield; it may return a URL string or an array depending on return_format
            $link_field = $row['link'];

            // Support ACF Link field returning array or string
            if (is_array($link_field)) {
                $url = $link_field['url'] ?? '';
            } else {
                $url = $link_field;
            }

            // Only proceed if URL exists
            if (!$url) continue;

            // Human-readable platform name (optional)
            $platform_names = [
                'instagram' => 'Instagram',
                'facebook'  => 'Facebook',
                'linkedin'  => 'LinkedIn',
                'twitter_x' => 'Twitter / X',
                'tiktok'    => 'TikTok',
                'youtube'   => 'YouTube',
            ];
            $platform_label = $platform_names[$platform_key] ?? ucfirst($platform_key);
            ?>
            
            <a class="social-media__icon"
               href="<?php echo esc_url($url); ?>"
               target="_blank" rel="noopener noreferrer"
               aria-label="Follow us on <?php echo esc_attr($platform_label); ?>">
                <img class="social-media__<?php echo esc_attr($platform_key); ?>"
                     src="<?php echo esc_url($theme_uri . $platform_key . '-' . $color . '.svg'); ?>"
                     alt="<?php echo esc_attr($platform_label); ?> Icon">
            </a>

        <?php endforeach; ?>
    </div>
<?php endif; ?>
