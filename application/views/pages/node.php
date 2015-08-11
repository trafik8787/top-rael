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

                    <img src="<?=$data['ArticImg']?>" width="800" height="600" class="img-responsive"/>

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
                        <div class="row">
                            <div class="panel panel-thumbnail">

                                <div class="panel-heading">

                                    <div class="panel-title">Обзор бизнесов по определеной тематике</div>

                                </div>

                                <div class="panel-body">
                                    <?foreach ($data['BusArr'] as $rows_busines):?>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="thumbnail">

                                                <a href="#" class="pin">
                                                    <i class="fa fa-star"></i>
                                                </a>

                                                <a href="/business/<?=$rows_busines[0]['BusUrl']?>" class="thumbnail-image">
                                                    <img src="<?=$rows_busines[0]['BusImg']?>" width="240" height="150" alt="">
                                                </a>

                                                <div class="caption">
                                                    <h3><strong><a href="/business/<?=$rows_busines[0]['BusUrl']?>"><?=$rows_busines[0]['BusName']?></a></strong></h3>

                                                    <p><strong>Тель-Авив. <?=$rows_busines[0]['BusAddress']?></strong></p>

                                                    <?=Text::limit_chars(strip_tags($rows_busines[0]['BusInfo']), 100, null, true)?>
                                                </div>
                                            </div>
                                        </div>
                                        <? if (!empty($rows_busines[1])):?>
                                            <div class="col-md-6">
                                                <div class="thumbnail">

                                                    <a href="#" class="pin">
                                                        <i class="fa fa-star"></i>
                                                    </a>

                                                    <a href="/business/<?=$rows_busines[1]['BusUrl']?>" class="thumbnail-image">
                                                        <img src="<?=$rows_busines[1]['BusImg']?>" width="240" height="150" alt="">
                                                    </a>

                                                    <div class="caption">
                                                        <h3><strong><a href="/business/<?=$rows_busines[1]['BusUrl']?>"><?=$rows_busines[1]['BusName']?></a></strong></h3>

                                                        <p><strong>Тель-Авив. <?=$rows_busines[1]['BusAddress']?></strong></p>

                                                        <?=Text::limit_chars(strip_tags($rows_busines[1]['BusInfo']), 100, null, true)?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endif?>
                                    </div>
                                    <?endforeach?>

                                </div>
                            </div>
                        </div>
                    <?endif?>
                    <p><i><strong><?=$data['ArticBigPreviev']?></strong></i></p>




                    <div>
                        <hr/>

                        <div class="recomendation">
                            <strong>Рекомендуйте нас друзьям</strong>

                            <div class="recomendation-icons">

                                <a href="#" class="social vk">
                                    <i class="fa fa-vk"></i>
                                </a>

                                <a href="#" class="social facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#" class="social twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="#" class="social email">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </div>
                            <a href="#" class="btn btn-link">
                                <i class="fa fa-star"></i>
                                Добавить в Избранные места
                            </a>
                        </div>


                        <hr/>
                    </div>

                    <?if (!empty($data['CoupArr'])):?>
                        <div class="row">
                            <div class="panel panel-coupons-thumbnail">

                                <div class="panel-heading">
                                    <div class="panel-title">Обзор новых купонов по определеной тематике</div>
                                </div>

                                <div class="panel-body">

                                    <?foreach ($data['CoupArr'] as $rows_coupons):?>

                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="coupon">
                                                    <div class="coupon-container">

                                                        <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                                                        <div class="coupon-image">
                                                            <div class="overlay">
                                                               <?=$rows_coupons[0]['CoupSecondname']?>
                                                            </div>

                                                            <img src="<?=$rows_coupons[0]['CoupImg']?>" width="155" height="125" alt=""
                                                                 title=""/>
                                                        </div>

                                                        <div class="coupon-context">

                                                            <div>
                                                                <span>СКИДКА</span>
                                                                <span><strong>20%</strong></span>
                                                                <span><small>На все пищевые добавки</small></span>
                                                            </div>

                                                            <small class="coupon-date">до 1 Апр 2015</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?if (!empty($rows_coupons[1])):?>
                                                <div class="col-md-6">

                                                    <div class="coupon">
                                                        <div class="coupon-container">

                                                            <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                                                            <div class="coupon-image">
                                                                <div class="overlay">
                                                                    <?=$rows_coupons[1]['CoupSecondname']?>
                                                                </div>

                                                                <img src="<?=$rows_coupons[1]['CoupImg']?>" width="155" height="125" alt=""
                                                                     title=""/>
                                                            </div>

                                                            <div class="coupon-context">

                                                                <div class="fz large"><strong>Десерт в Подарок</strong></div>
                                                                <small>На все пищевые добавки</small>

                                                                <small class="coupon-date">до 1 Апр 2015</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?endif?>
                                        </div>

                                    <?endforeach?>
                                </div>
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

                    <div class="row">
                        <div class="panel panel-media">

                            <div class="panel-heading">

                                <div class="panel-title">Читать еще</div>

                            </div>

                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="/public/uploade/review.jpg" width="260" height="190"
                                                 class="media-object"/>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="media-heading"><a href="#"><strong>Куда пойти
                                                    завтра?</strong></a></h2>

                                        <p class="fz medium"><strong>Пабы, дискотеки и чудесные пляжи</strong>
                                        </p>

                                        Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших
                                        гостей и родных? Хотите вспоминать о ней долгие годы, с радостью и
                                        гордостью показывая вашим детям и внукам фото и видео со свадьбы?
                                        Доверьте организацию свадьбы вашей мечты профессионалам! Вы хотите
                                        сделать вашу свадьбу яркой и запоминающейся? Удивить ваших гостей
                                    </div>
                                </div>

                                <hr/>


                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="/public/uploade/review.jpg" width="260" height="190"
                                                 class="media-object"/>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="media-heading"><a href="#"><strong>Куда пойти
                                                    завтра?</strong></a></h2>

                                        <p class="fz medium"><strong>Пабы, дискотеки и чудесные пляжи</strong>
                                        </p>

                                        Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших
                                        гостей и родных? Хотите вспоминать о ней долгие годы, с радостью и
                                        гордостью показывая вашим детям и внукам фото и видео со свадьбы?
                                        Доверьте организацию свадьбы вашей мечты профессионалам! Вы хотите
                                        сделать вашу свадьбу яркой и запоминающейся? Удивить ваших гостей
                                    </div>
                                </div>

                                <hr/>

                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="/public/uploade/review.jpg" width="260" height="190"
                                                 class="media-object"/>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="media-heading"><a href="#"><strong>Куда пойти
                                                    завтра?</strong></a></h2>

                                        <p class="fz medium"><strong>Пабы, дискотеки и чудесные пляжи</strong>
                                        </p>

                                        Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших
                                        гостей и родных? Хотите вспоминать о ней долгие годы, с радостью и
                                        гордостью показывая вашим детям и внукам фото и видео со свадьбы?
                                        Доверьте организацию свадьбы вашей мечты профессионалам! Вы хотите
                                        сделать вашу свадьбу яркой и запоминающейся? Удивить ваших гостей
                                    </div>
                                </div>

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