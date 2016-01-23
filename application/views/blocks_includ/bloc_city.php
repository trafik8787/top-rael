<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 17.01.2016
 * Time: 23:37
 */

?>

<style>

    .w-bloc-right td {
        /*padding-right: 14%;*/
    }

    a.w-city-general {
        font-size: 15px;
    }

    .w-bloc-right .table>tbody>tr>td {
        border: none;
    }
</style>

<hr>
<div class="w-bloc-right">
    <h2>По городам</h2>
    <table class="table" style="margin-bottom: 6px;">
    <? foreach (array_chunk($data['general'], 3) as $row): ?>

        <tr>
            <td><a class="w-city-general" href="/city/<?=isset($row[0]['cityUrl']) ? $row[0]['cityUrl'] : '' ?>"><?=isset($row[0]['cityName']) ? $row[0]['cityName'] : '' ?></a></td>
            <td><a class="w-city-general" href="/city/<?=isset($row[1]['cityUrl']) ? $row[1]['cityUrl'] : '' ?>"><?=isset($row[1]['cityName']) ? $row[1]['cityName'] : '' ?></a></td>
            <td><a class="w-city-general" href="/city/<?=isset($row[2]['cityUrl']) ? $row[2]['cityUrl'] : '' ?>"><?=isset($row[2]['cityName']) ? $row[2]['cityName'] : '' ?></a></td>
        </tr>

    <? endforeach ?>
    </table>
    <!-- Single button -->
    <div class="btn-group" style="margin-top: 10px">

        <a href="#"  class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Другие города <span class="caret"></span> </a>

        <div class="dropdown-menu" style="width: 330px;">
            <table class="table">
            <? foreach (array_chunk($data['all'], 3) as $row_all): ?>

                <tr>
                    <td><a class="w-city-general" href="/city/<?=isset($row_all[0]['cityUrl']) ? $row_all[0]['cityUrl'] : '' ?>"><?=isset($row_all[0]['cityName']) ? $row_all[0]['cityName'] : '' ?></a></td>
                    <td><a class="w-city-general" href="/city/<?=isset($row_all[1]['cityUrl']) ? $row_all[1]['cityUrl'] : '' ?>"><?=isset($row_all[1]['cityName']) ? $row_all[1]['cityName'] : '' ?></a></td>
                    <td><a class="w-city-general" href="/city/<?=isset($row_all[2]['cityUrl']) ? $row_all[2]['cityUrl'] : '' ?>"><?=isset($row_all[2]['cityName']) ? $row_all[2]['cityName'] : '' ?></a></td>
                </tr>

            <? endforeach ?>
            </table>
        </div>

    </div>

</div>
<hr>