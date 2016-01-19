<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.01.2016
 * Time: 19:58
 */

?>

<p>Здравствуйте!</p>

<p>Реклама вашего купона включена на сайте TopIsrael.ru.</p>

<p>Срок купона: с <?=date('d/m/Y', strtotime($data['CouponsDateStart']))?> по <?=date('d/m/Y', strtotime($data['CouponsDateEnd']))?></p>

<p>Посмотреть купон можно по адресу</p>

<p><strong>http://<?=$_SERVER['HTTP_HOST']?>/coupon/<?=$data['CouponsUrl'] ?></strong></p>

<p>--------------------------</p>


<p>Если у вас есть вопросы или пожелания, пишите на top@topisrael.ru или звоните на
    03-5604505</p>

<p>С уважением, команда TopIsrael.ru</p>

<p>קופון של העסק שלך עלה לאתר טופ ישראל</p>

<p>שלום!
    קופון של העסק שלך עלה לאתר טופ ישראל TopIsrael.ru</p>


<p>הקופון יהיה פעיל מ- ועד</p>
<p>ניתן לראות את הקופון בכתובת הבאה:</p>

<p>
<hr>
</p>

<p>אם יהיו לך שאלות או בקשות, נא לפנות אלינו במייל: top@topisrael.ru או להתקשר בטלפון:
    03-5604505</p>

<p>בכבוד רב, צוות האתר TopIsrael.ru</p>