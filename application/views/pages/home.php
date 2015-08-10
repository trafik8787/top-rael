<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 03.08.2015
 * Time: 18:05
 */

?>
<script>
    $(document).ready(function(){


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


            $.ajax({ // описываем наш запрос
                type: "POST", // будем передавать данные через POST
                dataType: "JSON", // указываем, что нам вернется JSON
                url: '/ajaxselect',
                data: 'section='+$(this).data('section')+'&cat='+$(this).data('cat'), // передаем данные из формы
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

    });

</script>
<?//HTML::x($articles)?>

<content>
    <div id="content">

        <div class="top">

            <div class="top-image">
                <img src="<?=$articles['top_articles']['images_article']?>" width="600" height="420" class="img-responsive" alt="<?=$articles['top_articles']['secondname']?>"/>

                <div class="top-image-text">
                    <h2><a href="/article/<?=$articles['top_articles']['url']?>"><?=$articles['top_articles']['secondname']?></a></h2>
                    <?=$articles['top_articles']['short_previev']?>
                </div>
            </div>

            <div class="top-list">

                <?foreach($articles['articles'] as $rows_articles):?>
                    <div class="media">
                        <div class="media-left">
                            <a href="/article/<?=$rows_articles['url']?>">
                            <?if (file_exists($_SERVER['DOCUMENT_ROOT'].$rows_articles['images_article'])):?>
                                <img src="/uploads/img_articles/thumbs/<?=basename($rows_articles['images_article'])?>" width="120" height="85" class="media-object" alt="<?=$rows_articles['name']?>"/>
                            <?else:?>
                                <img src="/public/uploade/list.png" width="120" height="85" class="media-object"/>
                            <?endif?>

                            </a>
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading"><a href="/article/<?=$rows_articles['url']?>"><strong><?=$rows_articles['name']?></strong></a></h2>

                            <strong><?=$rows_articles['secondname']?></strong>

                            <p> <?=Text::limit_chars(strip_tags($rows_articles['content']), 100, null, true)?></p>
                        </div>
                    </div>
                <?endforeach?>

                <div class="text-center">
                    <a href="/articles" class="btn btn-default open-all" role="button">Открыть все</a>
                </div>
            </div>
        </div>

        <div class="panel panel-coupons-carousel w-bloc-coupons">
            <div class="panel-heading">

                <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-coupons-panel"
                   aria-controls="nav-coupons-panel">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="panel-title">Купоны</div>

                <div class="collapse" id="nav-coupons-panel">
                    <ul class="nav nav-pills">
                        <li class="active"><a class="w-coupon-section" href="#">Новые</a></li>
                        <?foreach ($section as $row_section):?>
                            <li><a href="/coupons/<?=$row_section['url']?>" class="w-coupon-section" data-sectcop="<?=$row_section['url']?>"><?=$row_section['name']?></a></li>
                        <?endforeach?>

                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <div class="owl-carousel w-coupon-carusel">

                    <?foreach ($coupons['data'] as $rows_coupon):?>

                        <div class="coupon">
                            <div class="coupon-container">

                                <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                                <div class="coupon-image">
                                    <div class="overlay">
                                        <?=$rows_coupon['secondname']?>
                                    </div>

                                    <img src="<?=$rows_coupon['img_coupon']?>" width="155" height="125" alt="" title=""/>
                                </div>

                                <div class="coupon-context">
                                    <div>
                                        <span>Купон</span>
                                        <span><small>Массаж</small></span>
                                    </div>

                                    <div>
                                        <span>20%</span>
                                        <span><small>скидка</small></span>
                                    </div>

                                    <div><small class="coupon-date">до 1 Апр 2015</small></div>
                                </div>
                            </div>
                        </div>

                    <?endforeach?>

                </div>
            </div>
        </div>

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">

                <div id="context">
                    <?foreach($data as $key => $rowsdata):?>

                        <div class="row w-bloc-section">
                            <div class="panel panel-thumbnail">

                                <div class="panel-heading">

                                    <div class="panel-title"><?=$rowsdata['category'][0]['name']?></div>

                                    <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-restaurant"
                                       aria-controls="nav-restaurant">
                                        <i class="fa fa-bars"></i>
                                    </a>

                                    <div class="panel-heading-sub">

                                        <div class="dropdown pull-left">


                                            <select class="form-control w-select-city" name="city" >
                                                <option value="">По городам</option>
                                                <?foreach($rowsdata['city'] as $key_id => $row_city):?>
                                                    <option value="<?=$key_id?>"><?=$row_city?></option>
                                                <?endforeach?>
                                            </select>

                                        </div>

                                        <a href="#" class="btn" role="button">На карте</a>
                                    </div>

                                    <div class="collapse" id="nav-restaurant">

                                        <ul class="nav nav-pills w-category-bloc" role="tablist">

                                            <li role="presentation" class="active"><a href="/section/<?=$rowsdata['category'][0]['url']?>" data-section="<?=$rowsdata['category'][0]['url']?>" class="w-home-cat w-cat-active">Новые</a></li>

                                            <?foreach($rowsdata['category'][0]['childs'] as $row_category):?>
                                                <li role="presentation"><a href="/section/<?=$rowsdata['category'][0]['url'].'/'.$row_category['url']?>" data-cat="<?=$row_category['url']?>" class="w-home-cat"><?=$row_category['name']?></a></li>

                                            <?endforeach?>
                                            <li role="presentation"><a href="/section/<?=$rowsdata['category'][0]['url']?>">ещё...</a></li>

                                        </ul>

                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="row slider">
                                        <?foreach ($rowsdata['data'] as $rows):?>
                                            <div class="col-md-4">
                                                <div class="thumbnail">

                                                    <a href="#" class="pin">
                                                        <i class="fa fa-star"></i>
                                                    </a>

                                                    <a href="/business/<?=$rows['url']?>" class="thumbnail-image">
                                                        <?if (file_exists($_SERVER['DOCUMENT_ROOT'].$rows['home_busines_foto'])):?>
                                                            <img src="/uploads/img_business/thumbs/<?=basename($rows['home_busines_foto'])?>" width="240" height="150" alt="<?=$rows['name']?>">
                                                        <?else:?>

                                                            <img src="/public/uploade/thumbnail.jpg" width="240" height="150" alt="<?=$rows['name']?>">
                                                        <?endif?>
                                                    </a>

                                                    <div class="caption">
                                                        <h3><strong><a href="/business/<?=$rows['url']?>"><?=$rows['name']?></a></strong></h3>

                                                        <p><strong><?=$rows['CityName']?>. <?=$rows['address']?></strong></p>

                                                        <?=Text::limit_chars(strip_tags($rows['info']), 150, null, true)?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endforeach?>

                                    </div>
                                </div>

                                <div class="panel-footer text-center">
                                    <a href="/section/<?=$rowsdata['category'][0]['url']?>" class="btn btn-default  open-all" role="button">Открытьвсе</a>
                                </div>
                            </div>
                        </div>

                        <hr/>

                    <?endforeach?>

                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>
</content>