/**
 * Created by Fedor on 8/2/2015.
 */
$(function () {
    discountCarousel();
    galleryLarge();
});




function discountCarousel(){
    var owl = $('.discount .owl-carousel');

    owl.owlCarousel({
        loop: true,
        items: 1,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false
    });
}

function galleryLarge(){
    var owl = $('.primary-gallery .owl-carousel');

    owl.owlCarousel({
        loop: true,
        items: 1,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: true
    });
}