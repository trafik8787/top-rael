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
    <?=$data['UsersName'] ?> <?=$data['UsersSecondname'] ?>,
שלום רב!
</p>

<p>
הבאנר עלה לאתר TopIsrael.ru.
</p>

<p>
 משך הפרסום: מיום <?=date('d/m/Y', strtotime($data['BanersDateStart']))?>

 ועד ליום  <?=date('d/m/Y', strtotime($data['BanersDateEnd']))?>
 
 </p>

<p> 
למעבר לצפייה בבאנר:


<? if (!empty($data['SECTION'])): ?>
    <? foreach ($data['SECTION'] as $row_s): ?>
    <br>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_s['sectionUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_s['sectionUrl'] ?></a>
    <? endforeach ?>
<? endif ?>

<? if (!empty($data['CATEGORY'])): ?>
    <? foreach ($data['CATEGORY'] as $row_с): ?>
    <br>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_с['categoryUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_с['categoryUrl'] ?></a>
    <? endforeach ?>
<? endif ?>
</p>

<p>
<hr>
</p>

<p>

לשאלות ובקשות ניתן לפנות באמצעות הדוא"ל: top@topisrael.ru או בטלפון: 
<nobr>
03-5604505
</nobr>

</p>


<p>
בברכה,
<br>
קבוצת מדיה טופ ישראל
 </p>
</span>