<?php
    $content = get_sub_field('section_content');

    if ($content) {
        $header_alignment = $content['header_alignment'];
        $header = $content['header'];
        $header_style = $content['header_style'];
        $wysiwyg_text = $content['wysiwyg_text'];
    } else {
        $header_alignment = get_sub_field('header_alignment');
        $header = get_sub_field('header');
        $header_style = get_sub_field('header_style') ?? 'h2';
        $wysiwyg_text = get_sub_field('wysiwyg_text');
    }
?>