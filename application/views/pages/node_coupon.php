<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 13.09.2015
 * Time: 20:21
 */
//HTML::x($data);
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=strip_tags($data[0]['name'])?> <?=strip_tags($data[0]['secondname'])?>. <?=$data[0]['BusName']?>, <?=$data[0]['CityName']?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Действительно до <?=Date::rusdate(strtotime($data[0]['dateoff']), 'j %MONTH% Y'); ?>. Скидки и подарки только при предъявлении купона TopIsrael.ru">



    <link rel="stylesheet" href="/public/stylesheets/jquery.ui/all.css">
    <link rel="stylesheet" href="/public/stylesheets/bootstrap.min.css">
    <link rel="stylesheet" href="/public/stylesheets/bootstrap-social.css">
    <link rel="stylesheet" href="/public/stylesheets/font-awesome.min.css">
    <link rel="stylesheet" href="/public/stylesheets/screen.css">
    <link rel="stylesheet" href="/public/stylesheets/owl.carousel.min.css">
    <link rel="stylesheet" href="/public/stylesheets/jquery.bxslider.min.css">
    <link rel="stylesheet" href="/public/stylesheets/common.css">
    <link rel="stylesheet" href="/public/stylesheets/ie.css">

    <script src="/public/javascripts/jquery.min.js"></script>
    <script src="/public/javascripts/jquery-ui.min.js"></script>
    <script src="/public/javascripts/bootstrap.min.js"></script>
    <script src="/public/javascripts/owl.carousel.min.js"></script>
    <script src="/public/javascripts/jquery.bxslider.min.js"></script>
    <script src="/public/javascripts/orb.min.js"></script>
    <script src="/public/javascripts/jquery.validate.min.js"></script>
    <script src="/public/javascripts/common.js"></script>
    <script src="/public/javascripts/jquery.print.js"></script>
    <script src="/public/javascripts/markerclusterer_compiled.js"></script>
    <script src="/public/javascripts/infobox.js"></script>
    <script src="/public/javascripts/app.js"></script>
    <script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="UTF-8"></script>

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

            .coupon-sidebar-heading a {

            }

            .coupon-sidebar-heading {
                text-align: center!important;
            }

            .coupon-object-middle {
                font-size: 28px;
                padding-top: 20px;
            }

        }
    </style>


</head>



<body class="modal-open">

<div id="wrapper" class="container">

    <content>
        <div id="content">
            <div class="modal fade in modal-coupon" tabindex="-1" role="dialog" style="display: block;">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">


                        <div class="modal-body w-print-coupon" style="height: 540px;">

                            <div class="coupon coupon-modal">

                                <div class="coupon-body" style="height: 360px;">

                                    <div class="coupon-content">

                                        <img src="<?=$data[0]['img_coupon']?>" width="440" height="360" class="coupon-image"/>

                                    </div>

                                    <div class="coupon-sidebar">
                                        <div class="coupon-sidebar-content">
                                            <div class="coupon-sidebar-heading">
                                                <a href="/" class="md">
                                                    <img src="/public/images/logo-new.png" width="238" alt="">
                                                </a>
                                            </div>

                                            <div class="coupon-sidebar-body">
                                                <div class="coupon-object-middle">

                                                    <div class="coupon-title">
                                                        <?=$data[0]['name']?>

                                                    </div>

                                                    <div class="text-center">
                                                        <strong style="font-size: 23.4px;"><?=$data[0]['secondname']?></strong>

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
                            </div>


                            <p class="rtl" style="font-size: 17px; padding-right: 10px;">
                                <?=Text::limit_chars(strip_tags($data[0]['info']), 150, null, true)?>
                            </p>
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
                                            <a href="#" class="btn btn-primary btn-lg btn-block pin-aria" disabled="disabled">
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



                                </div>

                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-center">


                                        <span>Отправьте ссылку на этот купон</span><br>

                                        <a class="w-icon-mail" href="mailto:?Subject=Купон <?=strip_tags($data[0]['name'])?> <?=strip_tags($data[0]['secondname'])?>. <?=$data[0]['BusName']?>, <?=$data[0]['CityName']?>&body=<?=HTML::HostSite('/'.Request::detect_uri())?> <?=strip_tags($data[0]['name'])?> <?=strip_tags($data[0]['secondname'])?>. <?=$data[0]['BusName']?>, <?=$data[0]['CityName']?>">
                                            <span></span>
                                        </a>


                                        <?php
                                        $image_url = 'http://'.$_SERVER['HTTP_HOST'].$data[0]['img_coupon']; // URL изображения
                                        ?>
                                        <a href="http://www.facebook.com/sharer.php?s=100&p[url]=<?= urlencode(  Request::full_current_url() ); ?>&p[title]=<?=$data[0]['name'] ?>&p[summary]=<?=Text::limit_chars(strip_tags($data[0]['info']), 150, null, true)?>&p[images][0]=<?=$image_url ?>" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" class="social facebook" title="Поделиться ссылкой на Фейсбук" target="_parent"><i class="fa fa-facebook"></i></a>


                                        <script type="text/javascript">
                                            document.write(VK.Share.button({
                                                url: '<?=Request::full_current_url()?>',
                                                title: '<?=$data[0]['name']?>',
                                                description: '<?=Text::limit_chars(strip_tags($data[0]['info']), 120, null, true)?>',
                                                image: 'http://<?=$_SERVER['HTTP_HOST']?><?=$data[0]['img_coupon']?>',
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

                                        <a href="https://twitter.com/intent/tweet?text=<?=Text::limit_chars(strip_tags($data[0]['info']), 100, null, true).' '.Request::full_current_url()?>" class="social twitter">
                                            <i class="fa fa-twitter"></i>
                                        </a>


                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </content>

</div>

</body>
</html>