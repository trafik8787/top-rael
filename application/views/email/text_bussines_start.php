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
    שלום!
</p>

<p>
פרסום העסק באתר TopIsrael החל.

</p>

<p>
    תקופת הפרסום היא בין
    <?=date('d/m/Y', strtotime($data['date_create'])) ?>
    ל-
    <?=date('d/m/Y', strtotime($data['date_end']))?></p>

<p>
    את כרטיס העסק שלך ניתן לראות בכתובת הבאה:
</p>

<p><strong><a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?></a></strong></p>



<p><hr></p>


    <p>
        לשאלות ובקשות פנה באמצעות הדוא"ל, לכתובת: top@topisrael.ru או חייג: 03-5604505

    </p>

<p>
בכבוד רב,<br>
קבוצת מדיה טופ ישראל
 </p>
</span>
