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

                    <div class="row">
                        <div class="panel panel-media">

                            <div class="panel-heading">

                                <div class="panel-title">Обзоры</div>

                                <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-review"
                                   aria-controls="nav-review">
                                    <i class="fa fa-bars"></i>
                                </a>

                                <div class="panel-heading-sub">

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
                                    <ul class="nav nav-pills" role="tablist">

                                        <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == URL::site('articles').$pagesUrl) { echo 'active'; }?>"><a href="/articles" >Новые</a></li>
                                        <?foreach($category as $row_category):?>

                                            <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == '/articles/'.$row_category['url'].$pagesUrl) { echo 'active'; }?>"><a href="/articles/<?=$row_category['url']?>" ><?=$row_category['name']?></a></li>

                                        <?endforeach?>

                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <?if (!empty($data_shift)):?>

                                    <div class="well">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="/article/<?=$data_shift['url']?>">
                                                    <img src="/uploads/img_articles/thumbs/<?=basename($data_shift['images_article'])?>" width="260" height="190" class="media-object" alt="<?=$data_shift['name']?>"/>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h2 class="media-heading"><a href="/article/<?=$data_shift['url']?>"><strong><?=$data_shift['name']?></strong></a></h2>

                                                <p class="fz medium">
                                                    <strong>Пабы, дискотеки и чудесные пляжи</strong>
                                                    <br/>
                                                    <a href="/articles/<?=$data_shift['CatUrl']?>"><?=$data_shift['CatName']?></a>
                                                </p>
                                                <?=Text::limit_chars(strip_tags($data_shift['content']), 250, null, true)?>
                                            </div>
                                        </div>
                                    </div>
                                <?endif?>

                                <?foreach($data as $rows_data):?>

                                    <div>
                                        <?if (!empty($rows_data['CatUrl'])):?>
                                            <a href="/articles/<?=$rows_data['CatUrl']?>" class="fz medium"><?=$rows_data['CatName']?></a>
                                        <?endif?>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="/article/<?=$rows_data['url']?>">
                                                    <img src="/uploads/img_articles/thumbs/<?=basename($rows_data['images_article'])?>" width="260" height="190" class="media-object" alt="<?=$rows_data['name']?>"/>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h2 class="media-heading"><a href="/article/<?=$rows_data['url']?>"><strong><?=$rows_data['name']?></strong></a></h2>

                                                <p class="fz medium"><strong><?=$rows_data['secondname']?></strong>
                                                </p>

                                                <?=Text::limit_chars(strip_tags($rows_data['content']), 350, null, true)?>
                                            </div>
                                        </div>
                                    </div>

                                    <hr/>
                                <?endforeach?>

                            </div>

                            <div class="panel-footer text-center">
                                <nav>
                                    <?=$pagination?>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>
</content>