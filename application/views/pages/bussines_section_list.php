<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 22:30
 */
?>

<div class="row">
    <div class="col-md-9">

        <?foreach($data as $rows_data):?>
            <div style="width: 200px; border: 1px solid #000; display: inline-block">
                <img src="" alt="sdf"/>
                <h3><a href="/business/<?=$rows_data['url']?>"><?=$rows_data['name']?></a></h3>
                <h4><?=$rows_data['address']?></h4>
                <p><?=Text::limit_chars(strip_tags($rows_data['info']), 200, null, true)?></p>
            </div>
        <?endforeach?>
    </div>

    <div class="col-md-3">
        <?=isset($bloc_right)? $bloc_right : ''?>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <?=$pagination?>
    </div>
</div>