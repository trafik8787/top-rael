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
        <? if (isset($message)) echo '<span class="label label-important">'.$message."</span><hr />"; ?>
        <form method="post" action="/account/forgot">
            <label>E-Mail адрес</label>
            <input type="email" name="email" value="<?=$email;?>" class="span3">
            </label>
            <input type="submit" value="Восстановить пароль" class="btn btn-primary">
            <div class="clearfix"></div>
        </form>
    </div>
</div>
