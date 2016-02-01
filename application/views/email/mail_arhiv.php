<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 15.09.2015
 * Time: 12:05
 */
//HTML::x($users);
?>

<meta charset="UTF-8">
<meta name=viewport content="width=device-width, initial-scale=1">

<div style="border:1px solid #e3e1e1; max-width: 600px; margin: 0 auto; width:100%;">
    <div style="border:1px solid #d4d2d2">
        <div style="border:1px solid #bfbdbd; background:#ffffff;">

            <!-- Email Content -->
            <table cellspacing="0" cellpadding="0" width="100%"
                   style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px;">

                <thead>
                <tr>
                    <td>
                        <div style="background-color:#ffffff;">

                            <table height="120" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="top" align="left" style="padding:0 10px;">

                                        <!-- Header -->
                                        <table cellpadding="0" cellspacing="0" align="left" width="100%" height="120">
                                            <tr>
                                                <td valign="bottom" align="left" style="padding: 0 10px 28px 8px;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="max-width:250px;">
                                                        <tr>
                                                            <td>
                                                                <a href="http://<?=$_SERVER['HTTP_HOST']?>" target="_blank" style="display: block;">
                                                                    <img src="/public/images/logo-new.png" width="250"
                                                                         style="width:100%; height:auto;" alt="logo"/>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td valign="bottom" align="right" style="padding:0 10px;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="max-width:109px;">
                                                        <tr>
                                                            <td>
                                                                <img src="/public/mail/images/2.png" width="109" height="108"
                                                                     style="width:100%; height: auto" alt="plane"/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                </thead>

                <tbody>

                <tr>
                    <td>

                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="padding:0 20px 15px 20px;">
                                    <span style="font-size:12px; color: #a9a9a9;">Рассылка за <?=Date::rusdate(strtotime($date_subscribe), 'j %MONTH% Y'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><span><h3 style="margin: 0;padding: 0 0 10px 7px;">Обзоры</h3></span></td>
                            </tr>
                            <?if (!empty($article_shift)):?>
                                <tr>
                                    <td>
                                        <img src="/uploads/img_articles/thumbs/<?=basename($article_shift['images_article'])?>" width="600" height="420"
                                             style="width: 100%; height:auto"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 20px;" bgcolor="#E6E6E6">
                                        <span style="font-size:30px">
                                            <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$article_shift['url']?>" style="color:#000;"><?=$article_shift['name']?></a>
                                        </span>

                                        <p style="font-size:14px; margin:5px 0;">
                                            <?=Text::limit_chars(strip_tags($article_shift['content']), 150, null, true)?>
                                        </p>
                                    </td>
                                </tr>
                            <?endif?>
                            <tr>
                                <td style="padding: 10px 10px 0 10px;">
                                    <!-- Content -->
                                    <?if (!empty($articless)):?>
                                        <table cellpadding="0" cellspacing="0" width="100%" style="padding:20px;">
                                            <?foreach ($articless as $artic):?>
                                                <tr>
                                                    <td>

                                                        <table cellpadding="0" cellspacing="0" width="100%" align="left"
                                                               style="max-width:165px;">
                                                            <tr>
                                                                <td style="padding:0 20px 5px 0">
                                                                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$artic['url']?>" style="display:block;">
                                                                        <img src="/uploads/img_articles/thumbs/<?=basename($artic['images_article'])?>" width="164" height="115"
                                                                             style="width:100%; height:auto;"/>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                        <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$artic['url']?>" style="font-size: 18px; color:#000; text-decoration: none;">
                                                            <strong>
                                                                <?=$artic['name']?>
                                                            </strong>
                                                        </a>

                                                        <p style="margin:10px 0; font-size:14px;">
                                                            <strong><?=$artic['secondname']?></strong>
                                                        </p>

                                                        <p style="margin:10px 0; font-size:14px;">
                                                            <?=Text::limit_chars(strip_tags($artic['content']), 150, null, true)?>
                                                        </p>

                                                    </td>
                                                </tr>
                                            <?endforeach?>
                                            <tr>
                                                <td style="text-align: right!important;">
                                                   <strong> <a href="http://<?=$_SERVER['HTTP_HOST']?>/articles"
                                                       style="font-size:12px; text-decoration: none; color:#007898;">Открыть
                                                        все</a></strong>
                                                </td>
                                            </tr>

                                        </table>
                                    <?endif?>




                                    <table cellpadding="0" cellspacing="0" width="100%" style="margin-top: 20px;">
                                        <tr>
                                            <td><span><h3 style="margin: 0;padding: 0 0 10px 7px;">Купоны</h3></span></td>
                                        </tr>

                                        <? if (!empty($coupons)): ?>

                                            <? foreach ($coupons as $row_coupons): ?>

                                            <tr style="width: 100%">
                                                <td style="width: 50%">
                                                    <div style="padding: 10px; ">
                                                        <div style="height: 400px;position: relative; border: 1px solid #d8d8d8;box-shadow: rgba(0, 0, 0, 0.3) 0 2px 3px;">
                                                            <div style="font-size: 25px;line-height: 1.1;color: #e02929;">
                                                                <div>
                                                                    <div style="height: 54px; color: #fff;font-size: 80%;background: rgba(0, 0, 0, 0.5);padding: 5px 10px;">
                                                                        <?=$row_coupons[0]['BusName']?>
                                                                    </div>
                                                                    <a href="/coupon/<?=$row_coupons[0]['url']?>">
                                                                        <img src="<?=$row_coupons[0]['img_coupon']?>" title="Посмотреть полный купон" style="width:100%; height:auto;"/>
                                                                    </a>
                                                                </div>
                                                                <a href="/coupon/<?=$row_coupons[0]['url']?>"  style="text-decoration: none;width: 100%;color: #e02929;" title="Посмотреть полный купон">
                                                                    <div style="padding-left: 5px;padding-right: 5px;">
                                                                        <div style="font-size: 17px;text-align: center;">
                                                                            <div>
                                                                                <div>
                                                                                    <div style="margin-top: 10px;">
                                                                                        <?=$row_coupons[0]['name']?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div>

                                                                                    <div>
                                                                                        <?=$row_coupons[0]['secondname']?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="position: absolute;bottom: 2px;display: block;width: 100%;">

                                                                                <div style="vertical-align: bottom;">

                                                                                    <span style="display: block;text-align: center;padding: 5px 0;">до <?=Date::rusdate(strtotime($row_coupons[0]['dateoff']), 'j %MONTH% Y'); ?></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </td>


                                                <? if (!empty($row_coupons[1])): ?>


                                                <td style="width: 50%">

                                                    <div style="padding: 10px; ">

                                                        <div style="height: 400px;position: relative;border: 1px solid #d8d8d8;box-shadow: rgba(0, 0, 0, 0.3) 0 2px 3px;" >
                                                            <div style="font-size: 25px;line-height: 1.1;color: #e02929;">
                                                                <div>
                                                                    <div style="height: 54px; color: #fff;font-size: 80%;background: rgba(0, 0, 0, 0.5);padding: 5px 10px;">
                                                                        <?=$row_coupons[1]['BusName']?>
                                                                    </div>
                                                                    <a href="/coupon/<?=$row_coupons[1]['url']?>">
                                                                        <img src="<?=$row_coupons[1]['img_coupon']?>" title="Посмотреть полный купон" style="width:100%; height:auto;"/>
                                                                    </a>
                                                                </div>
                                                                <a href="/coupon/<?=$row_coupons[1]['url']?>"  style="text-decoration: none;width: 100%;color: #e02929;" title="Посмотреть полный купон">
                                                                    <div style="padding-left: 5px;padding-right: 5px;">
                                                                        <div style="font-size: 17px;text-align: center;">
                                                                            <div>
                                                                                <div>
                                                                                    <div style="margin-top: 10px;">
                                                                                        <?=$row_coupons[1]['name']?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div>

                                                                                    <div>
                                                                                        <?=$row_coupons[1]['secondname']?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="position: absolute;bottom: 2px;display: block;width: 100%;">

                                                                                <div style="vertical-align: bottom;">

                                                                                    <span style="display: block;text-align: center;padding: 5px 0;">до <?=Date::rusdate(strtotime($row_coupons[1]['dateoff']), 'j %MONTH% Y'); ?></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                                <? endif ?>


                                            </tr>
                                            <? endforeach ?>

                                            <tr>
                                                <td colspan="2" style="text-align: right!important;">
                                                    <strong> <a href="/coupons"
                                                                style="font-size:12px; text-decoration: none; color:#007898;">Открыть
                                                            все</a></strong>
                                                </td>
                                            </tr>
                                        <? endif ?>
                                    </table>





                                    <?if (!empty($business)):?>

                                        <? foreach ($business as $row_bus): ?>

                                            <table cellpadding="0" cellspacing="0" width="100%" style="margin-top: 20px;">
                                                <tr>
                                                    <td><span><h3 style="margin: 0;padding: 0 0 10px 7px;"><?=$row_bus['CatName']?></h3></span></td>
                                                </tr>
                                                <?foreach (Controller_BaseController::convertArrayVievData($row_bus['BusArr']) as $bus_rows):?>
                                                    <tr style="width: 100%">
                                                        <td style="vertical-align: top;">

                                                            <table cellpadding="0" cellspacing="0" style="min-width:250px; max-width:288px;" align="left">
                                                                <tr>
                                                                    <td style="padding:5px 10px;">
                                                                        <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$bus_rows[0]['url']?>" style="display:block; overflow: hidden;">
                                                                            <img src="/uploads/img_business/thumbs/<?=basename($bus_rows[0]['home_busines_foto'])?>"
                                                                                 style="width:100%; height:auto;"/>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding:5px 10px;">
                                                                        <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$bus_rows[0]['url']?>"
                                                                           style="font-size:18px; color:#000; text-decoration: underline">
                                                                            <strong>
                                                                                <?=$bus_rows[0]['name']?>

                                                                            </strong>
                                                                        </a>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="padding:5px 10px; font-size:14px;">
                                                                        <strong>
                                                                            <?=$bus_rows[0]['CityName']?>. <?=$bus_rows[0]['address']?>
                                                                        </strong>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="padding:5px 10px 20px 10px; font-size:14px;">
                                                                        <?=Text::limit_chars(strip_tags($bus_rows[0]['info']), 150, null, true)?>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                        </td>

                                                            <?if (!empty($bus_rows[1])):?>
                                                                <td style="vertical-align: top;">

                                                                    <table cellpadding="0" cellspacing="0" style="min-width:250px; max-width:288px;" align="left">
                                                                        <tr>
                                                                            <td style="padding:5px 10px;">
                                                                                <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$bus_rows[1]['url']?>" style="display:block; overflow: hidden;">
                                                                                    <img src="/uploads/img_business/thumbs/<?=basename($bus_rows[1]['home_busines_foto'])?>"
                                                                                         style="width:100%; height:auto;"/>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding:5px 10px;">
                                                                                <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$bus_rows[1]['url']?>"
                                                                                   style="font-size:18px; color:#000; text-decoration: underline">
                                                                                    <strong>
                                                                                        <?=$bus_rows[1]['name']?>

                                                                                    </strong>
                                                                                </a>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td style="padding:5px 10px; font-size:14px;">
                                                                                <strong>
                                                                                    <?=$bus_rows[1]['CityName']?>. <?=$bus_rows[1]['address']?>
                                                                                </strong>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td style="padding:5px 10px 20px 10px; font-size:14px;">
                                                                                <?=Text::limit_chars(strip_tags($bus_rows[1]['info']), 150, null, true)?>
                                                                            </td>
                                                                        </tr>
                                                                    </table>

                                                                </td>
                                                            <?endif?>

                                                    </tr>
                                                <?endforeach?>
                                            </table>

                                        <? endforeach ?>

                                    <?endif?>


                                </td>
                            </tr>


                        </table>

                    </td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>
</div>
