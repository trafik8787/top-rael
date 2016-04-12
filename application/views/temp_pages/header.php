<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 23.05.2015
 * Time: 16:40
 */

?>

<div id="wrapper" class="container">

    <div class="modal fade in modal-coupon bs-coupon-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">


            </div>
        </div>
    </div>

    <?=isset($modal_subskribe) ? $modal_subskribe : ''?>

    <header>
        <div id="header">

            <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-header" aria-controls="nav-header">
                <i class="fa fa-bars"></i>
            </a>

            <a href="/" class="icons logo w-logo">TopIsrael</a>


            <div class="w-search-mobile visible-xs-block">

                <form class="search" action="http://topisrael.ru/search" id="cse-search-box">
                    <div class="inner-addon right-addon">
                        <!--                                    <i class="glyphicon glyphicon-search"></i>-->
                        <button class="glyphicon glyphicon-search w-search-button" name="sa" value="&#x041f;&#x043e;&#x0438;&#x0441;&#x043a;" type="submit"></button>
                        <input type="hidden" name="cx" value="partner-pub-6089615049498543:4215273310" />
                        <input type="hidden" name="cof" value="FORID:10" />
                        <input type="hidden" name="ie" value="UTF-8" />
                        <input type="text" class="form-control" name="q" size="100" />
                        <!--                                    <input class="glyphicon glyphicon-search" type="submit" name="sa" value="&#x041f;&#x043e;&#x0438;&#x0441;&#x043a;" />-->
                    </div>
                </form>

                <script type="text/javascript" src="http://www.google.co.il/coop/cse/brand?form=cse-search-box&amp;lang=ru"></script>
            </div>


            <div class="collapse" id="nav-header">
                <?if (isset($user)):?>

                    <div class="header-profile">

                        <div class="header-profile-shape">

                            <a href="/account#izbran"><i class="fa fa-star"></i>Избранные места <span class="badge w-count-bussines"><?=Controller_BaseController::$count_bussines?></span></a>
                            <div class="clearfix"></div>
                            <a href="/coupons">Купоны, </a> 
                            <a href="/places">места, </a> 
                            <a href="/articles">обзоры</a>
                        </div>
                        <?if (!empty($user->photo)):?>
                            <img src="<?=$user->photo?>" width="60" height="60" alt="" class="img-circle"/>
                        <?else:?>
                            <img src="/public/uploade/no_avatar.jpg" width="60" height="60" alt="" class="img-circle"/>
                        <?endif?>
                        <div class="header-profile-info">
                            <div>
                                <small>Добро пожаловать</small>
                                <small class="profile-username"><?=!empty($user->name) ? $user->name : $user->username?> <?=$user->secondname?></small>
                                <a href="/account#profile">Профиль</a> <a href="/account/logout"><i class="fa fa-sign-out"></i></a>
                            </div>
                        </div>
                    </div>

                <?else:?>

                    <div class="header-profile">

                        <div class="header-profile-shape">

                            <a href="/account#izbran"><i class="fa fa-star"></i>Избранные места <span class="badge w-count-bussines"><?=Controller_BaseController::$count_bussines?></span></a>
                            <a href="/account#coupons"><i class="fa fa-thumb-tack"></i>Мои купоны <span class="badge w-count-coupon"><?=Controller_BaseController::$count_coupon?></span></a>
                        </div>

                        <img src="/public/uploade/no_avatar.jpg" width="60" height="60" alt="" class="img-circle"/>

                        <div class="header-profile-info">
                            <div>
                                <div><a href="/account/login">Вход</a></div>
                                <div><a href="/account/registration">Регистрация</a></div>
                            </div>
                        </div>
                    </div>

                <?endif?>


                <div id="header-top">
                    <nav>
                        <ul class="header-nav">
                            
                            <?foreach ($top_meny as $name=>$url):?>
                                <li><a href="<?=$url?>"><?=$name?></a></li>
                            <?endforeach?>
                            
                                <li>
                                    
                                    <div class="dropdown">
                                        <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                                            По городам <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <? foreach ($city_list as $row_list_city): ?>
                                                <li><a href="/city/<?=!empty($row_list_city['cityUrl']) ? $row_list_city['cityUrl'] : '' ?>"><?=$row_list_city['cityName'] ?></a></li>
                                            <? endforeach ?>
                                        </ul>
                                    </div>
                                </li>
                            
                        </ul>
                    </nav>
                </div>

                <div id="header-bottom">
                    <nav>
                        <ul class="header-nav">
                            <li>
                                <a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                            </li>
                            <?foreach($general_meny as $row_meny):?>
                                <li><a <?if (Request::initial()->DetectUri() == '/section/'.$row_meny['url']):?> class="active" <?endif?> href="/section/<?=$row_meny['url']?>"><?=$row_meny['name']?></a></li>
                            <?endforeach?>
                        </ul>


<!--                        --><?//if (!empty($tags)):?>
<!--                            --><?//foreach($tags as $tags_row):?>
<!--                                --><?//if ($tags_row['url_tags'] == 'luxury'):?>
<!--                                    <a href="/tags/--><?//=$tags_row['url_tags']?><!--" class="button"><span>--><?//=$tags_row['name_tags']?><!--</span></a>-->
<!--                                --><?//endif?>
<!--                            --><?//endforeach?>
<!--                        --><?//endif?>



                        <div class="w-search hidden-xs">

                            <form class="search" action="http://topisrael.ru/search" id="cse-search-box">
                                <div class="inner-addon right-addon">
<!--                                    <i class="glyphicon glyphicon-search"></i>-->
                                    <button class="glyphicon glyphicon-search w-search-button" name="sa" value="&#x041f;&#x043e;&#x0438;&#x0441;&#x043a;" type="submit"></button>
                                    <input type="hidden" name="cx" value="partner-pub-6089615049498543:4215273310" />
                                    <input type="hidden" name="cof" value="FORID:10" />
                                    <input type="hidden" name="ie" value="UTF-8" />
                                    <input type="text" placeholder="Поиск" class="form-control" name="q" size="100" />
<!--                                    <input class="glyphicon glyphicon-search" type="submit" name="sa" value="&#x041f;&#x043e;&#x0438;&#x0441;&#x043a;" />-->
                                </div>
                            </form>

                            <script type="text/javascript" src="http://www.google.co.il/coop/cse/brand?form=cse-search-box&amp;lang=ru"></script>
                        </div>
                    </nav>



                </div>
            </div>
        </div>
    </header>
