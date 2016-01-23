<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 02.08.2015
 * Time: 23:15
 */

?>

<div class="row">
    <div class="col-md-12">
        <? if (isset($message)) :?>
            <h3 style="margin-top: 100px;margin-bottom: 100px;text-align: center;"><strong><?=$message?></strong></h3>
        <?endif?>

        <hr />
        <form method="post" class="form-inline" role="form" action="/account/forgot">

            <input type="email" name="email" class="form-control" value="<?=$email;?>" placeholder="Введите Email">

            <input type="submit" value="Восстановить пароль" class="btn btn-primary">
        </form>
    </div>
</div>
