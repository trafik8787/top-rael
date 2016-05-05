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
</style>

<div class="row">
    <div class="col-md-12">
        <form action="" method="post">
            <input type="hidden" name="import_static" value="1">
            <button type="submit" class="btn btn-danger" style="margin-bottom: 10px;">Upgrade</button>
        </form>

        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Кпопку выше Не нажимать!</strong> Кнопка для импорта данных. Служебная!
        </div>
    </div>
</div>
<!-- Nav tabs -->

<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#bus" data-toggle="tab">Бизнесы</a></li>
            <li><a href="#article" data-toggle="tab">Обзоры</a></li>
            <li><a href="#coupons" data-toggle="tab">Купоны</a></li>
            <li><a href="#baners" data-toggle="tab">Баннеры</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div class="tab-pane fade in active" id="bus">

                <div class="row">

                    <form action="" method="post">
                        <div class="col-md-4 col-md-offset-3 demo">
                            <input type='text' name="daterange" class="form-control" value="" />
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>

                        </div>
                        <button type="submit" name="filtr_bussines" value="1" class="btn btn-primary">Фильтровать</button>
                    </form>


                </div>

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




            <div class="tab-pane fade" id="article">


                <table id="table-article" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name1</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                    <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                    </tr>
                    <tr>
                        <td>Ashton Cox</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>66</td>
                        <td>2009/01/12</td>
                        <td>$86,000</td>
                    </tr>
                    <tr>
                        <td>Cedric Kelly</td>
                        <td>Senior Javascript Developer</td>
                        <td>Edinburgh</td>
                        <td>22</td>
                        <td>2012/03/29</td>
                        <td>$433,060</td>
                    </tr>
                    <tr>
                        <td>Airi Satou</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>33</td>
                        <td>2008/11/28</td>
                        <td>$162,700</td>
                    </tr>
                    <tr>
                        <td>Brielle Williamson</td>
                        <td>Integration Specialist</td>
                        <td>New York</td>
                        <td>61</td>
                        <td>2012/12/02</td>
                        <td>$372,000</td>
                    </tr>
                    <tr>
                        <td>Martena Mccray</td>
                        <td>Post-Sales support</td>
                        <td>Edinburgh</td>
                        <td>46</td>
                        <td>2011/03/09</td>
                        <td>$324,050</td>
                    </tr>
                    <tr>
                        <td>Unity Butler</td>
                        <td>Marketing Designer</td>
                        <td>San Francisco</td>
                        <td>47</td>
                        <td>2009/12/09</td>
                        <td>$85,675</td>
                    </tr>
                    <tr>
                        <td>Howard Hatfield</td>
                        <td>Office Manager</td>
                        <td>San Francisco</td>
                        <td>51</td>
                        <td>2008/12/16</td>
                        <td>$164,500</td>
                    </tr>
                    <tr>
                        <td>Hope Fuentes</td>
                        <td>Secretary</td>
                        <td>San Francisco</td>
                        <td>41</td>
                        <td>2010/02/12</td>
                        <td>$109,850</td>
                    </tr>
                    <tr>
                        <td>Vivian Harrell</td>
                        <td>Financial Controller</td>
                        <td>San Francisco</td>
                        <td>62</td>
                        <td>2009/02/14</td>
                        <td>$452,500</td>
                    </tr>
                    <tr>
                        <td>Timothy Mooney</td>
                        <td>Office Manager</td>
                        <td>London</td>
                        <td>37</td>
                        <td>2008/12/11</td>
                        <td>$136,200</td>
                    </tr>


                    </tbody>
                </table>


            </div>





            <div class="tab-pane fade" id="coupons">dfghdfghd </div>
            <div class="tab-pane fade" id="baners">dgfhdfsghfsdgh</div>
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

        $(document).on('click', '.demo .fa-calendar', function(){
            $('input[name="daterange"]').trigger('click');
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







        $('#table-bus, #table-article').DataTable({
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