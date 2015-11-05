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
    <div class="sidebar-lottery">

        <!-- Modal -->
        <div class="modal fade" id="myPravilaLotarey" tabindex="-1" role="dialog" aria-labelledby="myPravilaLotarey" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Правила участия в лотарее</h4>
                    </div>
                    <div class="modal-body">
                        правила
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

            <div class="sidebar-tabs">

                <div class="sidebar-tabs-heading">
                    <div class="sidebar-tabs-title">Победители</div>
                </div>

                <div class="sidebar-tabs-body">
                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="#" >
                                <img src="/public/uploade/no_avatar.jpg" width="43" height="43"
                                     class="media-object img-circle"/>
                            </a>
                        </div>
                        <div class="media-body">
                            <strong>Александр Жуков</strong><br/>
                            11.6.15 - 500ш в ресторан<br/>
                            <a href="#">"Круглый стол"</a>
                        </div>
                    </div>

                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="#" >
                                <img src="/public/uploade/no_avatar.jpg" width="43" height="43"
                                     class="media-object img-circle"/>
                            </a>
                        </div>
                        <div class="media-body">
                            <strong>Александр Жуков</strong><br/>
                            11.6.15 - 500ш в ресторан<br/>
                            <a href="#">"Круглый стол"</a>
                        </div>
                    </div>

                    <div class="media">

                        <div class="media-left media-middle">
                            <a href="#" >
                                <img src="/public/uploade/no_avatar.jpg" width="43" height="43"
                                     class="media-object img-circle"/>
                            </a>
                        </div>

                        <div class="media-body">
                            <strong>Александр Жуков</strong><br/>
                            11.6.15 - 500ш в ресторан<br/>
                            <a href="#">"Круглый стол"</a>
                        </div>
                    </div>

                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="#" >
                                <img src="/public/uploade/no_avatar.jpg" width="43" height="43"
                                     class="media-object img-circle"/>
                            </a>
                        </div>
                        <div class="media-body">
                            <strong>Александр Жуков</strong><br/>
                            11.6.15 - 500ш в ресторан<br/>
                            <a href="#">"Круглый стол"</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-lottery-footer">
            <a href="/arhiv_lotery">Архив лотереи</a>
        </div>
    </div>
<?endif?>



