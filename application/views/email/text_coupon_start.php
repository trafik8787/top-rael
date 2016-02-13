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
הפעלת קופון באתר טופ ישראל
</p-->



<p> 
שלום,
</p>

<p>
פרסום הקופון באתר TopIsrael החל.
</p>

<p>
משך הפרסום: החל מ 
 <?=date('d/m/Y', strtotime($data['CouponsDateStart']))?> 
  ועד
  <?=date('d/m/Y', strtotime($data['CouponsDateEnd']))?></p>

<p>
למעבר לצפייה בקופון לחץ על הקישור:
</p>

<p><strong><a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?></a></strong></p>


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
