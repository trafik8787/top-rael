<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 03.08.2015
 * Time: 12:19
 */

?>


<content>
    <div id="content">

        <div class="col-md-6 col-md-offset-3 page">

            <div class="page-title">Регистрация через социальные сети</div>

            <span style="display: none"><?=$ulogin;?></span>
            <div class="page-context" id="uLogin" data-ulogin="display=buttons;fields=first_name,last_name,email;providers=vkontakte,facebook,twitter,google;redirect_uri=<?=Kohana::$config->load('ulogin')->redirect_uri?>;optional=photo,city,sex,bdate;">

                <a href="#" class="social twitter" data-uloginbutton="twitter">
                    <i class="fa fa-twitter"></i>
                </a>

                <a href="#" class="social vk" data-uloginbutton="vkontakte">
                    <i class="fa fa-vk"></i>
                </a>

                <a href="#" class="social facebook" data-uloginbutton="facebook">
                    <i class="fa fa-facebook"></i>
                </a>

                <a href="#" class="social google" data-uloginbutton="google">
                    <i class="fa fa-google"></i>
                </a>
            </div>

            <hr/>

            <form class="row" method="post" action="/account/registration">

                <div class="col-md-12">
                    <div class="form-title">Зарегистрироваться</div>
                </div>
                <? if (isset($messageReg))
                {
                    echo '<span class="label label-important">'.$messageReg."</span><br />";
                    if (isset($errors)) foreach ($errors as $error) echo $error."<br />";
                    echo "<hr />";
                } ?>
                <div class="form-group clearfix">
                    <div class="col-md-4">
                        <label>Отображаемое имя</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="username" value="<?=$username;?>" class="form-control input-lg">
                    </div>
                </div>

                <div class="form-group clearfix">
                    <div class="col-md-4">
                        <label>E-Mail адрес</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="email" value="<?=$email;?>" class="form-control input-lg">
                    </div>
                </div>

                <div class="form-group clearfix">
                    <div class="col-md-4">
                        <label>Пароль</label>
                    </div>
                    <div class="col-md-8">
                        <input type="password" name="password" class="form-control input-lg">
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-lg pull-right">Зарегистрироваться</button>
                </div>

            </form>
        </div>


    </div>
</content>