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
Subject for mail:
התראה לסיום פרסום באתר טופ ישראל
</p-->

<p>
שלום,
</p>

<p>
תקופת פרסום העסק באתר TopIsrael עומדת להסתיים.
</p>

<p>
נותרו 7 ימים בלבד לסיום הפרסום!
</p>
<p>
לצפייה בעמוד העסק:
 <strong><a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?></a></strong></p>
<p>
מועד סיום הפרסום:
 <?=date('d/m/Y', strtotime($data['date_end']))?></p>



<p>
<hr>
</p>

<p><strong>
אל תאבד את קהל הלקוחות דוברי הרוסית שלך, חדש את חבילת הפרסום!
</strong></p>
<p>
לקבלת הצעה לחידוש פרסום העסק חייג: 052-5512121 - לאון ברסקי
<br>
או פנה באמצעות הדוא"ל, לכתובת: leon@topisrael.ru
    </p>

<p>
בכבוד רב,<br>
קבוצת מדיה טופ ישראל
 </p>

</span>
