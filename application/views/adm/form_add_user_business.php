<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 23.07.2015
 * Time: 19:57
 */
?>
<script type="text/javascript">
    $(function () {
        $('.form_date').datetimepicker({
            locale: 'ru',
            format: 'YYYY-MM-DD'
        });
    });
</script>

<div class="form-group has-feedback">

    <label for="Название" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">

        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Пользователь бизнеса
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="form-inline">

                            <input type="text" data-toggle="tooltip" data-original-title="Имя пользователя" name="name_user" class="form-control" placeholder="Имя пользователя" value="<?=isset($name_user) ? $name_user : ''?>"/>
                            <input type="text" data-toggle="tooltip" data-original-title="Фамилия пользователя" name="secondname_user" class="form-control" placeholder="Фамилия пользователя" value="<?=isset($secondname_user) ? $secondname_user : ''?>"/>
                            <input type="email" data-toggle="tooltip" data-original-title="Email" name="email_user" class="form-control" placeholder="Email" value="<?=isset($email_user)? $email_user: ''?>"/>

                        </div>

                        <div class="form-inline" style="margin-top: 10px;">
                            <select class="form-control" data-toggle="tooltip"  data-original-title="Выбрать пол" name="sex" data-placeholder="Пол">
                                <option <?if (!empty($sex) and $sex == 'm'):?> selected <?endif?> value="m">Мужчина</option>
                                <option <?if (!empty($sex) and $sex == 'j'):?> selected <?endif?> value="j">Женщина</option>
                            </select>
                            <div class="input-group date col-md-5 form_date">
                                <input class="form-control" type="text" value="<?=isset($age) ? $age: ''?>" data-toggle="tooltip" data-original-title="Возраст" name="age">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <input type="text" data-toggle="tooltip" data-original-title="Телефон" name="tel" class="form-control"  value="<?=isset($tel) ? $tel: ''?>"/>

                        </div>
                        <div class="form-inline" style="margin-top: 10px;">
                            <input type="password" data-toggle="tooltip" data-original-title="Пароль" name="password" class="form-control" placeholder="Пароль" value=""/>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>



