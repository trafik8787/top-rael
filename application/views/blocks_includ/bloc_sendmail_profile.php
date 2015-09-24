<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 30.08.2015
 * Time: 15:23
 */

?>
<style>
    .error{
        color: red;
        font-size: 18px;
    }
</style>
<div class="panel panel-subscribe settings">


    <div class="panel-heading">

        <div class="panel-title">
            <strong>Настройки почтовой рассылки</strong><br/>
            <?if (!empty($user)):?>
            <small><i>Выберите подходящие вам параметры</i></small>
            <?endif?>
        </div>

    </div>


    <div class="panel-body">
        <div class="col-md-12">
            <form class="w-subscribe-profile" method="post">

                <?if (!empty($user)):?>
                    <strong>Что вам инетересно?</strong>

                    <div class="checkbox-container">

                        <div class="checkbox">

                            <label>
                                <div class="form-control input-lg">
                                    <input type="checkbox" name="coupons" value="1" checked="checked">
                                    <i class="input-icon fa fa-check"></i>
                                </div>

                                Купоны
                            </label>

                            <label>
                                <div class="form-control input-lg">
                                    <input type="checkbox" name="articles" value="1" >
                                    <i class="input-icon fa fa-check"></i>
                                </div>

                                Обзоры
                            </label>

                            <?if (!empty($generall_menu)):?>
                                <?foreach ($generall_menu as $rows_meny):?>
                                    <label>
                                        <div class="form-control input-lg">
                                            <input type="checkbox" name="<?=$rows_meny['url']?>" value="<?=$rows_meny['id']?>">
                                            <i class="input-icon fa fa-check"></i>
                                        </div>
                                        <?=$rows_meny['name']?>
                                    </label>
                                <?endforeach?>
                            <?endif?>

                        </div>

                    </div>

                <?endif?>

                <div class="row">

                    <div class="col-md-4">

                        <div class="radio">

                            <label>
                                <div class="form-control input-lg">
                                    <input type="radio" value="1" name="subscrib_disable" checked="checked">
                                    <i class="input-icon fa fa-circle"></i>
                                </div>

                                Подписка включена
                            </label>

                        </div>

                        <div class="radio">

                            <label>
                                <div class="form-control input-lg">
                                    <input type="radio" value="0" name="subscrib_disable">
                                    <i class="input-icon fa fa-circle"></i>
                                </div>

                                Подписка отключена
                            </label>

                        </div>
                    </div>


                    <div class="col-md-7 col-md-offset-1 input-aria">

                        <div class="input-group-title">Ваш email:</div>

                        <div class="input-group">

                            <input type="email" name="email" class="form-control input-lg"/>

                            <div class="input-group-addon">
                                <button type="submit" class="btn btn-lg btn-danger">Отправить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>