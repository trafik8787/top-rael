<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 10.11.2015
 * Time: 15:22
 */

?>
<div class="form-group has-feedback">

    <label for="Название" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Статистика пользователя</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>Купонов добавленных в избранное:</td>
                        <td>
                            <?foreach($data['coupons'] as $row):?>
                                <span>ID <?=$row['id']?> - <?=$row['secondname']?></span><br>
                            <?endforeach?>
                        </td>
                    </tr>
                    <tr>
                        <td>Бизнесов добавленных в избранное:</td>
                        <td>
                            <?foreach($data['business'] as $row):?>
                                <span><?=$row['name']?></span><br>
                            <?endforeach?>

                        </td>
                    </tr>
                    <tr>
                        <td>Обзоров добавленных в избранное:</td>
                        <td>

                            <?foreach($data['articles'] as $row):?>
                                <span><?=$row['name']?></span><br>
                            <?endforeach?>

                        </td>
                    </tr>
                    <tr>
                        <td>Дата последней авторизации:</td>
                        <td><?=$last_login?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>