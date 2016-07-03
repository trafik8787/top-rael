<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 05.05.2016
 * Time: 1:04
 */

?>




<style>
    .tab-pane {
        padding: 10px 0 0 0;
    }

    .demo i {
        position: absolute;
        bottom: 10px;
        right: 24px;
        top: auto;
        cursor: pointer;
    }

    .dataTable tr td {
        height: 44px;
    }
</style>


<!-- Nav tabs -->

<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs">

            <li class="<? if ($_GET['tab'] == 'bus'):?>active <?endif?>"><a href="?tab=bus">Бизнесы</a></li>
            <li class="<? if ($_GET['tab'] == 'articles'):?>active <?endif?>"><a href="?tab=articles">Обзоры</a></li>
            <li class="<? if ($_GET['tab'] == 'coupons'):?>active <?endif?>"><a href="?tab=coupons">Купоны</a></li>
            <li class="<? if ($_GET['tab'] == 'baners'):?>active <?endif?>"><a href="?tab=baners">Баннеры</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div class="tab-pane fade in <? if ($_GET['tab'] == 'bus'):?>active <?endif?>" id="bus">

                <div class="row">

                    <form action="" method="post">
                        <div class="col-md-4 col-md-offset-3 demo">
                            <input type='text' name="daterange" class="form-control" value="" />
                            <i class="glyphicon glyphicon-calendar fa fa-calendar w-calendar-bus"></i>

                        </div>
                        <button type="submit" name="filtr_bussines" value="1" class="btn btn-primary">Фильтровать</button>
                    </form>

                </div>

                <div class="row">

                    <div class="col-md-4 col-md-offset-3">
                        <?if (!empty($daterange_bus)):?>
                            <strong class="text-center">Отфильтровано с <?=$daterange_bus?></strong>
                        <?endif?>
                    </div>
                </div>



                <div class="row">

                    <div class="col-md-12">
                        <table id="table-bus" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Просмотры</th>
                                    <th>В избранном</th>

                                </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Просмотры</th>
                                <th>В избранном</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                <?if ($_GET['tab'] == 'bus'):?>
                                    <? foreach ($data_bus as $row): ?>
                                        <tr>
                                            <td><?=$row['id'] ?></td>
                                            <td><?= $row['name']?></td>
                                            <td><?= $row['count_vievs']?></td>
                                            <td><?= $row['count_favor']?></td>
                                        </tr>
                                    <? endforeach ?>
                                <?endif?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>



<!--            articles-->
            <div class="tab-pane fade in <? if ($_GET['tab'] == 'articles'):?>active<?endif?>" id="article">


                <div class="row">

                    <form action="" method="post">
                        <div class="col-md-4 col-md-offset-3 demo">
                            <input type='text' name="daterange_article" class="form-control" value="" />
                            <i class="glyphicon glyphicon-calendar fa fa-calendar w-calendar-article"></i>

                        </div>
                        <button type="submit" name="filtr_articles" value="1" class="btn btn-primary">Фильтровать</button>
                    </form>

                </div>

                <div class="row">

                    <div class="col-md-4 col-md-offset-3">
                        <?if (!empty($daterange_article)):?>
                            <strong class="text-center">Отфильтровано с <?=$daterange_article?></strong>
                        <?endif?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">

                        <table id="table-article" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Просмотры</th>
                                    <th>В избранном</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Просмотры</th>
                                    <th>В избранном</th>

                                </tr>
                            </tfoot>
                            <tbody>

                                <? if ($_GET['tab'] == 'articles'):?>
                                    <? foreach ($data_articles as $row): ?>
                                        <tr>
                                            <td><?=$row['id'] ?></td>
                                            <td><?= $row['name']?></td>
                                            <td><?= $row['count_vievs']?></td>
                                            <td><?= $row['count_favor']?></td>
                                        </tr>
                                    <? endforeach ?>
                                <?endif?>
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>




            <div class="tab-pane fade in <? if ($_GET['tab'] == 'coupons'):?>active<?endif?>" id="coupons">


                <div class="row">

                    <form action="" method="post">
                        <div class="col-md-4 col-md-offset-3 demo">
                            <input type='text' name="daterange_coupons" class="form-control" value="" />
                            <i class="glyphicon glyphicon-calendar fa fa-calendar w-calendar-coupons"></i>

                        </div>
                        <button type="submit" name="filtr_coupons" value="1" class="btn btn-primary">Фильтровать</button>
                    </form>

                </div>

                <div class="row">

                    <div class="col-md-4 col-md-offset-3">
                        <?if (!empty($daterange_coupons)):?>
                            <strong class="text-center">Отфильтровано с <?=$daterange_coupons?></strong>
                        <?endif?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">

                        <table id="table-coupons" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Просмотры</th>
                                <th>В избранном</th>

                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Просмотры</th>
                                <th>В избранном</th>

                            </tr>
                            </tfoot>
                            <tbody>

                            <? if ($_GET['tab'] == 'coupons'):?>
                                <? foreach ($data_coupons as $row): ?>
                                    <tr>
                                        <td><?=$row['id'] ?></td>
                                        <td><?= $row['name']?></td>
                                        <td><?= $row['count_vievs']?></td>
                                        <td><?= $row['count_favor']?></td>
                                    </tr>
                                <? endforeach ?>
                            <?endif?>

                            </tbody>
                        </table>

                    </div>
                </div>


            </div>



            <div class="tab-pane fade in <? if ($_GET['tab'] == 'baners'):?>active<?endif?>" id="baners">


                <div class="row">

                    <form action="" method="post">
                        <div class="col-md-4 col-md-offset-3 demo">
                            <input type='text' name="daterange_baners" class="form-control" value="" />
                            <i class="glyphicon glyphicon-calendar fa fa-calendar w-calendar-baners"></i>

                        </div>
                        <button type="submit" name="filtr_baners" value="1" class="btn btn-primary">Фильтровать</button>
                    </form>

                </div>

                <div class="row">

                    <div class="col-md-4 col-md-offset-3">
                        <?if (!empty($daterange_baners)):?>
                            <strong class="text-center">Отфильтровано с <?=$daterange_baners?></strong>
                        <?endif?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">

                        <table id="table-baners" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Клики</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Клики</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            <? if ($_GET['tab'] == 'baners'):?>
                                <? foreach ($data_baners as $row): ?>
                                    <tr>
                                        <td><?=$row['id'] ?></td>
                                        <td><?= $row['name']?></td>
                                        <td><?= $row['count_vievs']?></td>
                                    </tr>
                                <? endforeach ?>
                            <?endif?>

                            </tbody>
                        </table>

                    </div>
                </div>



            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row" style="margin-top: 20px">
            <div class="col-md-3">
                <form action="" method="post">
                    <button type="submit" name="import_static" value="1" class="btn btn-danger" style="margin-bottom: 10px;"><span class="glyphicon glyphicon-refresh"></span></button>
                    Обновить статистику бизнесов.
                </form>

            </div>
            <div class="col-md-4">
                <form action="" method="post">
                    <button type="submit" name="update_informer" value="1" class="btn btn-danger" style="margin-bottom: 10px;"><span class="glyphicon glyphicon-refresh"></span></button>
                    Обновление информеров.
                </form>

            </div>
        </div>

    </div>
</div>

