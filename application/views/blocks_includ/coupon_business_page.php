<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.08.2015
 * Time: 14:32
 */
//HTML::x($content);
?>

<?if (!empty($content)):?>


    <div class="sidebar-coupons w-bussines-coupons">

        <div class="sidebar-coupons-heading">
            <div class="sidebar-coupons-title">Купоны</div>
        </div>
        <?foreach ($content as $row):?>
            <div class="sidebar-coupons-body">

                <div class="coupon coupon-big">

                    <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                    <?if (!empty($row['coupon_favorit']))://если купон добавлен в избранное?>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin">
                            <i class="fa fa-thumb-tack" style="color: #E44F44"></i>
                        </a>
                    <?else:?>
                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$row['CoupId']?>" class="pin w-add-coupon-favor">
                            <i class="fa fa-thumb-tack"></i>
                        </a>
                    <?endif?>


                    <div class="coupon-body">

                        <div class="coupon-content">

                            <div class="coupon-content-heading">
                                <?=$BusName?>
                            </div>
                            <a href="/modalcoupon/<?=$row['CoupId']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image">
                                <img src="<?=$row['CoupImg']?>" alt="<?=$BusName?>" title="Посмотреть полный купон"/>
                            </a>
                        </div>
                        <a href="/modalcoupon/<?=$row['CoupId']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image" title="Посмотреть полный купон">
                            <div class="coupon-sidebar">
                                <div class="coupon-sidebar-content">
                                    <div class="coupon-sidebar-heading">
                                        <div class="coupon-object-top">

                                            <div class="coupon-title">
                                                <?=$row['CoupName']?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="coupon-sidebar-body">
                                        <div class="coupon-object-middle">

                                            <div class="coupon-title">
                                                <?=$row['CoupSecondname']?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="coupon-sidebar-footer">

                                        <div class="coupon-object-bottom">

                                            <small class="coupon-date">до <?=Date::rusdate(strtotime($row['DateOff']), 'j %MONTH% Y'); ?></small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?endforeach?>
    </div>


<?endif?>