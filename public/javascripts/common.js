/**
 * Created by Fedor on 8/2/2015.
 */
$(function () {
    //panelCoupnsCarsousel();
    discountCarousel();
    galleryLarge();
});


function panelCoupnsCarsousel() {

    var owl = $('.panel-coupons-carousel .owl-carousel');

    owl.owlCarousel({
        loop: true,
        margin: 10,
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