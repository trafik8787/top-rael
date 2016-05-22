<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.01.2016
 * Time: 19:58
 */

?>

<span style="direction: rtl;">

<!--p>
subject for mail:
התראה לסיום פרסום הקופון
</p-->


<p>
<!--name-->,
שלום רב!
</p>


<p>
תקופת פרסום הקופון באתר TopIsrael.ru עומדת להסתיים.
</p>
<p>
נותרו 7 ימים בלבד לסיום הפרסום!
</p>

<p>
לצפייה בקופון:
 <strong><a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?></a></strong></p>

<p>
מועד סיום הפרסום:
 <?=date('d/m/Y', strtotime($data['CouponsDateEnd']))?></p>

<p>
<hr>
</p>


<p>
הגדילו את קהל הלקוחות דוברי הרוסית, 
<strong>
פרסמו קופון חדש! 
</strong></p>




<p>
לפרסום קופון חדש יש לחייג: 052-5512121 - לאון ברסקי
<br>
או לפנות באמצעות הדוא"ל: leon@topisrael.ru
    </p>

<p>
בברכה,<br>
קבוצת מדיה טופ ישראל
 </p>

</span>

