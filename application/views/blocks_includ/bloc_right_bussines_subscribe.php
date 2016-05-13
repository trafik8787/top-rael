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


    <h2>Почтовая рассылка</h2>
    <p>Подпишитесь на рассылку новинок этого места и получайте первыми новые обзоры, новости и купоны со скидками. <br>Рассылка выходит при появлении новостей. </p>

    <form class="form-inline w-bloc-right-subscribe" role="form">


        <div class="form-group w-form-group">
            <input type="email" class="form-control w-input-email-subcribe"  name="email"  placeholder="Напишите ваш E-mail">
            <input type="hidden" name="subscribe_bussines" value="<?=$bussines_id?>">
        </div>

        <button value="1" type="submit" class="btn btn-primary w-subskrip-buton">Подписаться</button>


    </form>
<hr>


