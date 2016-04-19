<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.04.2016
 * Time: 12:06
 */

?>
<?if (!empty($data)):?>

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