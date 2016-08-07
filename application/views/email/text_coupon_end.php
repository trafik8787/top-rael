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
ניתוק קופון 
</p-->




<p>
    <?=$data['UsersName'] ?> <?=$data['UsersSecondname'] ?>,
שלום רב!
</p>

<p>
תקופת פרסום הקופון באתר TopIsrael.ru הסתיימה.
</p>

<p>

מועד סיום הפרסום: <?=date('d/m/Y', strtotime($data['CouponsDateEnd']))?></p>

<p>
<hr>
</p>

<p>
הגדילו את קהל הלקוחות דוברי הרוסית 
<strong>
על ידי פרסום קופון חדש!
</strong></p>




<p>
לפרסום קופון חדש יש לחייג: 052-5512121 - לאון ברסקי
<br>
או לפנות באמצעות הדוא"ל: leon@topisrael.ru
    </p>

<p>
בברכה,
<br>
קבוצת מדיה טופ ישראל
 </p>

</span>
