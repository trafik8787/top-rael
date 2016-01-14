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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$data[0]['name']?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">



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

</head>



<body class="modal-open">

<div id="wrapper" class="container">

    <content>
        <div id="content">
            <div class="modal fade in modal-coupon" tabindex="-1" role="dialog" style="display: block;">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">


                        <div class="modal-body w-print-coupon">

                            <div class="coupon coupon-modal">

                                <div class="coupon-body">

                                    <div class="coupon-content">

                                        <img src="<?=$data[0]['img_coupon']?>" width="440" height="360" class="coupon-image"/>

                                    </div>

                                    <div class="coupon-sidebar">
                                        <div class="coupon-sidebar-content">
                                            <div class="coupon-sidebar-heading">
                                                <div class="coupon-object-middle text-center">
                                                    <a href="#" class="icons w-logo md"><!-- TopIsrael --></a>
                                                </div>
                                            </div>

                                            <div class="coupon-sidebar-body">
                                                <div class="coupon-object-middle">

                                                    <div class="coupon-title">
                                                        <?=$data[0]['name']?>
<!--                                                        <span class="block"><strong>--><?//=$data[0]['secondname']?><!--</strong></span>-->
                                                    </div>

                                                    <div class="text-center">
                                                        <strong><?=$data[0]['secondname']?></strong>
<!--                                                        <small class="block">--><?//=Text::limit_chars(strip_tags($data[0]['info']), 150, null, true)?><!--</small>-->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="coupon-sidebar-footer">

                                                <div class="coupon-object-bottom">
                                                    <small class="coupon-date">до <?=Date::rusdate(strtotime($data[0]['dateoff']), 'j %MONTH% Y'); ?></small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="div-table">

                                    <div class="div-row">

                                        <div class="div-cell">

                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="<?=$data[0]['BusLogo']?>" width="88" height="88" alt="...">
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

                                        <div class="div-cell">
                                            <div> <?=$data[0]['BusSchedule']?></div>
                                            <div>Адрес: <?=$data[0]['BusAddress']?></div>
                                            <div><?=$data[0]['CityName']?></div>
                                            <div>Тел: <?=$data[0]['BusTel']?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <p class="rtl">
                                <?=Text::limit_chars(strip_tags($data[0]['info']), 150, null, true)?>
                            </p>

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
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </content>

</div>

</body>
</html>