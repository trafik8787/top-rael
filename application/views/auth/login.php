<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 02.08.2015
 * Time: 23:14
 */

?>

<div class="row">
    <div class="col-md-5 col-md-offset-3">
        <h4>Войти на сайт</h4>
        <? if (isset($message)) echo '<span class="label label-important">'.$message."</span><hr />"; ?>
        <form method="post" action="/account/login" role="form" class="form-horizontal">
            <div class="form-group">
                <label for="pageEmail" class="col-sm-2 control-label">E-Mail адрес</label>
                <div class="col-sm-10">
                    <input type="email" name="email" value="<?=$email;?>" id="pageEmail" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="pagePass" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" name="password"  id="pagePass" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label class="col-sm-2 control-label">
                            <input type="checkbox" name="rememberme" value="true"> Запомнить меня
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="Войти на сайт" class="btn btn-primary">
                        <a href="/account/forgot">Забыли пароль?</a>
                </div>
            </div>
        </form>

        <div class="span4">
            <h4>Вход через социальные сети</h4>
            <?=$ulogin;?>

        </div>

    </div>
</div>