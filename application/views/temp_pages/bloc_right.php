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
        <?foreach ($data_bloc as $row_bloc):?>

            <?=$row_bloc?>

        <?endforeach?>
    <?endif?>
</div>

