<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.08.2015
 * Time: 14:32
 */

?>

<?if (!empty($content)):?>

    <div class="sidebar-coupons">

        <div class="sidebar-coupons-heading">
            <div class="sidebar-coupons-title">Купоны</div>
        </div>
        <?foreach ($content as $row):?>
            <div class="sidebar-coupons-body">
                <div class="coupon">
                    <div class="coupon-container">

                        <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                        <div class="coupon-image">
                            <div class="overlay">
                                Каббалистические украшения Haari
                            </div>

                            <img src="<?=$row['CoupImg']?>" width="155" height="125" alt="" title=""/>
                        </div>

                        <div class="coupon-context">
                            <div>
                                <span>Купон</span>
                                <span><small>Массаж</small></span>
                            </div>

                            <div>
                                <span>20%</span>
                                <span><small>скидка</small></span>
                            </div>

                            <div>
                                <small class="coupon-date">до 1 Апр 2015</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?endforeach?>

    </div>

<?endif?>