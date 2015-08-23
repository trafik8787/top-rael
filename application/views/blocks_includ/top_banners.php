<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 20.08.2015
 * Time: 16:42
 */
//HTML::x($data);
?>
<?if (!empty($data)):?>
    <div class="discount">
        <div class="owl-carousel">
            <?foreach ($data as $rows):?>
                <?if ($rows['website'] == ''):?>
                    <a href="/business/<?=$rows['BusUrl']?>"><img src="<?=$rows['images']?>" width="1200" height="200" alt=""
                                 class="img-responsive"></a>
                <?else:?>
                    <a href="<?=$rows['website']?>"><img src="<?=$rows['images']?>" width="1200" height="200" alt=""
                                                                  class="img-responsive"></a>
                <?endif?>
            <?endforeach?>
        </div>
    </div>
<?endif?>