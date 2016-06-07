<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.06.2016
 * Time: 18:22
 */

?>


<span>

     <? if (!empty($data['ArrBrif'])): ?>
         <p>загружен документ: Бриф</p>
     <? endif ?>

    <? if (!empty($data['ArrKvitanciy'])): ?>
        <p>загружен документ: Хешбонит</p>
    <? endif ?>

    <? if (!empty($data['ArrZacaz'])): ?>
        <p>загружен документ: Заказ</p>
    <? endif ?>

</span>
