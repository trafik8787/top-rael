<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 17.04.2016
 * Time: 23:32
 */
//HTML::x($data);
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

                                    <div class="micronews-title"><a href="/business/<?=$row['BusUrl']?>"><?=$row['name'] ?></a></div>
                                    <div class="micronews-text"><?=$row['text'] ?></div>

                                </div>

                            </div>
                        </div>
                    </div>

                <?endforeach?>


            </div>
        </div>

    </div>
<?endif?>