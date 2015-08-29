<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 29.08.2015
 * Time: 23:18
 */
//die(HTML::x($data));
?>

<?foreach ($data as $rows_coupon):?>

    <div class="coupon-layer">
        <div class="coupon coupon-small">

            <?if (!empty($rows_coupon['coupon_favorit']))://если купон добавлен в избранное?>
                <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                    <i class="fa fa-thumb-tack"></i>
                </a>
            <?else:?>
                <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_coupon['id']?>" class="pin w-add-coupon-favor">
                    <i class="fa fa-thumb-tack"></i>
                </a>
            <?endif?>

            <div class="coupon-body">

                <div class="coupon-content">

                    <div class="coupon-content-heading">
                        <?=$rows_coupon['BusName']?>
                    </div>
                    <a href="/modalcoupon/<?=$rows_coupon['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image">
                        <img src="<?=$rows_coupon['img_coupon']?>" width="155" height="125" alt="" title=""/>
                    </a>

                </div>

                <div class="coupon-sidebar">
                    <div class="coupon-sidebar-content">
                        <div class="coupon-sidebar-heading">
                            <div class="coupon-object-top">

                                <div class="coupon-title">
                                    Купон
                                    <small class="block"><?=$rows_coupon['name']?></small>
                                </div>
                            </div>
                        </div>
                        <div class="coupon-sidebar-body">
                            <div class="coupon-object-middle">

                                <div class="coupon-title">
                                    20%
                                    <span class="block">скидка</span>
                                </div>
                            </div>
                        </div>
                        <div class="coupon-sidebar-footer">

                            <div class="coupon-object-bottom">

                                <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_coupon['dateoff']), 'j %MONTH% Y'); ?></small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?endforeach?>