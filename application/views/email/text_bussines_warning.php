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
    <?=$data['UsersName'] ?> <?=$data['UsersSecondname'] ?>,
שלום רב!
</p>


<p>
תקופת הפרסום באתר TopIsrael.ru עומדת להסתיים.
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

<p>
אל תאבדו את קהל הלקוחות דוברי הרוסית, 
<strong>
חדשו את הפרסום באתר TopIsrael.ru!
</strong></p>
<p>
לקבלת הצעה לחידוש הפרסום יש לחייג: 052-5512121 –לאון ברסקי
<br>
או לפנות באמצעות הדוא"ל: leon@topisrael.ru
    </p>

<p>
בברכה,<br>
קבוצת מדיה טופ ישראל
 </p>

</span>
