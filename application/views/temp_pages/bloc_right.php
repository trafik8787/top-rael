<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 23.05.2015
 * Time: 16:48
 */
?>

<div class="col-md-4">
    <?if (!empty($data_bloc)):?>

        <?if (!empty($data_bloc['lotery'])):?>
            <?=$data_bloc['lotery']?>
        <?endif?>
        <div>
            <?foreach ($data_bloc as $key => $row_bloc):?>

                <? if ($key !== 'lotery'): ?>

                    <?=$row_bloc?>
                <? endif ?>

            <?endforeach?>

        </div>
    <?endif?>
</div>

