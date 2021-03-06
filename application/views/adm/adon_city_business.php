<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 24.07.2015
 * Time: 15:46
 */
?>
<script>
    $(document).ready(function(){
        $(document).on('click', '.w-button-add', function(){
            var add = '<li class="edit"><select name="dop_sity[]" class="form-control chosen-select" id="">' +

                '<option value=""></option>' +
                <?foreach ($list_sity as $row_list):?>
                    '<option value="<?=$row_list['name']?>"><?=$row_list['name']?></option>'+
                <?endforeach?>
                '</select>' +
                '<div class="form-inline">' +
                '<input class="form-control" placeholder="Адрес" type="text" name="dop_addres[]" value="" style="width: 46%;"/>' +
                '<input class="form-control" placeholder="Телефон" type="text" name="tel_dop_adress[]" value=""/>'+
                '<input class="form-control" placeholder="Расписание" type="text" name="dop_sheduler[]" value=""/>'+
                '<br/>'+
                '<input class="form-control" placeholder="Широта" type="text" name="maps_x[]" value=""/>' +
                '<input class="form-control" placeholder="Долгота" type="text" name="maps_y[]" value=""/>' +
                '</div>'+
                '<p> <button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Удалить</button></p></li>';
            $(".media-list li.edit").last().after(add);
            jQuery('.chosen-select').chosen({no_results_text:'Нет результатов по'});
            return false;
        });

        $(document).on('click', '.w-button-delete', function(){
            $(this).parents('li').detach();
            return false;
        });
    });
</script>

<div class="form-group has-feedback" style="margin-top: 5%;">

    <label for="Видео" class="col-sm-2 control-label">Добавить адреса</label>
    <div class="col-sm-10">
        <ul class="media-list">
            <li></li>
            <?if ($data !=null):?>
                <?foreach ($data as $key => $row_data):?>
                    <li class="edit">
                        <select name="dop_sity[<?=$key?>]" data-placeholder="Выбрать город" class="form-control chosen-select" id="">
                            <option value=""></option>
                            <?foreach ($list_sity as $row_list):?>

                                <option  value="<?=$row_list['name']?>" <?if ($row_list['name'] == $row_data['name']) {echo 'selected="selected"';}?>><?=$row_list['name']?></option>
                            <?endforeach?>
                        </select>
                        <div class="form-inline">
                            <input class="form-control" placeholder="Адрес" name="dop_addres[<?=$key?>]" type="text" value="<?=$row_data['address']?>" style="width: 46%;"/>
                            <input class="form-control" placeholder="Телефон" type="text" name="tel_dop_adress[<?=$key?>]" value="<?=isset($row_data['tel_dop_adress']) ? $row_data['tel_dop_adress'] : ''?>"/>
                            <input class="form-control" placeholder="Расписание" type="text" name="dop_sheduler[<?=$key?>]" value="<?=isset($row_data['dop_sheduler']) ? $row_data['dop_sheduler'] : ''?>"/>
                            <br/>
                            <input class="form-control" placeholder="Широта" type="text" name="maps_x[<?=$key?>]" value="<?=$row_data['maps_x']?>"/>
                            <input class="form-control" placeholder="Долгота" type="text" name="maps_y[<?=$key?>]" value="<?=$row_data['maps_y']?>"/>
                        </div>
                        <p> <button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Удалить</button></p>
                    </li>
                <?endforeach?>
            <?else:?>
                <li class="edit">
                    <select name="dop_sity[]" class="form-control chosen-select" id="">
                        <option value=""></option>
                        <?foreach ($list_sity as $row_list):?>

                            <option value="<?=$row_list['name']?>"><?=$row_list['name']?></option>
                        <?endforeach?>
                    </select>
                    <div class="form-inline">
                        <input class="form-control" placeholder="Адрес" name="dop_addres[]" type="text" value="" style="width: 46%;"/>
                        <input class="form-control" placeholder="Телефон" type="text" name="tel_dop_adress[]" value=""/>
                        <input class="form-control" placeholder="Расписание" type="text" name="dop_sheduler[]" value=""/>
                        <br/>
                        <input class="form-control" placeholder="Широта" type="text" name="maps_x[]" value=""/>
                        <input class="form-control" placeholder="Долгота" type="text" name="maps_y[]" value=""/>
                    </div>
                </li>
            <?endif?>
        </ul>
        <p> <button type="button" class="btn btn-default btn-lg w-button-add"><span class="glyphicon glyphicon-plus"></span> Добавить</button></p>

    </div>
</div>