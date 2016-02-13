<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.01.2016
 * Time: 21:32
 */

?>


<span style="direction: rtl;">

<!--p>
subject for mail:
הפעלת הבאנר באתר טופ ישראל
</p-->


<p>
שלום,
</p>

<p>
החל פרסום הבאנר באתר TopIsrael.
</p>

<p>
 משך הפרסום: החל מ <?=date('d/m/Y', strtotime($data['BanersDateStart']))?>

 ועד <?=date('d/m/Y', strtotime($data['BanersDateEnd']))?>
 
 </p>

<p> 
ניתן לצפות בבאנר בקטגוריות:
</p>

<? if (!empty($data['SECTION'])): ?>
    <? foreach ($data['SECTION'] as $row_s): ?>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_s['sectionUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_s['sectionUrl'] ?></a><br>
    <? endforeach ?>
<? endif ?>

<? if (!empty($data['CATEGORY'])): ?>
    <? foreach ($data['CATEGORY'] as $row_с): ?>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_с['categoryUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_с['categoryUrl'] ?></a><br>
    <? endforeach ?>
<? endif ?>

<p>
<hr>
</p>

<p>

לשאלות ובקשות פנה באמצעות הדוא"ל, לכתובת: top@topisrael.ru או חייג: 03-5604505

</p>


<p>
בכבוד רב,<br>
קבוצת מדיה טופ ישראל
 </p>
</span>