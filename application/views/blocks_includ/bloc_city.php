<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 17.01.2016
 * Time: 23:37
 */
?>
<hr>
<div class="w-bloc-right">
    <h2>По городам</h2>
    <? foreach ($data['general'] as $row): ?>

        <a href="/city/<?=$row['cityUrl'] ?>"><?=$row['cityName'] ?></a><br>

    <? endforeach ?>

    <!-- Single button -->
    <div class="btn-group" style="margin-top: 10px">

        <a href="#"  class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Другие города <span class="caret"></span> </a>
        <ul class="dropdown-menu">
            <? foreach ($data['all'] as $row_all): ?>
                <li><a href="/city/<?=$row_all['cityUrl'] ?>"><?=$row_all['cityName'] ?></a></li>
            <? endforeach ?>
        </ul>
    </div>

</div>
<hr>