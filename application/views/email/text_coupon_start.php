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
    <?=$data['BusName'] ?>,
שלום רב!
</p>

<p>
הקופון עלה לאתר TopIsrael.ru.
</p>

<p>
משך הפרסום: מיום
 <?=date('d/m/Y', strtotime($data['CouponsDateStart']))?> 
ועד ליום
  <?=date('d/m/Y', strtotime($data['CouponsDateEnd']))?></p>

<p>
למעבר לצפייה בקופון: 
<a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?></a>
</p>

<p><strong>חשוב מאוד:
</strong>
<br>
יש ליידע את הצוות בנוגע לקופון!
</p>


<p>
<hr>
</p>


<p>
לשינוי או עדכון הקופון ניתן לפנות באמצעות הדוא"ל: top@topisrael.ru או בטלפון: 
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
