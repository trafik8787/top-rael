<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 26.07.2015
 * Time: 14:27
 */
$section = '';
$citys = '';
if (!empty($_GET['section'])) {
    $section = $_GET['section'];
}

if (!empty($_GET['city'])) {
    $citys = $_GET['city'];
}



?>
<script>
    $(document).ready(function(){
        $(document).on('change', '#filtr_section_adm', function(){
            $('#filtr_city_adm').val('');
            $('#w-form-filtr-adm').submit();
        });

        $(document).on('change', '#filtr_city_adm', function(){
            $('#w-form-filtr-adm').submit();
        });

    });
</script>
<form role="form" action="" id="w-form-filtr-adm">
    <select name="section" class="form-control chosen-select" data-placeholder="Выбрать раздел" id="filtr_section_adm">
        <option value=""></option>
        <?foreach ($data as $row_list):?>

            <option  value="<?=$row_list['id']?>" <?if ($row_list['id'] == $section) {echo 'selected="selected"';}?>><?=$row_list['name']?></option>
        <?endforeach?>
    </select>
    <?if (!empty($city)):?>
        <select name="city" class="form-control chosen-select" data-placeholder="Выбрать город" id="filtr_city_adm">
            <option value="">Выбрать город</option>
            <?foreach ($city as $key => $row_city):?>
                <option  value="<?=$key?>" <?if ($key == $citys) {echo 'selected="selected"';}?>><?=$row_city?></option>
            <?endforeach?>
        </select>
    <?endif?>

    <?=isset($activ) ? $activ : '' ?>

</form>
