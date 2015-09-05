<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 02.08.2015
 * Time: 23:14
 */

?>


<content>
    <div id="content">

        <div class="col-md-6 col-md-offset-3 page">

            <div class="page-title">Вход через социальные сети</div>
            <span style="display: none"><?=$ulogin;?></span>

            <div class="page-context" id="uLogin" data-ulogin="display=buttons;redirect_uri=<?=Kohana::$config->load('ulogin')->redirect_uri?>;">

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
            <? if (isset($message)) echo '<span class="label label-important">'.$message."</span><hr />"; ?>
            <form class="row" method="post" action="/account/login" role="form">

                <div class="col-md-12">
                    <div class="form-title">Войти на сайт</div>
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

                <div class="form-group clearfix">
                    <div class="col-md-8 col-md-offset-4">
                        <div class="checkbox">

                            <label>

                                <div class="form-control input-lg">
                                    <input type="checkbox" name="rememberme" value="true" checked="checked">
                                    <i class="input-icon fa fa-check"></i>
                                </div>

                                Запомнить меня
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-lg  pull-right">Войти на сайт</button>
                    <a href="/account/forgot" class="btn btn-primary btn-link btn-lg pull-right">Забыли пароль?</a>
                </div>

            </form>
        </div>
    </div>
</content>