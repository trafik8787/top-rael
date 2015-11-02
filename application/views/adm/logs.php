<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 01.11.2015
 * Time: 11:00
 */

?>


<div class="panel panel-default">
    <div class="panel-heading">Журнал событий</div>
    <div class="w-logs panel-body">

        <?foreach ($data as $rows):?>
            <?if ($rows['status'] == 1):?>
                 <span class="bg-success"><?=$rows['date'].' - '.$rows['text']?></span><br/>
              <?elseif ($rows['status'] == 2):?>
                 <span class="bg-warning"><?=$rows['date'].' - '.$rows['text']?></span><br/>
               <?elseif ($rows['status'] == 3):?>
                <span class="bg-danger"><?=$rows['date'].' - '.$rows['text']?></span><br/>
            <?endif?>
        <?endforeach?>
    </div>

</div>
<div class="text-center">
<?=isset($pagination) ? $pagination : ''?>
</div>