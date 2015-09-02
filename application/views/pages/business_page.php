<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 17.07.2015
 * Time: 17:55
 */

//HTML::x($data);
?>

<script>
    $(document).ready(function(){

        $('.tabs__caption').on('click', 'a:not(.active)', function() {
            $(this)
                .addClass('active').siblings().removeClass('active')
                .closest('.tabs').find('.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
            return false;
        });

    });
</script>

<style>
    .tabs__content {
        display: none; /* по умолчанию прячем все блоки */
    }
    .tabs__content.active {
        display: block; /* по умолчанию показываем нужный блок */
    }

    .tabs a.active {
        font-weight: bold;
    }
</style>

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


        </div>

        <div class="page-profile">

            <?if (!empty($data['BusLogo'])):?>
                <div class="page-profile-avarat"><img src="<?=$data['BusLogo']?>" width="88" height="88"/></div>
            <?endif?>
            <div class="page-profile-body">

                <div class="page-profile-content">

                    <div class="page-profile-title"><?=$data['BusName']?></div>

                    <div class="page-profile-link">
                        <?if(!empty($data['BusWebsite'])):?>
                            <a href="<?=$data['BusWebsite']?>"><?=$data['BusWebsite']?></a>
                        <?endif?>
                    </div>

                    <ul class="nav nav-pills">
                        <?foreach ($data['CatArr'] as $row_cat_arr):?>
                            <li><a href="/section/<?=$row_cat_arr['CatUrl']?>"><?=$row_cat_arr['CatName']?></a></li>
                        <?endforeach?>

                        <?if (!empty($data['TagArr'])):?>
                            <?foreach ($data['TagArr'] as $tags):?>
                                <li><a href="/tags/<?=$tags['TagUrl']?>" class="button"><span><?=$tags['TagName']?></span></a></li>
                            <?endforeach?>
                        <?endif?>
                    </ul>

                </div>

                <div class="page-profile-sidebar">

                    <?if (!empty($data['BusDopAddress'])):?>
                        <span class="tabs">
                            <p class="tabs__caption">
                                <a href="#" class="active"><?=$data['BusCity']?></a>

                                <?foreach ($data['BusDopAddress'] as $key => $dop_adress_city):?>
                                    &nbsp; &nbsp; | &nbsp; &nbsp;
                                    <a href="#"><?=$dop_adress_city['name']?></a>

                                <?endforeach?>
                            </p>
                            <span>
                                 <p class="tabs__content active">
                                     Адрес: <?=$data['BusAddress']?><br/>
                                     Тел: <?=$data['BusTel']?><br/>
                                     <?=$data['BusSchedule']?>
                                 </p>
                                <?foreach ($data['BusDopAddress'] as $key => $dop_adress_address):?>

                                     <p class="tabs__content">
                                         Адрес: <?=$dop_adress_address['address']?><br/>
                                         Тел: <?=$dop_adress_address['tel_dop_adress']?><br/>
                                         <?=$dop_adress_address['dop_sheduler']?>
                                     </p>
                                <?endforeach?>
                            </span>

                        </span>
                    <?endif?>

                </div>


            </div>

            <div class="page-profile-footer">
                <div class="page-profile-content">

                    <?if (!empty($data['bussines_favorit']))://если купон добавлен в избранное?>
                        <a href="#" class="pin-aria">
                            <span class="pin" data-toggle="tooltip" data-placement="right" title="Этот бизнес уже добавлен в Избранное" style="background-color: #ccc">
                                <i class="fa fa-star"></i>
                            </span>В избранном
                        </a>
                    <?else:?>
                        <a href="#" class="pin-aria w-add-bussines-favor" data-id="<?=$data['BusId']?>">
                            <span class="pin" data-toggle="tooltip" data-placement="right">
                                <i class="fa fa-star"></i>
                            </span>Добавить в избраные места
                        </a>
                    <?endif?>

                </div>

                <div class="page-profile-sidebar">
                    <a href="#" class="pin-aria">
                        <span class="pin"><i class="fa fa-map-marker"></i></span>Посмотреть на карте
                    </a>
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


                        <div class="panel panel-vertical-gallery">

                            <div class="panel-heading">
                                <div class="panel-title">Фотогалерея</div>

                                <div class="panel-links">
                                    <a href="#">Галлерея "Наши друзья"</a>
                                    &nbsp;|&nbsp;
                                    <a href="#">Галлерея "Блюда"</a>
                                    &nbsp;|&nbsp;
                                    <a href="#">Галлерея "Пейзажи"</a>
                                </div>
                            </div>

                            <div class="panel-body">

                                <div class="bx-gallery">

                                    <div class="bx-image">
                                        <div class="layer">
                                            <img src="/public/uploade/review.jpg" style="width:100%; height: auto;"/>
                                        </div>
                                        <div class="bx-caption">sdfgsd</div>
                                    </div>

                                    <div class="bx-slider">

                                        <span class="btn-prev"><i class="fa fa-angle-up"></i></span>

                                        <div class="layers">


                                            <div class="layer">
                                                <div>
                                                    <a href="javascript:;" data-bx-image="/public/uploade/coupon.jpg" data-bx-caption="test1"><img
                                                            src="/public/uploade/review.jpg"/></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:;" data-bx-image="/public/uploade/review.jpg" data-bx-caption="test2"><img
                                                            src="/public/uploade/review.jpg"/></a>
                                                </div>
                                            </div>

                                            <div class="layer">
                                                <div>
                                                    <a href="javascript:;" data-bx-image="/public/uploade/coupon.jpg" data-bx-caption="test1"><img
                                                            src="/public/uploade/review.jpg"/></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:;" data-bx-image="/public/uploade/review.jpg" data-bx-caption="test2"><img
                                                            src="/public/uploade/review.jpg"/></a>
                                                </div>
                                            </div>

                                            <div class="layer">
                                                <div>
                                                    <a href="javascript:;" data-bx-image="/public/uploade/review.jpg" data-bx-caption="test3"><img
                                                            src="/public/uploade/review.jpg"/></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:;" data-bx-image="/public/uploade/coupon.jpg" data-bx-caption="test4"><img
                                                            src="/public/uploade/review.jpg"/></a>
                                                </div>
                                            </div>

                                            <div class="layer">
                                                <div>
                                                    <a href="javascript:;" data-bx-image="/public/uploade/coupon.jpg" data-bx-caption="test5"><img
                                                            src="/public/uploade/review.jpg"/></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:;" data-bx-image="/public/uploade/review.jpg" data-bx-caption="test6"><img
                                                            src="/public/uploade/review.jpg"/></a>
                                                </div>
                                            </div>

                                            <div class="layer">
                                                <div>
                                                    <a href="javascript:;" data-bx-image="/public/uploade/coupon.jpg" data-bx-caption="test7"><img
                                                            src="/public/uploade/review.jpg"/></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:;" data-bx-image="/public/uploade/review.jpg" data-bx-caption="test8"><img
                                                            src="/public/uploade/review.jpg"/></a>
                                                </div>
                                            </div>

                                        </div>


                                        <span class="btn-next"><i class="fa fa-angle-down"></i></span>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <hr/>

                        <?if (!empty($data['BusVideo'])):?>
                            <div class="panel">

                                <div class="panel-heading">
                                    <div class="panel-title">Убедитесь сами - лучше один раз увидеть</div>
                                </div>

                                <div class="panel-body">

                                    <div class="col-md-12">

                                        <div class="embed-responsive embed-responsive-16by9">
                                            <?=$data['BusVideo']?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?endif?>

                        <hr/>

                        <?if (!empty($data['ArticArr'])):?>
                            <div class="panel panel-list">

                                <div class="panel-heading">
                                    <div class="panel-title">Читать о нас</div>
                                </div>

                                <div class="panel-body">

                                    <div class="list list-media">


                                        <?foreach ($data['ArticArr'] as $rows_artic):?>

                                            <div class="list-item">
                                                <div class="media">

                                                    <div class="media-left">
                                                        <a href="/article/<?=$rows_artic['ArticUrl']?>">
                                                            <img src="/uploads/img_articles/thumbs/<?=basename($rows_artic['ArticImage'])?>" width="260" height="190"
                                                                 class="media-object"/>
                                                        </a>
                                                    </div>

                                                    <div class="media-body">

                                                        <h2 class="media-heading">
                                                            <a href="/article/<?=$rows_artic['ArticUrl']?>"><strong><?=$rows_artic['ArticName']?></strong></a>
                                                            <small><?=$rows_artic['ArticSecondName']?></small>
                                                        </h2>

                                                        <?=Text::limit_chars(strip_tags($rows_artic['ArticContent']), 300, null, true)?>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr/>
                                        <?endforeach?>



                                    </div>

                                </div>
                            </div>
                        <?endif?>
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

        <div class="panel panel-thumbnails">

            <div class="panel-heading">

                <div class="panel-title">Похожие места - которые могут вас заинтересовать</div>

            </div>

            <div class="panel-body">

                <?foreach ($related as $rows_related):?>
                    <div class="col-md-3">

                        <div class="thumbnail">

                            <?if (!empty($rows_related['bussines_favorit']))://если купон добавлен в избранное?>
                                <a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                                    <i class="fa fa-star"></i>
                                </a>
                            <?else:?>
                                <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_related['id']?>" class="pin w-add-bussines-favor">
                                    <i class="fa fa-star"></i>
                                </a>
                            <?endif?>

                            <a href="/business/<?=$rows_related['url']?>" class="thumbnail-image">
                                <img src="<?=$rows_related['home_busines_foto']?>" width="240" height="150" alt="">
                            </a>

                            <div class="thumbnail-content">
                                <h2 class="thumbnail-title">
                                    <a href="/business/<?=$rows_related['url']?>"><?=$rows_related['name']?></a>
                                    <small><?=$rows_related['CityName'].', '.$rows_related['address']?></small>
                                </h2>
                                <?=Text::limit_chars(strip_tags($rows_related['info']), 200, null, true)?>

                            </div>
                        </div>

                    </div>
                <?endforeach?>

            </div>
        </div>

    </div>




</content>

