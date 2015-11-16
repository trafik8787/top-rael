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
                <div id="context">
                    <?=isset($data) ? $data : ''?>
                    <?if (isset($data_list)):?>
                        <h3>Выпуски рассылки</h3>
                        <?foreach ($data_list as $row):?>
                            <a href="/newsletter/<?=$row['id']?>"><?=$row['data']?></a><br>
                        <?endforeach?>
                    <?endif?>
                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>