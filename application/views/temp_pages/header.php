<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 23.05.2015
 * Time: 16:40
 */
?>

<div class="container">

    <div class="row">
        <div class="col-md-3">Logo</div>
        <div class="col-md-6">
            <ul class="list-inline">
                <?foreach ($top_meny as $name=>$url):?>
                    <li><a href="<?=$url?>" class="normal8Tahoma <? if (Controller_BaseController::$detect_uri == $url) { echo 'active'; }?>"><?=$name?></a></li>

                <?endforeach?>
            </ul>
        </div>
        <div class="col-md-3">

            <?if (isset($user)):?>

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object img-circle" src="<?=$user->photo?>" alt="">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading"><a href="/account">Профиль</a></h5>
                        <h5><a href="/account/logout">выход</a></h5>
                    </div>
                </div>

            <?else:?>

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object img-circle" src="" alt="">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading"><a href="/account/login">Вход</a></h5>
                        <h5><a href="/account/registration">Регистрация</a></h5>
                    </div>
                </div>

            <?endif?>


        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <ul class="list-inline">
                <?foreach($general_meny as $row_meny):?>

                        <li><a href="/section/<?=$row_meny['url']?>" class="normal8Tahoma <? if (Controller_BaseController::$detect_uri == '/section/'.$row_meny['url']) { echo 'active'; }?>"><?=$row_meny['name']?></a></li>

                <?endforeach?>
            </ul>
        </div>

    </div>