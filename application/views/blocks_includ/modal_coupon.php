<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.08.2015
 * Time: 16:07
 */
//die(HTML::x($data));
?>

<button type="button" class="close" data-dismiss="modal"
        aria-label="Close"><span
        class="lnr lnr-cross"></span></button>

<div class="modal-body w-print-coupon">

        <div class="coupon coupon-modal">

            <div class="coupon-body">

                <div class="coupon-content">
                    <a href="#" class="coupon-image">
                        <img src="<?=$data[0]['img_coupon']?>" width="440" height="360"/>
                    </a>
                </div>

                <div class="coupon-sidebar">
                    <div class="coupon-sidebar-content">
                        <div class="coupon-sidebar-heading">
                            <div class="coupon-object-middle text-center">
                                <a href="#" class="icons logo md">TopIsrael</a>
                            </div>
                        </div>

                        <div class="coupon-sidebar-body">
                            <div class="coupon-object-middle">

                                <div class="coupon-title">
                                    СКИДКА
                                    <span class="block"><strong><?=$data[0]['secondname']?></strong></span>
                                </div>

                                <div class="text-center">
                                    <strong><?=$data[0]['name']?></strong>
                                    <small class="block"><?=Text::limit_chars(strip_tags($data[0]['info']), 150, null, true)?></small>
                                </div>
                            </div>
                        </div>

                        <div class="coupon-sidebar-footer">

                            <div class="coupon-object-bottom">
                                <small class="coupon-date"><?=Date::rusdate(strtotime($data[0]['dateoff']), 'j %MONTH% Y'); ?></small>
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
                                    <img class="media-object" src="<?=$data[0]['BusLogo']?>" width="88" height="88" alt="">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="media-heading">
                                    <a href="/business/<?=$data[0]['BusUrl']?>"><?=$data[0]['BusName']?></a>
                                </div>
                                Стильный, итальянский ресторан, асположенный прямо под зданием
                                остиницы Rich
                                Carlton в марине Герцлии
                            </div>
                        </div>

                    </div>

                    <div class="div-cell">
                        <div> Открыты ежедневно с 12:00-24:00</div>
                        <div>Адрес: Ha-Shunit St 2</div>
                        <div>Герцлия</div>
                        <div>Тел: 09-9514000</div>
                    </div>
                </div>
            </div>

        </div>

</div>

<div class="modal-footer">

    <p class="rtl">
        כלל משחקים תחבורה ייִדיש ב. לחיבור הקנאים רב־לשוני את ויש, טיפול המלצת אל זכר, יידיש
        פיסול אקראי זאת של.<br/>
        צ'ט העמוד והגולשים את, מדע של מונחים מועמדים. מה שער מתוך ברית מונחונים. בקר מה הטבע
        הרוח ופיתוחה.
    </p>

    <div class="div-table">

        <div class="div-row">
            <?if (empty($data[0]['coupon_favorit'])):?>
                <div class="div-cell">
                    <a href="#" class="btn btn-primary btn-lg btn-block pin-aria w-add-coupon-favor-modal" data-id="<?=$data[0]['id']?>" data-dismiss="modal">
                        <span class="pin"><i class="fa fa-thumb-tack"></i></span>
                        <strong><i>Сохранить</i></strong>
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
                <a href="#" class="btn btn-primary btn-lg btn-block pin-aria">
                    <span class="pin"><i class="fa fa-mobile"></i></span>
                    <strong><i>Открыть на телефоне</i></strong>
                </a>
            </div>

        </div>

    </div>
</div>