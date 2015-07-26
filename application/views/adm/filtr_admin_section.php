<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 26.07.2015
 * Time: 14:27
 */
$section = '';
if (!empty($_GET['section'])) {
    $section = $_GET['section'];
}

?>
<script>
    $(document).ready(function(){
        $(document).on('change', '#filtr_section_adm', function(){
            $('#w-form-filtr-adm').submit();
        });
    });
</script>
<form role="form" action="" id="w-form-filtr-adm">
    <select name="section" class="form-control chosen-select" data-placeholder="Все" id="filtr_section_adm">
        <option value=""></option>
        <?foreach ($data as $row_list):?>

            <option  value="<?=$row_list['id']?>" <?if ($row_list['id'] == $section) {echo 'selected="selected"';}?>><?=$row_list['name']?></option>
        <?endforeach?>
    </select>
</form>
