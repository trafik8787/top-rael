<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 26.08.2015
 * Time: 15:42
 */

?>

<?foreach($data_coupon as $rows_data):?>
    <div class="clearfix">
        <div class="col-sm-4">
            <div class="coupon coupon-big">

                <?if (!empty($rows_data[0]['coupon_favorit']))://если купон добавлен в избранное?>
                    <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin">
                        <i class="fa fa-thumb-tack" style="color: #E44F44"></i>
                    </a>
                <?else:?>
                    <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data[0]['id']?>" title="Добавить в Личный кабинет" class="pin w-add-coupon-favor">
                        <i class="fa fa-thumb-tack"></i>
                    </a>
                <?endif?>

                <div class="coupon-body">

                    <div class="coupon-content">

                        <div class="coupon-content-heading">
                            <?=$rows_data[0]['BusName']?>
                        </div>

                        <a href="/modalcoupon/<?=$rows_data[0]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image">
                            <img src="<?=$rows_data[0]['img_coupon']?>"  alt="<?=$rows_data[0]['BusName']?>" title="Посмотреть полный купон"/>
                        </a>

                    </div>
                    <a href="/modalcoupon/<?=$rows_data[0]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image" title="Посмотреть полный купон">
                        <div class="coupon-sidebar">
                            <div class="coupon-sidebar-content">
                                <div class="coupon-sidebar-heading">
                                    <div class="coupon-object-top">

                                        <div class="coupon-title">
                                            <?=$rows_data[0]['name']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="coupon-sidebar-body">
                                    <div class="coupon-object-middle">

                                        <div class="coupon-title">
                                            <?=$rows_data[0]['secondname']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="coupon-sidebar-footer">

                                    <div class="coupon-object-bottom">

                                        <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_data[0]['dateoff']), 'j %MONTH% Y'); ?></small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?if (!empty($rows_data[1])):?>
            <div class="col-sm-4">
                <div class="coupon coupon-big">

                    <?if (!empty($rows_data[1]['coupon_favorit']))://если купон добавлен в избранное?>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin">
                            <i class="fa fa-thumb-tack" style="color: #E44F44"></i>
                        </a>
                    <?else:?>
                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data[1]['id']?>" title="Добавить в Личный кабинет" class="pin w-add-coupon-favor">
                            <i class="fa fa-thumb-tack"></i>
                        </a>
                    <?endif?>

                    <div class="coupon-body">

                        <div class="coupon-content">

                            <div class="coupon-content-heading">
                                <?=$rows_data[1]['BusName']?>
                            </div>

                            <a href="/modalcoupon/<?=$rows_data[1]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image">
                                <img src="<?=$rows_data[1]['img_coupon']?>" alt="<?=$rows_data[1]['name']?>" title="Посмотреть полный купон"/>
                            </a>
                        </div>
                        <a href="/modalcoupon/<?=$rows_data[1]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image" title="Посмотреть полный купон">
                            <div class="coupon-sidebar">
                                <div class="coupon-sidebar-content">
                                    <div class="coupon-sidebar-heading">
                                        <div class="coupon-object-top">

                                            <div class="coupon-title">
                                                <?=$rows_data[1]['name']?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="coupon-sidebar-body">
                                        <div class="coupon-object-middle">

                                            <div class="coupon-title">
                                                <?=$rows_data[1]['secondname']?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="coupon-sidebar-footer">

                                        <div class="coupon-object-bottom">

                                            <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_data[1]['dateoff']), 'j %MONTH% Y'); ?></small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?endif?>

        <?if (!empty($rows_data[2])):?>
            <div class="col-sm-4">
                <div class="coupon coupon-big">

                    <?if (!empty($rows_data[2]['coupon_favorit']))://если купон добавлен в избранное?>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin">
                            <i class="fa fa-thumb-tack" style="color: #E44F44"></i>
                        </a>
                    <?else:?>
                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data[2]['id']?>" title="Добавить в Личный кабинет" class="pin w-add-coupon-favor">
                            <i class="fa fa-thumb-tack"></i>
                        </a>
                    <?endif?>

                    <div class="coupon-body">

                        <div class="coupon-content">

                            <div class="coupon-content-heading">
                                <?=$rows_data[2]['BusName']?>
                            </div>

                            <a href="/modalcoupon/<?=$rows_data[2]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image">
                                <img src="<?=$rows_data[2]['img_coupon']?>" alt="<?=$rows_data[2]['name']?>" title="Посмотреть полный купон"/>
                            </a>
                        </div>
                        <a href="/modalcoupon/<?=$rows_data[2]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image" title="Посмотреть полный купон">
                            <div class="coupon-sidebar">
                                <div class="coupon-sidebar-content">
                                    <div class="coupon-sidebar-heading">
                                        <div class="coupon-object-top">

                                            <div class="coupon-title">
                                                <?=$rows_data[2]['name']?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="coupon-sidebar-body">
                                        <div class="coupon-object-middle">

                                            <div class="coupon-title">
                                                <?=$rows_data[2]['secondname']?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="coupon-sidebar-footer">

                                        <div class="coupon-object-bottom">

                                            <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_data[2]['dateoff']), 'j %MONTH% Y'); ?></small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?endif?>
    </div>

    <br/>
<?endforeach?>