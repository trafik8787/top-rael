/**
 * Created by Vitalik on 16.07.2015.
 */
$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('change', '.w-select-city', function(){
        $('#w-form-city').submit();

    });











    /*
    выбор категории БИЗНЕСОВ группы лакшери (теги)
     */
    $(document).on('click', '.w-tags-bus-cat', function(){

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

        var tags_url = '';
        if ($('.w-tags-url').val() != undefined) {
            tags_url = $('.w-tags-url').val();
        }


        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/tagscatselest',
            data: 'section='+$(this).data('section')+'&cat='+$(this).data('cat')+'&tags_url='+tags_url, // передаем данные из формы
            success: function(response) { // когда получаем ответ


                sliderTmp.empty();
                //в переменной будем хранить иконуку в зависимости от того добавлен ли бизнес в избранное
                var bus_icon;
                //console.log(response);
                $.each(response.data, function(index, value) {
                    //console.log(value);

                    if (value.bussines_favorit != undefined) {
                        bus_icon = '<a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin" style="background-color: #ccc">'+
                                    '<i class="fa fa-star"></i></a>';
                    } else {
                        bus_icon = '<a href="#" data-toggle="tooltip" data-placement="left" data-id="'+value.id+'" class="pin w-add-bussines-favor">'+
                                    '<i class="fa fa-star"></i></a>';
                    }

                    sliderTmp.append('<div class="col-md-4">' +
                    '<div class="thumbnail">' +
                    bus_icon +
                    '<a href="/business/'+value.url+'" class="thumbnail-image"> ' +
                    '<img src="'+value.home_busines_foto+'" width="240" height="150" alt="">' +
                    '</a> ' +
                    '<div class="caption"> ' +
                    '<h3><strong><a href="/business/'+value.url+'">'+value.name+'</a></strong></h3> ' +
                    '<p><strong>'+value.CityName+' '+ value.address+'</strong></p>' +
                    value.info+
                    '</div> </div> </div>').hide();

                });
                sliderTmp.fadeIn();
                $('[data-toggle="tooltip"]').tooltip();

            }
        });


        return false;
    });


    /**
     *
     * выбор раздела СТАТЬИ группы лакшери (теги)
     */
    $(document).on('click', '.w-tags-artic-cat', function(){


        var thises = $(this);
        var sliderTmp = thises.closest('.w-bloc-section').find('.slider');
        var remowClas = thises.parents('.w-category-bloc').find('a.w-cat-active');
        var addClasLi = thises.parent();
        var remClassLi = thises.parents('.w-category-bloc').find('li.active');

        //удаляем клас
        remowClas.removeClass('w-cat-active');
        remClassLi.removeClass('active');
        //добавляем класс
        thises.addClass('w-cat-active');
        addClasLi.addClass('active');

        var tags_url = '';
        if ($('.w-tags-url').val() != undefined) {
            tags_url = $('.w-tags-url').val();
        }

        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/tagsecartic',
            data: 'section='+$(this).data('section')+'&tags_url='+tags_url, // передаем данные из формы
            success: function(response) { // когда получаем ответ

                sliderTmp.empty();
                //console.log(response);
                $.each(response, function(index, value) {
                    //console.log(value);
                    sliderTmp.append('<div><a href="/articles/'+value.CatUrl+'" class="fz medium">'+value.CatName+'</a> <div class="media"> <div class="media-left">'+
                    '<a href="/article/'+value.url+'">'+
                    '<img src="'+value.images_article+'" width="260" height="190" class="media-object" alt="'+value.name+'"/></a> </div>'+
                    '<div class="media-body">'+
                    '<h2 class="media-heading"><a href="/article/'+value.url+'"><strong>'+value.name+'</strong></a></h2>'+
                    '<p class="fz medium"><strong>'+value.secondname+'</strong></p>'+
                    value.content+
                    '</div> </div> </div><hr/>').hide();
                });
                sliderTmp.fadeIn();
            }
        });


        return false;
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
                //в переменной будем хранить иконуку в зависимости от того добавлен ли бизнес в избранное
                var bus_icon;

                //console.log(response);
                $.each(response.data, function(index, value) {
                    //console.log(value);

                    if (value.bussines_favorit != undefined) {
                        bus_icon = '<a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin" style="background-color: #ccc">'+
                        '<i class="fa fa-star"></i></a>';
                    } else {
                        bus_icon = '<a href="#" data-toggle="tooltip" data-placement="left" data-id="'+value.id+'" class="pin w-add-bussines-favor">'+
                        '<i class="fa fa-star"></i></a>';
                    }

                    sliderTmp.append('<div class="col-md-4">' +
                    '<div class="thumbnail">' +
                    bus_icon +
                    '<a href="/business/'+value.url+'" class="thumbnail-image"> ' +
                    '<img src="'+value.home_busines_foto+'" width="240" height="150" alt="">' +
                    '</a> ' +
                    '<div class="caption"> ' +
                    '<h3><strong><a href="/business/'+value.url+'">'+value.name+'</a></strong></h3> ' +
                    '<p><strong>'+value.CityName+' '+ value.address+'</strong></p>' +
                    value.info+
                    '</div> </div> </div>').hide();

                });

                sliderTmp.fadeIn();

                var options='<option value="">По городам</option>';
                $.each(response.city, function(index, value) {
                    //console.log(value);
                    selectTmp.empty();
                    options += '<option value="'+index+'">' + value + '</option>';
                });
                selectTmp.html(options);

                //переиницыализируем подсказку
                $('[data-toggle="tooltip"]').tooltip();
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
                var bus_icon;

                $.each(response.data, function(index, value) {
                    //console.log(value);

                    if (value.bussines_favorit != undefined) {
                        bus_icon = '<a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin" style="background-color: #ccc">'+
                        '<i class="fa fa-star"></i></a>';
                    } else {
                        bus_icon = '<a href="#" data-toggle="tooltip" data-placement="left" data-id="'+value.id+'" class="pin w-add-bussines-favor">'+
                        '<i class="fa fa-star"></i></a>';
                    }

                    sliderTmp.append('<div class="col-md-4">' +
                    '<div class="thumbnail">' +
                    bus_icon +
                    '<a href="/business/'+value.url+'" class="thumbnail-image"> ' +
                    '<img src="'+value.home_busines_foto+'" width="240" height="150" alt="">' +
                    '</a> ' +
                    '<div class="caption"> ' +
                    '<h3><strong><a href="/business/'+value.url+'">'+value.name+'</a></strong></h3> ' +
                    '<p><strong>'+value.CityName+' '+ value.address+'</strong></p>' +
                    value.info+
                    '</div> </div> </div>').hide();

                });
                sliderTmp.fadeIn();
                //переиницыализируем подсказку
                $('[data-toggle="tooltip"]').tooltip();
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

                var coup_icon;

                $.each(response.data, function(index, value) {
                    //console.log(value);

                    if (value.coupon_favorit != undefined) {
                        coup_icon = ' <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin" style="background-color: #ccc">'+
                                    '<i class="fa fa-thumb-tack"></i> </a>';
                    } else {
                        coup_icon = ' <a href="#" data-toggle="tooltip" data-placement="left" data-id="'+value.id+'" class="pin w-add-coupon-favor">'+
                                    '<i class="fa fa-thumb-tack"></i></a>';
                    }

                    slider_bloc.append('<div class="coupon"> <div class="coupon-container"> ' +
                    coup_icon +
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
                    '</div>').hide();
                });

                slider_bloc.fadeIn();

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

                //переиницыализируем подсказку
                $('[data-toggle="tooltip"]').tooltip();
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




    //добавить бизнес в избранное
    $(document).on('click', '.w-add-bussines-favor', function(){

        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/bussinessave',
            data: 'id_bussines='+$(this).data('id'),
            success: function(response) { // когда получаем ответ

                console.log(response);
            }
        });

        var count_bus = $('.w-count-bussines').text();
        count_bus = parseInt(count_bus) + 1;
        $('.w-count-bussines').text(count_bus);

        $(this).removeClass('w-add-bussines-favor');
        $(this).css('background-color', '#ccc');
        $(this).attr('data-original-title', 'Бизнес добавлен в Избранное').tooltip('show');
        $('[data-toggle="tooltip"]').tooltip();

        return false;
    });


    //удаляем бизнес из избранного
    $(document).on('click', '.w-delete-bussines-favor', function(){

        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/bussinesdel',
            data: 'id_bussines='+$(this).data('id'),
            success: function(response) { // когда получаем ответ

                console.log(response);
            }
        });


        $(this).parents('.bussines').hide();
        var count_bus = $('.w-count-bussines').text();
        count_bus = count_bus - 1;
        $('.w-count-bussines').text(count_bus);

        return false;

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

        var input_email = $('.w-input-lotarey-email');

        $.ajax({ // описываем наш запрос
            type: "POST", // будем передавать данные через POST
            dataType: "JSON", // указываем, что нам вернется JSON
            url: '/subscribe',
            data: $(this).serialize(),
            success: function(response) { // когда получаем ответ

                if (response.susses != undefined) {

                    input_email.popover({
                        placement: 'bottom',
                        content: response.susses,
                        delay: { show: 100, hide: 500 }
                    });
                    input_email.popover('show');
                    $('.popover.fade.bottom.in').css('background-color','greenyellow');
                    $('.popover.bottom>.arrow').addClass('susses-email');
                }

                if (response.dublicate_email != undefined) {
                    console.log(response.dublicate_email);
                    input_email.popover({
                        placement: 'bottom',
                        content: response.dublicate_email,
                        delay: { show: 100, hide: 500 }
                    });
                    input_email.popover('show');

                    $('.popover.fade.bottom.in').css('background-color','#FF7272');
                    $('.popover.bottom>.arrow').addClass('errors-email');
                }

                setTimeout(function () {
                    input_email.popover('destroy');
                }, 2000);

            }
        });

        return false;
    });




});