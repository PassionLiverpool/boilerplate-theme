<<?php echo esc_attr( $header_style ); ?> class="<?php echo $section_class ?>__header font--<?php echo esc_attr($font_colour) ?> alignment--<?php echo $header_alignment ?>">
    <?php echo wp_kses_post( $header ); ?>
</<?php echo esc_attr( $header_style ); ?>>
