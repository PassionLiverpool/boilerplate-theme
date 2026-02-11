<?php
$show_icon = $button['show_icon'] ?? false;
$button_link = $button['button_link'] ?? null;
$button_icon = $button['button_icon'] ?? null;
$icon_position = $button['icon_position'] ?? 'left';

if ($button_link) :
    $url    = $button_link['url'] ?? '#';
    $title  = $button_link['title'] ?? '';
    $target = $button_link['target'] ?? '_self';
?>
    <a class="btn btn--primary btn--icon-<?php echo esc_attr($icon_position)?>"
       href="<?php echo esc_url($url); ?>"
       target="<?php echo esc_attr($target); ?>">

        <?php
        // --- ICON ---
        if ( $show_icon == true && $button_icon ) {
            if ( filter_var( $button_icon, FILTER_VALIDATE_URL ) ) {
                echo '<img class="btn__icon" src="' . esc_url( $button_icon ) . '" alt="">';
            }
            else {
                echo esc_html( $button_icon );
            }
        }
        ?>

        <span class="btn__text"><?php echo esc_html($title); ?></span>
    </a>
<?php endif; ?>
