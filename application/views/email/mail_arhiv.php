<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 15.09.2015
 * Time: 12:05
 */

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
                                                <td valign="bottom" align="left" style="padding:0 10px 40px 10px;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="max-width:250px;">
                                                        <tr>
                                                            <td>
                                                                <a href="http://<?=$_SERVER['HTTP_HOST']?>" target="_blank" style="display: block;">
                                                                    <img src="/public/mail/images/1.png" width="250" height="54"
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
                                <td style="padding:10px 0;">
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
                                                <td align="right">
                                                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/articles"
                                                       style="font-size:12px; text-decoration: none; color:#007898;">Открыть
                                                        все</a>
                                                </td>
                                            </tr>

                                        </table>
                                    <?endif?>

                                    <?if (!empty($business)):?>
                                        <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="padding:0 10px;">

                                                <?foreach ($business as $bus_rows):?>

                                                    <table cellpadding="0" cellspacing="0" style="min-width:250px; max-width:288px;" align="left">
                                                        <tr>
                                                            <td style="padding:5px 10px;">
                                                                <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$bus_rows['url']?>" style="display:block; overflow: hidden;">
                                                                    <img src="/uploads/img_business/thumbs/<?=basename($bus_rows['home_busines_foto'])?>"
                                                                         style="width:100%; height:auto;"/>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:5px 10px;">
                                                                <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$bus_rows['url']?>"
                                                                   style="font-size:18px; color:#000; text-decoration: underline">
                                                                    <strong>
                                                                        <?=$bus_rows['name']?>

                                                                    </strong>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="padding:5px 10px; font-size:14px;">
                                                                <strong>
                                                                    <?=$bus_rows['CityName']?>. <?=$bus_rows['address']?>
                                                                </strong>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="padding:5px 10px 20px 10px; font-size:14px;">
                                                                <?=Text::limit_chars(strip_tags($bus_rows['info']), 150, null, true)?>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                <?endforeach?>

                                            </td>
                                        </tr>
                                        </table>
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
