<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.07.2015
 * Time: 21:46
 */
//HTML::x($_SERVER);
?>


<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">

                <div id="context" class="full-text description-content">

                    <img src="<?=$data['ArticImg']?>" width="800" height="600" class="img-responsive" alt="<?=$data['ArticName']?>"/>

                    <p style="margin-top: 5px">

                        <?if (!empty($data['articles_favorit'])):?>
                            <a href="#" class="pin-aria">
                            <span class="pin" data-toggle="tooltip" data-placement="right" title="Этот обзор уже добавлен в Избранное">
                                <i class="fa fa-star" style="color: #E44F44"></i>
                            </span><span class="w-text-bus-page">В избранном</span>
                            </a>
                        <?else:?>
                            <a href="#" class="pin-aria w-add-article-favor" data-id="<?=$data['ArticId']?>">
                            <span class="pin" data-toggle="tooltip" data-placement="right">
                                <i class="fa fa-star"></i>
                            </span><span class="w-text-artic-page">Добавить в Избранное</span>
                            </a>
                        <?endif?>


                    </p>

                    <h1><?=$data['ArticName']?></h1>


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

                    <span class="w-node-article">
                        <p><?=$data['ArticContent']?></p>
                    </span>


                    <hr/>

                    <?if (!empty($data['articles_favorit'])):?>
                        <a href="#" class="pin-aria">
                            <span class="pin" data-toggle="tooltip" data-placement="right" title="Этот обзор уже добавлен в Избранное">
                                <i class="fa fa-star" style="color: #E44F44"></i>
                            </span><span class="w-text-bus-page">В избранном</span>
                        </a>
                    <?else:?>
                        <a href="#" class="pin-aria w-add-article-favor" data-id="<?=$data['ArticId']?>">
                            <span class="pin" data-toggle="tooltip" data-placement="right">
                                <i class="fa fa-star"></i>
                            </span><span class="w-text-artic-page">Добавить в Избранное</span>
                        </a>
                    <?endif?>



                    <?if (!empty($data['BusArr'])):?>

                        <hr/>

                        <div class="panel panel-thumbnails">

                            <div class="panel-heading">

                                <div class="panel-title">Полная информация - фото, видео, описание и адреса</div>

                            </div>

                            <div class="panel-body">

                                <?foreach ($data['BusArr'] as $rows_busines):?>
                                    <div class="clearfix">
                                        <div class="col-sm-6">
                                            <div class="thumbnail">

                                                <?if (!empty($rows_busines[0]['bussines_favorit']))://если купон добавлен в избранное?>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Добавлено в ваш Личный кабинет" class="pin">
                                                        <i class="fa fa-star" style="color: #E44F44"></i>
                                                    </a>
                                                <?else:?>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_busines[0]['BusId']?>" title="Добавить в Личный кабинет" class="pin w-add-bussines-favor">
                                                        <i class="fa fa-star"></i>
                                                    </a>
                                                <?endif?>

                                                <a href="/business/<?=$rows_busines[0]['BusUrl']?>" class="thumbnail-image">
                                                    <img src="<?=$rows_busines[0]['BusImg']?>" width="240" height="150" alt="">
                                                </a>

                                                <div class="thumbnail-content">
                                                    <h2 class="thumbnail-title">
                                                        <a href="/business/<?=$rows_busines[0]['BusUrl']?>"><?=$rows_busines[0]['BusName']?></a>
                                                        <small><?=$rows_busines[0]['BusCity']?>. <?=$rows_busines[0]['BusAddress']?></small>
                                                    </h2>

                                                    <?=Text::limit_chars(strip_tags($rows_busines[0]['BusInfo']), 100, null, true)?>

                                                </div>
                                            </div>
                                        </div>
                                        <?if (!empty($rows_busines[1])):?>
                                            <div class="col-sm-6">
                                                <div class="thumbnail">

                                                    <?if (!empty($rows_busines[1]['bussines_favorit']))://если купон добавлен в избранное?>
                                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Добавлено в ваш Личный кабинет" class="pin">
                                                            <i class="fa fa-star" style="color: #E44F44"></i>
                                                        </a>
                                                    <?else:?>
                                                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_busines[1]['BusId']?>" title="Добавить в Личный кабинет" class="pin w-add-bussines-favor">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                    <?endif?>

                                                    <a href="/business/<?=$rows_busines[1]['BusUrl']?>" class="thumbnail-image">
                                                        <img src="<?=$rows_busines[1]['BusImg']?>" width="240" height="150" alt="">
                                                    </a>

                                                    <div class="thumbnail-content">
                                                        <h2 class="thumbnail-title">
                                                            <a href="/business/<?=$rows_busines[1]['BusUrl']?>"><?=$rows_busines[1]['BusName']?></a>
                                                            <small><?=$rows_busines[1]['BusCity']?>. <?=$rows_busines[1]['BusAddress']?></small>
                                                        </h2>

                                                        <?=Text::limit_chars(strip_tags($rows_busines[1]['BusInfo']), 100, null, true)?>

                                                    </div>
                                                </div>
                                            </div>
                                        <?endif?>
                                    </div>
                                <?endforeach?>

                            </div>
                        </div>

                    <?endif?>


                    <?if (!empty($data['CoupArr'])):?>


                        <div class="panel panel-coupons">

                            <div class="panel-heading">
                                <div class="panel-title">Купоны только на TopIsrael.ru</div>
                            </div>

                            <div class="panel-body">

                                <?foreach ($data['CoupArr'] as $rows_coupons):?>

                                    <div class="clearfix">
                                        <div class="col-sm-4">
                                            <div class="coupon coupon-big">

                                                <?if (!empty($rows_coupons[0]['coupon_favorit']))://если купон добавлен в избранное?>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin">
                                                        <i class="fa fa-star" style="color: #E44F44"></i>
                                                    </a>
                                                <?else:?>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_coupons[0]['id']?>" title="Добавить в Личный кабинет" class="pin w-add-coupon-favor">
                                                        <i class="fa fa-star"></i>
                                                    </a>
                                                <?endif?>

                                                <div class="coupon-body">

                                                    <div class="coupon-content">

                                                        <div class="coupon-content-heading">
                                                            <?=$rows_coupons[0]['BusName']?>
                                                        </div>

                                                        <a href="/modalcoupon/<?=$rows_coupons[0]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image">
                                                            <img src="<?=$rows_coupons[0]['img_coupon']?>"  alt="<?=$rows_coupons[0]['BusName']?>" title="Посмотреть полный купон"/></a>

                                                    </div>
                                                    <a href="/modalcoupon/<?=$rows_coupons[0]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image" title="Посмотреть полный купон">
                                                        <div class="coupon-sidebar">
                                                            <div class="coupon-sidebar-content">
                                                                <div class="coupon-sidebar-heading">
                                                                    <div class="coupon-object-top">

                                                                        <div class="coupon-title">
                                                                            <?=$rows_coupons[0]['name']?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="coupon-sidebar-body">
                                                                    <div class="coupon-object-middle">

                                                                        <div class="coupon-title">
                                                                            <?=$rows_coupons[0]['secondname']?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="coupon-sidebar-footer">

                                                                    <div class="coupon-object-bottom">

                                                                        <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_coupons[0]['dateoff']), 'j %MONTH% Y'); ?></small>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?if (!empty($rows_coupons[1])):?>
                                            <div class="col-sm-4">
                                                <div class="coupon coupon-big">

                                                    <?if (!empty($rows_coupons[1]['coupon_favorit']))://если купон добавлен в избранное?>
                                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin">
                                                            <i class="fa fa-star" style="color: #E44F44"></i>
                                                        </a>
                                                    <?else:?>
                                                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_coupons[1]['id']?>" title="Добавить в Личный кабинет" class="pin w-add-coupon-favor">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                    <?endif?>

                                                    <div class="coupon-body">

                                                        <div class="coupon-content">

                                                            <div class="coupon-content-heading">
                                                                <?=$rows_coupons[1]['BusName']?>
                                                            </div>

                                                            <a href="/modalcoupon/<?=$rows_coupons[1]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image">
                                                                <img src="<?=$rows_coupons[1]['img_coupon']?>" alt="<?=$rows_coupons[1]['BusName']?>" title="Посмотреть полный купон"/></a>

                                                        </div>
                                                        <a href="/modalcoupon/<?=$rows_coupons[1]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image" title="Посмотреть полный купон">
                                                            <div class="coupon-sidebar">
                                                                <div class="coupon-sidebar-content">
                                                                    <div class="coupon-sidebar-heading">
                                                                        <div class="coupon-object-top">

                                                                            <div class="coupon-title">
                                                                                <?=$rows_coupons[1]['name']?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="coupon-sidebar-body">
                                                                        <div class="coupon-object-middle">

                                                                            <div class="coupon-title">
                                                                                <?=$rows_coupons[1]['secondname']?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="coupon-sidebar-footer">

                                                                        <div class="coupon-object-bottom">

                                                                            <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_coupons[1]['dateoff']), 'j %MONTH% Y'); ?></small>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endif?>

                                        <?if (!empty($rows_coupons[2])):?>
                                            <div class="col-sm-4">
                                                <div class="coupon coupon-big">

                                                    <?if (!empty($rows_coupons[2]['coupon_favorit']))://если купон добавлен в избранное?>
                                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin">
                                                            <i class="fa fa-star" style="color: #E44F44"></i>
                                                        </a>
                                                    <?else:?>
                                                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_coupons[2]['id']?>" title="Добавить в Личный кабинет" class="pin w-add-coupon-favor">
                                                            <i class="fa fa-star"></i>
                                                        </a>
                                                    <?endif?>

                                                    <div class="coupon-body">

                                                        <div class="coupon-content">

                                                            <div class="coupon-content-heading">
                                                                <?=$rows_coupons[2]['BusName']?>
                                                            </div>

                                                            <a href="/modalcoupon/<?=$rows_coupons[2]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image">
                                                                <img src="<?=$rows_coupons[2]['img_coupon']?>"  alt="<?=$rows_coupons[2]['BusName']?>" title="Посмотреть полный купон" /></a>

                                                        </div>
                                                        <a href="/modalcoupon/<?=$rows_coupons[2]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image" title="Посмотреть полный купон">
                                                            <div class="coupon-sidebar">
                                                                <div class="coupon-sidebar-content">
                                                                    <div class="coupon-sidebar-heading">
                                                                        <div class="coupon-object-top">

                                                                            <div class="coupon-title">
                                                                                <?=$rows_coupons[2]['name']?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="coupon-sidebar-body">
                                                                        <div class="coupon-object-middle">

                                                                            <div class="coupon-title">
                                                                                <?=$rows_coupons[2]['secondname']?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="coupon-sidebar-footer">

                                                                        <div class="coupon-object-bottom">

                                                                            <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_coupons[2]['dateoff']), 'j %MONTH% Y'); ?></small>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endif?>
                                    </div>
                                <?endforeach?>

                            </div>

                        </div>



                    <?endif?>




                    <hr/>

                    <div class="recomendation">
                        <strong>Порекомендуйте прочитать этот обзор другим</strong>
                        <br/>

                        <div class="recomendation-icons">


                            <?php
                            $image_url = 'http://'.$_SERVER['HTTP_HOST'].$data['ArticImg']; // URL изображения
                            ?>
                            <a href="http://www.facebook.com/sharer.php?s=100&p[url]=<?= urlencode(  Request::full_current_url() ); ?>&p[title]=<?=$data['ArticName'] ?>&p[summary]=<?=Text::limit_chars(strip_tags($data['ArticShortPreviev']), 150, null, true)?>&p[images][0]=<?=$image_url ?>" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" class="social facebook" title="Поделиться ссылкой на Фейсбук" target="_parent"><i class="fa fa-facebook"></i></a>


                            <script type="text/javascript">
                                document.write(VK.Share.button({
                                    url: '<?=Request::full_current_url()?>',
                                    title: '<?=$data['ArticName']?>',
                                    description: '<?=Text::limit_chars(strip_tags($data['ArticShortPreviev']), 120, null, true)?>',
                                    image: 'http://<?=$_SERVER['HTTP_HOST']?><?=$data['ArticImg']?>',
                                    noparse: true
                                }, {
                                    type: 'custom',
                                    text: '<span class="social vk"><i class="fa fa-vk"></i></span>'
                                }));
                            </script>



                            <div id="ok_shareWidget" style="display: inline-block;position: relative;top: 19px"></div>
                            <script>
                                !function (d, id, did, st) {
                                    var js = d.createElement("script");
                                    js.src = "https://connect.ok.ru/connect.js";
                                    js.onload = js.onreadystatechange = function () {
                                        if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                                            if (!this.executed) {
                                                this.executed = true;
                                                setTimeout(function () {
                                                    OK.CONNECT.insertShareWidget(id,did,st);
                                                }, 0);
                                            }
                                        }};
                                    d.documentElement.appendChild(js);
                                }(document,"ok_shareWidget","http://<?=$_SERVER['HTTP_HOST']?>/","{width:40,height:40,st:'straight',sz:45,nt:1,nc:1}");
                            </script>




                            <a style="top: 1px;position: relative;" href="https://plus.google.com/share?url=<?=HTML::HostSite($_SERVER['REQUEST_URI'])?>" onclick="javascript:window.open(this.href,
                                                    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
                                    src="../../../public/images/google_icon.png" width="45" alt="Share on Google+"/></a>

                            <a href="https://twitter.com/intent/tweet?text=<?=Text::limit_chars(strip_tags($data['ArticShortPreviev']), 100, null, true).' '.Request::full_current_url()?>" class="social twitter">
                                <i class="fa fa-twitter"></i>
                            </a>


                        </div>

                    </div>


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
            
            
            
            <!--
            <div class="col-md-4">
                <div class="w-bloc-right">
                    <h2>Новости</h2>
                    <hr>
                    <div class="title-micronews">Заголовок 1</div>
                    <p class="description-micronews">В каждом городе, даже самом большом, есть заветные уголки, не отмеченные на туристических картах, которые известны даже не всем его жителям</p>
                    <hr>
                    <div class="title-micronews">Заголовок 2</div>
                    <p class="description-micronews">Шопинг – своего рода охота или рыбалка. Вопрос – насколько она удачна и с какими «трофеями» или «уловом» вы вернетесь домой. Кто осведомлен, тот вооружен.м</p>
                    <hr>
                    <div class="title-micronews">Заголовок 3</div>
                    <p class="description-micronews">В Bamboo Village на пляже Полег в пяти минутах езды от Нетании действует эксклюзивный серфинг-клуб: опытные профессиональные инструкторы дают уроки…</p>
                    <hr>
                    <div class="title-micronews">Заголовок 4</div>
                    <p class="description-micronews">Галерея Shomroni - одна из старейших в Яффо, она существует уже более тридцати лет и имеет лицензию Министерства туризма и Управления древностей, что…</p>
                    <hr>
                    <div class="title-micronews">Заголовок 5</div>
                    <p class="description-micronews">Sea Village SPA Если вы устали, душа просит отдыха, а до отпуска еще далеко, всегда можно взять небольшой тайм-аут и отправиться на денек в уютное…</p>
                </div>
                <div class="clearfix"></div>
            </div>
            
            -->
            
            
            
        </div>

    </div>
</content>