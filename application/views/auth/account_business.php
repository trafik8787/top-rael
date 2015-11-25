<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 08.09.2015
 * Time: 13:06
 */
HTML::x($subscribe);
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($seo_title) ? $seo_title : '' ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?= isset($seo_keywords) ? $seo_keywords : '' ?>">
    <meta name="description" content="<?= isset($seo_description) ? $seo_description : '' ?>">


    <? foreach ($style as $row_style): ?>
        <link rel="stylesheet" href="<?= URL::base(); ?><?= $row_style ?>">
    <? endforeach ?>

    <link href='//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic'
          rel='stylesheet' type='text/css'>

    <? foreach ($script as $row_script): ?>
        <script src="<?= URL::base(); ?><?= $row_script ?>"></script>
    <? endforeach ?>

    <? if (!empty($scripts_map)): //скрипт для карты?>
        <script src="<?= URL::base(); ?><?= $scripts_map ?>"></script>
    <? endif ?>
    <!--    <link rel="shortcut icon" href="../../public/img/favicon.ico" type="image/x-icon">-->
    <script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="windows-1251"></script>


    <script>

        $(document).ready(function(){
            $('.tabs__caption').on('click', 'a:not(.active)', function() {
                $(this)
                    .addClass('active').siblings().removeClass('active')
                    .closest('.tabs').find('.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
                return false;
            });
        });
    </script>

    <style>
        .tabs__caption {
            font-size: 14px!important;
        }
        .tabs__content {
            display: none; /* по умолчанию прячем все блоки */
        }
        .tabs__content.active {
            display: block; /* по умолчанию показываем нужный блок */
            font-size: 13px!important;
        }

        .tabs a.active {
            font-weight: bold;
            color: #000000;
            text-decoration: none;
        }

    </style>
</head>
<body>

<div id="wrapper" class="container">


    <header>
        <div id="header">

            <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-header" aria-controls="nav-header">
                <i class="fa fa-bars"></i>
            </a>

            <a href="/" class="icons logo">TopIsrael</a>

            <div class="collapse" id="nav-header">

                <div class="header-profile">
                    <a href="/account/logout">Logout</a>
                </div>

            </div>
        </div>
    </header>


<content dir="rtl">
    <div id="content" class="rtl">


        <div class="jumbotron jumbotron-profile">

            <div class="panel panel-page-profile">


                <div class="panel-heading">
                    <div class="panel-title rtl pull-left">
                        <strong>
                            דף אישי
                        </strong>
                    </div>
                </div>


                <div class="panel-body rtl">
                    <div class="col-md-12">
                        <div class="div-table">

                            <div class="div-row">

                                <div class="col-md-4 div-cell">
                                    <img src="<?=$data['BusLogo']?>" width="200" height="200"
                                         class="img-responsive profile-avarat"/>
                                </div>

                                <div class="col-md-4 div-cell">
                                    <div class="profile-title">
                                        <strong>
                                            <?=$data['BusName']?>
                                        </strong>
                                    </div>

                                    <p>
                                        <?$web_url = parse_url($data['BusWebsite'])?>
                                        <a href="<?=$data['BusWebsite']?>">http://<?=$web_url['host']?></a>
                                    </p>

                                    <a href="/business/<?=$data['BusUrl']?>" class="btn btn-primary btn-lg btn-angle-left">דף האישי בקטלוג </a>
                                </div>

                                <div class="col-md-4 div-cell">

                                     <span class="tabs">
                                        <p class="tabs__caption">
                                            <a href="#" class="active"><?=$data['BusCity']?></a>
                                            <?if (!empty($data['BusDopAddress'])):?>
                                                <?foreach ($data['BusDopAddress'] as $key => $dop_adress_city):?>
                                                    <?if ($dop_adress_city['name'] != ''):?>
                                                        &nbsp; &nbsp; | &nbsp; &nbsp;
                                                        <a href="#"><?=$dop_adress_city['name']?></a>
                                                    <?endif?>
                                                <?endforeach?>
                                            <?endif?>
                                        </p>
                                        <span>
                                             <p class="tabs__content active">
                                                 Адрес: <?=$data['BusAddress']?><br/>
                                                 <?if ($data['BusTel'] != ''):?>
                                                     Тел: <?=$data['BusTel']?><br/>
                                                 <?endif?>

                                             </p>
                                            <?if (!empty($data['BusDopAddress'])):?>
                                                <?foreach ($data['BusDopAddress'] as $key => $dop_adress_address):?>

                                                    <span class="tabs__content">
                                                         Адрес: <?=isset($dop_adress_address['address']) ? $dop_adress_address['address'] : ''?><br/>
                                                         Тел: <?=isset($dop_adress_address['tel_dop_adress']) ? $dop_adress_address['tel_dop_adress'] : ''?><br/>

                                                     </span>
                                                <?endforeach?>
                                            <?endif?>
                                        </span>

                                      </span>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <hr/>

        <div class="panel panel-page-profile">

            <div class="panel-body">
                <div class="col-md-12">
                    <div class="div-table">

                        <div class="div-row">

                            <div class="col-md-4 col-sm-12 div-cell">
                                <div class="panel-heading">
                                    <div class="panel-title rtl pull-left">

                                        <strong>
                                            מידע על הדף
                                        </strong>

                                        <div>
                                            <small>
                                                <strong>
                                                    נכון לתאריך
                                                </strong>

                                                <?=date('d/m/Y')?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12 div-cell">
                                <div class="div-table counters">

                                    <div class="div-row">
                                        <div class="div-cell">ביקורים בדף:</div>
                                        <div class="div-cell"><strong><?=Rediset::getInstance()->get_business_all($data['BusId'])?></strong></div>
                                    </div>

                                    <div class="div-row">
                                        <div class="div-cell">הוסיפו למועדפים:</div>
                                        <div class="div-cell"><strong><?=Rediset::getInstance()->get_business_favor($data['BusId'])?></strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12 div-cell">
                                <div class="div-table counters">

                                    <div class="div-row">
                                        <div class="div-cell">בצפיות בקופון:</div>
                                        <div class="div-cell"><strong><?=Rediset::getInstance()->get_coupon_show($data['CoupArr'][0]['CoupId'])?></strong></div>
                                    </div>

                                    <div class="div-row">
                                        <div class="div-cell">הוסיפו למועדפים:</div>
                                        <div class="div-cell"><strong><?=Rediset::getInstance()->get_coupon($data['CoupArr'][0]['CoupId'])?></strong></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr/>

        <?if (!empty($data['CoupArr'])):?>
            <div class="panel panel-page-profile">
                <?foreach ($data['CoupArr'] as $rows_coup):?>
                    <div class="panel-body">

                        <div class="col-md-4 col-xs-12 rtl pull-left">
                            <div class="panel-heading">
                                <div class="panel-title rtl pull-left">

                                    <strong>
                                        קופון
                                    </strong>


                                    <div>
                                        <small>
                                            <strong>
                                                נכון לתאריך
                                            </strong>

                                            <?=date('d/m/Y',strtotime($rows_coup['DateOff']))?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4 col-sm-6 col-xs-12 rtl pull-left">

                            <div class="coupon coupon-big">

                                <div class="coupon-body">

                                    <div class="coupon-content">

                                        <div class="coupon-content-heading">
                                            <?=$data['BusName']?>
                                        </div>


                                        <img src="<?=$rows_coup['CoupImg']?>" width="155" height="125"  class="coupon-image"/>


                                    </div>

                                    <div class="coupon-sidebar">
                                        <div class="coupon-sidebar-content">
                                            <div class="coupon-sidebar-heading">
                                                <div class="coupon-object-top">

                                                    <div class="coupon-title">
                                                        <?=$rows_coup['CoupName']?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="coupon-sidebar-body">
                                                <div class="coupon-object-middle">

                                                    <div class="coupon-title">
                                                        <?=$rows_coup['CoupSecondname']?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="coupon-sidebar-footer">

                                                <div class="coupon-object-bottom">

                                                    <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_coup['DateOff']), 'j %MONTH% Y'); ?></small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                <?endforeach?>
            </div>

            <hr/>
        <?endif?>

        <?if (!empty($baners)):?>
            <div class="panel panel-page-profile">
                <?foreach ($baners as $row_baners):?>
                    <div class="panel-body">
                        <div class="col-md-4 col-xs-12 rtl pull-left">

                            <div class="panel-heading">
                                <div class="panel-title rtl pull-left">

                                    <strong>
                                        באנר
                                    </strong>

                                    <div>
                                        <small>
                                            <strong>
                                                נכון לתאריך
                                            </strong>

                                            <?=date('d/m/Y',strtotime($row_baners['date_end']))?>
                                        </small>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 rtl pull-left">
                                <div class="col-md-12 col-xs-12 ">

                                    <a href="#"><img src="<?=$row_baners['images']?>" class="img-responsive" style="margin-bottom: 5px"></a>

                                </div>
                        </div>
                    </div>
                <?endforeach?>
            </div>

            <hr/>
        <?endif?>

        <?if (!empty($data['ArticArr'])):?>
            <div class="panel panel-list panel-page-profile">

                <div class="panel-body">

                    <div class="col-md-4 col-xs-12 rtl pull-left">

                        <div class="panel-heading">
                            <div class="panel-title rtl pull-left">

                                <strong>
                                    מאמרים
                                </strong>


                            </div>
                        </div>

                    </div>

                    <div class="col-md-8 col-xs-12 rtl pull-left">

                        <div class="row ltr">
                            <div class="list list-media">
                                <?foreach ($data['ArticArr'] as $rows_artic):?>
                                    <div class="list-item">
                                        <div class="media">

                                            <div class="media-left">
                                                <a href="/article/<?=$rows_artic['ArticUrl']?>">
                                                    <img src="/uploads/img_articles/thumbs/<?=basename($rows_artic['ArticImage'])?>" width="260" height="190"
                                                         class="media-object"/>
                                                </a>
                                            </div>

                                            <div class="media-body">

                                                <h2 class="media-heading">
                                                    <a href="/article/<?=$rows_artic['ArticUrl']?>"><strong><?=$rows_artic['ArticName']?></strong></a>
                                                    <small><?=$rows_artic['ArticSecondName']?></small>
                                                </h2>

                                                <?=Text::limit_chars(strip_tags($rows_artic['ArticContent']), 300, null, true)?>
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

            <hr/>
        <?endif?>

        <div class="panel panel-page-profile">

            <div class="panel-body">

                <div class="col-md-4 col-xs-12 rtl pull-left">
                    <div class="panel-heading">
                        <div class="panel-title rtl pull-left">

                            <strong>
                                דיוורים שלך
                            </strong>

                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-xs-12 rtl  pull-left">

                    <div class="row">




                        <div class="col-md-4 col-sm-6 col-xs-12 pull-left">
                                <?if (!empty($subscribe)):?>
                                    <?foreach($subscribe as $row_subscribe):?>
                                        <div class="flag">

                                            <div class="flag-sidebar">
                                                <div class="flag-date">
                                                    <?=Date::rusdate(strtotime($row_subscribe['data']), 'j %MONTH% Y', 0, 'he')?>
            <!--                                        <di><strong>20</strong></di>-->
            <!--                                        <div>יולי</div>-->
            <!--                                        <di>2015</di>-->
                                                </div>
                                            </div>


                                            <div class="flag-context rtl">

                                                <a href="/newsletter/<?=$row_subscribe['id']?>">
                                                        <span class="flag-title">
                                                        דיוור
                                                        </span>
                                                    <small class="flag-description">
                                                        הנחות חדשות
                                                        חדשות החברה
                                                        זוכים
                                                    </small>

                                                </a>

                                            </div>


                                        </div>
                                    <?endforeach?>
                                <?endif?>

                        </div>




                    </div>

                </div>
            </div>
        </div>

    </div>
</content>


    <footer>
        <div class="panel panel-footer">

            <div class="panel-heading">

                <div class="col-md-7 col-sm-6">
                    <span class="icons logo white">TopIsrael</span>
                </div>



            </div>




        </div>
    </footer>
</div>
<div id="fb-root"></div>

</body>
</html>