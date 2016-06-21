<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.06.2016
 * Time: 18:22
 */
//шаблон письма для собственника бизнеса и отвецтвенного
?>


<div style="direction:rtl">


שלום!

    <? if (!empty($data['ArrArticle']) OR !empty($data['ArrNews']) OR !empty($data['ArrLotery'])): ?>
<p title="news">
באתר שלנו עלה תוכן חדש הקשור לעסק שלך.
</p>
    <? endif ?>

    <? if (!empty($data['ArrBrif']) OR !empty($data['ArrKvitanciy']) OR !empty($data['ArrZacaz'])): ?>
<p title="docs">
אנחנו העלנו מסמכים חדשים לעמוד האישי שלך
</p>
    <? endif ?>

<span>

    <? if (!empty($data['ArrArticle'])): ?>
        <p>פורסמה סקירה </p>
        <? foreach ($data['ArrArticle'] as $row): ?>
            <p><a href="<?=HTML::HostSite('/article/'.$row) ?>"><?=HTML::HostSite('/article/'.$row) ?></a></p>
        <? endforeach ?>

    <? endif ?>

    <? if (!empty($data['ArrNews'])): ?>
        <p>פורסמה ידיעה 
</p>
    <? endif ?>

    <? if (!empty($data['ArrLotery'])): ?>
        <p>החלה הגרלה בה העסק שלך הוא נותן חסות ראשי </p>
    <? endif ?>





    <? if (!empty($data['ArrBrif'])): ?>
        <p>בריף</p>
    <? endif ?>

    <? if (!empty($data['ArrKvitanciy'])): ?>
        <p>חשבונית מס\קבלה 
</p>
    <? endif ?>

    <? if (!empty($data['ArrZacaz'])): ?>
        <p>הזמנה</p>
    <? endif ?>

</span>



</div>