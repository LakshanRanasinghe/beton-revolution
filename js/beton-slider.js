jQuery(document).ready(function ($) {

    let slider = $('.bpc-custom-slider');
    if (slider.length === 0) {
        return;
    }

    let images = slider.find('.slides img').map(function () {
        return $(this).attr('src');
    }).get();

    let current = 0;

    function updateSlider() {

        let prev = (current - 1 + images.length) % images.length;
        let next = (current + 1) % images.length;

        $('.center-img').attr('src', images[current]);
        $('.left-img').attr('src', images[prev]);
        $('.right-img').attr('src', images[next]);
    }

    updateSlider();

    // Next
    $('.nav-right').click(function () {
        current = (current + 1) % images.length;
        updateSlider();
    });

    // Prev
    $('.nav-left').click(function () {
        current = (current - 1 + images.length) % images.length;
        updateSlider();
    });

    // Auto slide
    setInterval(function () {
        current = (current + 1) % images.length;
        updateSlider();
    }, 5000);

    function updateSlider() {

        let prev = (current - 1 + images.length) % images.length;
        let next = (current + 1) % images.length;

        $('.center-img').fadeOut(200, function () {
            $(this).attr('src', images[current]).fadeIn(200);
        });

        $('.left-img').attr('src', images[prev]);
        $('.right-img').attr('src', images[next]);
    }


    //Modal Popup
    // OPEN popup (call this when needed)
    function openModal() {
        $('.bpc-custom-modal-container .custom-modal-overlay').fadeIn(200);
    }

    // CLOSE popup
    function closeModal() {
        $('.bpc-custom-modal-container .custom-modal-overlay').fadeOut(200);
    }

    // Close actions
    $('.bpc-custom-modal-container .modal-close, .bpc-custom-modal-container .modal-ok').click(function () {
        closeModal();
    });

    // Click outside to close
    $('.bpc-custom-modal-container .custom-modal-overlay').click(function (e) {
        if ($(e.target).is('.bpc-custom-modal-container .custom-modal-overlay')) {
            closeModal();
        }
    });


});