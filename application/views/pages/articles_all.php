<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.07.2015
 * Time: 18:09
 */
//HTML::x($data);
?>

<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">

                <div id="context">

                    <div class="panel panel-list">

                        <div class="panel-heading">

                            <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-review"
                               aria-controls="nav-review">
                                <i class="fa fa-bars"></i>
                            </a>

                            <div class="panel-title">Обзоры</div>

                            <div class="panel-buttons-group">
                                <form action="" method="get" id="w-form-city">
                                    <select class="form-control w-select-city" name="city">
                                        <option value="">По городам</option>
                                        <?foreach($city as $key_id => $row_city):?>
                                            <option <?if ($city_id == $key_id) { echo 'selected="selected"';}?> value="<?=$key_id?>"><?=$row_city?></option>
                                        <?endforeach?>
                                    </select>
                                </form>
                            </div>

                            <div class="collapse" id="nav-review">
                                <ul class="nav nav-pills panel-navigation" role="tablist">
                                    <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == URL::site('articles').$pagesUrl) { echo 'active'; }?>"><a href="/articles" >Новые</a></li>
                                    <?foreach($category as $row_category):?>

                                        <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == '/articles/'.$row_category['url'].$pagesUrl) { echo 'active'; }?>"><a href="/articles/<?=$row_category['url']?>" ><?=$row_category['name']?></a></li>

                                    <?endforeach?>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">

                            <div class="list list-media">
                                <?if (!empty($data_shift)):?>
                                    <div class="list-item top">

                                        <div class="media">

                                            <div class="media-left">

                                                <a href="/article/<?=$data_shift['url']?>">
                                                    <img src="/uploads/img_articles/thumbs/<?=basename($data_shift['images_article'])?>" width="260" height="190" class="media-object" alt="<?=$data_shift['name']?>"/>
                                                </a>

                                            </div>

                                            <div class="media-body">

                                                <h2 class="media-heading">
                                                    <a href="/article/<?=$data_shift['url']?>"><strong><?=$data_shift['name']?></strong></a>
                                                    <small><?=$data_shift['secondname']?></small>

                                                    <a href="/articles/<?=$data_shift['CatUrl']?>" class="media-link"><?=$data_shift['CatName']?></a>
                                                </h2>

                                                <?=$data_shift['big_previev']?>
                                            </div>
                                        </div>

                                    </div>
                                <?endif?>

                                <div class="col-md-12">

                                    <?foreach($data as $rows_data):?>
                                        <div class="list-item">
                                            <?if (!empty($rows_data['CatUrl'])):?>
                                                <a href="/articles/<?=$rows_data['CatUrl']?>"><?=$rows_data['CatName']?></a>
                                            <?endif?>
                                            <div class="media">

                                                <div class="media-left">

                                                    <a href="/article/<?=$rows_data['url']?>">
                                                        <img src="/uploads/img_articles/thumbs/<?=basename($rows_data['images_article'])?>" width="260" height="190" class="media-object" alt="<?=$rows_data['name']?>"/>
                                                    </a>

                                                </div>

                                                <div class="media-body">

                                                    <h2 class="media-heading">
                                                        <a href="/article/<?=$rows_data['url']?>"><strong><?=$rows_data['name']?></strong></a>
                                                        <small><?=$rows_data['secondname']?></small>
                                                    </h2>

                                                    <?=$rows_data['big_previev']?>

                                                </div>
                                            </div>
                                        </div>

                                        <hr/>
                                    <?endforeach?>

                                </div>
                            </div>

                        </div>

                        <div class="panel-footer text-center">
                            <nav>
                                <?=$pagination?>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>
</content>