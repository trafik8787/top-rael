<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.07.2015
 * Time: 21:46
 */

?>

<div class="row">
    <div class="col-md-9">
        <img src="<?=$data['ArticImg']?>" alt="<?=$data['ArticName']?>" width="100%"/>
        <h4><?=$data['ArticName']?></h4>
        <div>
            <?=$data['ArticContent']?>
        </div>
<!--        --><?//HTML::x($data)?>
    </div>

    <div class="col-md-3">
        <?=isset($bloc_right)? $bloc_right : ''?>
    </div>
</div>
