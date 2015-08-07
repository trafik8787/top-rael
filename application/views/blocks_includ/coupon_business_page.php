<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.08.2015
 * Time: 14:32
 */

?>

<?if (!empty($content)):?>
    <div class="panel panel-default">
        <div class="panel-heading">Купон</div>
        <div class="panel-body">
            <ul class="media-list">
                <?foreach ($content as $row):?>
                    <li class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="<?=$row['CoupImg']?>" alt="фото обзора">
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#"><?=$row['CoupSecondname']?></a></h5>
                            <?=Text::limit_chars(strip_tags($row['CoupInfo']), 100, null, true)?>
                        </div>
                    </li>
                <?endforeach?>
            </ul>
        </div>
    </div>
<?endif?>