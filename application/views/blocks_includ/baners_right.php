<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 09.08.2015
 * Time: 18:07
 */
?>
<?if (!empty($data)):?>
    <div class="discount">
        <div class="owl-carousel">
            <?foreach ($data as $rows):?>
                <?if ($rows['website'] == ''):?>
                    <a href="/business/<?=$rows['BusUrl']?>"><img src="<?=$rows['images']?>" width="360" height="300" alt=""
                                                                  class="img-responsive"></a>
                <?else:?>
                    <a href="<?=$rows['website']?>"><img src="<?=$rows['images']?>" width="360" height="300" alt=""
                                                         class="img-responsive"></a>
                <?endif?>
            <?endforeach?>
        </div>
    </div>
<?endif?>