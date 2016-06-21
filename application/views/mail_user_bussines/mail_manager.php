<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.06.2016
 * Time: 18:22
 */

?>


<div style="direction:rtl">


שלום!

<p title="news">
באתר שלנו עלה תוכן חדש הקשור לעסק שלך.
</p>

<span>

    <? if (!empty($data['ArrArticle'])): ?>
        <p>פורסמה סקירה 
</p>
        <? foreach ($data['ArrArticle'] as $row): ?>
            <p><a href="<?=HTML::HostSite('/article/'.$row) ?>"><?=HTML::HostSite('/article/'.$row) ?></a></p>
        <? endforeach ?>

    <? endif ?>

    <? if (!empty($data['ArrNews'])): ?>
        <p>פורסמה ידיעה 
</p>
    <? endif ?>

    <? if (!empty($data['ArrLotery'])): ?>
        <p>החלה הגרלה בה העסק שלך הוא נותן חסות ראשי 
</p>
    <? endif ?>

</span>

</div>
