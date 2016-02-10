<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.02.2016
 * Time: 14:24
 */

?>

<div class="row w-baner-top-row">
    <div class="col-md-3 hidden-xs w-baner-top-logo">
        <img src="<?=$data['logo']?>" alt="">
    </div>
    <div class="col-md-9 col-xs-12 w-baner-top-bagraunt">
        <img class="w-baner-html-dom" src="<?=$data['images']?>" width="900" height="240" alt="">
        <div class="w-baner-top-opacity-bloc">
            <span><?=$data['text_banners']?></span>
        </div>
    </div>
</div>
