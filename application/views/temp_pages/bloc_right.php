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


        <div style="margin-bottom: 30px;">
            <?foreach ($data_bloc as $key => $row_bloc):?>

                <? if ($key !== 'lotery' and $key !== 'bloc_reclam'): ?>

                    <?=$row_bloc?>
                <? endif ?>

            <?endforeach?>

        </div>



        <?if (!empty($data_bloc['bloc_reclam'])): //для вывода банера на странице бизнеса отдельно?>
            <?=$data_bloc['bloc_reclam']?>
        <?endif?>

    <?endif?>
</div>

