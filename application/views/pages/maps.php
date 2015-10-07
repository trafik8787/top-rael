<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */
?>
<script>
     window.dataMapsBus = <?=$json?>;
     window.busLng = <?=isset($lng) ? $lng : 0?>;
     window.busLat = <?=isset($lat) ? $lat : 0?>;
</script>
<content>


    <div id="content">

        <div id="map" style="height:550px;"></div>

        <div class="google-map-filter">

            <div class="google-map-shorkeys">
                <a href="javascript:;" data-map-shortkey="Тель Авив">Тель Авив</a>
                <a href="javascript:;" data-map-shortkey="Яффа">Яффо</a>
                <a href="javascript:;" data-map-shortkey="Иерусалим">Иерусалим</a>
                <a href="javascript:;" data-map-shortkey="Эйлат">Эйлат</a>
                <a href="javascript:;" data-map-shortkey="Нетания">Нетания</a>
                <a href="javascript:;" data-map-shortkey="Герцлия">Герцлия</a>
            </div>

            <div id="google-map-search">
                <div class="inner-addon right-addon">
                    <i class="glyphicon glyphicon-search"></i>
                    <input type="text" class="form-control" id="pac-input"
                           placeholder="Напишите город"/>
                </div>
            </div>

            <div class="checkbox-container">

                <div class="checkbox">


                    <label class="restaurants" data-map-filter="1">
                        <div class="form-control input-md">
                            <input type="checkbox" value="24" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Рестораны
                    </label>

                    <label class="purchases" data-map-filter="2">
                        <div class="form-control input-md">
                            <input type="checkbox" value="25" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Шоппинг
                    </label>

                    <label class="night-life" data-map-filter="3">
                        <div class="form-control input-md">
                            <input type="checkbox" value="26" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Бары
                    </label>

                    <label class="relax" data-map-filter="4">
                        <div class="form-control input-md">
                            <input type="checkbox" value="32" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Отдых
                    </label>

                    <label class="beauty" data-map-filter="5">
                        <div class="form-control input-md">
                            <input type="checkbox" value="42" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Красота
                    </label>


                    <label class="hotels" data-map-filter="6">
                        <div class="form-control input-md">
                            <input type="checkbox" value="43" checked="checked">
                            <i class="input-icon fa fa-check"></i>
                        </div>

                        Отели
                    </label>
                </div>

            </div>
        </div>


    </div>


</content>






