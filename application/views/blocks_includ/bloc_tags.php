<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.01.2016
 * Time: 15:09
 */
?>
<div class="w-bloc-right">
    <h2>Теги</h2>
    <? if (!empty($data)): ?>

        <? foreach ($data as $row): ?>
            <a href="/tags/<?=$row['url_tags'] ?>" class="button"><span><?=$row['name_tags'] ?></span></a>
        <? endforeach ?>

    <? endif ?>

</div>