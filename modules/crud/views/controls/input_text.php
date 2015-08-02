<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?//print_r($value_fild)?>

<?if (!empty($multiple)):?>

    <?
        if(!empty($value_fild)) {

            try {
                $arr_value = unserialize($value_fild);
            } catch (Exception $e) {
                $arr_value = $value_fild;
            }

        }
    ?>

    <div class="w-input-form">

        <?if (!empty($arr_value)):?>

            <?if (is_array($arr_value)): //при условии что получен десереализованый масив?>

                <?foreach ($arr_value as $row):?>
                    <div class="entry input-group">
                        <input class="form-control" type="<?=$type_field?>" name="<?=$name_fied?>[]" data-toggle="tooltip"
                               data-placement="bottom"
                               title="<?=isset($title) ? $title : ''?>" value='<?=$row?>'>
                        <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"></span>
                        <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none"></span>
                            <span class="input-group-btn">
                                <button class="btn btn-remove btn-danger" type="button"><span class="glyphicon glyphicon-minus" style="padding: 3px"></span></button>
                            </span>
                    </div>
                <?endforeach?>

            <?else://если в базе не сериализованый обьект а подключили multiple?>

                <div class="entry input-group">
                    <input class="form-control" type="<?=$type_field?>" name="<?=$name_fied?>[]" data-toggle="tooltip"
                           data-placement="bottom"
                           title="<?=isset($title) ? $title : ''?>" value='<?=$arr_value?>'>
                    <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"></span>
                    <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none"></span>
                            <span class="input-group-btn">
                                <button class="btn btn-remove btn-danger" type="button"><span class="glyphicon glyphicon-minus" style="padding: 3px"></span></button>
                            </span>
                </div>

            <?endif?>
        <?endif?>

        <div class="entry input-group">
            <input <?=$attr?> class="form-control"
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="<?=isset($title) ? $title : ''?>"
                              type="<?=$type_field?>"
                              name="<?=$name_fied?>[]"
                              value=""/>
            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"></span>
            <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none"></span>
                <span class="input-group-btn">
                    <button class="btn btn-success btn-add" type="button">
                        <span class="glyphicon glyphicon-plus" style="padding: 3px"></span>
                    </button>
                </span>
        </div>


    </div>


<?else:?>

    <?
        switch ($type_field) {

            case 'date':
                $data_class = 'form_date';
              ?>
                <script type="text/javascript">
                    $(function () {
                        $('.form_date').datetimepicker({
                            locale: 'ru',
                            format: 'YYYY-MM-DD',
                            defaultDate: 'moment'
                        });
                    });
                </script>
                <?
            break;

            case 'datetime':
                $data_class = 'form_datetime';
                ?>
                <script type="text/javascript">
                    $(function () {
                        $('.form_datetime').datetimepicker({
                            locale: 'ru',
                            format: 'YYYY-MM-DD HH-mm-ss',
                            defaultDate: 'moment'
                        });
                    });
                </script>

                <?
            break;

            case 'time':
                $data_class = 'form_time';
                ?>
                <script type="text/javascript">
                    $(function () {
                        $('.form_time').datetimepicker({
                            locale: 'ru',
                            format: 'HH-mm-ss',
                            defaultDate: 'moment'
                        });
                    });
                </script>

                <?
            break;

        }


    ?>

    <?if ($type_field != 'time' AND $type_field != 'datetime' AND $type_field != 'date') {?>
        <input <?=$attr?> class="form-control"
                          data-toggle="tooltip"
                          data-placement="bottom"
                          title="<?=isset($title) ? $title : ''?>"
                          type="<?=$type_field?>"
                          name="<?=$name_fied?>"
                          value='<?if (!empty($value_fild)) echo $value_fild?>'
                          id="<?=$name_fied?>"/>
        <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"></span>
        <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none"></span>
    <?} else {?>

        <div class="input-group date col-md-5 <?=$data_class?>"  data-link-field="<?=$name_fied?>">
            <input <?=$attr?> class="form-control"
                              type="text"
                              data-toggle="tooltip"
                              title='<?=isset($title) ? $title : ''?>'
                              data-placement="bottom"
                              name="<?=$name_fied?>"
                              value='<?if (!empty($value_fild)) echo $value_fild?>'
                              id="<?=$name_fied?>"/>
            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"></span>
            <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none"></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        <input type="hidden" id="<?=$name_fied?>" value="" />


    <?}?>

<?endif?>
