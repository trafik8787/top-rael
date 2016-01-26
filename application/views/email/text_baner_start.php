<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.01.2016
 * Time: 21:32
 */

?>


<span style="direction: rtl;">

<!--p>
subject for mail:
הבאנר של העסק שלך עלה לאתר טופ ישראל
</p-->


<p>
  שלום!
</p>

<p>
 הבאנר של העסק שלך עלה לאתר טופ ישראל
</p>

<p>
הבאנר יהיה פעיל מ-<?=date('d/m/Y', strtotime($data['BanersDateStart']))?>

 ועד <?=date('d/m/Y', strtotime($data['BanersDateEnd']))?>
 
 </p>

<p> 
ניתן לראות את הבאנר במקומות הבאים באתר:
</p>

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

<p>
<hr>
</p>

<p>

    אנא פנו אלינו בטלפון: 052-5512121, 03-5604505 או במייל: top@topisrael.ru

</p>


<p>בכבוד רב, צוות האתר TopIsrael.ru</p>
</span>