<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 09.08.2015
 * Time: 18:02
 */
//HTML::x($data);
?>
<style>
    .popover.bottom > .arrow.errors-email:after {
        border-bottom-color: #FF7272!important;
    }

    .popover.bottom > .arrow.susses-email:after {
        border-bottom-color: greenyellow!important;
    }
</style>



<?if (!empty($data)):?>
    <div class="sidebar-lottery w-bloc-right">

        <!-- Display Informer -->
        <div id="topIsraelInformerBusiness"></div>
        <!-- Css -->
        <style type="text/css">#topIsraelInformerBusiness.ti-container{font-family:  Arial, 'Helvetica Neue', Helvetica, sans-serif; color: #000000; background: #fff; border:1px solid #C7C6C6; width: 300px;}#topIsraelInformerBusiness.ti-container .ti-header{ font-size: 20px; line-height: 1.25; margin: 5px 0; padding:5px 10px 10px; border-bottom:1px solid #ECECEC; display: block;}#topIsraelInformerBusiness.ti-container .ti-footer{ font-size: 20px; line-height: 1.25; margin: 5px 0; padding:10px 10px 5px 10px; border-top:1px solid #ECECEC; display: block;}#topIsraelInformerBusiness.ti-container .ti-item{display:block; text-decoration:none; margin:10px;}#topIsraelInformerBusiness.ti-container .ti-item .ti-image{float:left; margin:0 10px 0 0; width:50px; height:50px; background:#F2F2F2;}#topIsraelInformerBusiness.ti-container .ti-item .ti-image img{display:block; width:100%; height:auto;}#topIsraelInformerBusiness.ti-container .ti-item .ti-context{display:block; position:relative; overflow:hidden;}#topIsraelInformerBusiness.ti-container .ti-item .ti-context .ti-title{display:block;  margin:0 0 5px 0; font-size:18px; line-height: 1.25; color: #103DD3;}#topIsraelInformerBusiness.ti-container .ti-item .ti-context .ti-text{display:block; margin:0 0 5px 0; font-size:14px; line-height: 1.25; color: #000000;}#topIsraelInformerBusiness.ti-container .ti-item .ti-context .ti-category{display:block; margin:0 0 5px 0; font-size:11px; line-height: 1.25; color: #000000;}#topIsraelInformerBusiness.ti-container .ti-item .ti-context .ti-adress{display:block; margin:0 0 5px 0; font-size:11px; line-height: 1.25; color: #000000;}#topIsraelInformerBusiness.ti-clear{display:block; clear:both; height:0; overflow: hidden;}</style>
        <!-- Script -->
        <script type="text/javascript">(function (w, d, t, p, e, m) {
                _rs = {"container":"topIsraelInformerBusiness","city":0,"category":0,"limit":3};
                e = d.createElement(t); e.async = 1; e.src = p;
                m = d.getElementsByTagName(t)[0]; m.parentNode.insertBefore(e, m);
            })(window, document, 'script', '/public/javascripts/data/business.js');</script>


        <!-- Modal -->
        <div class="modal fade" id="myPravilaLotarey" tabindex="-1" role="dialog" aria-labelledby="myPravilaLotarey" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Правила Лотереи TopIsrael.ru</h4>
                    </div>
                    <div class="modal-body">
                        <p>Уважаемый подписчик и участник Лотереи!</p>
                        <p>Участвуя в Лотерее TopIsrael.ru, вы соглашаетесь и подписываетесь под правилами:</p>
                        <ol type="1" style="list-style-type: decimal; padding-left: 10px">
                            <li>Лотерея разыгрывается только в те даты, когда она анонсирована и видна на сайте. Срок окончания каждого розыгрыша написан в анонсе.</li>
                            <li>Призы для Лотереи предоставляют бизнесы. Администрация TopIsrael.ru не несет ответственность за точность описания призов и их реализацию.</li>
                            <li>Приз может быть вручен только в том виде, как он описан в анонсе лотереи и не может быть заменен на эквивалентное вознаграждение деньгами.</li>
                            <li>Каждый участник может выиграть только один раз, в любой из лотерей. После выигрыша, e-mail победителя больше не участвует в следующих розыгрышах. Мы реализуем принцип равноправия, чтобы каждый участник имел шанс на выигрыш.</li>
                            <li>Выбор победителя определяется автоматически. Специальный скрипт выбирает e-mail победителя, среди всех участников, в случайном порядке.</li>
                            <li>Победитель получает на свой e-mail письмо-уведомление с поздравлениями и с ссылкой на заполнение анкеты победителя, которую он отправляет администрации сайта.</li>
                            <li>После получения анкеты, администрация TopIsrael.ru связывается с победителем и вручает приз.</li>
                            <li>Приз можно получить ТОЛЬКО после заполнения и отправки анкеты победителя.</li>
                            <li>Победитель соглашается с тем, что его личные данные могут быть опубликованы в результатах Лотереи, на сайте TopIsrael.ru и на официальных страницах сайта в социальных сетях.</li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-lottery-heading">
            <div class="sidebar-lottery-title">Еженедельная лотерея</div>
        </div>

        <div class="sidebar-lottery-body">

            <div class="sidebar-tabs">

                <div class="sidebar-tabs-heading">
                    <div class="sidebar-tabs-title">Приз</div>
                </div>

                <div class="sidebar-tabs-body">


                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="/business/<?=$data['BusUrl']?>">
                                <img src="<?=$data['img']?>" width="88" height="88" class="media-object"/>
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-heading prize-title"><?=$data['secondname']?></div>
                            <p><?=$data['description']?></p>
                            <p>до розыгрыша осталось <?=Date::diffDay('', $data['date_end'])?> дней</p>
                        </div>
                    </div>


                </div>
            </div>

            <div class="sidebar-tabs">

                <div class="sidebar-tabs-heading">
                    <div class="sidebar-tabs-title">Участвовать</div>
                </div>

                <div class="sidebar-tabs-body">
                    <p>Подпишись на нашу почтовую рассылку и станьте участником еженедельной
                        лотереи</p>

                    <form class="w-form-subscribe-lotarey">


                        <div class="checkbox">

                            <label>

                                <div class="form-control">
                                    <input type="checkbox" value="1" class="w-cheklicenz" name="cheklicenz">
                                    <i class="input-icon fa fa-check"></i>
                                </div>

                                Принимаю <a href="#" data-toggle="modal" data-target="#myPravilaLotarey">правила</a> участия в лотереи

                            </label>

                        </div>


                        <div class="input-group">
                            <input type="email" class="form-control w-input-lotarey-email" name="email" placeholder="Ваш email:">

                            <div class="input-group-addon">
                                <button value="1" type="submit" class="btn btn-danger w-subskrip-buton">Отправить</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <? if (!empty($data_user)): ?>

                <div class="sidebar-tabs">

                    <div class="sidebar-tabs-heading">
                        <div class="sidebar-tabs-title">Победители</div>
                    </div>

                    <div class="sidebar-tabs-body">

                        <? foreach ($data_user as $row_user): ?>

                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#" >
                                        <? if (!empty($row_user['usersPhoto'])): ?>

                                        <img src="<?=$row_user['usersPhoto'] ?>" width="43" height="43"
                                             class="media-object img-circle"/>

                                            <?else:?>

                                            <img src="/public/uploade/no_avatar.jpg" width="43" height="43"
                                                 class="media-object img-circle"/>

                                        <?endif?>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <strong><?=$row_user['usersName']?> <?=$row_user['usersSecondname']?></strong><br/>
                                    <?=date('d-m-Y', strtotime($row_user['loteryDate'])) ?> - <?=$row_user['loteryName'] ?><br/>
                                    <a href="/business/<?=$row_user['busUrl'] ?>"><?=$row_user['busName'] ?></a>
                                </div>
                            </div>

                        <? endforeach ?>
                    </div>
                </div>

            <? endif ?>
        </div>
        <? if (!empty($data_user)): ?>
            <div class="sidebar-lottery-footer">
                <a href="/arhiv_lotery">Архив лотереи</a>
            </div>
        <? endif ?>
    </div>
<?endif?>



