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
                    <?if (!empty($data)):?>
                        <?foreach ($data as $row):?>

                            <div class="well">
                                <div class="media">
                                    <a class="pull-left" href="<?=$row['file']?>">
                                        <img class="media-object" src="<?=$row['img']?>" width="180">
                                    </a>
                                    <div class="media-body">
                                        <p><?=$row['info']?></p>
                                        <ul class="list-inline list-unstyled">
                                            <li>
                                                <span>
                                                    <i class="glyphicon glyphicon-calendar"></i>
                                                    <?=Date::rusdate(strtotime($row['date']))?>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        <?endforeach?>
                    <?else:?>
                        Нет журналов
                    <?endif?>
                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>