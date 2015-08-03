<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 03.08.2015
 * Time: 12:19
 */

?>

<div class="row">
    <div class="col-md-6 col-md-offset-2">
        <h4>Зарегистрироваться</h4>
        <? if (isset($messageReg))
        {
            echo '<span class="label label-important">'.$messageReg."</span><br />";
            if (isset($errors)) foreach ($errors as $error) echo $error."<br />";
            echo "<hr />";
        } ?>
        <form method="post" action="/account/registration" role="form" class="form-horizontal" >
            <div class="form-group">
                <label for="pageUsername" class="col-sm-4 control-label">Отображаемое имя</label>
                <div class="col-sm-8">
                    <input type="text" name="username" value="<?=$username;?>" id="pageUsername" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="pageEmail" class="col-sm-4 control-label">E-Mail адрес</label>
                <div class="col-sm-8">
                    <input type="email" name="email" value="<?=$email;?>" id="pageEmail" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="pagePass" class="col-sm-4 control-label">Пароль</label>
                <div class="col-sm-8">
                    <input type="password" name="password" id="pagePass" class="form-control">
                </div>
            </div>
            <div class="form-group text-right">

                    <input type="submit" value="Зарегистрироваться" class="btn btn-primary">

            </div>

        </form>
    </div>
</div>