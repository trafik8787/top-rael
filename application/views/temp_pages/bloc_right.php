<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 23.05.2015
 * Time: 16:48
 */
?>


<div class="col-md-2">

    <div class="row">
        <div class="col-md-12">

            <?=isset($board_search) ? $board_search : ''?>


            <?=isset($bloc)? $bloc : ''?>

            <?
                if (isset($meny_right)) {

                    if (is_array($meny_right)) {
                        foreach ($meny_right as $row) {
                            echo $row;
                        }
                    } else {
                        echo $meny_right;
                    }
                }

            ?>

            <?=isset($news_top)? $news_top : ''?>

        </div>
    </div>

</div>