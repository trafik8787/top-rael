<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.07.2015
 * Time: 21:46
 */
//HTML::x($data);
?>


<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">

                <div id="context" class="full-text">

                    <img src="<?=$data['ArticImg']?>" width="800" height="600" class="img-responsive" alt="<?=$data['ArticName']?>"/>

                    <h1><?=$data['ArticName']?></h1>

                    <p><i><strong><?=$data['ArticSecondname']?></strong></i></p>

                    <br/>
                    <?if (!empty($data['ArticShortPreviev'])):?>
                        <div class="short-description">
                            <i class="fa fa-quote-left"></i>

                            <div class="short-description-body">
                                <br/>
                                <i><?=$data['ArticShortPreviev']?></i>
                            </div>
                        </div>
                    <?endif?>
                    <br/>

                    <p><?=$data['ArticContent']?></p>

                    <?if (!empty($data['BusArr'])):?>
                        <hr/>


                        <div class="panel panel-thumbnails">

                            <div class="panel-heading">

                                <div class="panel-title">Обзор бизнесов по определеной тематике</div>

                            </div>

                            <div class="panel-body">

                                <?foreach ($data['BusArr'] as $rows_busines):?>

                                    <div class="col-md-6">
                                        <div class="thumbnail">

                                            <?if (!empty($rows_busines['bussines_favorit']))://если купон добавлен в избранное?>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                                                    <i class="fa fa-star"></i>
                                                </a>
                                            <?else:?>
                                                <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_busines['BusId']?>" class="pin w-add-bussines-favor">
                                                    <i class="fa fa-star"></i>
                                                </a>
                                            <?endif?>

                                            <a href="/business/<?=$rows_busines['BusUrl']?>" class="thumbnail-image">
                                                <img src="<?=$rows_busines['BusImg']?>" width="240" height="150" alt="">
                                            </a>

                                            <div class="thumbnail-content">
                                                <h2 class="thumbnail-title">
                                                    <a href="/business/<?=$rows_busines['BusUrl']?>"><?=$rows_busines['BusName']?></a>
                                                    <small>Тель-Авив(not). <?=$rows_busines['BusAddress']?></small>
                                                </h2>

                                                <?=Text::limit_chars(strip_tags($rows_busines['BusInfo']), 100, null, true)?>

                                            </div>
                                        </div>
                                    </div>
                                <?endforeach?>

                            </div>
                        </div>

                    <?endif?>

                    <p><i><strong><?=$data['ArticBigPreviev']?></strong></i></p>





                    <hr/>

                    <div class="recomendation">
                        <strong>Рекомендуйте нас друзьям</strong>
                        <br/>

                        <script type="text/javascript">(function() {
                                if (window.pluso)if (typeof window.pluso.start == "function") return;
                                if (window.ifpluso==undefined) { window.ifpluso = 1;
                                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                                    var h=d[g]('body')[0];
                                    h.appendChild(s);
                                }})();</script>
                        <div class="pluso" data-background="transparent" data-options="big,square,line,horizontal,nocounter,theme=08" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>

<!--                        <div class="recomendation-icons">-->
<!--                            -->
<!---->
<!--                            <a href="#" class="social vk">-->
<!--                                <i class="fa fa-vk"></i>-->
<!--                            </a>-->
<!---->
<!--                            <a href="#" class="social facebook">-->
<!--                                <i class="fa fa-facebook"></i>-->
<!--                            </a>-->
<!---->
<!--                            <a href="#" class="social twitter">-->
<!--                                <i class="fa fa-twitter"></i>-->
<!--                            </a>-->
<!---->
<!--                            <a href="#" class="social email">-->
<!--                                <i class="fa fa-envelope"></i>-->
<!--                            </a>-->
<!--                        </div>-->
                        <?if (!empty($data['articles_favorit'])):?>
                            <a href="#" class="btn btn-link" style="color: #003c4c;">
                                <i class="fa fa-star"></i>
                                В избранном
                            </a>
                        <?else:?>
                            <a href="#" data-id="<?=$data['ArticId']?>"  class="btn btn-link w-add-article-favor">
                                <i class="fa fa-star"></i>
                                Добавить в Избранные места
                            </a>
                        <?endif?>
                    </div>


                    <hr/>




                    <?if (!empty($data['CoupArr'])):?>


                        <div class="panel panel-poupons">

                            <div class="panel-heading">
                                <div class="panel-title">Обзор новых купонов по определеной тематике</div>
                            </div>

                            <div class="panel-body">

                                <?foreach ($data['CoupArr'] as $rows_coupons):?>
                                    <div class="col-md-6">
                                        <div class="coupon coupon-big">

                                            <?if (!empty($rows_coupons['coupon_favorit']))://если купон добавлен в избранное?>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                                                    <i class="fa fa-thumb-tack"></i>
                                                </a>
                                            <?else:?>
                                                <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_coupons['CoupId']?>" class="pin w-add-coupon-favor">
                                                    <i class="fa fa-thumb-tack"></i>
                                                </a>
                                            <?endif?>

                                            <div class="coupon-body">

                                                <div class="coupon-content">

                                                    <div class="coupon-content-heading">
                                                        <?=$rows_coupons['CoupSecondname']?>
                                                    </div>

                                                    <a href="/modalcoupon/<?=$rows_coupons['CoupId']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm">
                                                        <img src="<?=$rows_coupons['CoupImg']?>" width="155" height="125" alt="" title="" class="coupon-image"/></a>

                                                </div>

                                                <div class="coupon-sidebar">
                                                    <div class="coupon-sidebar-content">
                                                        <div class="coupon-sidebar-heading">
                                                            <div class="coupon-object-top">

                                                                <div class="coupon-title">
                                                                    Купон
                                                                    <small class="block">Массаж</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="coupon-sidebar-body">
                                                            <div class="coupon-object-middle">

                                                                <div class="coupon-title">
                                                                    20%
                                                                    <span class="block">скидка</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="coupon-sidebar-footer">

                                                            <div class="coupon-object-bottom">

                                                                <small class="coupon-date">до 1 апреля 2015</small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?endforeach?>

                            </div>

                        </div>



                    <?endif?>


                    <p><i><strong>Тут будет краткая выдержка основных смысловых блоков для привлечения внимания
                                посетителей!</strong></i></p>

                    <p>Для этого он специально приехал в Израиль и провел не один день в гастрономической
                        лаборатории ресторана (в просторечье именуемой "кухня") отбирая для нас самые лучшие блюда
                        итальянской кухни. Особо интересны кулинарные сочетания, придуманные маэстро Камбони,
                        совмещающие старинные тосканийские рецепты и местные израильские ингредиенты. В меню столько
                        классных блюд, что самое правильное будет заказать сразу несколько, расположить их в центре
                        стола и пробовать понемножку отовсюду. Ну а если вам просто захочется полюбоваться волшебным
                        закатом, в Lucca есть просторный </p>

                    <hr/>


                    <div class="panel panel-list">

                        <div class="panel-heading">
                            <div class="panel-title">Читать еще</div>
                        </div>

                        <div class="panel-body">

                            <div class="list list-media">
                                <?foreach ($other_articles as $rows_other_art):?>
                                    <div class="list-item">
                                        <div class="media">

                                            <div class="media-left">
                                                <a href="/article/<?=$rows_other_art['url']?>">
                                                    <img src="/uploads/img_articles/thumbs/<?=basename($rows_other_art['images_article'])?>" width="260" height="190"
                                                         class="media-object" alt="<?=$rows_other_art['name']?>"/>
                                                </a>
                                            </div>

                                            <div class="media-body">

                                                <h2 class="media-heading">
                                                    <a href="/article/<?=$rows_other_art['url']?>"><strong><?=$rows_other_art['name']?></strong></a>
                                                    <small><?=$rows_other_art['secondname']?></small>
                                                </h2>

                                                <?=Text::limit_chars(strip_tags($rows_other_art['content']), 300, null, true)?>
                                            </div>
                                        </div>
                                    </div>

                                    <hr/>
                                <?endforeach?>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>
</content>