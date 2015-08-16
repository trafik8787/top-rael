<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 02.08.2015
 * Time: 23:15
 */

?>

<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-12">
                <div id="context">

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#coupons" data-toggle="tab">Купоны</a></li>
                                <li><a href="#izbran" data-toggle="tab">Избранные места</a></li>
                                <li><a href="#profile" data-toggle="tab">Профиль</a></li>
                                <li><a href="#subscribers" data-toggle="tab">Рассылка</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

<!--                                купоны-->
                                <div class="tab-pane fade in active" id="coupons">


                                    <div class="coupon" style="width: 300px; display: inline-block">
                                        <div class="coupon-container">

                                            <a href="#" data-id="68" class="pin w-delete-coupon-favor"><i class="fa fa-thumb-tack"></i></a>

                                            <div class="coupon-image">
                                                <div class="overlay">
                                                    <!--                                                            -->                                                            Rolex concept store                                                        </div>
                                                <a href="/modalcoupon/68" data-toggle="modal" data-target=".bs-coupon-modal-sm">
                                                    <img src="/uploads/img_coupons/coup_55a7967fe9740.jpg" width="155" height="125" alt="" title=""></a>
                                            </div>

                                            <div class="coupon-context">

                                                <div class="fz large"><strong>Тест купон</strong></div>
                                                <small>Тест купон2</small>

                                                <small class="coupon-date">до 27 августа 2015</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="coupon" style="width: 300px; display: inline-block">
                                        <div class="coupon-container">

                                            <a href="#" data-id="68" class="pin w-delete-coupon-favor"><i class="fa fa-thumb-tack"></i></a>

                                            <div class="coupon-image">
                                                <div class="overlay">
                                                    <!--                                                            -->                                                            Rolex concept store                                                        </div>
                                                <a href="/modalcoupon/68" data-toggle="modal" data-target=".bs-coupon-modal-sm">
                                                    <img src="/uploads/img_coupons/coup_55a7967fe9740.jpg" width="155" height="125" alt="" title=""></a>
                                            </div>

                                            <div class="coupon-context">

                                                <div class="fz large"><strong>Тест купон</strong></div>
                                                <small>Тест купон2</small>

                                                <small class="coupon-date">до 27 августа 2015</small>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="tab-pane fade" id="izbran">
                                    Избранные места
                                </div>



                                <div class="tab-pane fade" id="profile">
                                    <h2><?= $user->username; ?></h2>
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

                                <div class="tab-pane fade" id="subscribers">
                                    рассилки
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</content>