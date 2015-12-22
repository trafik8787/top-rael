<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.11.2015
 * Time: 23:26
 */
?>

<div class="form-group has-feedback">

    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne3">
                            Журнал
                        </a>
                    </h4>
                </div>
                <div id="collapseOne3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?if (!empty($data)):?>
                            <?foreach ($data as $rows):?>
                                    <span class="bg-warning"><?=$rows['date'].' - '.$rows['text']?></span><br/>
                            <?endforeach?>
                        <?else:?>

                            Журнал пуст...
                        <?endif?>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>