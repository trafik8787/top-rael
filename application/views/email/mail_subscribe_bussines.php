<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 15.09.2015
 * Time: 12:05
 *
 * шаблон рассылки по конкретным бизнесам
 */
header('Content-Type: text/html; charset=utf-8');
?>

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>

<body>

<div style="border:1px solid #e3e1e1;max-width: 600px;margin: 0 auto;width:100%;font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:14px;">
    <div style="border:1px solid #d4d2d2">
        <div style="border:1px solid #bfbdbd;background:#ffffff;padding:15px 25px;">
            <div style="display: table;width:100%;">
                <div style="display: table-cell;width:50%;">
                    <img src="cid:logo-new.png" width="250" style="width:250px;" alt="logo">
                </div>
                <div style="display: table-cell;width:50%;font-size:12px;color: #a9a9a9;text-align: right;vertical-align: middle;">
                    Рассылка за <?=Date::rusdate(strtotime(date('Y-m-d')), 'j %MONTH% Y'); ?>
                </div>
            </div>
            <?if (!empty($article_shift)):?>
                <h3 style="margin: 20px 0px 10px 0px;padding: 0px;font-size: 22px;">Обзоры</h3>

                <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$article_shift['ArticUrl']?>" target="_blank" rel="noopener" style="width: 100%;padding:0px;margin:0px;border:0px;">
                    <img src="cid:<?=basename($article_shift['ArticImg'])?>" style="width: 100%;padding:0px;margin:0px;border:0px;"/>
                </a>
                <div style="background: #E6E6E6;padding: 15px 10px;">
                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$article_shift['ArticUrl']?>" style="color:#000;font-size:28px;font-weight: bold;" target="_blank" rel="noopener"><?=$article_shift['ArticName']?></a>
                    <p style="font-size:14px;margin:10px 0px 0px 0px;"> <?=Text::limit_chars(strip_tags($article_shift['ArticContent']), 150, null, true)?></p>
                </div>
            <?endif?>


            <?if (!empty($articless)):?>
                <?foreach ($articless as $artic):?>
                    <div style="width:100%;margin-top: 30px;">
                        <div style="float:left;margin: 0px 15px 5px 0px;">
                            <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$artic['ArticUrl']?>" target="_blank" rel="noopener">
                                <img src="cid:<?=basename($artic['ArticImg'])?>" width="164" height="115" style="width:164px;height:115px;">
                            </a>
                        </div>
                        <div style="">
                            <a href="http://<?=$_SERVER['HTTP_HOST']?>/article/<?=$artic['ArticUrl']?>" style="font-size: 20px;color:#000;" target="_blank" rel="noopener">
                                <strong><?=$artic['ArticName']?></strong>
                            </a>
                            <p style="margin:10px 0;font-size:14px;">
                                <strong></strong>
                            </p>
                            <p style="margin:10px 0;font-size:14px;">
                                <?=Text::limit_chars(strip_tags($artic['ArticContent']), 150, null, true)?>
                            </p>
                        </div>
                    </div>
                <?endforeach;?>


                <div style="text-align: center !important;margin: 20px 0px 0px 0px;">
                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/articles" style="font-size: 14px;padding: 2px 10px;color: #007898 !important;text-decoration: none !important;border: 1px solid #007898;display: inline-block;margin-bottom: 0;font-weight: normal;text-align: center;vertical-align: middle;touch-action: manipulation;cursor: pointer;background-image: none;white-space: nowrap;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;" target="_blank" rel="noopener">Открыть все</a>
                </div>

            <?endif?>

            <? if (!empty($coupons)): ?>

                <h3 style="margin: 30px 0px 0px 0px;padding: 0px;display:block;font-size: 22px;">Купоны</h3>


                <? foreach ($coupons as $row_coupons): ?>

                    <div style="display: table;width:100%;margin: 0px 0px 0px 0px;">

                        <div style="display: table-cell;width:50%;padding-top:20px;">
                            <div style="height: 400px;border: 1px solid #d8d8d8;box-shadow: rgba(0, 0, 0, 0.3) 0 2px 3px;margin-right: 7.5px;">
                                <div style="font-size: 25px;line-height: 1.1;color: #e02929;">
                                    <div style="height: 50px;color: #fff;font-size: 100%;background: rgba(0, 0, 0, 0.5);padding: 5px 10px;">
                                        <?=$row_coupons[0]['BusName']?>
                                    </div>
                                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$row_coupons[0]['CoupUrl']?>" target="_blank" rel="noopener">
                                        <img src="cid:<?=basename($row_coupons[0]['CoupImg'])?>" title="Посмотреть полный купон" style="width:100%;height:auto;">
                                    </a>
                                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$row_coupons[0]['CoupUrl']?>" style="text-decoration: none;width: 100%;color: #e02929;display:block;" title="Посмотреть полный купон" target="_blank" rel="noopener">
                                        <div style="font-size: 16px;text-align: center;">
                                            <div style="margin-top: 10px;"><?=$row_coupons[0]['CoupName']?></div>
                                            <div style="margin-top: 5px;"><?=$row_coupons[0]['CoupSecondname']?> </div>
                                            <div style="margin-top: 10px;">до <?=Date::rusdate(strtotime($row_coupons[0]['CoupDateoff']), 'j %MONTH% Y'); ?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <? if (!empty($row_coupons[1])): ?>
                            <div style="display: table-cell;width:50%;padding-top:20px;">
                                <div style="height: 400px;border: 1px solid #d8d8d8;box-shadow: rgba(0, 0, 0, 0.3) 0 2px 3px;margin-left: 7.5px;">
                                    <div style="font-size: 25px;line-height: 1.1;color: #e02929;">
                                        <div style="height: 50px;color: #fff;font-size: 80%;background: rgba(0, 0, 0, 0.5);padding: 5px 10px;">
                                            <?=$row_coupons[1]['BusName']?>
                                        </div>
                                        <a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$row_coupons[1]['CoupUrl']?>" target="_blank" rel="noopener">
                                            <img src="cid:<?=basename($row_coupons[1]['CoupImg'])?>" title="Посмотреть полный купон" style="width:100%;height:auto;">
                                        </a>
                                        <a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$row_coupons[1]['CoupUrl']?>" style="text-decoration: none;width: 100%;color: #e02929;display:block;" title="Посмотреть полный купон" target="_blank" rel="noopener">
                                            <div style="font-size: 16px;text-align: center;">
                                                <div style="margin-top: 10px;"><?=$row_coupons[1]['CoupName']?></div>
                                                <div style="margin-top: 5px;"><?=$row_coupons[1]['CoupSecondname']?></div>
                                                <div style="margin-top: 10px;">до <?=Date::rusdate(strtotime($row_coupons[1]['CoupDateoff']), 'j %MONTH% Y'); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?else:?>
                            <div style="display: table-cell;width:50%;padding-top:20px;">
                            </div>
                        <?endif?>

                    </div>

                <?endforeach?>



                <div style="text-align: center !important;margin: 20px 0px 0px 0px;">
                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/coupons" style="font-size: 14px;padding: 2px 10px;color: #007898 !important;text-decoration: none !important;border: 1px solid #007898;display: inline-block;margin-bottom: 0;font-weight: normal;text-align: center;vertical-align: middle;touch-action: manipulation;cursor: pointer;background-image: none;white-space: nowrap;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;" target="_blank" rel="noopener">Открыть все</a>
                </div>

            <?endif?>




            <div style="margin: 10px -25px -15px -25px">
                <div style="background: #0389ae;padding:30px 25px;font-size: 12px;color: #fff;text-align: center">
                    Вы получили это письмо, потому что выразили свое согласие получать новости TopIsrael.ru. Если вы не хотите получать рассылку, <a href="http://<?=$_SERVER['HTTP_HOST']?>/unsubscribe" style="color: #ffffff;" target="_blank" rel="noopener">можете отписаться.</a>
                    <br><br>
                    Это автоматическое письмо, пожалуйста, не отвечайте на него. Если у вас есть вопросы или пожелания, <a href="http://<?=$_SERVER['HTTP_HOST']?>/contacts" style="color: #ffffff;text-decoration: underline;" target="_blank" rel="noopener">пишите или звоните нам.</a>
                </div>
            </div>

        </div>
    </div>
</div>

</body>

</html>

