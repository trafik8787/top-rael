<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 08.09.2015
 * Time: 13:06
 */
HTML::x(Date::diffDay('', '2015-09-20'));
?>

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
                                    <div>
                                        <a href="#">
                                            הרצליה
                                        </a>
                                        &nbsp; | &nbsp;
                                        <a href="#">
                                            אשדוד
                                        </a>
                                        &nbsp; | &nbsp;
                                        <a href="#">
                                            חיפה
                                        </a>
                                    </div>

                                    <br/>

                                    <div>
                                        <div>
                                            כתובת:&nbsp; ארלוזורוב 39
                                        </div>

                                        <div>
                                            טלפון:&nbsp; 0547-555 777

                                        </div>

                                        <div>
                                            פתוח מ-&nbsp; 09:00 עד 18:00

                                        </div>

                                    </div>
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

                            <div class="col-md-4 div-cell">
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

                                                2015 יולי 22
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 div-cell">
                                <div class="div-table counters">

                                    <div class="div-row">
                                        <div class="div-cell">ביקורים בדף:</div>
                                        <div class="div-cell"><strong>3500</strong></div>
                                    </div>

                                    <div class="div-row">
                                        <div class="div-cell">הוסיפו למועדפים:</div>
                                        <div class="div-cell"><strong>3500</strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 div-cell">
                                <div class="div-table counters">

                                    <div class="div-row">
                                        <div class="div-cell">ביקורים בדף:</div>
                                        <div class="div-cell"><strong>3500</strong></div>
                                    </div>

                                    <div class="div-row">
                                        <div class="div-cell">הוסיפו למועדפים:</div>
                                        <div class="div-cell"><strong>3500</strong></div>
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

                                        2015 יולי 22
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?foreach ($data['CoupArr'] as $rows_coup):?>
                        <div class="col-md-4 col-xs-12 rtl pull-left">
                            <div class="coupon coupon-big">

<!--                                <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>-->

                                <div class="coupon-body">

                                    <div class="coupon-content">

                                        <div class="coupon-content-heading">
                                            <?=$data['BusName']?>
                                        </div>

                                        <img src="<?=$rows_coup['CoupImg']?>" width="155" height="125" alt="" title=""
                                             class="coupon-image"/>
                                    </div>

                                    <div class="coupon-sidebar">
                                        <div class="coupon-sidebar-content">
                                            <div class="coupon-sidebar-heading">
                                                <div class="coupon-object-top">

                                                    <div class="coupon-title">
                                                        Купон
                                                        <small class="block"><?=$rows_coup['CoupName']?></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="coupon-sidebar-body">
                                                <div class="coupon-object-middle">

                                                    <div class="coupon-title">
                                                        <?=$rows_coup['CoupSecondname']?>
                                                        <span class="block">скидка</span>
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
                    <?endforeach?>

                </div>
            </div>

            <hr/>
        <?endif?>

        <?if (!empty($baners)):?>
            <div class="panel panel-page-profile">

                <div class="panel-body">
                    <div class="col-md-4 rtl pull-left">

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

                                        2015 יולי 22
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>

                    <?foreach ($baners as $row_baners):?>
                        <div class="clearfix">
                            <div class="col-md-12 col-xs-12 ">

                                <a href="#"><img src="<?=$row_baners['images']?>" class="img-responsive" style="margin-bottom: 5px"></a>

                            </div>
                        </div>
                    <?endforeach?>
                </div>
            </div>

            <hr/>
        <?endif?>

        <?if (!empty($data['ArticArr'])):?>
            <div class="panel panel-list panel-page-profile">

                <div class="panel-body">

                    <div class="col-md-4 col-md-4 col-xs-12 rtl pull-left">

                        <div class="panel-heading">
                            <div class="panel-title rtl pull-left">

                                <strong>
                                    מאמרים
                                </strong>

                                <div>
                                    <small>
                                        <strong>
                                            נכון לתאריך
                                        </strong>

                                        2015 יולי 22
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-8 col-md-4 col-xs-12 rtl pull-left">

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

                <div class="col-md-4 col-md-4 col-xs-12 rtl pull-left">
                    <div class="panel-heading">
                        <div class="panel-title rtl pull-left">

                            <strong>
                                דיוורים שלך
                            </strong>

                            <div>
                                <small>
                                    <strong>
                                        נכון לתאריך
                                    </strong>

                                    2015 יולי 22
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-md-4 col-xs-12 rtl  pull-left">

                    <div class="row">

                        <div class="col-md-4 col-xs-12 rtl pull-left">
                            <div class="flag">

                                <div class="flag-sidebar">
                                    <div class="flag-date">
                                        <di><strong>20</strong></di>
                                        <div>יולי</div>
                                        <di>2015</di>
                                    </div>
                                </div>

                                <div class="flag-context rtl">

                                    <a href="#">
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
                        </div>

                        <div class="col-md-4 col-xs-12 rtl pull-left">
                            <div class="flag">

                                <div class="flag-sidebar">
                                    <div class="flag-date">
                                        <di><strong>20</strong></di>
                                        <div>יולי</div>
                                        <di>2015</di>
                                    </div>
                                </div>

                                <div class="flag-context rtl">

                                    <a href="#">
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
                        </div>

                        <div class="col-md-4 col-xs-12 pull-left">
                            <div class="flag">

                                <div class="flag-sidebar">
                                    <div class="flag-date">
                                        <di><strong>20</strong></di>
                                        <div>יולי</div>
                                        <di>2015</di>
                                    </div>
                                </div>

                                <div class="flag-context rtl">

                                    <a href="#">
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
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</content>