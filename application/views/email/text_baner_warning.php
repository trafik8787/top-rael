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
    תקופת הפרסום של באנר של העסק שלך באתר טופ ישראל עומדת להסתיים
    </p-->

<p> 
שלום!
</p>

<p>
תקופת הפרסום של באנר של העסק שלך באתר טופ ישראל עומדת להסתיים.
</p>

<p>
 נשארו 7 ימים בלבד עד הסיום.
</p>
<p>
 ניתן לראות את הבאנר במקומות הבאים באתר:
 <?=date('d/m/Y', strtotime($data['BanersDateEnd']))?>
 </p>

<p>
 תקופת פרסום הבאנר תסתיים בתאריך:
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
 תגדילו את כמות הלקוחות הרוסיים – האריכו את תקופת פרסום הבאנר!
 </strong></p>
<p> 
כעת יש לנו מחירים מיוחדים וכלים שיווקיים חדשים! 
</p>
<p>
    אנא פנו אלינו בטלפון: 052-5512121, 03-5604505 או במייל: top@topisrael.ru

</p>



<p>בכבוד רב, צוות האתר TopIsrael.ru</p>
</span>
    
   