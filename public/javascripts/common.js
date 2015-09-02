/**
 * Created by Fedor on 8/2/2015.
 */
$(function () {
    //couponsGallery();
    discountCarousel();
    galleryLarge();
    verticalGallery();
});

function verticalGallery() {

    $('.bx-gallery').each(function () {

        var minSlides = 4;
        var bxImageBlock = $('.bx-image .layer', this);
        var bxImage = $('img', bxImageBlock);
        var gallery = $('.bx-slider .layers', this).bxSlider({
            mode: 'vertical',
            responsive: true,
            minSlides: minSlides,
            pager: false,
            controls: false,
            slideMargin: 20
        });

        $('[data-bx-image]', this).off('click').on('click', function () {

            var data = $(this).data('bx-image');

            if (!data)
                return;

            var zIndex = 1000;

            var image = $('<img>');
            image.attr({src: data});

            bxImage.replaceWith(image);

            bxImage = image;
        });

        if (gallery.getSlideCount() <= minSlides) {

            bxImageBlock.css({
                top: 0,
                bottom: 0
            });

            $([
                $('.btn-prev', this).get(0),
                $('.btn-next', this).get(0)
            ]).hide();

            return;
        }

        $('.btn-prev', this).off('click').on('click', function () {
            gallery.goToPrevSlide();
        });
        $('.btn-next', this).off('click').on('click', function () {
            gallery.goToNextSlide();
        });
    });
}

function couponsGallery() {

    var owl = $('.panel-coupons.gallery .owl-carousel');

    owl.owlCarousel({
        loop: true,
        margin: 0,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1170: {
                items: 4
            }
        },
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false
    });
}


function discountCarousel() {
    var owl = $('.discount .owl-carousel');

    owl.owlCarousel({
        loop: true,
        items: 1,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false
    });
}

function galleryLarge() {
    var owl = $('.primary-gallery .owl-carousel');

    owl.owlCarousel({
        loop: true,
        items: 1,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: true
    });
}

