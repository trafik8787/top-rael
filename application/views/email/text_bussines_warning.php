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
תקופת הפרסום של העסק שלך באתר טופ ישראל עומדת להסתיים
</p-->

<p>
 שלום!
</p>

<p>
 תקופת הפרסום של העסק שלך באתר טופ ישראל עומדת להסתיים
</p>

<p>
נשארו 7 ימים בלבד עד הסיום.
</p>
<p>
הנה עמוד העסק שלך באתר שלנו:
 <strong><a href="http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?></a></strong></p>
<p>
 הפרסום יסתיים בתאריך:
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
אם יהיו לך שאלות או בקשות, נא לפנות אלינו במייל: top@topisrael.ru או להתקשר בטלפון:
    03-5604505
    </p>

<p>בכבוד רב, צוות האתר TopIsrael.ru</p>
</span>
