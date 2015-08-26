<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 26.08.2015
 * Time: 15:42
 */

?>

<?foreach($data_coupon as $rows_data):?>
    <div class="row">
        <div class="col-md-6">

            <div class="coupon">
                <div class="coupon-container">
                    <?if (!empty($rows_data[0]['coupon_favorit']))://если купон добавлен в избранное?>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                            <i class="fa fa-thumb-tack"></i>
                        </a>
                    <?else:?>
                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data[0]['id']?>" class="pin w-add-coupon-favor">
                            <i class="fa fa-thumb-tack"></i>
                        </a>
                    <?endif?>


                    <div class="coupon-image">
                        <div class="overlay">
                            <?=$rows_data[0]['BusName']?>
                        </div>
                        <a href="/modalcoupon/<?=$rows_data[0]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm">
                            <img src="<?=$rows_data[0]['img_coupon']?>" width="155" height="125" alt=""
                                 title=""/></a>
                    </div>

                    <div class="coupon-context">

                        <div class="fz large"><strong><?=$rows_data[0]['name']?></strong></div>
                        <small><?=$rows_data[0]['secondname']?></small>

                        <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_data[0]['dateoff']), 'j %MONTH% Y'); ?></small>
                    </div>
                </div>
            </div>
        </div>
        <?if (!empty($rows_data[1])):?>
            <div class="col-md-6">

                <div class="coupon">
                    <div class="coupon-container">

                        <?if (!empty($rows_data[1]['coupon_favorit']))://если купон добавлен в избранное?>
                            <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                                <i class="fa fa-thumb-tack"></i>
                            </a>
                        <?else:?>
                            <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data[1]['id']?>" class="pin w-add-coupon-favor">
                                <i class="fa fa-thumb-tack"></i>
                            </a>
                        <?endif?>

                        <div class="coupon-image">
                            <div class="overlay">
                                <?=$rows_data[1]['BusName']?>
                            </div>
                            <a href="/modalcoupon/<?=$rows_data[1]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm">
                                <img src="<?=$rows_data[1]['img_coupon']?>"  width="155" height="125" alt=""
                                     title=""/></a>
                        </div>

                        <div class="coupon-context">

                            <div class="fz large"><strong><?=$rows_data[1]['name']?></strong></div>
                            <small><?=$rows_data[1]['secondname']?></small>

                            <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_data[1]['dateoff']), 'j %MONTH% Y'); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?endif?>
    </div>

    <br/>
<?endforeach?>