<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 20.08.2015
 * Time: 16:42
 */

?>


<?if (!empty($data)):?>
    <div class="discount">
        <div class="owl-carousel">
            <?foreach ($data as $rows):?>
                <?if ($rows['website'] == ''):?>

                    <a href="/business/<?=$rows['BusUrl']?>" class="w-baner-click" data-id="<?=$rows['id']?>">
                        <? if ($rows['type_baners'] == 1): ?>
                            <img src="<?=$rows['images']?>" width="1200" height="200" alt="" class="img-responsive">
                        <?else:?>
                            <?
                            $un = unserialize($rows['images']);
                            echo htmlspecialchars_decode($un['html'])
                            ?>
                        <?endif?>

                    </a>
                <?else:?>
                    <a href="<?=$rows['website']?>" class="w-baner-click" data-id="<?=$rows['id']?>">
                        <? if ($rows['type_baners'] == 1): ?>
                            <img src="<?=$rows['images']?>" width="1200" height="200" alt="" class="img-responsive">
                        <?else:?>
                            <?
                            $un = unserialize($rows['images']);
                            echo htmlspecialchars_decode($un['html'])
                            ?>
                        <?endif?>
                    </a>
                <?endif?>
            <?endforeach?>
        </div>
    </div>
<?else:?>
    <div class="discount" style="text-align: center;">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Адаптивный -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-6089615049498543"
             data-ad-slot="5552405714"
             data-ad-format="auto"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
<?endif?>
