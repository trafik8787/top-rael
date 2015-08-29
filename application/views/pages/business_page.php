<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 17.07.2015
 * Time: 17:55
 */

HTML::x($data);
?>

<content>
    <div id="content">

        <?if (!empty($data['TopsArr'])):?>
            <div class="primary-gallery">
                <div class="owl-carousel">
                    <?foreach($data['TopsArr'] as $rows):?>
                        <a href="#"><img src="<?=$rows['TopsliderImg']?>" width="1200" height="400" alt="" class="img-responsive"></a>
                    <?endforeach?>
                </div>
            </div>
        <?endif?>

        <div class="page-profile">

            <div class="page-profile-avarat"><img src="/public/uploade/prize.jpg" width="88" height="88"/></div>

            <div class="page-profile-body">

                <div class="page-profile-context">

                    <div class="page-profile-title"><?=$data['BusName']?></div>
                    <?if(!empty($data['BusWebsite'])):?>
                        <a href="<?=$data['BusWebsite']?>"><?=$data['BusWebsite']?></a>
                    <?endif?>
                    <ul class="nav nav-pills">
                        <?foreach ($data['CatArr'] as $row_cat_arr):?>
                            <li><a href="/section/<?=$row_cat_arr['CatUrl']?>"><?=$row_cat_arr['CatName']?></a></li>
                        <?endforeach?>
                        <li><a href="#" class="button"><span>LUXURY</span></a></li>
                    </ul>

                    <a href="#"><span class="pin"><i class="fa fa-star"></i></span>Добавить в избраные места</a>

                </div>

                <div class="page-profile-contacts">

                    <p>
                        Герцлия
                        &nbsp; &nbsp; | &nbsp; &nbsp;
                        <a href="#">Хайфа</a>
                        &nbsp; &nbsp; | &nbsp; &nbsp;
                        <a href="#">Ашдод</a>
                    </p>

                    <p>
                        Адрес: Ha-Shunit St 2<br/>
                        Тел: 09-9514000<br/>
                        Открыты ежедневно с 12:00-24:00
                    </p>


                    <a href="#"><span class="pin"><i class="fa fa-map-marker"></i></span>Посмотреть на карте</a>


                </div>

            </div>
        </div>

        <div class="row">

            <!-- Context -->
            <div class="col-md-8">
                <div id="context" class="full-text border clearfix">
                    <div class="col-md-12">

                       <?=$data['BusInfo']?>

                        <hr/>

                        <!-- Photo Gallery -->
                        <?if (!empty($data['BusVideo'])):?>
                            <div class="row">
                                <div class="panel">

                                    <div class="panel-heading">
                                        <div class="panel-title">Убедитесь сами - лучше один раз увидеть</div>
                                    </div>

                                    <div class="panel-body">


                                        <div class="embed-responsive embed-responsive-16by9">
                                           <?=$data['BusVideo']?>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <hr/>
                        <?endif?>

                        <div class="row">
                            <div class="panel panel-media">

                                <div class="panel-heading">
                                    <div class="panel-title">Читать о нас</div>
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

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <br/>

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
            </div>

            <!-- Side Bar -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

        <hr/>

        <div class="row">
            <div class="panel panel-thumbnail">

                <div class="panel-heading">
                    <div class="panel-title">Похожие места - которые могут вас заинтересовать</div>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="thumbnail">

                                <a href="#" class="pin">
                                    <i class="fa fa-star"></i>
                                </a>

                                <a href="#" class="thumbnail-image">
                                    <img src="/public/uploade/thumbnail.jpg" width="240" height="150" alt="">
                                </a>

                                <div class="caption">
                                    <h3><strong><a href="#">Магазин "Алмаз"</a></strong></h3>

                                    <p><strong>Тель-Авив. Арлозоров 5</strong></p>

                                    Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших
                                    гостей и родных? Хотите вспоминать о ней долгие годы, с радостью и
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="thumbnail">

                                <a href="#" class="pin">
                                    <i class="fa fa-star"></i>
                                </a>

                                <a href="#" class="thumbnail-image">
                                    <img src="/public/uploade/thumbnail2.jpg" width="240" height="150" alt="">
                                </a>

                                <div class="caption">
                                    <h3><strong><a href="#">Ресторан "Круглый стол"</a></strong></h3>

                                    <p><strong>Тель-Авив. Арлозоров 5</strong></p>

                                    Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших
                                    гостей и родных? Хотите вспоминать о ней долгие годы, с радостью и
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="thumbnail">

                                <a href="#" class="pin">
                                    <i class="fa fa-star"></i>
                                </a>

                                <a href="#" class="thumbnail-image">
                                    <img src="/public/uploade/thumbnail.jpg" width="240" height="150" alt="">
                                </a>

                                <div class="caption">
                                    <h3><strong><a href="#">Магазин "Алмаз"</a></strong></h3>

                                    <p><strong>Тель-Авив. Арлозоров 5</strong></p>

                                    Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших
                                    гостей и родных? Хотите вспоминать о ней долгие годы, с радостью и
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="thumbnail">

                                <a href="#" class="pin">
                                    <i class="fa fa-star"></i>
                                </a>

                                <a href="#" class="thumbnail-image">
                                    <img src="/public/uploade/thumbnail.jpg" width="240" height="150" alt="">
                                </a>

                                <div class="caption">
                                    <h3><strong><a href="#">Магазин "Алмаз"</a></strong></h3>

                                    <p><strong>Тель-Авив. Арлозоров 5</strong></p>

                                    Вы хотите сделать вашу свадьбу яркой и запоминающейся? Удивить ваших
                                    гостей и родных? Хотите вспоминать о ней долгие годы, с радостью и
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</content>

