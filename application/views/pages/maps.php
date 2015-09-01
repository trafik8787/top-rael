<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */
?>
<content>


    <div id="content">

        <div id="map" style="height:550px;"></div>

        <div class="google-map-filter">

            <div class="google-map-shorkeys">
                <a href="javascript:;" data-map-shortkey="Тель Авив">Тель Авив</a>
                <a href="javascript:;" data-map-shortkey="Иерусалим">Иерусалим</a>
                <a href="javascript:;" data-map-shortkey="Хайфа">Хайфа</a>
                <a href="javascript:;" data-map-shortkey="Эйлат">Эйлат</a>
                <a href="javascript:;" data-map-shortkey="Бат Ям">Бат Ям</a>
                <a href="javascript:;" data-map-shortkey="Ашкелон">Ашкелон</a>
                <a href="javascript:;" data-map-shortkey="Ашдод">Ашдод</a>
            </div>

            <div id="google-map-search">
                <div class="inner-addon right-addon">
                    <i class="glyphicon glyphicon-search"></i>
                    <input type="text" class="form-control" id="pac-input"
                           placeholder="Введите адресс или название места"/>
                </div>
            </div>

            <div class="checkbox-container">

                <div class="checkbox">

                    <label class="restaurants" data-map-filter="1">
                        <div class="form-control input-md">
                            <input type="checkbox" value="1" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Рестораны
                    </label>

                    <label class="purchases" data-map-filter="2">
                        <div class="form-control input-md">
                            <input type="checkbox" value="2" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Покупки
                    </label>

                    <label class="night-life" data-map-filter="3">
                        <div class="form-control input-md">
                            <input type="checkbox" value="3" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Ночная жизнь
                    </label>

                    <label class="relax" data-map-filter="4">
                        <div class="form-control input-md">
                            <input type="checkbox" value="4" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Отдых
                    </label>

                    <label class="beauty" data-map-filter="5">
                        <div class="form-control input-md">
                            <input type="checkbox" value="5" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Красота
                    </label>


                    <label class="hotels" data-map-filter="6">
                        <div class="form-control input-md">
                            <input type="checkbox" value="6" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Отели
                    </label>
                </div>

            </div>
        </div>


    </div>


</content>






