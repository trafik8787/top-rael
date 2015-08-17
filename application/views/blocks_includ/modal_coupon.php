<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.08.2015
 * Time: 16:07
 */
//die(HTML::x($data));
?>

<div class="w-print-coupon">

    <div class="row">
        <div class="col-md-8" style="float: left; width: 400px">
            <img src="<?=$data[0]['img_coupon']?>" width="400" alt=""/>
            <div class="w-logo-bus">
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="<?=$data[0]['BusLogo']?>">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?=$data[0]['BusName']?></h4>
                        <?=Text::limit_chars(strip_tags($data[0]['info']), 150, null, true)?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="float: right; width: 220px;">
            <span>logo</span><br/>
            <strong><?=$data[0]['name']?></strong><br/>
            <?=Date::rusdate(strtotime($data[0]['dateoff']), 'j %MONTH% Y'); ?>
        </div>
    </div>

    
</div>

<div class="modal-footer">
    <?if (empty($data[0]['coupon_favorit'])):?>
        <button type="button" data-id="<?=$data[0]['id']?>" class="btn btn-primary w-add-coupon-favor" data-dismiss="modal">Сохранить</button>
    <?endif?>
    <button type="button" class="btn btn-primary w-button-print">Распечатать</button>
    <button type="button" class="btn btn-primary">Открыть на телефоне</button>
</div>