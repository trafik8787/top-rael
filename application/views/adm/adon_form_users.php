<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 14.07.2015
 * Time: 23:16
 */
//HTML::x($list);
?>
<script>
    $(document).ready(function(){

        $(document).on('click', '.w-button-add-zacaz', function(){
            var add = '<li class="media add">'+
                '<input type="file" title="Єто поле обязательно" required name="filename_zacaz[]"/>'+
            '<button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Удалить</button>'+
            '</li>';
            $(".w-file-zacaz li").first().before(add);
            return false;
        });

        $(document).on('click', '.w-button-add-brif', function(){
            var add = '<li class="media add">'+
                '<input type="file" title="Єто поле обязательно" required name="filename_brif[]"/>'+
            '<button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Удалить</button>'+
            '</li>';
            $(".w-file-brif li").first().before(add);
            return false;
        });

        $(document).on('click', '.w-button-add-cvitanciy', function(){
            var add = '<li class="media add">'+
                '<input type="file" title="Єто поле обязательно" required name="filename_cvitanciy[]"/>'+
            '<button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Удалить</button>'+
            '</li>';
            $(".w-file-cvitanciy li").first().before(add);
            return false;
        });

        $(document).on('click', '.w-button-delete', function(){
            $(this).parents('li').detach();
            return false;
        });

    });
</script>

<div class="form-group has-feedback">
    <label for="Заказы" class="col-sm-2 control-label">Заказы</label>
    <div class="col-sm-10">

        <p> <button type="button" class="btn btn-default btn-lg w-button-add-zacaz"><span class="glyphicon glyphicon-plus"></span> Добавить</button></p>
        <ul class="media-list w-file-zacaz">
            <li></li>
            <?if (!empty($list_zacaz)):?>
                <?foreach($list_zacaz as $row):?>
                    <li class="media edit">
                        <a href="<?=$row['path']?>"><?=basename($row['path'])?></a>
                        <input type="hidden" name="filename_zacaz[<?=$row['id']?>]" value="<?=$row['path']?>"/>
                        <input type="file" title="dfg" name="filename_zacaz[<?=$row['id']?>]"/>
                        <button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Удалить</button>
                    </li>
                <?endforeach?>
            <?endif?>

        </ul>

    </div>
</div>

<div class="form-group has-feedback">
    <label for="Бриф" class="col-sm-2 control-label">Бриф</label>
    <div class="col-sm-10">

        <p> <button type="button" class="btn btn-default btn-lg w-button-add-brif"><span class="glyphicon glyphicon-plus"></span> Добавить</button></p>
        <ul class="media-list w-file-brif">
            <li></li>
            <?if (!empty($list_brif)):?>
                <?foreach($list_brif as $row):?>
                    <li class="media edit">
                        <a href="<?=$row['path']?>"><?=basename($row['path'])?></a>
                        <input type="hidden" name="filename_brif[<?=$row['id']?>]" value="<?=$row['path']?>"/>
                        <input type="file" title="dfg" name="filename_brif[<?=$row['id']?>]"/>
                        <button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Удалить</button>
                    </li>
                <?endforeach?>
            <?endif?>

        </ul>

    </div>
</div>


<div class="form-group has-feedback">
    <label for="Бриф" class="col-sm-2 control-label">Квитанции</label>
    <div class="col-sm-10">

        <p> <button type="button" class="btn btn-default btn-lg w-button-add-cvitanciy"><span class="glyphicon glyphicon-plus"></span> Добавить</button></p>
        <ul class="media-list w-file-cvitanciy">
            <li></li>
            <?if (!empty($list_cvitanciy)):?>
                <?foreach($list_cvitanciy as $row):?>
                    <li class="media edit">
                        <a href="<?=$row['path']?>"><?=basename($row['path'])?></a>
                        <input type="hidden" name="filename_cvitanciy[<?=$row['id']?>]" value="<?=$row['path']?>"/>
                        <input type="file" title="dfg" name="filename_cvitanciy[<?=$row['id']?>]"/>
                        <button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Удалить</button>
                    </li>
                <?endforeach?>
            <?endif?>

        </ul>

    </div>
</div>