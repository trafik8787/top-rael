<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.06.2016
 * Time: 18:22
 */

?>


<span>

    <? if (!empty($data['ArrArticle'])): ?>
        <p>Новыe обзоры:</p>
        <? foreach ($data['ArrArticle'] as $row): ?>
            <p><a href="<?=HTML::HostSite('/article/'.$row) ?>"><?=HTML::HostSite('/article/'.$row) ?></a></p>
        <? endforeach ?>

    <? endif ?>

    <? if (!empty($data['ArrNews'])): ?>
        <p>Oпубликована новость</p>
    <? endif ?>

    <? if (!empty($data['ArrLotery'])): ?>
        <p>Oпубликована лотерея с призом</p>
    <? endif ?>

</span>
