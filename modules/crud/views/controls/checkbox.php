<?php defined('SYSPATH') or die('No direct script access.'); ?>

<script>
$(document).on('click', '.w-cheked-status', function() {
    if ($(this).prop('checked') == true){
        $('.w-hide-status').val(1);
    } else {
        $('.w-hide-status').val(0);
    }
});
</script>


<div class="w-chec has-error">
    <div class="checkbox">


            <?if(is_array($value_fild)):?>
                <?
                    if(!empty($origin_value_fild)) {

                        try {
                            $arr_value = unserialize($origin_value_fild);
                        } catch (Exception $e) {
                            $arr_value = $origin_value_fild;
                        }

                    }


                ?>

                <?if ($type_field == 'checkbox') :?>
                    <?$checked = '';?>
                    <?foreach ($value_fild as $val => $row):?>
                        <?
                            if (!empty($arr_value)) {
                                foreach ($arr_value as $rows_val) {
                                    if ($rows_val == $val) {
                                        $checked = 'checked';
                                    }
                                }
                            }
                        ?>

                        <label> <input <?=$attr?> type="checkbox" name="<?=$name_fied.'['.$val.']'?>" <?=$checked?> value="<?=$val?>"/> <?=$row?></label><br/>
                        <?$checked = '';?>
                    <?endforeach?>

                <?elseif ($type_field == 'radio'):?>

                    <?foreach ($value_fild as $val => $row):?>

                        <label> <input <?=$attr?> type="radio" name="<?=$name_fied?>" <?if (!empty($arr_value)):?><?if ($arr_value == $val):?> checked <?endif?><?endif?> value="<?=$val?>"/><?=$row?></label><br/>

                    <?endforeach?>

                <?endif?>


            <?else:?>

                <?if ($value_fild != 0):?>
                    <input <?=$attr?> class="w-cheked-status" name="<?=$name_fied?>" type="checkbox" checked value=""/>
                <?else:?>
                    <input <?=$attr?> class="w-cheked-status" name="<?=$name_fied?>" type="checkbox" value=""/>
                <?endif?>

                <input class="w-hide-status" name="<?=$name_fied?>" type="hidden" value="<?if (!empty($origin_value_fild)) { echo $origin_value_fild; } else {?>0<?}?>"/>

            <?endif?>

    </div>
</div>