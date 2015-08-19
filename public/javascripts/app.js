/**
 * Created by Vitalik on 16.07.2015.
 */
$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('change', '.w-select-city', function(){
        $('#w-form-city').submit();

    });


    /**
     * выбор категории бизнеса
     */
    $(document).on('click', '.w-home-cat', function(){

        var thises = $(this);
        var sliderTmp = thises.closest('.w-bloc-section').find('.slider');
        var selectTmp = thises.closest('.w-bloc-section').find('.w-select-city');
        var remowClas = thises.parents('.w-category-bloc').find('a.w-cat-active');
        var addClasLi = thises.parent();
        var remClassLi = thises.parents('.w-category-bloc').find('li.active');
        //удаляем клас
        remowClas.removeClass('w-cat-active');
        remClassLi.removeClass('active');
        //добавляем класс
        thises.addClass('w-cat-active');
        addClasLi.addClass('active');

        var city_id = '';
        if ($('.w-city-id').val() != undefined) {
            city_id = $('.w-city-id').val();
        }


        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/ajaxselect',
            data: 'section='+$(this).data('section')+'&cat='+$(this).data('cat')+'&city='+city_id, // передаем данные из формы
            success: function(response) { // когда получаем ответ


                sliderTmp.empty();

                //console.log(response);
                $.each(response.data, function(index, value) {
                    //console.log(value);
                    sliderTmp.append('<div class="col-md-4">' +
                    '<div class="thumbnail">' +
                    '<a href="#" class="pin"><i class="fa fa-star"></i></a>' +
                    '<a href="/business/'+value.url+'" class="thumbnail-image"> ' +
                    '<img src="'+value.home_busines_foto+'" width="240" height="150" alt="">' +
                    '</a> ' +
                    '<div class="caption"> ' +
                    '<h3><strong><a href="/business/'+value.url+'">'+value.name+'</a></strong></h3> ' +
                    '<p><strong>'+value.CityName+' '+ value.address+'</strong></p>' +
                    value.info+
                    '</div> </div> </div>');

                });

                var options='<option value="">По городам</option>';
                $.each(response.city, function(index, value) {
                    //console.log(value);
                    selectTmp.empty();
                    options += '<option value="'+index+'">' + value + '</option>';
                });
                selectTmp.html(options);

            }
        });


        return false;
    });


    /**
     * выбор города бизнеса
     */
    $(document).on('change', '.w-select-city', function(){

        var thisSel = $(this);
        var sliderTmp = thisSel.closest('.w-bloc-section').find('.slider');
        var section = thisSel.closest('.w-bloc-section').find('.w-cat-active').data('section');
        var cat = thisSel.closest('.w-bloc-section').find('.w-cat-active').data('cat');
        //console.log($(this).val());
        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/ajaxselect',
            data: 'city='+$(this).val()+'&section='+section+'&cat='+cat, // передаем данные из формы
            success: function(response) { // когда получаем ответ
                //очищаем слайдер
                sliderTmp.empty();
                $.each(response.data, function(index, value) {
                    //console.log(value);
                    sliderTmp.append('<div class="col-md-4">' +
                    '<div class="thumbnail">' +
                    '<a href="#" class="pin"><i class="fa fa-star"></i></a>' +
                    '<a href="/business/'+value.url+'" class="thumbnail-image"> ' +
                    '<img src="'+value.home_busines_foto+'" width="240" height="150" alt="">' +
                    '</a> ' +
                    '<div class="caption"> ' +
                    '<h3><strong><a href="/business/'+value.url+'">'+value.name+'</a></strong></h3> ' +
                    '<p><strong>'+value.CityName+' '+ value.address+'</strong></p>' +
                    value.info+
                    '</div> </div> </div>');

                });

            }
        });
    });


    //сортировка купонов по разделам
    $(document).on('click', '.w-coupon-section', function(){

        var sectcop =  $(this).data('sectcop');
        var slider_bloc = $(this).closest('.w-bloc-coupons').find('.w-coupon-carusel');

        var addClasLi = $(this).parent();
        var remClassLi = $(this).parents('.w-bloc-coupons').find('li.active');

        remClassLi.removeClass('active');
        addClasLi.addClass('active');
        //деструктор слайдера
        owl.trigger('destroy.owl.carousel');
        owl.html(owl.find('.owl-stage-outer').empty()).removeClass('owl-loaded');

        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/ajaxselect/coupons',
            data: 'sectcop='+sectcop, // передаем данные из формы
            success: function(response) { // когда получаем ответ
                //очищаем слайдер
                //slider_bloc.empty();

                $.each(response.data, function(index, value) {
                    //console.log(value);

                    slider_bloc.append('<div class="coupon"> <div class="coupon-container"> ' +
                    '<a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a> ' +
                    '<div class="coupon-image">'+
                    '<div class="overlay">'+
                    value.secondname+
                    '</div> <img src="'+value.img_coupon+'" width="155" height="125" alt="" title=""/> </div> ' +
                    '<div class="coupon-context"> <div> ' +
                    '<span>Купон</span> ' +
                    '<span><small>Массаж</small></span> </div> <div> ' +
                    '<span>20%</span>'+
                    '<span><small>скидка</small></span></div>'+
                    '<div><small class="coupon-date">до 1 Апр 2015</small></div></div> </div>'+
                    '</div>');
                });

                //переинициализация слайдера
                owl.owlCarousel({
                    loop: true,

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
        });

        return false;
    });


    //слайдер купонов на главной
    var owl = $('.panel-coupons-carousel .owl-carousel');

    owl.owlCarousel({
        loop: true,

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




    //переиницыализация модельного окна купона
    $('.bs-coupon-modal-sm').on('hide.bs.modal', function (e) {
        $('.bs-coupon-modal-sm').removeData('bs.modal')
    });

    //печать купона
    $(document).on('click', '.w-button-print', function(){
        $(".w-print-coupon").print({
            globalStyles: true
        });
    });

    //добавить купон в избранное
    $(document).on('click', '.w-add-coupon-favor', function(){

        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/couponsave',
            data: 'id_coupon='+$(this).data('id'),
            success: function(response) { // когда получаем ответ

                console.log(response);
            }
        });

        var count_coupon = $('.w-count-coupon').text();
        count_coupon = parseInt(count_coupon) + 1;
        $('.w-count-coupon').text(count_coupon);


        $(this).removeClass('w-add-coupon-favor');
        $(this).css('background-color', '#ccc');
        $(this).attr('data-original-title', 'Купон добавлен в Избранное').tooltip('show');
        $('[data-toggle="tooltip"]').tooltip();

        return false;
    });


    //добавить купон в избранное из модального окна купона
    $(document).on('click', '.w-add-coupon-favor-modal', function(){

        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/couponsave',
            data: 'id_coupon='+$(this).data('id'),
            success: function(response) { // когда получаем ответ

                console.log(response);
            }
        });

        var count_coupon = $('.w-count-coupon').text();
        count_coupon = parseInt(count_coupon) + 1;
        $('.w-count-coupon').text(count_coupon);

        var icon_favor =  $('[data-id="'+$(this).data('id')+'"]');
        icon_favor.removeClass('w-add-coupon-favor');
        icon_favor.css('background-color', '#ccc');
        icon_favor.attr('data-original-title', 'Купон добавлен в Избранное').tooltip('show');
        $('[data-toggle="tooltip"]').tooltip();

        return false;
    });




    //удалить купоны в избранном
    $(document).on('click', '.w-delete-coupon-favor', function(){

        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/coupondelete',
            data: 'id_coupon='+$(this).data('id'),
            success: function(response) { // когда получаем ответ

                console.log(response);
            }
        });

        $(this).parents('.coupon').hide();
        var count_coupon = $('.w-count-coupon').text();
        count_coupon = count_coupon - 1;
        $('.w-count-coupon').text(count_coupon);

        return false;
    });


    //подписка блок лотарея
    $('.w-form-subscribe-lotarey').submit(function(){

        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/subscribe',
            data: $(this).serialize(),
            success: function(response) { // когда получаем ответ

                console.log(response);
            }
        });

        return false;
    });

    //$(document).on('click', '.w-subskrip-buton', function(){
    //
    //    alert($('.w-form-subscribe-lotarey').serialize());
    //    return false;
    //
    //});
    //$(".w-form-subscribe-lotarey").validate({
    //
    //    rules:{
    //
    //        cheklicenz:{
    //            required: true
    //        },
    //
    //        email:{
    //            required: true,
    //            email: true
    //        }
    //
    //    },
    //
    //    messages:{
    //
    //        cheklicenz:{
    //            required: "Для продолжения поставьте галочку"
    //        },
    //
    //        email:{
    //            required: "Это поле обязательно для заполнения",
    //            email: 'Неправельный формат'
    //        }
    //    },
    //    submitHandler: function(form){
    //        alert('sdf');
    //    }
    //});




});