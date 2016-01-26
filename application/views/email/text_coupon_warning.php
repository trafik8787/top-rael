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
תקופת הפרסום של קופון העסק שלך באתר טופ ישראל עומדת להסתיים
</p-->


<p>  
שלום!
</p>

<p>
תקופת הפרסום של קופון העסק שלך באתר טופ ישראל עומדת להסתיים
</p>
<p>
נשאר 7 ימים בלבד עד הסיום.
</p>

<p>
 ניתן לראות את הקופון בכתובת הבאה:
 <strong><a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?></a></strong></p>

<p>
 תקופת פרסום הקופון תסתיים בתאריך:
 <?=date('d/m/Y', strtotime($data['CouponsDateEnd']))?></p>

<p>
<hr>
</p>


<p><strong>
תגדילו את כמות הלקוחות הרוסיים – האריכו את תקופת פרסום הבאנר!
</strong></p>




<p>
אם יהיו לך שאלות או בקשות, נא לפנות אלינו במייל: top@topisrael.ru או להתקשר בטלפון:
    03-5604505
    </p>

<p>בכבוד רב, צוות האתר TopIsrael.ru</p>
</span>

