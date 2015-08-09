<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 03.08.2015
 * Time: 18:05
 */

?>
<style>
    .w-active-cat {
        background-color: aqua;
    }
</style>

<script>
    $(document).ready(function(){



        $(document).on('click', '.w-home-cat', function(){

            var thises = $(this);
            var sliderTmp = thises.closest('.w-bloc-section').find('.slider');
            var selectTmp = thises.closest('.w-bloc-section').find('.w-select-city');
            var remowClas = thises.parents('.w-category-bloc').find('a.active');

            //удаляем клас
            remowClas.removeClass('active');
            //добавляем класс
            thises.addClass('active');


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
                        '<a href="#" class="thumbnail-image"> ' +
                        '<img src="/public/uploade/thumbnail.jpg" width="240" height="150" alt="">' +
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


        $(document).on('change', '.w-select-city', function(){

            var thisSel = $(this);
            var sliderTmp = thisSel.closest('.w-bloc-section').find('.slider');
            var section = thisSel.closest('.w-bloc-section').find('.active').data('section');
            //console.log($(this).val());
            $.ajax({ // описываем наш запрос
                type: "POST", // будем передавать данные через POST
                dataType: "JSON", // указываем, что нам вернется JSON
                url: '/ajaxselect',
                data: 'city='+$(this).val()+'&section='+section+'&cat='+$('.active').data('cat'), // передаем данные из формы
                success: function(response) { // когда получаем ответ
                    //очищаем слайдер
                    sliderTmp.empty();
                    $.each(response.data, function(index, value) {
                        console.log(value);
                        sliderTmp.append('<div class="col-md-4">' +
                        '<div class="thumbnail">' +
                        '<a href="#" class="pin"><i class="fa fa-star"></i></a>' +
                        '<a href="#" class="thumbnail-image"> ' +
                        '<img src="/public/uploade/thumbnail.jpg" width="240" height="150" alt="">' +
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


    });
</script>
<?HTML::x($data)?>

<content>
    <div id="content">

        <div class="top">

            <div class="top-image">
                <img src="/public/uploade/image-large.png" width="600" height="420" class="img-responsive"/>

                <div class="top-image-text">
                    <h2><a href="#">TOP 5 Ресторанов Тель-Авива</a></h2>
                    Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших гостей и родных? Хотите
                    вспоминать о ней долгие годы, с радостью и видео со свадьбы? Доверьте организацию свадьбы вашей
                    мечты профессионалам!
                </div>
            </div>

            <div class="top-list">

                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img src="/public/uploade/list.png" width="120" height="85" class="media-object"/>
                        </a>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading"><a href="#"><strong>Куда пойти завтра?</strong></a></h2>

                        <strong>Лучшие суши в городе</strong>

                        <p>Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших гостей и родных?</p>
                    </div>
                </div>

                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img src="/public/uploade/list.png" width="120" height="85" class="media-object"/>
                        </a>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading"><a href="#"><strong>Куда пойти завтра?</strong></a></h2>

                        <strong>События стоящие вашего внимания</strong>

                        <p>Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших гостей и родных?</p>
                    </div>
                </div>

                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img src="/public/uploade/list.png" width="120" height="85" class="media-object"/>
                        </a>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading"><a href="#"><strong>Куда пойти завтра?</strong></a></h2>

                        <strong>Любите пиво? Футбол или хоршую музыку? Бары на любой вкус.</strong>

                        <p>Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших гостей и родных?</p>
                    </div>
                </div>

                <div class="text-center">
                    <a href="#" class="btn btn-default open-all" role="button">Открыть все</a>
                </div>
            </div>
        </div>

        <div class="panel panel-coupons-carousel">
            <div class="panel-heading">

                <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-coupons-panel"
                   aria-controls="nav-coupons-panel">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="panel-title">Купоны</div>

                <div class="collapse" id="nav-coupons-panel">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#">Все рестораны</a></li>
                        <li><a href="#">Европейские</a></li>
                        <li><a href="#">Итальянские</a></li>
                        <li><a href="#">Рыбные</a></li>
                        <li><a href="#">Китайские</a></li>
                        <li><a href="#">ещё...</a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <div class="owl-carousel">
                    <div class="coupon">
                        <div class="coupon-container">

                            <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                            <div class="coupon-image">
                                <div class="overlay">
                                    Каббалистические украшения Haari
                                </div>

                                <img src="/public/uploade/coupon.jpg" width="155" height="125" alt="" title=""/>
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
                    <div class="coupon">
                        <div class="coupon-container">

                            <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                            <div class="coupon-image">
                                <div class="overlay">
                                    Каббалистические украшения Haari
                                </div>

                                <img src="/public/uploade/coupon.jpg" width="155" height="125" alt="" title=""/>
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
                    <div class="coupon">
                        <div class="coupon-container">

                            <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                            <div class="coupon-image">
                                <div class="overlay">
                                    Каббалистические украшения Haari
                                </div>

                                <img src="/public/uploade/coupon.jpg" width="155" height="125" alt="" title=""/>
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
                    <div class="coupon">
                        <div class="coupon-container">

                            <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                            <div class="coupon-image">
                                <div class="overlay">
                                    Каббалистические украшения Haari
                                </div>

                                <img src="/public/uploade/coupon.jpg" width="155" height="125" alt="" title=""/>
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
                    <div class="coupon">
                        <div class="coupon-container">

                            <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                            <div class="coupon-image">
                                <div class="overlay">
                                    Каббалистические украшения Haari
                                </div>

                                <img src="/public/uploade/coupon.jpg" width="155" height="125" alt="" title=""/>
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

                                            <li role="presentation"><a href="/section/<?=$rowsdata['category'][0]['url']?>" data-section="<?=$rowsdata['category'][0]['url']?>" class="w-home-cat active">Новые</a></li>

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

                                                    <a href="#" class="thumbnail-image">
                                                        <img src="/public/uploade/thumbnail.jpg" width="240" height="150" alt="">
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

            <!-- Side Bar -->
            <div class="col-md-4">
                <div id="sidebar">

                    <div class="lottery">
                        <div class="lottery-title">Еженедельная лотерея</div>

                        <div class="lottery-section">
                            <div class="lottery-section-title">Приз</div>

                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img src="/public/uploade/prize.jpg" width="88" height="88" class="media-object"/>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">Купон на 500ш в ресторан «Круглый стол».</div>
                                    <p>до розыгрыша осталось 5 дней </p>
                                </div>
                            </div>
                        </div>

                        <div class="lottery-section">
                            <div class="lottery-section-title">Участвовать</div>

                            <p>Подпишись на нашу почтовую рассылку и станьте участником еженедельной лотереи</p>

                            <form>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="">

                                            <span class="cr">
                                                <i class="cr-icon glyphicon glyphicon-ok"></i>
                                            </span>
                                        Принимаю <a href="">правила</a> участия в лотереи
                                    </label>
                                </div>

                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Ваш email:">

                                    <div class="input-group-addon">
                                        <button type="submit" class="btn btn-danger">Отправить</button>
                                    </div>
                                </div>

                            </form>

                        </div>

                        <div class="lottery-section">
                            <div class="lottery-section-title">Победители</div>

                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#" class="img-circle">
                                        <img src="/public/uploade/avata-lottery.jpg" width="43" height="43"
                                             class="media-object"/>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <strong>Александр Жуков</strong><br/>
                                    11.6.15 - 500ш в ресторан<br/>
                                    <a href="#">"Круглый стол"</a>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#" class="img-circle">
                                        <img src="/public/uploade/avata-lottery.jpg" width="43" height="43"
                                             class="media-object"/>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <strong>Александр Жуков</strong><br/>
                                    11.6.15 - 500ш в ресторан<br/>
                                    <a href="#">"Круглый стол"</a>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#" class="img-circle">
                                        <img src="/public/uploade/avata-lottery.jpg" width="43" height="43"
                                             class="media-object"/>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <strong>Александр Жуков</strong><br/>
                                    11.6.15 - 500ш в ресторан<br/>
                                    <a href="#">"Круглый стол"</a>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#" class="img-circle">
                                        <img src="/public/uploade/avata-lottery.jpg" width="43" height="43"
                                             class="media-object"/>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <strong>Александр Жуков</strong><br/>
                                    11.6.15 - 500ш в ресторан<br/>
                                    <a href="#">"Круглый стол"</a>
                                </div>
                            </div>
                        </div>

                        <a href="#">Архив лотереи</a>
                    </div>

                    <div class="tabs-social">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">

                            <li role="presentation" class="active nav-facebook">
                                <a href="#tab-facebook" aria-controls="tab-facebook" role="tab" data-toggle="tab">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>

                            <li role="presentation" class="nav-twitter">
                                <a href="#tab-twitter" aria-controls="tab-twitter" role="tab" data-toggle="tab">
                                    <i class="fa fa-twitter"></i></a>
                            </li>
                            <li role="presentation" class="nav-vk">
                                <a href="#tab-vk" aria-controls="tab-vk" role="tab" data-toggle="tab">
                                    <i class="fa fa-vk"></i>
                                </a>
                            </li>
                            <li role="presentation" class="nav-odnoklassniki">
                                <a href="#tab-odnoklassniki" aria-controls="tab-odnoklassniki" role="tab"
                                   data-toggle="tab">
                                    <i class="fa fa-odnoklassniki"></i>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab-facebook">
                                <div class="fb-page" data-href="https://www.facebook.com/facebook"
                                     data-small-header="true" data-adapt-container-width="true"
                                     data-hide-cover="true" data-show-facepile="true" data-show-posts="false"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab-twitter">Twitter</div>
                            <div role="tabpanel" class="tab-pane" id="tab-vk">Vk</div>
                            <div role="tabpanel" class="tab-pane" id="tab-odnoklassniki">Однокласники</div>
                        </div>
                    </div>

                    <div class="discount">
                        <div class="owl-carousel">
                            <a href="#"><img src="/public/uploade/discount.jpg" width="360" height="300" alt=""
                                             class="img-responsive"></a>
                            <a href="#"><img src="/public/uploade/discount.jpg" width="360" height="300" alt=""
                                             class="img-responsive"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</content>