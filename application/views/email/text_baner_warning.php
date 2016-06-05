<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.01.2016
 * Time: 19:27
 */

?>


<span style="direction: rtl;">

<!--p>
subject for mail:
התראה לסיום פרסום באנר
    </p-->

<p>
    <?=$data['BusName'] ?>,
שלום רב!
</p>


<p>
תקופת פרסום הבאנר באתר TopIsrael.ru עומדת להסתיים.
</p>

<p>
נותרו 7 ימים בלבד לסיום הפרסום!
</p>
<p>
מועד סיום הפרסום: 
 <?=date('d/m/Y', strtotime($data['BanersDateEnd']))?>
 </p>

<p>
ניתן לצפות בבאנר בקטגוריות:


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
הגדילו את קהל הלקוחות דוברי הרוסית 
<strong>
על ידי חידוש פרסום הבאנר!
 </strong></p>
<p> 
לקבלת הצעה לחידוש פרסום הבאנר יש לחייג: 052-5512121 - לאון ברסקי
<br>
או לפנות באמצעות הדוא"ל, לכתובת: leon@topisrael.ru
</p>



<p>
בברכה,<br>
קבוצת מדיה טופ ישראל
 </p>
</span>
    
   