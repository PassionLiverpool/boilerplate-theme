<?php
$primary_button = $content['primary_button_button'] ?? get_sub_field('primary_button_button');
$secondary_button = $content['secondary_button_button'] ?? get_sub_field('secondary_button_button');

$has_wysiwyg = !empty(trim(wp_strip_all_tags($wysiwyg_text ?? '')));
$has_primary_button = !empty($primary_button['url']);
$has_secondary_button = !empty($secondary_button['url']);

if ($has_wysiwyg || $has_primary_button || $has_secondary_button): ?>
    <div class="<?php echo $section_class ?>__introduction">
        <!-- WYSIWYG -->
        <?php if ( $wysiwyg_text ) {
            include get_stylesheet_directory() . '/components/section-wysiwyg.php';
        } ?>

        <!-- Buttons -->
        <?php if($primary_button || $secondary_button): ?>
            <div class="<?php echo $section_class ?>__buttons buttons">
                <?php if($primary_button): ?>
                    <?php
                        $button = $primary_button;
                        include get_stylesheet_directory() . '/components/button.php';
                    ?>
                <?php endif; ?>
                <?php if($secondary_button): ?>
                    <?php
                        $button = $secondary_button;
                        include get_stylesheet_directory() . '/components/button.php';
                    ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>