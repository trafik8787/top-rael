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

        $(document).on('click', '.w-button-add', function(){
            var add = '<li class="media add">'+
                '<input type="file" title="Єто поле обязательно" required name="filename[]"/><b>470х340</b>'+
            '<div class="media-body text-left">'+
            '<input type="text" name="title[]" class="form-control" value=""  placeholder="Описание"></div>'+
            '<p> <button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Удалить</button></p>'+
            '</li>';
            $(".media-list li").first().before(add);
            return false;
        });

        $(document).on('click', '.w-button-delete', function(){
            $(this).parents('li').detach();
            return false;
        });

    });
</script>

<div class="col-sm-offset-2 col-sm-10">
    <b>"Обратите внимание! Фотографии должны быть весом не более 200 Kb. Максимальный размер 1200 px</b>
    <div class="row">
        <div class="col-md-12">
            <p> <button type="button" class="btn btn-default btn-lg w-button-add"><span class="glyphicon glyphicon-plus"></span> Добавить</button></p>
            <ul class="media-list">
                    <li></li>
                    <?if (isset($list)):?>
                    <?foreach($list as $row):?>
                        <li class="media edit">
                            <img class="media-object pull-left" src="/uploads/img_galery/thumbs/<?=basename($row['filename'])?>" alt="" width="15%">
                            <input type="hidden" name="filename[<?=$row['id']?>]" value="<?=$row['filename']?>"/>
                            <input type="file" title="dfg" name="filename[<?=$row['id']?>]"/>
                            <div class="media-body text-left">
                                <input type="text" name="title[<?=$row['id']?>]" class="form-control" value="<?=$row['title']?>"  placeholder="Описание">

                            </div>
                            <p> <button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Удалить</button></p>
                        </li>
                    <?endforeach?>
                <?endif?>

            </ul>

        </div>
    </div>
</div>

