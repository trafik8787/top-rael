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
        hash && $('ul.nav-tabs a[href="' + hash + '"]').tab('show');



    });
</script>
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
                                <?if (!empty($user)):?>
                                    <li><a href="#profile" data-toggle="tab">Профиль</a></li>
                                <?endif?>
                                <li><a href="#subscribers" data-toggle="tab">Рассылка</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

<!--                                купоны-->
                                <div class="tab-pane fade in active" id="coupons">

                                    <?if (!empty($favorit_coupon)):?>

                                        <?foreach($favorit_coupon as $rows_data_coupon):?>
                                            <div class="coupon" style="width: 300px; display: inline-block">
                                                <div class="coupon-container">

                                                    <a href="#" data-id="<?=$rows_data_coupon['id']?>" class="pin w-delete-coupon-favor"><i class="glyphicon glyphicon-trash"></i></a>

                                                    <div class="coupon-image">
                                                        <div class="overlay">
                                                            <!--                                                            --><?//=$rows_data[0]['secondname']?>
                                                            <?=$rows_data_coupon['BusName']?>
                                                        </div>
                                                        <a href="/modalcoupon/<?=$rows_data_coupon['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm">
                                                            <img src="<?=$rows_data_coupon['img_coupon']?>" width="155" height="125" alt=""
                                                                 title=""/></a>
                                                    </div>

                                                    <div class="coupon-context">

                                                        <div class="fz large"><strong><?=$rows_data_coupon['name']?></strong></div>
                                                        <small><?=$rows_data_coupon['secondname']?></small>

                                                        <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_data_coupon['dateoff']), 'j %MONTH% Y'); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endforeach?>

                                    <?else:?>
                                        <span>Тут купоны</span>
                                    <?endif?>
                                </div>


                                <div class="tab-pane fade" id="izbran">

                                    <?if (!empty($favorits_bussines)):?>
                                        <?foreach($favorits_bussines as $rows_data_bus):?>
                                            <div class="thumbnail bussines" style="width: 20%; display: inline-block;">

                                                <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data_bus['id']?>" class="pin w-delete-bussines-favor">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>

                                                <a href="/business/<?=$rows_data_bus['url']?>" class="thumbnail-image">
                                                    <img src="<?=$rows_data_bus['home_busines_foto']?>" width="240" height="150" alt="">
                                                </a>

                                                <div class="caption">
                                                    <h3><strong><a href="/business/<?=$rows_data_bus['url']?>"><?=$rows_data_bus['name']?></a></strong></h3>

                                                    <p><strong><?=$rows_data_bus['address']?></strong></p>

                                                    <?=Text::limit_chars(strip_tags($rows_data_bus['info']), 200, null, true)?>
                                                </div>
                                            </div>
                                        <?endforeach?>
                                    <?else:?>
                                        <span>Тут бизнесы</span>
                                    <?endif?>
                                </div>


                                <?if (!empty($user)): //если пользователи ?>
                                    <div class="tab-pane fade" id="profile">
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
                                <?endif?>

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