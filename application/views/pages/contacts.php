<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 31.07.2015
 * Time: 15:20
 */

?>


<content>
    <div id="content">

        <div class="page-contacts">


            <div class="page-heading">

                <span class="icons plane hidden-xs"></span>

                <div>
                    <div class="page-title">Свяжитесь с нами</div>

                    <div class="page-context">
                        <p>
                            <i>
                                Заполните и отправьте форму связи и наши сотрудники ответят вам как можно скорее
                            </i>
                        </p>
                    </div>
                </div>

            </div>

            <form class="row" method="post">

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
                    <div class="col-md-5">
                        <label>Ваше сообщение:</label>
                    </div>
                    <div class="col-md-7">
                        <textarea class="form-control input-lg" name="desc" cols="3" rows="4"></textarea>
                    </div>
                </div>


                <div class="col-md-12">
                    <button type="submit" class="btn btn-danger btn-lg pull-right">Отправить</button>
                </div>

            </form>
        </div>

    </div>
</content>

