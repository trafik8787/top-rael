<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?//HTML::x(unserialize($value_fild), true)?>
<?
    if ($type_field_upload == 'img') {

        if (!empty($value_fild)) {

            try {

                $value_fild = unserialize($value_fild); ?>

                <?if (!empty($value_fild)):?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>File</th>
<!--                                <th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                        <?$exemple_id = uniqid()?>
                        <? foreach ($value_fild as $row): ?>

                             <tr class="w-tr-hover-file-del">
                               <td>
                                   <a class="example-image-link" href="<?=$row?>" data-lightbox="example-<?=$exemple_id?>" data-title="Optional caption."><img width="70" src="<?=$row?>" alt=""></a>
                                   <input type="hidden" name="editfile-<?=$name_fied?>[]" value="<?=$row?>">
                                   <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"></span>
                                   <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none"></span>

                                   <span class="glyphicon glyphicon-remove w-delete"></span>

                               </td>

<!--                               <td><a class="w-delete" href="#">del</a></td>-->
                            </tr>
                        <?endforeach?>
                        </tbody>
                    </table>
                <?endif?>

           <? } catch (Exception $e) { ?>
                <div class="w-tr-hover-file-del">
                    <img width="200" src="<?=$value_fild?>" alt="">
                    <input type="hidden" name="editfile-<?=$name_fied?>" value="<?=$value_fild?>">
                    <a class="w-delete" href="#"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
           <? } ?>

        <?
        }

    } elseif ($type_field_upload == 'others') {?>


        <? if (!empty($value_fild)) {

            try {

                $value_fild = unserialize($value_fild); ?>


                <?if (!empty($value_fild)):?>



                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <? foreach ($value_fild as $row): ?>
                                <tr class="w-tr-hover-file-del">
                                    <td>

                                        <a class="w-download" href="<?=URL::site(substr($row, 1), 'http')?>"><?=basename($row)?></a>
                                        <input type="hidden" name="editfile-<?=$name_fied?>[]" value="<?=$row?>">
                                    </td>

                                    <td><a class="w-delete" href="#"><span class="glyphicon glyphicon-remove"></span></a></td>
                                </tr>
                            <?endforeach;?>
                        </tbody>
                    </table>



                <?endif?>

            <? } catch (Exception $e) { ?>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?if (!empty($value_fild)):?>
                        <tr class="w-tr-hover-file-del">
                            <td>

                                <a class="w-download" href="<?=URL::site(substr($value_fild, 1), 'http')?>"><?=basename($value_fild)?></a>
                                <input type="hidden" name="editfile-<?=$name_fied?>" value="<?=$value_fild?>">
                            </td>

                            <td><a class="w-delete" href="#"><span class="glyphicon glyphicon-remove"></span></a></td>
                        </tr>
                    <?endif?>
                    </tbody>
                </table>

            <? } ?>


        <? }?>


    <?}?>

<?if (!empty($multiple)):?>

    <div class="w-input-form">
        <div class="entry input-group">
            <input type="file"  name="<?=$name_fied?>[]"/>
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

    <div class="w-input-form">
        <div class="entry input-group">
            <input type="file"  name="<?=$name_fied?>" data-toggle="tooltip"
                   data-placement="bottom"
                   title="<?=$title?>"/>
            <span class="glyphicon glyphicon-remove form-control-feedback" style="display: none"></span>
            <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none"></span>
        </div>
    </div>

<?endif?>

<span class="w-float-reset"></span>