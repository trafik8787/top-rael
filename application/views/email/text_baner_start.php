<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.01.2016
 * Time: 21:32
 */

?>

<p>Здравствуйте!</p>

<p>Реклама вашего баннера включена на сайте TopIsrael.ru.</p>

<p>Срок рекламы: с <?=date('d/m/Y', strtotime($data['BanersDateStart']))?> по <?=date('d/m/Y', strtotime($data['BanersDateEnd']))?></p>

<p>Посмотреть баннер можно в разделах:</p>

<? if (!empty($data['SECTION'])): ?>
    <? foreach ($data['SECTION'] as $row_s): ?>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_s['sectionUrl'] ?>"></a><br>
    <? endforeach ?>
<? endif ?>

<? if (!empty($data['CATEGORY'])): ?>
    <? foreach ($data['CATEGORY'] as $row_с): ?>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/<?=$row_с['categoryUrl'] ?>"></a><br>
    <? endforeach ?>
<? endif ?>

<p>--------------------------</p>


<p>Если у вас есть вопросы или пожелания, пишите на top@topisrael.ru или звоните на
    03-5604505</p>

<p>С уважением, команда TopIsrael.ru</p>

<p>הבאנר של העסק שלך עלה לאתר טופ ישראל</p>

<p>שלום!
    הבאנר של העסק שלך עלה לאתר טופ ישראל</p>

<p>הבאנר יהיה פעיל מ- ועד</p>

<p>ניתן לראות את הבאנר במקומות הבאים באתר:</p>

<p>
<hr>
</p>

<p>אם יהיו לך שאלות או בקשות, נא לפנות אלינו במייל: top@topisrael.ru או להתקשר בטלפון:
    03-5604505</p>


<p>בכבוד רב, צוות האתר TopIsrael.ru</p>