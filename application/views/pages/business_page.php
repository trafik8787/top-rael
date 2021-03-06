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
        var gallery = verticalGallery();

        console.log($(window).width());



        function verticalGallery() {
            var gallery = [];
            $('.bx-gallery').each(function (i) {

                var minSlides = 4;

                if ($(window).width() < 768) {
                    minSlides = 2;
                }

                var bxImageBlock = $('.bx-image', this);
                var bxImage = $('.layer img', bxImageBlock);
                var bxCaption = $('.bx-caption', bxImageBlock);

                gallery[i] = $('.bx-slider .layers', this).bxSlider({
                    mode: 'vertical',
                    responsive: true,
                    minSlides: minSlides,
                    pager: false,
                    controls: false,
                    slideMargin: 20
                });

                $('[data-bx-image]', this).off('click').on('click', function () {

                    var $image = $(this).data('bx-image');

                    bxCaption.text($(this).data('bx-caption'));

                    if (!$image)
                        return;

                    var zIndex = 1000;

                    var image = $('<img>');
                    image.attr({src: $image});

                    bxImage.replaceWith(image);

                    bxImage = image;
                });

                if (gallery[i].getSlideCount() <= minSlides) {
                    $([
                        $('.btn-prev', this).get(0),
                        $('.btn-next', this).get(0)
                    ]).addClass('disabled');
                }

                $('.btn-prev', this).off('click').on('click', function () {
                    gallery[i].goToPrevSlide();
                });
                $('.btn-next', this).off('click').on('click', function () {
                    gallery[i].goToNextSlide();
                });

            });

            return gallery;
        }

        var hrefmap = $('.w-baselink-maps').val();

        $('.tabs__caption').on('click', 'span:not(.active)', function() {

            $('.w-link-maps').attr('href', hrefmap+'&mapx='+$(this).data('item'));

            $(this)
                .addClass('active').siblings().removeClass('active')
                .closest('.tabs').find('.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
            return false;
        });



        $('.tabs__caption_galery').on('click', 'span:not(.active)', function() {

            $(this).addClass('active').siblings().removeClass('active')
                .closest('.tabs_galery').find('.tabs__content_galery')
                .removeClass('active').eq($(this).index()).addClass('active');

            for(var i=0; i<gallery.length; i++) {
                gallery[i].reloadSlider();
            }

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
        color: #000000;
        text-decoration: none;
    }



    .tabs__content_galery {
        display: none; /* по умолчанию прячем все блоки */
    }
    .tabs__content_galery.active {
        display: block; /* по умолчанию показываем нужный блок */
    }

    .tabs_galery span, .tabs__caption  span{
        cursor: pointer;
        color: #007898;
    }
    .tabs_galery span.active, .tabs__caption  span.active{
        font-weight: bold;
        color: #000000;
        text-decoration: none;
        cursor: default;
    }

</style>

<content>

    <div id="content">

        <?if (!empty($data['TopsArr'])):?>
            <div class="primary-gallery">
                <div class="owl-carousel">
                    <?foreach($data['TopsArr'] as $rows):?>
                        <a href="#"><img src="<?=$rows['TopsliderImg']?>" width="1200" height="400" alt="<?=$data['BusName']?>" class="img-responsive"></a>
                    <?endforeach?>
                </div>
            </div>
        <?endif?>

        <div class="page-profile">

            <?if (!empty($data['BusLogo'])):?>
                <div class="profile-media">
                    <div class="profile-avatar"><img src="<?=$data['BusLogo']?>" width="235" height="" alt="<?=$data['BusName']?>"/></div>
                </div>

            <?endif?>
            <div class="profile-title visible-xs"><?=$data['BusName']?></div>
            <div class="profile-body">

                <div class="profile-content">

                    <div class="profile-context">

                        <div class="profile-title hidden-xs"><?=$data['BusName']?></div>

                        <div class="profile-link">
                            <?if(!empty($data['BusWebsite'])):?>
                                <?$web_url = URL::parse_link($data['BusWebsite'])?>
                                <a target="_blank" href="<?=$web_url['link']?>"><?=$web_url['text']?></a>
                            <?endif?>
                        </div>

                        <ul class="nav nav-pills profile-tags">
                            <?foreach ($data['CatArr'] as $row_cat_arr):?>
                                <li><a href="/section/<?=$row_cat_arr['CatUrl']?>"><?=$row_cat_arr['CatName']?></a></li>
                            <?endforeach?>

                            <?if (!empty($data['TagArr'])):?>
                                <?foreach ($data['TagArr'] as $tags):?>
                                    <li><a href="/tags/<?=$tags['TagUrl']?>" class="tag-business"><span><?=$tags['TagName']?></span></a></li>
                                <?endforeach?>
                            <?endif?>
                        </ul>
                    </div>


                    <div class="profile-sidebar">

                        <span class="tabs">
                            <p class="tabs__caption">
                                <span href="#" data-item="<?=$data['BusMapsX']?>" class="active"><?=$data['BusCity']?></span>
                                <?if (!empty($data['BusDopAddress'])):?>
                                    <?foreach ($data['BusDopAddress'] as $key => $dop_adress_city):?>
                                        <?if ($dop_adress_city['name'] != ''):?>
                                            &nbsp; &nbsp; | &nbsp; &nbsp;
                                            <span href="#" data-item="<?=$dop_adress_city['maps_x']?>"><?=$dop_adress_city['name']?></span>
                                        <?endif?>
                                    <?endforeach?>
                                <?endif?>
                            </p>
                            <span>
                                 <p class="tabs__content active">
                                     Адрес: <?=$data['BusAddress']?><br/>
                                     <?if ($data['BusTel'] != ''):?>
                                        Тел: <?=$data['BusTel']?><br/>
                                     <?endif?>
                                     <?=$data['BusSchedule']?>
                                 </p>
                                <?if (!empty($data['BusDopAddress'])):?>
                                    <?foreach ($data['BusDopAddress'] as $key => $dop_adress_address):?>

                                         <span class="tabs__content">
                                             Адрес: <?=isset($dop_adress_address['address']) ? $dop_adress_address['address'] : ''?><br/>
                                             Тел: <?=isset($dop_adress_address['tel_dop_adress']) ? $dop_adress_address['tel_dop_adress'] : ''?><br/>
                                             <?=isset($dop_adress_address['dop_sheduler']) ? $dop_adress_address['dop_sheduler'] : ''?>
                                         </span>
                                    <?endforeach?>
                                <?endif?>
                            </span>

                        </span>
                    </div>

                </div>


                <div class="profile-footer">

                    <div class="profile-context">

                        <?if (!empty($data['bussines_favorit']))://если купон добавлен в избранное?>
                            <a href="#" class="pin-aria">
                            <span class="pin" data-toggle="tooltip" data-placement="right" title="Добавлено в ваш Личный кабинет">
                                <i class="fa fa-star" style="color: #E44F44"></i>
                            </span><span class="w-text-bus-page">В избранном</span>
                            </a>
                        <?else:?>
                            <a href="#" class="pin-aria w-add-bussines-page-favor" data-id="<?=$data['BusId']?>">
                            <span class="pin" data-toggle="tooltip" data-placement="right">
                                <i class="fa fa-star"></i>
                            </span><span class="w-text-bus-page">Добавить в избраные места</span>
                            </a>
                        <?endif?>
                    </div>

                    <div class="profile-sidebar">
                        <input type="hidden" value="/maps?id=<?=$data['BusId']?>" class="w-baselink-maps">
                        <a href="/maps?id=<?=$data['BusId']?>&mapx=<?=$data['BusMapsX']?>" class="pin-aria w-link-maps">
                            <span class="pin"><i class="fa fa-map-marker"></i></span>Посмотреть на карте
                        </a>
                    </div>
                </div>

            </div>


        </div>

        <div class="row">

            <!-- Context -->
            <div class="col-md-8 slidebar-next">
                <div id="context" class="full-text border clearfix">
                    <div class="col-md-12 description-content">

                        <?=$data['BusInfo']?>

                        <hr/>

                        <?if (!empty($data['GalryArr'])):?>
                            <div class="panel panel-vertical-gallery">
                                <div class="tabs_galery">
                                    <div class="panel-heading">
                                        <div class="panel-title">Фотогалерея</div>

                                        <div class="panel-links">
                                            <span class="tabs__caption_galery">
                                                <?foreach ($data['GalryArr'] as $key => $rows_galery_name):?>
                                                    <span title="<?=!empty($data['GalryDesk']) ? $data['GalryDesk'] : ''?>" <?if ($key == 0){?>class="active"<?}?>><?=$rows_galery_name['GalryName']?></span>
                                                    <?if (next($data['GalryArr'])):?>
                                                    &nbsp;|&nbsp;
                                                    <?endif?>
                                                <?endforeach?>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="panel-body">


                                        <?foreach ($data['GalryArr'] as $key => $galery_arr):?>
                                            <div class="tabs__content_galery <?if ($key == 0){?>active<?}?>">

                                                <div class="bx-gallery">
                                                    <? $shift_image = $galery_arr['FileArr'][0];?>
                                                    <div class="bx-image">
                                                        <div class="layer">
                                                            <img src="<?=$shift_image['FileFilename']?>"/>
                                                        </div>
                                                        <div class="bx-caption"><?=$shift_image['FileTitle']?></div>
                                                    </div>

                                                    <div class="bx-slider">

                                                        <span class="btn-prev"><i class="fa fa-angle-up"></i></span>

                                                        <div class="layers">
                                                            <?
                                                            $galery_arr['FileArr'] = Controller_BaseController::convertArrayVievData($galery_arr['FileArr']);

                                                            ?>
                                                            <?foreach ($galery_arr['FileArr'] as $galery_file):?>
                                                                <div class="layer">
                                                                    <div>
                                                                        <a href="javascript:;" data-bx-image="<?=$galery_file[0]['FileFilename']?>" data-bx-caption="<?=$galery_file[0]['FileTitle']?>"><img
                                                                                src="/uploads/img_galery/thumbs/<?=basename($galery_file[0]['FileFilename'])?>" width="auto" hidden="auto"/></a>
                                                                    </div>
                                                                    <?if (!empty($galery_file[1])):?>
                                                                        <div>
                                                                            <a href="javascript:;" data-bx-image="<?=$galery_file[1]['FileFilename']?>"  data-bx-caption="<?=$galery_file[1]['FileTitle']?>"><img
                                                                                    src="/uploads/img_galery/thumbs/<?=basename($galery_file[1]['FileFilename'])?>" width="auto" hidden="auto"/></a>
                                                                        </div>
                                                                    <?endif?>
                                                                </div>


                                                            <?endforeach?>


                                                        </div>


                                                        <span class="btn-next"><i class="fa fa-angle-down"></i></span>
                                                    </div>

                                                </div>
                                            </div>
                                        <?endforeach?>


                                    </div>

                                </div>
                            </div>
                            <hr/>
                        <?endif?>



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

                            <hr/>
                        <?endif?>

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

                                                    <? if (!empty($rows_artic['ArticImage'])): ?>

                                                        <div class="media-left">

                                                            <?
                                                            if (!empty($rows_artic['news'])){
                                                                $img_src = $rows_artic['ArticImage'];
                                                            } else {
                                                                $img_src = '/uploads/img_articles/thumbs/'.basename($rows_artic['ArticImage']);
                                                            }

                                                            ?>

                                                            <? if (!empty($rows_artic['ArticUrl'])): ?>
                                                                <a href="/article/<?=$rows_artic['ArticUrl']?>">
                                                                    <img src="<?=$img_src?>" width="260" height="190"
                                                                         class="media-object"/>
                                                                </a>
                                                            <?else:?>
                                                                <img src="<?=$img_src?>" width="260" height="190"
                                                                     class="media-object"/>
                                                            <?endif?>
                                                        </div>
                                                    <? endif ?>

                                                    <div class="media-body">

                                                        <h2 class="media-heading">
                                                            <? if (!empty($rows_artic['ArticUrl'])): ?>
                                                                <a href="/article/<?=$rows_artic['ArticUrl']?>"><strong><?=$rows_artic['ArticName']?></strong></a>
                                                            <?else:?>
                                                                <strong><?=$rows_artic['ArticName']?></strong>
                                                            <?endif?>
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

                        <?=Controller_BaseController::getViewsSharedButtonsCoupon()?>


                    </div>
                    <?if (!empty($data['bussines_favorit']))://если купон добавлен в избранное?>
                        <a href="#" class="btn btn-link">
                            <i class="fa fa-star"></i>
                            <span class="w-text-bus-page">В избранном</span>
                        </a>
                    <?else:?>
                        <a href="#" class="btn btn-link w-add-bussines-page-favor" data-id="<?=$data['BusId']?>">
                            <i class="fa fa-star"></i>
                            <span class="w-text-bus-page">Добавить в Избранные места</span>
                        </a>
                    <?endif?>

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
                    <div class="col-md-3 col-sm-6">

                        <div class="thumbnail">

                            <?if (!empty($rows_related['bussines_favorit']))://если купон добавлен в избранное?>
                                <a href="#" data-toggle="tooltip" data-placement="left" title="Добавлено в ваш Личный кабинет" class="pin">
                                    <i class="fa fa-star" style="color: #E44F44"></i>
                                </a>
                            <?else:?>
                                <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_related['id']?>" title="Добавить в Личный кабинет" class="pin w-add-bussines-favor">
                                    <i class="fa fa-star"></i>
                                </a>
                            <?endif?>

                            <a href="/business/<?=$rows_related['url']?>" class="thumbnail-image">
                                <img src="<?=$rows_related['home_busines_foto']?>" width="240" height="150" alt="<?=$rows_related['name']?>">
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

