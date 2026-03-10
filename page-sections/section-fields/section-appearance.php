<?php
    // Args
    $disable_bg = $disable_background ?? false;

    // Fields
    $section_appearance = get_sub_field('section_appearance');
    $background_colour = $section_appearance['background_colour'];
    $font_colour = $section_appearance['font_colour'];
    $background_image = $section_appearance['background_image'];
    $padding_top = $section_appearance['padding_top'] ?? '8';
    $padding_bottom = $section_appearance['padding_bottom'] ?? '8';
    $margin_top = $section_appearance['margin_top'] ?? '0';
    $margin_bottom = $section_appearance['margin_bottom'] ?? '0';

    $style = '';

    if (!$disable_bg && $background_image) {
        $style .= "background-image:url('{$background_image['url']}');";
    }

    $style .= "padding-top:{$padding_top}rem;";
    $style .= "padding-bottom:{$padding_bottom}rem;";
    $style .= "margin-top:{$margin_top}rem;";
    $style .= "margin-bottom:{$margin_bottom}rem;";
?>