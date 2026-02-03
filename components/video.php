<?php
    $video_id = '';
    $pattern = '%(?:https?:)?//(?:www\.|m\.)?(?:youtube(?:-nocookie)?\.com/(?:watch\?v=|embed/|oembed\?url=)|youtu\.be/)([A-Za-z0-9_-]{11})%ix';

    // Get the ID from the URL
    if (preg_match($pattern, $video, $matches)) {
        $video_id = $matches[1];
        $poster = 'https://img.youtube.com/vi/' . $video_id . '/maxresdefault.jpg';
    }

    if (empty($video_thumbnail)) {
        $video_poster = "<img src='" . esc_url($poster) . "' alt='Video poster' class='video-poster' />";
    } else {
        $video_poster = wp_get_attachment_image($video_thumbnail['id'], 'medium', false, array('loading' => 'lazy'));
    }
?>

<?php if ($video_id): ?>
<div class="video-thumbnail">
    <button type="button"
            class="content-button white-outline-button modal-video-button"
            data-video-id="<?php echo esc_attr($video_id) ?>">Play Video</button>
    <?php echo $video_poster; ?>
</div>
<?php endif; ?>
