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
כרטיס העסק שלך עלה לאתר טופ-ישראל
</p-->


<p>
 שלום!
</p>

<p>
    כרטיס העסק שלך עלה לאתר טופ-ישראל TopIsrael.ru.

</p>

<p>
 תקופת הפרסום היא בין
 <?=date('d/m/Y', strtotime($data['date_create'])) ?> 
  ל-
  <?=date('d/m/Y', strtotime($data['date_end']))?></p>

<p> 
את כרטיס העסק שלך ניתן לראות בכתובת הבאה:
</p>

<p><strong><a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?></strong></p>



<p><hr></p>


<p>
אם יהיו לך שאלות או בקשות, נא לפנות אלינו במייל: top@topisrael.ru או להתקשר בטלפון:
    03-5604505
    </p>

<p>בכבוד רב, צוות האתר TopIsrael.ru</p>
</span>
