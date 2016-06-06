<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 15.09.2015
 * Time: 12:05
 */
header('Content-Type: text/html; charset=utf-8');
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>

<body style="background: #ECECEC;padding: 0px;margin: 0px;">

<div style="background: #ECECEC;padding: 0px;margin: 0px;">
    <div style="max-width: 600px;margin: 0 auto;width:100%;font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:14px;">
        <div style="background:#ffffff;padding:15px 0px 0px 0px;">
            <div style="margin: 0px 25px;">
                <div style="display: inline-block;vertical-align: middle;width: 70%;margin-bottom: 10px;">
                    <img src="cid:logo-new.png" style="width: 250px;" alt="logo">
                </div>
                <div style="display: inline-block;font-size:12px;color: #a9a9a9;text-align: right;vertical-align: middle;margin-bottom: 10px;">
                    Рассылка за <?=Date::rusdate(strtotime(date('Y-m-d')), 'j %MONTH% Y'); ?>
                </div>
            </div>
            <?if (!empty($article_shift)):?>
                <h3 style="margin: 10px 25px 10px 25px;padding: 0px;font-size: 22px;">Обзоры</h3>

                <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$article_shift['url']?>" target="_blank" rel="noopener" style="display: block;padding:0px;margin:0px 25px;border:0px;">
                    <img src="cid:<?=basename($article_shift['images_article'])?>" style="width: 100%;padding:0px;margin:0px;border:0px;"/>
                </a>
                <div style="background: #666666;padding: 15px 10px;margin: 0px 25px 0px 25px;">
                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$article_shift['url']?>" style="color:#fff;font-size:24px;font-weight: bold;" target="_blank" rel="noopener"><?=$article_shift['name']?></a>
                    <p style="font-size:14px;margin:10px 0px 0px 0px;color: #fff;"> <?=Text::limit_chars(strip_tags($article_shift['content']), 150, null, true)?></p>
                </div>
            <?endif?>


            <?if (!empty($articless)):?>
                <?foreach ($articless as $artic):?>
                    <div style="margin: 30px 25px 0px 25px;">
                        <div style="float:left;margin: 0px 15px 5px 0px;">
                            <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$artic['url']?>" target="_blank" rel="noopener">
                                <img src="cid:<?=basename($artic['images_article'])?>" style="width: 164px;height: 115px;">
                            </a>
                        </div>
                        <div style="">
                            <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$artic['url']?>" style="font-size: 18px;color:#000;" target="_blank" rel="noopener">
                                <strong><?=$artic['name']?></strong>
                            </a>
                            <p style="margin:10px 0;font-size:14px;">
                                <strong></strong>
                            </p>
                            <p style="margin:10px 0;font-size:14px;">
                                <?=Text::limit_chars(strip_tags($artic['content']), 150, null, true)?>
                            </p>
                        </div>
                    </div>
                <?endforeach;?>


                <div style="text-align: center !important;margin: 20px 25px 0px 25px;">
                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/articles" style="font-size: 14px;padding: 2px 10px;color: #007898 !important;text-decoration: none !important;border: 1px solid #007898;display: inline-block;margin-bottom: 0;font-weight: normal;text-align: center;vertical-align: middle;touch-action: manipulation;cursor: pointer;background-image: none;white-space: nowrap;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;" target="_blank" rel="noopener">Открыть все</a>
                </div>

            <?endif?>

            <? if (!empty($coupons)): ?>

                <h3 style="margin: 30px 25px 0px 25px;padding: 0px;display:block;font-size: 22px;">Купоны</h3>


                <? foreach ($coupons as $row_coupons): ?>



                    <div style="margin: 0px 17.5px;text-align: center;">

                        <div style="padding-top:20px;width:280px;display: inline-block;vertical-align: top;">
                            <div style="height: 400px;border: 1px solid #d8d8d8;box-shadow: rgba(0, 0, 0, 0.3) 0 2px 3px;margin: 0px 7.5px;">
                                <div style="height: 50px;color: #fff;font-size: 80%;background: rgba(0, 0, 0, 0.5);padding: 5px 10px;">
                                    <?=$row_coupons[0]['BusName']?>
                                </div>
                                <a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$row_coupons[0]['url']?>" target="_blank" rel="noopener">
                                    <img src="cid:<?=basename($row_coupons[0]['img_coupon'])?>" title="Посмотреть полный купон" style="width:100%;height:auto;">
                                </a>
                                <a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$row_coupons[0]['url']?>" style="text-decoration: none;width: 100%;color: #e02929;display:block;" title="Посмотреть полный купон" target="_blank" rel="noopener">
                                    <div style="font-size: 16px;text-align: center;">
                                        <div style="margin-top: 10px;"><?=$row_coupons[0]['name']?></div>
                                        <div style="margin-top: 5px;"><?=$row_coupons[0]['secondname']?> </div>
                                        <div style="margin-top: 10px;">до <?=Date::rusdate(strtotime($row_coupons[0]['dateoff']), 'j %MONTH% Y'); ?></div>
                                    </div>
                                </a>
                            </div>
                        </div>


                        <? if (!empty($row_coupons[1])): ?>

                            <div style="padding-top:20px;width:280px;display: inline-block;vertical-align: top;">
                                <div style="height: 400px;border: 1px solid #d8d8d8;box-shadow: rgba(0, 0, 0, 0.3) 0 2px 3px;margin: 0px 7.5px;">
                                    <div style="height: 50px;color: #fff;font-size: 80%;background: rgba(0, 0, 0, 0.5);padding: 5px 10px;">
                                        <?=$row_coupons[1]['BusName']?>
                                    </div>
                                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$row_coupons[1]['url']?>" target="_blank" rel="noopener">
                                        <img src="cid:<?=basename($row_coupons[1]['img_coupon'])?>" title="Посмотреть полный купон" style="width:100%;height:auto;">
                                    </a>
                                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$row_coupons[1]['url']?>" style="text-decoration: none;width: 100%;color: #e02929;display:block;" title="Посмотреть полный купон" target="_blank" rel="noopener">
                                        <div style="font-size: 16px;text-align: center;">
                                            <div style="margin-top: 10px;"><?=$row_coupons[1]['name']?></div>
                                            <div style="margin-top: 5px;"><?=$row_coupons[1]['secondname']?></div>
                                            <div style="margin-top: 10px;">до <?=Date::rusdate(strtotime($row_coupons[1]['dateoff']), 'j %MONTH% Y'); ?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        <?else:?>
                            <div style="padding-top:20px;width:280px;display: inline-block;">
                            </div>
                        <?endif?>

                    </div>

                <?endforeach?>



                <div style="text-align: center !important;margin: 20px 25px 0px 25px;">
                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/coupons" style="font-size: 14px;padding: 2px 10px;color: #007898 !important;text-decoration: none !important;border: 1px solid #007898;display: inline-block;margin-bottom: 0;font-weight: normal;text-align: center;vertical-align: middle;touch-action: manipulation;cursor: pointer;background-image: none;white-space: nowrap;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;" target="_blank" rel="noopener">Открыть все</a>
                </div>

            <?endif?>


            <?if (!empty($business)):?>

                <? foreach ($business as $row_bus): ?>

                    <h3 style="margin: 30px 25px 0px 25px;padding: 0px;display:block;font-size: 22px;"><?=$row_bus['CatName']?></h3>

                    <?foreach (Controller_BaseController::convertArrayVievData($row_bus['BusArr']) as $bus_rows):?>

                        <div style="margin: 0px 17.5px;text-align: center;">
                            <div style="padding-top:20px;width:280px;display: inline-block;text-align: left;vertical-align: top;">
                                <div style="height: 380px;margin: 0px 7.5px;">
                                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$bus_rows[0]['url']?>" style="display:block;overflow: hidden;" target="_blank" rel="noopener">
                                        <img src="cid:<?=basename($bus_rows[0]['home_busines_foto'])?>" style="width:100%;height:auto;">
                                    </a>
                                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$bus_rows[0]['url']?>" style="font-size:18px;color:#000;text-decoration: underline;margin-top: 10px;display:block;" target="_blank" rel="noopener">
                                        <strong><?=$bus_rows[0]['name']?></strong>
                                    </a>
                                    <div style="font-size:14px;color:#000;margin-top: 10px;" >
                                        <strong><?=$bus_rows[0]['CityName']?>. <?=$bus_rows[0]['address']?></strong>
                                    </div>
                                    <div style="font-size:14px;color:#000;margin-top: 10px;" >
                                        <?=Text::limit_chars(strip_tags($bus_rows[0]['info']), 150, null, true)?>
                                    </div>
                                </div>
                            </div>

                            <?if (!empty($bus_rows[1])):?>
                                <div style="padding-top:20px;width:280px;display: inline-block;text-align: left;vertical-align: top;">
                                    <div style="height: 380px;margin: 0px 7.5px;">
                                        <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$bus_rows[1]['url']?>" style="display:block;overflow: hidden;" target="_blank" rel="noopener">
                                            <img src="cid:<?=basename($bus_rows[1]['home_busines_foto'])?>" style="width:100%;height:auto;">
                                        </a>
                                        <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$bus_rows[1]['url']?>" style="font-size:18px;color:#000;text-decoration: underline;margin-top: 10px;display:block;" target="_blank" rel="noopener">
                                            <strong><?=$bus_rows[1]['name']?></strong>
                                        </a>
                                        <div style="font-size:14px;color:#000;margin-top: 10px;" >
                                            <strong><?=$bus_rows[1]['CityName']?>. <?=$bus_rows[1]['address']?></strong>
                                        </div>
                                        <div style="font-size:14px;color:#000;margin-top: 10px;">
                                            <?=Text::limit_chars(strip_tags($bus_rows[0]['info']), 150, null, true)?>
                                        </div>
                                    </div>
                                </div>
                            <?else:?>
                                <div style="padding-top:20px;width:280px;display: inline-block;">
                                    <!-- заглушка -->
                                </div>
                            <?endif?>
                        </div>
                    <?endforeach?>
                <?endforeach?>

                <div style="text-align: center !important;margin: 20px 25px 30px 25px;">
                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/business/restaurants" style="font-size: 14px;padding: 2px 10px;color: #007898 !important;text-decoration: none !important;border: 1px solid #007898;display: inline-block;margin-bottom: 0;font-weight: normal;text-align: center;vertical-align: middle;touch-action: manipulation;cursor: pointer;background-image: none;white-space: nowrap;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;" target="_blank" rel="noopener">Открыть все</a>
                </div>

            <?endif?>

            <div style="margin: 10px 0px 0px 0px">
                <div style="background: #0389ae;padding:30px 25px;font-size: 12px;color: #fff;text-align: center">
                    Вы получили это письмо, потому что выразили свое согласие получать новости TopIsrael.ru. Если вы не хотите получать рассылку, <a href="http://<?=$_SERVER['HTTP_HOST']?>/unsubscribe" style="color: #ffffff;" target="_blank" rel="noopener">можете отписаться.</a>
                    <br>
                    <br>Это автоматическое письмо, пожалуйста, не отвечайте на него. Если у вас есть вопросы или пожелания, <a href="http://<?=$_SERVER['HTTP_HOST']?>/contacts" style="color: #ffffff;text-decoration: underline;" target="_blank" rel="noopener">пишите или звоните нам.</a>
                </div>
            </div>

        </div>
    </div>
</div>

</body>

</html>

