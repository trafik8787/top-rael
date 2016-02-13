<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */
?>

<script src="/public/javascripts/methods.js" type="application/javascript"></script>
<script src="/public/javascripts/business.js" type="application/javascript"></script>
<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">
                <div id="context">
                    <form class="page">

                        <div class="panel">

                            <div class="panel-heading">
                                <div class="panel-title">Настройки внешего вида информера</div>
                            </div>

                            <div class="panel-body">

                                <div class="clearfix">

                                    <div class="form-group inline">
                                        <label for="cities">Города</label>
                                        <select name="cities[]" class="form-control input-lg col-md-6" id="cities"></select>
                                    </div>

                                    <div class="form-group inline">
                                        <label for="cities">Раздел</label>
                                        <select name="category[]" class="form-control input-lg col-md-6" id="category"></select>
                                    </div>

                                    <div class="form-group inline">
                                        <label>Кол-во анонсов</label>
                                        <select name="limit[]" class="form-control input-lg" id="limit"></select>
                                    </div>

                                    <div class="form-group inline">
                                        <label>Размер заголовка</label>
                                        <input type="number" name="font.size[title]" class="form-control input-lg"
                                               id="fontSizeName"/>
                                    </div>

                                    <div class="form-group inline">
                                        <label>Размер текста</label>
                                        <input type="number" name="font.size[text]" class="form-control input-lg"
                                               id="fontSizeText"/>
                                    </div>

                                    <div class="form-group inline">
                                        <label>Ширина</label>
                                        <input type="number" name="layout.width[]" class="form-control input-lg"
                                               id="layoutWidth"/>
                                    </div>

                                    <div class="form-group inline">
                                        <br/><br/>
                                        <label>Цвета заголовка</label>
                                        <input type="hidden" class="minicolors" name="font.color[title]" value="#113fd6"
                                               id="fontColorHeading"/>
                                    </div>

                                    <div class="form-group inline">
                                        <br/><br/>
                                        <label>Цвета текста</label>
                                        <input type="hidden" class="minicolors" name="font.color[text]" value="#000"
                                               id="fontColorText"/>
                                    </div>

                                    <div class="form-group inline">
                                        <br/><br/>
                                        <label>Цвет фона</label>
                                        <input type="hidden" class="minicolors" name="font.color[background]" value="#FFF"
                                               id="layoutBackgroundColor"/>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <hr/>

                        <div class="panel">

                            <div class="panel-heading">
                                <div class="panel-title">Так выглядит ваш информер</div>
                            </div>

                            <div class="panel-body">

                                <div class="col-md-12">

                                    <div id="topIsraelInformerBusiness"></div>

                                </div>
                            </div>

                        </div>

                        <hr/>

                        <div class="panel">

                            <div class="panel-heading">
                                <div class="panel-title">Код информера для вставки на ваш сайт</div>
                            </div>

                            <div class="panel-body">

                                <div class="col-md-12">
                                    <textarea name="code" class="form-control input-lg" rows="10" onclick="select()"></textarea>
                                    <br/>
                                    <button type="button" id="showCode" class="btn btn-primary btn-lg pull-right">Показать код
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>


            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>