<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.11.2015
 * Time: 23:26
 */
?>

<div class="form-group has-feedback">

    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne2">
                            Статистика
                        </a>
                    </h4>
                </div>
                <div id="collapseOne2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>Просмотров бизнес страницы:</td>
                                <td><?=isset($business_show) ? $business_show : ''?></td>
                            </tr>
                            <tr>
                                <td>Просмотр купонов бизнеса:</td>
                                <td><?=isset($coupons_show) ? $coupons_show : ''?></td>
                            </tr>
                            <tr>
                                <td>Просмотр статей бизнеса:</td>
                                <td><?=isset($article_show) ? $article_show : ''?></td>
                            </tr>
                            <tr>
                                <td>Количество выпусков рассылки</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Количество добавленно в избранное:</td>
                                <td><?=isset($business_favorit) ? $business_favorit : ''?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>