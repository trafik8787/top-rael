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


<p title="docs">
אנחנו העלנו מסמכים חדשים לעמוד האישי שלך
</p>


<span>

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