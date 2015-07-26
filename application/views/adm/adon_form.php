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
                '<input type="file" title="Єто поле обязательно" required name="filename[]"/>'+
            '<div class="media-body text-left">'+
            '<input type="text" name="title[]" class="form-control" value=""  placeholder="Описание"></div>'+
            '<p> <button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Delete</button></p>'+
            '</li>';
            $(".media-list li").last().after(add);
            return false;
        });

        $(document).on('click', '.w-button-delete', function(){
            $(this).parents('li').detach();
            return false;
        });

    });
</script>
<div class="col-sm-offset-2 col-sm-10">
    <div class="row">
        <div class="col-md-12">
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
                            <p> <button type="button" class="btn btn-default btn-lg w-button-delete"><span class="glyphicon glyphicon-remove-sign"></span> Delete</button></p>
                        </li>
                    <?endforeach?>
                <?endif?>

            </ul>
            <p> <button type="button" class="btn btn-default btn-lg w-button-add"><span class="glyphicon glyphicon-plus"></span> Add</button></p>
        </div>
    </div>
</div>

