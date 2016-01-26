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
קופון של העסק שלך עלה לאתר טופ ישראל
</p-->



<p> 
שלום!
</p>

<p>
    קופון של העסק שלך עלה לאתר טופ ישראל TopIsrael.ru

</p>

<p>
 הקופון יהיה פעיל מ-
 <?=date('d/m/Y', strtotime($data['CouponsDateStart']))?> 
  ועד
  <?=date('d/m/Y', strtotime($data['CouponsDateEnd']))?></p>

<p>
ניתן לראות את הקופון בכתובת הבאה:
</p>

<p><strong><a href="http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?></a></strong></p>


<p>
<hr>
</p>


<p>
אם יהיו לך שאלות או בקשות, נא לפנות אלינו במייל: top@topisrael.ru או להתקשר בטלפון:
    03-5604505
    </p>

<p>בכבוד רב, צוות האתר TopIsrael.ru</p>
</span>
