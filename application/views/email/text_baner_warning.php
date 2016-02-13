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
שלום,
</p>

<p>
תקופת פרסום הבאנר באתר TopIsrael עומדת להסתיים.
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
    
    
    
    
<p><strong>
הגדל את קהל הלקוחות דוברי הרוסית שלך על ידי חידוש פרסום הבאנר!
 </strong></p>
<p> 
לקבלת הצעה לחידוש פרסום הבאנר חייג: 052-5512121 - לאון ברסקי
<br>
או פנה באמצעות הדוא"ל, לכתובת: leon@topisrael.ru
</p>



<p>
בכבוד רב,<br>
קבוצת מדיה טופ ישראל
 </p>
</span>
    
   