<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.01.2016
 * Time: 19:27
 */

?>

<p>Здравствуйте!</p>

<p>Реклама вашего бизнеса включена на сайте TopIsrael.ru.</p>

<p>Срок рекламы: с <?=date('d/m/Y', strtotime($data['date_create'])) ?> по <?=date('d/m/Y', strtotime($data['date_end']))?></p>

<p>Посмотреть страницу вашего бизнеса можно по адресу</p>

<p><strong>http://<?=$_SERVER['HTTP_HOST']?>/business/<?=$data['url'] ?></strong></p>

<p>--------------------------</p>

<p>Если у вас есть вопросы или пожелания, пишите на top@topisrael.ru или звоните на
03-5604505</p>

<p>С уважением, команда TopIsrael.ru</p>


<p>כרטיס העסק שלך עלה לאתר טופ-ישראל</p>



<p>שלום!
    כרטיס העסק שלך עלה לאתר טופ-ישראל TopIsrael.ru.
    תקופת הפרסום היא בין ל-
    את כרטיס העסק שלך ניתן לראות בכתובת הבאה:</p>

<p><hr></p>


<p>אם יהיו לך שאלות או בקשות, נא לפנות אלינו במייל: top@topisrael.ru או להתקשר בטלפון:
    03-5604505</p>

<p>בכבוד רב, צוות האתר TopIsrael.ru</p>
