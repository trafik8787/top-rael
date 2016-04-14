<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 28.08.2015
 * Time: 15:53
 */
//HTML::x($data);
?>
<?if (!empty($data)):?>
    <div class="sidebar-services">

        <div class="sidebar-services-heading">
            <div class="sidebar-services-title">Наши преимущества и услуги</div>
        </div>

        <div class="sidebar-services-body">
            <ul class="sidebar-services-list">
                <?foreach($data as $row):?>
                    <li><i class="fa fa-check"></i> <?=$row?></li>
                <?endforeach?>
            </ul>
        </div>
        
        
        <button value="1" type="submit" class="btn btn-primary w-subskrip-buton order-party">Заказ торжества</button>

    </div>
<?endif?>