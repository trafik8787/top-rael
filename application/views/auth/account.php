<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 02.08.2015
 * Time: 23:15
 */

?>
<script>
    //открытие нужной вкладки по якорю
    $(function () {
        var hash = window.location.hash;
        hash && $('ul.pull-left a[href="' + hash + '"]').tab('show');



        $(document).on('click', 'ul.pull-right a', function(){
            $('ul.pull-left li').removeClass('active');

        });

        $(document).on('click', 'ul.pull-left a', function(){
            $('ul.pull-right li').removeClass('active');

        });

    });




</script>
<content>


    <div id="content">

        <div class="user-container">

            <div class="user-profile">
                <?if (empty($user)):?>

                    <div class="text-center">
                        <div><strong><i>Добро пожаловать! Вы зашли как “Анонимный” пользователь. Выполните “Вход” или “Регистрацию”.</i></strong></div>
                        <div><i>Анонимно вы можете лишь временно сохранить Купоны, Места или Статьи</i></div>


                        <br/>

                        <a href="/account/login" class="btn btn-primary btn-lg btn-lg pin-aria">
                            <span class="pin"><i class="fa fa-lock"></i></span>
                            <strong><i>Вход</i></strong>
                        </a>
                        &nbsp; <strong><i>или</i></strong> &nbsp;

                        <a href="/account/registration" class="btn btn-primary btn-lg pin-aria">
                            <span class="pin"><i class="fa fa-pencil"></i></span>
                            <strong><i>Регистрация</i></strong>
                        </a>

                    </div>


                <?else:?>


                    <div class="user-object  user-avatar">
                        <img src="<?=$user->photo?>" width="90" height="90" alt=""
                             class="img-circle">
                    </div>

                    <div class="user-object">
                        <small>Добро пожаловать</small>
                        <strong class="user-name"><?=$user->username?> <?=$user->secondname?></strong>
                    </div>

                    <?if (!empty($user->bdate)):?>
                        <div class="user-object">
                            <small>Добро пожаловать</small>
                            <strong>
                                <?=$user->bdate?>
                            </strong>
                        </div>
                    <?endif?>

                    <?if (!empty($user->city)):?>
                        <div class="user-object">
                            <small>Место проживания</small>
                            <strong><?=$user->city?></strong>
                        </div>
                    <?endif?>

                    <div class="user-object">
                        <small>Семейное положение</small>
                        <strong>Замужем</strong>
                    </div>

                    <div class="user-object user-logout">
                        <a href="/account/logout" class="btn btn-primary btn-lg pin-aria">
                            <span class="pin"><i class="fa fa-sign-out"></i></span>
                            <strong><i>Выход</i></strong>
                        </a>
                    </div>


                <?endif?>

            </div>

            <div class="user-navigation">
                <ul class="pull-left">
                    <li class="active">
                        <a href="#coupons" class="pin-aria" data-toggle="tab">
                            <span class="pin"><i class="fa fa-thumb-tack"></i></span>
                            Купоны
                        </a>
                    </li>

                    <li>
                        <a href="#izbran" class="pin-aria" data-toggle="tab">
                            <span class="pin"><i class="fa fa-star"></i></span>
                            Избранные места
                        </a>
                    </li>

                    <li>
                        <a href="#articles" class="pin-aria" data-toggle="tab">
                            <span class="pin"><i class="fa fa-file-text"></i></span>
                            Статьи
                        </a>
                    </li>


                </ul>
                <?if (!empty($user)): //если пользователи ?>
                    <ul class="pull-right">
                            <li>
                                <a href="#profile" class="pin-aria" data-toggle="tab">
                                    <span class="pin"><i class="fa fa-user"></i></span>
                                    Профиль
                                </a>
                            </li>

                        <li>
                            <a href="#subscribers" class="pin-aria" data-toggle="tab">
                                <span class="pin"><i class="fa fa-paper-plane"></i></span>
                                Рассылка
                            </a>
                        </li>
                    </ul>
                <?endif?>
            </div>

        </div>




        <div id="context">

            <div class="tab-content">


                <!--coupons-->
                <div class="panel panel-coupons tab-pane fade in active" id="coupons">

                    <div class="panel-body">



                        <?if (!empty($favorit_coupon)):?>

                            <?foreach($favorit_coupon as $rows_data_coupon):?>

                                <div class="clearfix">

                                    <?foreach ($rows_data_coupon as $rows_data_coupon_favor):?>

                                        <div class="col-md-4">
                                            <div class="coupon coupon-big">

                                                <a href="#" data-id="<?=$rows_data_coupon_favor['id']?>" class="pin w-delete-coupon-favor"><i class="fa fa-trash"></i></a>

                                                <div class="coupon-body">

                                                    <div class="coupon-content">

                                                        <div class="coupon-content-heading">
                                                            <?=$rows_data_coupon_favor['BusName']?>
                                                        </div>
                                                        <a class="coupon-image" href="/modalcoupon/<?=$rows_data_coupon_favor['id']?>" data-toggle="modal" data-target=".bs-coupon-modal-sm">
                                                            <img src="<?=$rows_data_coupon_favor['img_coupon']?>" width="155" height="125" alt="" title=""/>
                                                        </a>
                                                    </div>

                                                    <div class="coupon-sidebar">
                                                        <div class="coupon-sidebar-content">
                                                            <div class="coupon-sidebar-heading">
                                                                <div class="coupon-object-top">

                                                                    <div class="coupon-title">
                                                                        Купон
                                                                        <small class="block"><?=$rows_data_coupon_favor['name']?></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="coupon-sidebar-body">
                                                                <div class="coupon-object-middle">

                                                                    <div class="coupon-title">
                                                                        <?=$rows_data_coupon_favor['secondname']?>
                                                                        <span class="block">скидка</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="coupon-sidebar-footer">

                                                                <div class="coupon-object-bottom">

                                                                    <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_data_coupon_favor['dateoff']), 'j %MONTH% Y'); ?></small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?endforeach?>

                                </div>

                            <?endforeach?>

                        <?else:?>
                        <div class="col-md-12">
                            <span>Тут купоны</span>
                        </div>
                        <?endif?>

                        <br/>

                    </div>

                </div>


                <!--busines-->
                <div class="panel panel-thumbnails tab-pane fade" id="izbran">

                    <div class="panel-body">


                        <?if (!empty($favorits_bussines)):?>

                            <?foreach($favorits_bussines as $rows_data_bus):?>
                                <div class="clearfix">
                                    <?foreach ($rows_data_bus as $rows_business_favor):?>
                                        <div class="col-md-3 bussines">
                                            <div class="thumbnail">

                                                <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_business_favor['id']?>" class="pin w-delete-bussines-favor">
                                                    <i class="fa fa-trash"></i>
                                                </a>


                                                <a href="/business/<?=$rows_business_favor['url']?>" class="thumbnail-image">
                                                    <img src="<?=$rows_business_favor['home_busines_foto']?>" width="240" height="150" alt="<?=$rows_business_favor['name']?>">
                                                </a>


                                                <div class="thumbnail-content">
                                                    <h2 class="thumbnail-title">
                                                        <a href="/business/<?=$rows_business_favor['url']?>"><?=$rows_business_favor['name']?></a>
                                                        <small><?=$rows_business_favor['address']?></small>
                                                    </h2>

                                                    <?=Text::limit_chars(strip_tags($rows_business_favor['info']), 150, null, true)?>

                                                </div>
                                            </div>
                                        </div>
                                    <?endforeach?>
                                </div>
                            <?endforeach?>
                        <?else:?>
                            <span>Тут бизнесы</span>
                        <?endif?>


                    </div>
                </div>



                <div class="panel panel-thumbnails tab-pane fade" id="articles">
                    <div class="panel-body">
                        <div class="col-md-12">
                            Статьи какие то
                        </div>
                    </div>
                </div>

                <?if (!empty($user)): //если пользователи ?>
                    <div class="panel panel-thumbnails tab-pane fade" id="profile">
                        <div class="panel-body">
                            <div class="col-md-12">


                                <h2><?=isset($user->username) ? $user->username : '' ?></h2>
                                <ul>
                                    <li>Аватарка: <img src="<?= $photo; ?>" class="img-rounded"/></li>
                                    <li>E-mail: <?= $user->email; ?></li>
                                    <li>Последнее посещение: <?= Date::fuzzy_span($user->last_login); ?></li>
                                </ul>
                                <hr/>
                                <? if (isset($_GET['changeok'])) {
                                    echo "Новый пароль был успешно сохранен<hr />";
                                } ?>
                                <? if (isset($_GET['changefalse'])) {
                                    echo "Старый пароль введен не верно или новый пароль слишком слабый<hr />";
                                } ?>
                                <form action="/account/changepass" method="post">
                                    Смена пароля:
                                    <input type="password" name="oldpassword" placeholder="Старый пароль"/><br/>
                                    Новый пароль:
                                    <input type="password" name="newpassword" placeholder="Новый пароль"/><br/>
                                    <input type="submit" class="btn" value="Изменить пароль"/>
                                </form>

                                <h3>Аккаунты социальных сетей:</h3>

                                <? if (isset($networks) && count($networks) > 0) {
                                    foreach ($networks as $n) echo "<a href='{$n['identity']}' target='_blank'>{$n['identity']}</a><br />";
                                } else {
                                    echo 'Аккаунты социальных сетей еще не добавлены :(';
                                } ?>
                                <hr/>
                                Добавить другие аккаунты:
                                <br/>
                                <?= $ulogin; ?>
                                <hr/>
                                <a href="/account/logout" class="btn">Выйти</a>


                            </div>
                        </div>
                    </div>
                <?endif?>

                <div class="panel panel-thumbnails tab-pane fade" id="subscribers">
                    <div class="panel-body">
                        <div class="col-md-12">
                            рассылка
                        </div>
                    </div>
                </div>


            </div>



            <?=isset($panel_subscribe)? $panel_subscribe: ''?>
        </div>

    </div>

</content>