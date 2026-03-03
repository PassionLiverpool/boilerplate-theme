<?php
    $content = get_sub_field('section_content');

    if ($content) {
        $wysiwyg_text = $content['wysiwyg_text'];
    } else {
        $wysiwyg_text = get_sub_field('wysiwyg_text');
    }
?>