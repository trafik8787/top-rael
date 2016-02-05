<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.08.2015
 * Time: 16:07
 */
//die(HTML::x($data));
?>

<style>
    @media print {

        a:after{
            content: "" !important;
        }

        .coupon-date {
            font-size: 14px!important;
        }

        .media-left img {
            position: absolute;
        }

        .media-body {
            position: relative;
            left: 92px;
        }

    }
</style>

<button type="button" class="close" data-dismiss="modal"
        aria-label="Close"><span
        class="lnr lnr-cross"></span></button>

<div class="modal-body print w-print-coupon" style="height: 540px;">

        <div class="coupon coupon-modal">

            <div class="coupon-body" style="height: 360px;">

                <div class="coupon-content">

                        <img src="<?=$data[0]['img_coupon']?>" width="440" height="360"/>

                </div>

                <div class="coupon-sidebar">
                    <div class="coupon-sidebar-content">
                        <div class="coupon-sidebar-heading">
                            <div class="coupon-object-middle text-center">
                                <a href="/" class="md">
                                    <img src="/public/images/logo-new.png" width="238" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="coupon-sidebar-body">
                            <div class="coupon-object-middle">

                                <div class="coupon-title">
                                    <?=$data[0]['name']?>
                                    <span class="block"><strong><?=$data[0]['secondname']?></strong></span>
                                </div>

                            </div>
                        </div>

                        <div class="coupon-sidebar-footer">

                            <div class="coupon-object-bottom">
                                <small class="coupon-date">до <?=Date::rusdate(strtotime($data[0]['dateoff']), 'j %MONTH% Y'); ?>
                                    <br> Только при предъявление этого купона</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="div-table">

                <div class="div-row">

                    <div class="div-cell" style="width: 434px;">

                        <div class="media">
                            <div class="media-left">
                                <a href="/business/<?=$data[0]['BusUrl']?>">
                                    <img class="media-object" src="<?=$data[0]['BusLogo']?>" width="88" height="88" alt="<?=$data[0]['BusName']?>">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="media-heading">
                                    <a href="/business/<?=$data[0]['BusUrl']?>"><?=$data[0]['BusName']?></a>
                                </div>
                                <?=Text::limit_chars(strip_tags($data[0]['BusInfo']), 150, null, true)?>
                            </div>
                        </div>

                    </div>

                    <div class="div-cell" style="width: 266px; padding-left: 41px!important;">
                        <div> <?=$data[0]['BusSchedule']?></div>
                        <div>Адрес: <?=$data[0]['BusAddress']?></div>
                        <div><?=$data[0]['CityName']?></div>
                        <div>Тел: <?=$data[0]['BusTel']?></div>
                    </div>
                </div>
            </div>

            <p class="rtl" style="font-size: 17px; padding-right: 10px;">
                <?=Text::limit_chars(strip_tags($data[0]['info']), 150, null, true)?>
            </p>

        </div>

</div>

<div class="modal-footer">


    <div class="div-table">

        <div class="div-row">
            <?if (empty($data[0]['coupon_favorit'])):?>
                <div class="div-cell">
                    <a href="#" class="btn btn-primary btn-lg btn-block pin-aria w-add-coupon-favor-modal" data-id="<?=$data[0]['id']?>">
                        <span class="pin"><i class="fa fa-thumb-tack"></i></span>
                        <strong><i class="w-text-button-coupon-modal-save">Сохранить</i></strong>
                    </a>
                </div>
            <?else:?>
                <div class="div-cell">
                    <a href="#" class="btn btn-primary btn-lg btn-block pin-aria" disabled>
                        <span class="pin"><i class="fa fa-thumb-tack"></i></span>
                        <strong><i class="w-text-button-coupon-modal-save">В избранном</i></strong>
                    </a>
                </div>
            <?endif?>


            <div class="div-cell">
                <a href="#" class="btn btn-primary btn-lg btn-block pin-aria w-button-print">
                    <span class="pin"><i class="fa fa-print"></i></span>
                    <strong><i>Распечатать</i></strong>
                </a>
            </div>


            <div class="div-cell">
                <a href="/coupon/<?=$data[0]['url']?>" target="_blank" class="btn btn-primary btn-lg btn-block pin-aria">
                    <span class="pin"><i class="fa fa-mobile"></i></span>
                    <strong><i>Открыть на телефоне</i></strong>
                </a>
            </div>

        </div>

    </div>

    <hr>
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">
                <span>Отправьте ссылку на этот купон</span><br>

                <a class="w-icon-mail" href="mailto:?Subject=Купон <?=$data[0]['name']?> <?=$data[0]['secondname']?>&body=<?=HTML::HostSite('/'.Request::detect_uri())?>">
                    <span></span>
                </a>

                <?php
                $image_url = 'http://'.$_SERVER['HTTP_HOST'].$data[0]['img_coupon']; // URL изображения
                ?>
                <a href="http://www.facebook.com/sharer.php?s=100&p[url]=<?= urlencode(  Request::full_current_url() ); ?>&p[title]=<?=$data[0]['name'] ?>&p[summary]=<?=Text::limit_chars(strip_tags($data[0]['info']), 150, null, true)?>&p[images][0]=<?=$image_url ?>" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" class="social facebook" title="Поделиться ссылкой на Фейсбук" target="_parent"><i class="fa fa-facebook"></i></a>



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

                <a href="https://twitter.com/intent/tweet?text=<?=Text::limit_chars(strip_tags($data[0]['info']), 100, null, true).' '.Request::full_current_url()?>" class="social twitter">
                    <i class="fa fa-twitter"></i>
                </a>

                <a title="Отправить на email" href="mailto:?Subject=Купон <?=$data[0]['name']?> <?=$data[0]['secondname']?>&body=<?=HTML::HostSite('/coupon/'.$data[0]['url'])?>"><span class="w-icon-mail"></span></a>

            </div>
        </div>

    </div>

</div>