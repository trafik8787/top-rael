<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 30.08.2015
 * Time: 15:23
 */

?>

<div class="panel panel-subscribe settings">


    <div class="panel-heading">

        <div class="panel-title">
            <strong>Настройки почтовой рассылки</strong><br/>
            <small><i>Выберите подходящие вам параметры</i></small>
        </div>

    </div>


    <div class="panel-body">
        <div class="col-md-12">
            <form method="">

                <strong>Что вам инетересно?</strong>

                <div class="checkbox-container">

                    <div class="checkbox">

                        <label>
                            <div class="form-control input-lg">
                                <input type="checkbox" value="" checked="checked">
                                <i class="input-icon fa fa-check"></i>
                            </div>

                            Купоны
                        </label>

                        <label>
                            <div class="form-control input-lg">
                                <input type="checkbox" value="" checked="checked">
                                <i class="input-icon fa fa-check"></i>
                            </div>

                            Обзоры
                        </label>


                        <label>
                            <div class="form-control input-lg">
                                <input type="checkbox" value="">
                                <i class="input-icon fa fa-check"></i>
                            </div>

                            Рестораны
                        </label>

                        <label>
                            <div class="form-control input-lg">
                                <input type="checkbox" value="">
                                <i class="input-icon fa fa-check"></i>
                            </div>

                            Покупки
                        </label>

                        <label>
                            <div class="form-control input-lg">
                                <input type="checkbox" value="">
                                <i class="input-icon fa fa-check"></i>
                            </div>

                            Красота
                        </label>

                        <label>
                            <div class="form-control input-lg">
                                <input type="checkbox" value="" checked="checked">
                                <i class="input-icon fa fa-check"></i>
                            </div>

                            Отдых
                        </label>

                        <label>
                            <div class="form-control input-lg">
                                <input type="checkbox" value="">
                                <i class="input-icon fa fa-check"></i>
                            </div>

                            Отели
                        </label>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="radio">

                            <label>
                                <div class="form-control input-lg">
                                    <input type="radio" value="" name="test" checked="checked">
                                    <i class="input-icon fa fa-circle"></i>
                                </div>

                                Подписка включена
                            </label>

                        </div>

                        <div class="radio">

                            <label>
                                <div class="form-control input-lg">
                                    <input type="radio" value="" name="test">
                                    <i class="input-icon fa fa-circle"></i>
                                </div>

                                Подписка отключена
                            </label>

                        </div>
                    </div>


                    <div class="col-md-7 col-md-offset-1 input-aria">

                        <div class="input-group-title">Ваш email:</div>

                        <div class="input-group">

                            <input type="text" class="form-control input-lg"/>

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