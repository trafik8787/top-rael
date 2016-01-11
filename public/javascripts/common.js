/**
 * Created by Fedor on 8/2/2015.
 */
$(function () {
    discountCarousel();
    galleryLarge();
   // verticalGallery();
});

function verticalGallery() {

    $('.bx-gallery').each(function () {

        var minSlides = 4;
        var bxImageBlock = $('.bx-image', this);
        var bxImage = $('.layer img', bxImageBlock);
        var bxCaption = $('.bx-caption', bxImageBlock);

        var gallery = $('.bx-slider .layers', this).bxSlider({
            mode: 'vertical',
            responsive: true,
           // minSlides: minSlides,
            minSlides: 2,
            maxSlides: 2,
            pager: false,
            controls: false,
            slideMargin: 20
        });

        $('[data-bx-image]', this).off('click').on('click', function () {

            var $image = $(this).data('bx-image');

            bxCaption.text($(this).data('bx-caption'));

            if (!$image)
                return;

            var zIndex = 1000;

            var image = $('<img>');
            image.attr({src: $image});

            bxImage.replaceWith(image);

            bxImage = image;
        });

        if (gallery.getSlideCount() <= minSlides) {
            $([
                $('.btn-prev', this).get(0),
                $('.btn-next', this).get(0)
            ]).addClass('disabled');
        }

        $('.btn-prev', this).off('click').on('click', function () {
            gallery.goToPrevSlide();
        });
        $('.btn-next', this).off('click').on('click', function () {
            gallery.goToNextSlide();
        });

    });
}



function discountCarousel() {
    var owl = $('.discount .owl-carousel');

    owl.owlCarousel({
        loop: true,
        autoplay : true,
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

