<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.01.2016
 * Time: 19:27
 */

?>

<p>Здравствуйте!</p>

<p>Реклама вашего баннера на сайте TopIsrael.ru скоро закончится.</p>

<p>До окончания осталось всего 7 дней!</p>
<p>Срок рекламы: до <?=date('d/m/Y', strtotime($data['BanersDateEnd']))?></p>

<p>Посмотреть баннер можно в разделах:</p>

<? if (!empty($data['SECTION'])): ?>
    <? foreach ($data['SECTION'] as $row_s): ?>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_s['sectionUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_s['sectionUrl'] ?></a><br>
    <? endforeach ?>
<? endif ?>

<? if (!empty($data['CATEGORY'])): ?>
    <? foreach ($data['CATEGORY'] as $row_с): ?>
        <a href="http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_с['categoryUrl'] ?>">http://<?=$_SERVER['HTTP_HOST']?>/section/<?=$row_с['categoryUrl'] ?></a><br>
    <? endforeach ?>
<? endif ?>

<p>--------------------------</p>

<p><strong>Получайте больше русскоязычных клиентов, продлите свой баннер!</strong></p>
<p>У нас для Вас особые цены и новые возможности!</p>
<p>Позвоните 052-5512121, 03-5604505 или напишите нам top@topisrael.ru.</p>
<p>С уважением, команда TopIsrael.ru</p>

<span style="direction: rtl;">
    <p>תקופת הפרסום של באנר של העסק שלך באתר טופ ישראל עומדת להסתיים</p>

    <p>
        שלום!<br>
        תקופת הפרסום של באנר של העסק שלך באתר טופ ישראל עומדת להסתיים.<br>
        נשארו 7 ימים בלבד עד הסיום.<br>
        ניתן לראות את הבאנר במקומות הבאים באתר:<br>
        תקופת פרסום הבאנר תסתיים בתאריך:<br>
    </p>

    <p>
    <hr>
    </p>

    <p>
        תגדילו את כמות הלקוחות הרוסיים – האריכו את תקופת פרסום הבאנר!<br>
        אנא פנו אלינו בטלפון: 052-5512121, 03-5604505 או במייל: top@topisrael.ru<br>

    </p>


    <p>בכבוד רב, צוות האתר TopIsrael.ru</p>

</span>