<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 23.05.2015
 * Time: 16:40
 */

?>

<div id="wrapper" class="container">

    <header>
        <div id="header">

            <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-header" aria-controls="nav-header">
                <i class="fa fa-bars"></i>
            </a>

            <a href="#" class="icons logo">TopIsrael</a>

            <div class="collapse" id="nav-header">
                <?if (isset($user)):?>

                    <div class="header-profile">

                        <div class="header-profile-shape">

                            <a href="/account/"><i class="fa fa-star"></i>Избранные места <span class="badge">78</span></a>
                            <a href="/account/"><i class="fa fa-thumb-tack"></i>Мои купоны <span class="badge">42</span></a>
                        </div>

                        <img src="<?=$user->photo?>" width="60" height="60" alt="" class="img-circle"/>

                        <div class="header-profile-info">
                            <small>Добро пожаловать</small>
                            <small class="profile-username">Валентина Громова</small>
                            <a href="/account">Профиль</a> <a href="/account/logout"><i class="fa fa-sign-out"></i></a>
                        </div>
                    </div>

                <?else:?>

                    <div class="header-profile">

                        <div class="header-profile-shape">

                            <a href="#"><i class="fa fa-star"></i>Избранные места <span class="badge">0</span></a>
                            <a href="#"><i class="fa fa-thumb-tack"></i>Мои купоны <span class="badge">0</span></a>
                        </div>

                        <img src="/public/uploade/user-avatar.jpg" width="60" height="60" alt="" class="img-circle"/>

                        <div class="header-profile-info">
                            <a href="/account/login">Вход</a>
                            <br/>
                            <a href="/account/registration">Регистрация</a>
                        </div>
                    </div>

                <?endif?>


                <div id="header-top">
                    <nav>
                        <ul class="header-nav">
                            <?foreach ($top_meny as $name=>$url):?>
                                <li><a href="<?=$url?>"><?=$name?></a></li>
                            <?endforeach?>
                        </ul>
                    </nav>
                </div>

                <div id="header-bottom">
                    <nav>
                        <ul class="header-nav">
                            <li><a href="/">Главная</a></li>
                            <?foreach($general_meny as $row_meny):?>
                                <li><a href="/section/<?=$row_meny['url']?>"><?=$row_meny['name']?></a></li>
                            <?endforeach?>
                        </ul>

                        <a href="#" class="button"><span>LUXURY</span></a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
