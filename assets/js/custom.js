jQuery(function ($) {

    // Modal video
    $('.modal-video-button').modalVideo();

}); // jQuery End

document.addEventListener("DOMContentLoaded", () => {
    // Basic lightbox
    const galleryItems = document.querySelectorAll('.gallery-image');

    galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            const fullSrc = img.getAttribute('data-full');
            const instance = basicLightbox.create(`
                <img src="${fullSrc}" width="1400" height="900" alt="">
            `);
            instance.show();
        });
    });

    // Video banner - toggle audio
    const video_banner = document.querySelector('.hero-banner__video');

    if (!video_banner) return;

    const video = video_banner.querySelector('video');
    const toggleButton = video_banner.querySelector('.audio-toggle');

    if (!video || !toggleButton) return;

    toggleButton.addEventListener('click', function () {
        video.muted = !video.muted;

        // Optional: update button state for styling / accessibility
        toggleButton.classList.toggle('is-muted', video.muted);
        toggleButton.setAttribute(
            'aria-pressed',
            video.muted ? 'false' : 'true'
        );
    });
});
