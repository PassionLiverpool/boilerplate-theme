<div class="<?php echo $section_class ?>__wysiwyg font--<?php echo esc_attr($font_colour) ?> alignment--<?php echo $text_alignment ?>">
    <?php echo wp_kses_post( $wysiwyg_text ); ?>
</div>