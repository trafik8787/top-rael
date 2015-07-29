<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 29.07.2015
 * Time: 18:11
 */

?>

<ul class="list-group">
    <li class="list-group-item">Ваш IP: <?=Request::$client_ip?></li>
    <li class="list-group-item">Email: <?=Auth::instance()->get_user()->email?></li>
    <li class="list-group-item">Группы: <?=implode(', ', Auth::instance()->get_user()->roles->find_all()->as_array(NULL,'description'))?></li>
    <li class="list-group-item">Дата регистрации: <?=Auth::instance()->get_user()->date_registration?></li>
    <li class="list-group-item">Количетво входов: <?=Auth::instance()->get_user()->logins?></li>
</ul>