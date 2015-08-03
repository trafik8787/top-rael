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
        <h2><?=$user->username;?></h2>
        <ul>
            <li>Аватарка: <img src="<?= $photo; ?>" class="img-rounded" /></li>
            <li>E-mail: <?= $user->email; ?></li>
            <li>Последнее посещение: <?= Date::fuzzy_span($user->last_login); ?></li>
        </ul>
        <hr />
        <? if (isset($_GET['changeok'])) { echo "Новый пароль был успешно сохранен<hr />"; } ?>
        <? if (isset($_GET['changefalse'])) { echo "Старый пароль введен не верно или новый пароль слишком слабый<hr />"; } ?>
        <form action="/account/changepass" method="post">
            Смена пароля:
            <input type="password" name="oldpassword" placeholder="Старый пароль" /><br />
            Новый пароль:
            <input type="password" name="newpassword" placeholder="Новый пароль" /><br />
            <input type="submit" class="btn" value="Изменить пароль" />
        </form>

        <h3>Аккаунты социальных сетей:</h3>

        <? if (isset($networks) && count($networks) > 0)
        {
            foreach ($networks as $n) echo "<a href='{$n['identity']}' target='_blank'>{$n['identity']}</a><br />";
        } else {
            echo 'Аккаунты социальных сетей еще не добавлены :(';
        } ?>
        <hr />
        Добавить другие аккаунты:
        <br />
        <?=$ulogin;?>
        <hr />
        <a href="/account/logout" class="btn">Выйти</a>
    </div>
</div>