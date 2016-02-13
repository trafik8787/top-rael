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
שלום,
</p>

<p>
תקופת פרסום הקופון באתר TopIsrael עומדת להסתיים.
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


<p><strong>
הגדל את קהל הלקוחות דוברי הרוסית שלך, פרסם קופון חדש! 
</strong></p>




<p>
        לשאלות ובקשות פנה באמצעות הדוא"ל, לכתובת: top@topisrael.ru או חייג: 03-5604505
    </p>

<p>
בכבוד רב,<br>
קבוצת מדיה טופ ישראל
 </p>

</span>

