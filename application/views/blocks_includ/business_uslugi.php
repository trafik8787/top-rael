<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 28.08.2015
 * Time: 15:53
 */
//HTML::x($data);
?>
    <style>

        #w-form-order-calebration label.error {
            color: red;
        }

    </style>

<?if (!empty($data)):?>
    <div class="sidebar-services">

        <div class="sidebar-services-heading">
            <div class="sidebar-services-title">Наши преимущества и услуги</div>
        </div>

        <div class="sidebar-services-body">
            <ul class="sidebar-services-list">
                <?foreach($data as $row):?>
                    <li><i class="fa fa-check"></i> <?=$row?></li>
                <?endforeach?>
            </ul>
        </div>
        
        
        <button value="1" data-toggle="modal" data-target="#myOrderCelebrations" class="btn btn-primary order-party">Заказ торжества</button>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="myOrderCelebrations" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myOrderCelebrations" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><strong>Заказ торжества TopIsrael.ru</strong></h4>
                </div>
                <form role="form" id="w-form-order-calebration" method="post">
                    <div class="modal-body">

                            <div class="form-group">
                                <input type="text" class="form-control" name="last_name" placeholder="Ваше полное имя">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="city" placeholder="Город">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email"  placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="tel" placeholder="Телефон">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="event" title="asd">
                                    <option disabled selected>Выберете событие</option>
                                    <option value="День рождение">День рождение</option>
                                    <option value="Корпаратив">Корпаратив</option>
                                    <option value="Бар">Бар</option>
                                    <option value="Бат мицва">Бат мицва</option>
                                    <option value="Свадьба">Свадьба</option>
                                    <option value="Встреча друзей">Встреча друзей</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="count_human" placeholder="Количество человек">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control w-date-event" name="date_event" placeholder="Дата и время события">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="desk" placeholder="Дополнительная информация"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="bussines_name" value="<?=$bussines_name?>">
                                <input type="hidden" name="bussines_url" value="<?=$bussines_url?>">
                            </div>

                    </div>
                    <div class="modal-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-primary" data-loading-text="Отправка..." id="w-button-order-celebration">Заказать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?endif?>