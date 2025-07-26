document.addEventListener("DOMContentLoaded", function () {
    const suspiciousIframes = document.querySelectorAll('iframe');

    suspiciousIframes.forEach(function (iframe) {
        const src = iframe.src || '';

        // Deteksi iframe mencurigakan dari srcdoc atau class parent
        const isSuspicious =
            iframe.parentElement?.classList.contains('ue-sidebar-container') ||
            iframe.srcdoc?.includes("frame-root");

        // Hanya izinkan iframe dari YouTube dan Google Maps
        const isAllowedSrc =
            src.includes('youtube.com') ||
            src.includes('youtu.be') ||
            src.includes('google.com/maps');

        // Hapus iframe yang mencurigakan atau tidak dari sumber resmi
        if (isSuspicious || !isAllowedSrc) {
            iframe.remove();
        }
    });
});