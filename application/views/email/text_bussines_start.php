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
החלת פרסום באתר טופ ישראל
</p-->


<p>
    <?=$data['name'] ?>,
שלום רב!
</p>

<p>
עמוד בית העסק שלך עלה לאתר TopIsrael.ru.

</p>

<p>
משך הפרסום: מיום    <?=date('d/m/Y', strtotime($data['date_create'])) ?>
   ועד ליום 
    <?=date('d/m/Y', strtotime($data['date_end']))?></p>

<p>
   לצפייה בעמוד העסק:
   <strong><a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?></a></strong></p>



<p><hr></p>


    <p>
לשינויים ועדכונים ניתן לפנות באמצעות הדוא"ל: top@topisrael.ru או בטלפון: 
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
