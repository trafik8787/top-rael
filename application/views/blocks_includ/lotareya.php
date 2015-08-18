<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 09.08.2015
 * Time: 18:02
 */
//HTML::x($data);
?>

<div class="lottery">

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

    <div class="lottery-title">Еженедельная лотерея</div>

    <div class="lottery-section">
        <div class="lottery-section-title">Приз</div>
        <?if (!empty($data)):?>
            <div class="media">
                <div class="media-left media-middle">
                    <a href="#">
                        <img src="<?=$data['img']?>" width="88" height="88" class="media-object"/>
                    </a>
                </div>
                <div class="media-body">
                    <div class="media-heading"><?=$data['secondname']?></div>
                    <p><?=$data['description']?></p>
                </div>
            </div>
        <?endif?>
    </div>

    <div class="lottery-section">
        <div class="lottery-section-title">Участвовать</div>

        <p>Подпишись на нашу почтовую рассылку и станьте участником еженедельной лотереи</p>

        <form>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="">

                                            <span class="cr">
                                                <i class="cr-icon glyphicon glyphicon-ok"></i>
                                            </span>
                    Принимаю <a href="#" data-toggle="modal" data-target="#myPravilaLotarey">правила</a> участия в лотереи
                </label>
            </div>

            <div class="input-group">
                <input type="text" class="form-control" placeholder="Ваш email:">

                <div class="input-group-addon">
                    <button type="submit" class="btn btn-danger">Отправить</button>
                </div>
            </div>

        </form>

    </div>

    <div class="lottery-section">
        <div class="lottery-section-title">Победители</div>

        <div class="media">
            <div class="media-left media-middle">
                <a href="#" class="img-circle">
                    <img src="/public/uploade/avata-lottery.jpg" width="43" height="43"
                         class="media-object"/>
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
                <a href="#" class="img-circle">
                    <img src="/public/uploade/avata-lottery.jpg" width="43" height="43"
                         class="media-object"/>
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
                <a href="#" class="img-circle">
                    <img src="/public/uploade/avata-lottery.jpg" width="43" height="43"
                         class="media-object"/>
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
                <a href="#" class="img-circle">
                    <img src="/public/uploade/avata-lottery.jpg" width="43" height="43"
                         class="media-object"/>
                </a>
            </div>
            <div class="media-body">
                <strong>Александр Жуков</strong><br/>
                11.6.15 - 500ш в ресторан<br/>
                <a href="#">"Круглый стол"</a>
            </div>
        </div>
    </div>

    <a href="#">Архив лотереи</a>
</div>