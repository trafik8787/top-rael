<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.04.2016
 * Time: 12:06
 */

?>
<?if (!empty($data)):?>

    <div id="unit_86591"><a href="http://smi2.ru/">Новости smi2.ru</a></div>
    <script type="text/javascript" charset="utf-8">
        (function() {
            var sc = document.createElement('script'); sc.type = 'text/javascript'; sc.async = true;
            sc.src = '//smi2.ru/data/js/86591.js'; sc.charset = 'utf-8';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sc, s);
        }());
    </script>

    <div class="w-bloc-right">
        <h2>Новости</h2>

        <? foreach ($data as $row): ?>
            <hr>
            <div class="title-micronews"><a href="/business/<?=$row['BusUrl']?>"><?=$row['name'] ?></a></div>
            <p class="description-micronews"><?=$row['text'] ?></p>
        <? endforeach ?>


    </div>




    <div class="clearfix"></div>

<?endif?>