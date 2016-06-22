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

                                <? foreach ($data_bus as $row): ?>
                                    <tr>
                                        <td><?=$row['id'] ?></td>
                                        <td><?= $row['name']?></td>
                                        <td><?= $row['count_vievs']?></td>
                                        <td><?= $row['count_favor']?></td>
                                    </tr>
                                <? endforeach ?>

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


                                <? foreach ($data_articles as $row): ?>
                                    <tr>
                                        <td><?=$row['id'] ?></td>
                                        <td><?= $row['name']?></td>
                                        <td><?= $row['count_vievs']?></td>
                                        <td><?= $row['count_favor']?></td>
                                    </tr>
                                <? endforeach ?>

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


                            <? foreach ($data_coupons as $row): ?>
                                <tr>
                                    <td><?=$row['id'] ?></td>
                                    <td><?= $row['name']?></td>
                                    <td><?= $row['count_vievs']?></td>
                                    <td><?= $row['count_favor']?></td>
                                </tr>
                            <? endforeach ?>

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


                            <? foreach ($data_baners as $row): ?>
                                <tr>
                                    <td><?=$row['id'] ?></td>
                                    <td><?= $row['name']?></td>
                                    <td><?= $row['count_vievs']?></td>
                                </tr>
                            <? endforeach ?>

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
        <form action="" method="post">
            <button type="submit" name="import_static" value="1" class="btn btn-danger" style="margin-bottom: 10px;">Upgrade</button>
        </form>

        <form action="" method="post">
            <button type="submit" name="update_informer" value="1" class="btn btn-danger" style="margin-bottom: 10px;">Upgrade Informders</button>
        </form>


        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Кпопку выше Не нажимать!</strong> Кнопка для импорта данных. Служебная!
        </div>
    </div>
</div>

<script>

    function get_date(data = null, day)
    {
        if (data == null) {
            data = formatDate();
        }

        data = data.split('/');
        data = new Date(data[2], +data[1]-1, +data[0]-day, 0, 0, 0, 0);
        data = [data.getDate(),data.getMonth()+1,data.getFullYear()];
        data = data.join('/').replace(/(^|\/)(\d)(?=\/)/g,"$10$2");
        return data
    }


    function formatDate() {

        date = new Date();
        var dd = date.getDate();
        if (dd < 10) dd = '0' + dd;

        var mm = date.getMonth() + 1;
        if (mm < 10) mm = '0' + mm;

        var yy = date.getFullYear();
        if (yy < 10) yy = '0' + yy;

        return dd + '/' + mm + '/' + yy;
    }


    $(document).ready(function() {

        $(document).on('click', '.demo .w-calendar-bus', function(){
            $('input[name="daterange"]').trigger('click');
        });

        $(document).on('click', '.demo .w-calendar-article', function(){
            $('input[name="daterange_article"]').trigger('click');
        });


        $(document).on('click', '.demo .w-calendar-coupons', function(){
            $('input[name="daterange_coupons"]').trigger('click');
        });


        $(document).on('click', '.demo .w-calendar-baners', function(){
            $('input[name="daterange_baners"]').trigger('click');
        });




        $('input[name="daterange"]').daterangepicker({
            //"timePickerIncrement": 43200,
            locale: {
                format: 'DD/MM/YYYY'
            },
            "alwaysShowCalendars": true,
            "startDate": get_date(null, 30),
            "endDate": formatDate()
        }, function(start, end, label) {
            console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
        });




        $('input[name="daterange_article"]').daterangepicker({
            //"timePickerIncrement": 43200,
            locale: {
                format: 'DD/MM/YYYY'
            },
            "alwaysShowCalendars": true,
            "startDate": get_date(null, 30),
            "endDate": formatDate()
        }, function(start, end, label) {
//                console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
        });


        $('input[name="daterange_coupons"]').daterangepicker({
            //"timePickerIncrement": 43200,
            locale: {
                format: 'DD/MM/YYYY'
            },
            "alwaysShowCalendars": true,
            "startDate": get_date(null, 30),
            "endDate": formatDate()
        }, function(start, end, label) {
//                console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
        });


        $('input[name="daterange_baners"]').daterangepicker({
            //"timePickerIncrement": 43200,
            locale: {
                format: 'DD/MM/YYYY'
            },
            "alwaysShowCalendars": true,
            "startDate": get_date(null, 30),
            "endDate": formatDate()
        }, function(start, end, label) {
//                console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
        });










        $('#table-bus, #table-article, #table-coupons, #table-baners').DataTable({
            "pagingType": "full_numbers",

            "order": [[ 2, "desc" ]],

            "pageLength": 50,

            "oLanguage": {
                "sZeroRecords": "Нет записей",
                "sInfo": "Показано _START_ из _END_ всего _TOTAL_ записей",
                "sLengthMenu": "Показать _MENU_ записей",
                "sSearch": "Поиск",
                "sInfoEmpty": "Нет записей для отображения",




                "oPaginate": {
                    "sNext": "Вперед",
                    "sLast": "Конец",
                    "sFirst": "Начало",
                    "sPrevious": "Назад"

                }
            }

        });
    } );

</script>