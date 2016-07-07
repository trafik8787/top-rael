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
                                    <br>Только при предъявлении купона</small>
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

            <p class="rtl" style="font-size: 17px;text-align: center;padding-top: 11px;">
                <?=Text::limit_chars(strip_tags($data[0]['info']), 150, null, true)?>
            </p>

        </div>

</div>

<div class="modal-footer">

    <hr>
    <div class="div-table">

        <div class="div-row">
            <?if (empty($data[0]['coupon_favorit'])):?>
                <div class="div-cell">
                    <a href="#" class="btn btn-primary btn-lg btn-block pin-aria w-add-coupon-favor-modal" data-id="<?=$data[0]['id']?>">
                        <span class="pin"><i class="fa fa-star"></i></span>
                        <strong><i class="w-text-button-coupon-modal-save">Сохранить</i></strong>
                    </a>
                </div>
            <?else:?>
                <div class="div-cell">
                    <a href="#" class="btn btn-primary btn-lg btn-block pin-aria" disabled>
                        <span class="pin"><i class="fa fa-star"></i></span>
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

                <?=Controller_BaseController::getViewsSharedButtonsCoupon($data[0]['name'],$data[0]['secondname'],$data[0]['info'],$data[0]['BusName'],$data[0]['CityName'],$data[0]['img_coupon'], $data[0]['url'], 'Купон')?>


            </div>
        </div>

    </div>

</div>