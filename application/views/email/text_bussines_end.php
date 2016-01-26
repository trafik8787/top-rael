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
תקופת הפרסום של העסק שלך באתר טופ ישראל הסתיימה
<p-->


<p>
 שלום!
</p>

<p>
תקופת הפרסום של העסק שלך באתר טופ ישראל הסתיימה.
</p>

<p>
  עמוד העסק שלך אינו פעיל יותר:

 <strong>http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?></strong></p>
<p>
  הפרסום הסתיים בתאריך:
 <?=date('d/m/Y', strtotime($data['date_end']))?></p>


<p>
<hr>
</p>

<p><strong>
 אל תאבדו את הלקוחות הרוסיים, האריכו את תקופת הפרסום באתר!
</strong></p>
<p>
 כרגע יש לנו מחירים מיוחדים וכלים שיווקיים חדשים!
</p>
<p>
    אנא פנו אלינו בטלפון: 052-5512121, 03-5604505 או במייל: top@topisrael.ru

</p>


<p>בכבוד רב, צוות האתר TopIsrael.ru</p>
</span>