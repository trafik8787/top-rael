<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 31.07.2015
 * Time: 15:20
 */

?>

<style>
    .error{
        color: red;
    }
</style>

<content>
    <div id="content">

        <div class="page-contacts">


            <div class="page-heading">

                <span class="w-convert-contact plane hidden-xs"></span>

                <div>
                    <div class="page-title">Свяжитесь с нами</div>

                    <div class="page-context">
                        <p>
                            <i>
                                Заполните и отправьте форму связи и наши сотрудники ответят вам как можно скорее <br>
                                или звоните нам 03-5604505
                            </i>
                        </p>
                    </div>
                </div>

            </div>

            <?if (empty($_GET['susses'])):?>
                <form class="row" method="post" id="w-form-contact">

                    <div class="col-md-12">
                        <div class="form-title">Форма связи</div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-md-5">
                            <label>Ваше полное имя:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="fullname" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-md-5">
                            <label>Страна проживания:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="city" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group  clearfix">
                        <div class="col-md-5">
                            <label>Email:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="email" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group  clearfix">
                        <div class="col-md-5">
                            <label>Телефон:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="tel" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group  clearfix">
                        <div class="col-md-4">
                            <label>Ваше сообщение:</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control input-lg" name="desc" cols="3" rows="7"></textarea>
                        </div>
                    </div>
                    <div class="form-group  clearfix">
                        <div class="col-md-5">
                            <label>Код</label>
                        </div>
                        <div class="col-md-7">
                            <span style="display: inline-block;"><?=$captcha; ?></span> <input type="text" name="captcha" class="form-control input-lg" style="width: 49%;display: inline-block;"/>
                            <?if (!empty($_GET['err_cap'])):?>
                                <label id="captcha-error" class="error" for="captcha"><?=base64_decode($_GET['err_cap'])?></label>
                            <?endif?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger btn-lg pull-right">Отправить</button>
                    </div>

                </form>
            <?else:?>

                <h2 style="color: #009900"><i>Ваше сообщение отправлено!</i></h2>
            <?endif?>
        </div>

    </div>
</content>

