<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 27.04.2016
 * Time: 0:37
 */

if (!empty($_GET['activ'])) {
    $activ = $_GET['activ'];
}

?>




<?if (isset($form)):?>

    <script>
        $(document).ready(function(){

            $(document).on('change', '.filtr_activ', function(){
                $('<?=$form?>').submit();
            });
        });
    </script>

<div style="margin-top: 10px">
    <label class="checkbox-inline">
        <input type="radio" name="activ" class="filtr_activ" <?if (isset($activ) AND $activ == 3) { echo 'checked'; } ?> checked value="3"> Все
    </label>

    <label class="checkbox-inline">
        <input type="radio" name="activ" class="filtr_activ" <?if (isset($activ) AND $activ == 1) { echo 'checked'; } ?> value="1"> Активные
    </label>
    <label class="checkbox-inline">
        <input type="radio" name="activ" class="filtr_activ" <?if (isset($activ) AND $activ == 2) { echo 'checked'; } ?>  value="2"> Отключенные
    </label>
</div>

<?else:?>
    <script>
        $(document).ready(function(){

            $(document).on('change', '.filtr_activ', function(){
                $('#w-filtr-activ').submit();
            });
        });
    </script>
    <form role="form" action="" id="w-filtr-activ">
        <div style="margin-top: 10px">
            <label class="checkbox-inline">
                <input type="radio" name="activ" class="filtr_activ" <?if (isset($activ) AND $activ == 3) { echo 'checked'; } ?> checked value="3"> Все
            </label>

            <label class="checkbox-inline">
                <input type="radio" name="activ" class="filtr_activ" <?if (isset($activ) AND $activ == 1) { echo 'checked'; } ?> value="1"> Активные
            </label>
            <label class="checkbox-inline">
                <input type="radio" name="activ" class="filtr_activ" <?if (isset($activ) AND $activ == 2) { echo 'checked'; } ?>  value="2"> Отключенные
            </label>
        </div>

    </form>
<?endif?>
