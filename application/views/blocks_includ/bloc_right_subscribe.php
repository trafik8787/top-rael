<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 24.01.2016
 * Time: 17:28
 */

?>
<style>
    .popover.bottom > .arrow.errors-email:after {
        border-bottom-color: #FF7272!important;
    }

    .popover.bottom > .arrow.susses-email:after {
        border-bottom-color: greenyellow!important;
    }
</style>

<div class="w-bloc-right">
    <h2>Почтовая рассылка</h2>
    <p>Подпишитесь на рассылку новинок сайта и получайте первыми новые обзоры интересных мест и купоны со скидками. <br>Рассылка выходит один раз в неделю. </p>

    <form class="form-inline w-bloc-right-subscribe" role="form">


        <div class="form-group w-form-group">
            <input type="email" class="form-control w-input-email-subcribe"  name="email"  placeholder="Напишите ваш E-mail">
        </div>

        <button value="1" type="submit" class="btn btn-primary w-subskrip-buton">Подписаться</button>


    </form>

</div>
<hr>
<div class="clearfix"></div>

