<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */
?>
<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">
                <div id="context" >
                    <?if (!empty($data)):?>
                        <?foreach ($data as $row):?>
                            <div class="well well-lg">
                                <a href="/business/<?=$row['BusUrl']?>">
                                    <p><?=$row['name'] ?></p>
                                </a>

                                <?=$row['text'] ?>
                            </div>
                        <?endforeach?>

                    <?else:?>
                        Нет новостей
                    <?endif?>
                    <?=$pagination?>
                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>