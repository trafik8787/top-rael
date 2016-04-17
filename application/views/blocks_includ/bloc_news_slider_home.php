<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 17.04.2016
 * Time: 23:32
 */

?>
<?if (!empty($data)):?>
    <div class="panel panel-micronews gallery w-bloc-micronews">

        <div class="panel-heading">

            <div class="panel-title">Новости</div>

        </div>

        <div class="panel-body">
            <div class="owl-carousel w-micronews-carusel">


                <?foreach ($data as $row):?>

                    <div class="micronews-layer">
                        <div class="micronews micronews-small">
                            <div class="micronews-body">

                                <div class="micronews-content">

                                    <div class="micronews-title"><a href="/business/RZR_extrim_dead_sea">RZR на Мертвом море</a></div>
                                    <div class="micronews-text">Остались последние места для самостоятельной семейной прогулки на квадроциклах в дни Песаха. Поспешите записаться по телефону: 054-4980941. Условие: наличие водительских прав.</div>

                                </div>

                            </div>
                        </div>
                    </div>

                <?endforeach?>


            </div>
        </div>

    </div>
<?endif?>