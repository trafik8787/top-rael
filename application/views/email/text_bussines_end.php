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
הפסקת פרסום
<p-->


<p>
    <?=$data['name'] ?>,
שלום רב!
</p>


<p>
תקופת הפרסום באתר TopIsrael.ru הסתיימה.
</p>


<p>
מועד סיום הפרסום:  <?=date('d/m/Y', strtotime($data['date_end']))?></p>


<p>
<hr>
</p>

<p>
הגדילו את קהל הלקוחות דוברי הרוסית על ידי 
<strong>
חידוש הפרסום באתר TopIsrael!
</strong></p>
<p>
לקבלת הצעה לחידוש הפרסום יש לחייג: 052-5512121 - לאון ברסקי
<br>
או לפנות באמצעות הדוא"ל: leon@topisrael.ru

</p>


<p>
בברכה,<br>
קבוצת מדיה טופ ישראל
 </p>
</span>