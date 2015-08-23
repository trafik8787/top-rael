<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */
//HTML::x($data);
?>
<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">
                <div id="context">
                    <input type="hidden" class="w-tags-url" value="<?=$tags_url?>"/>
                    <?foreach($data as $key => $rowsdata):?>

                        <?if (!empty($rowsdata['data'])):?>

                            <div class="row w-bloc-section">
                                <div class="panel panel-thumbnail">

                                    <div class="panel-heading">

                                        <div class="panel-title"><?=$rowsdata['category'][0]['name']?></div>

                                        <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-restaurant"
                                           aria-controls="nav-restaurant">
                                            <i class="fa fa-bars"></i>
                                        </a>

                                        <div class="panel-heading-sub form-inline">

                                            <a href="#" class="btn btn-default" role="button">На карте</a>
                                        </div>

                                        <div class="collapse" id="nav-restaurant">

                                            <ul class="nav nav-pills w-category-bloc" role="tablist">

                                                <li role="presentation" class="active"><a href="/section/<?=$rowsdata['category'][0]['url']?>" data-section="<?=$rowsdata['category'][0]['url']?>" class="w-tags-bus-cat w-cat-active">Новые</a></li>

                                                <?foreach($rowsdata['category'][0]['childs'] as $row_category):?>
                                                    <li role="presentation"><a href="/section/<?=$rowsdata['category'][0]['url'].'/'.$row_category['url']?>" data-cat="<?=$row_category['url']?>" class="w-tags-bus-cat"><?=$row_category['name']?></a></li>

                                                <?endforeach?>

                                            </ul>

                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row slider">
                                            <?foreach ($rowsdata['data'] as $rows):?>
                                                <div class="col-md-4">
                                                    <div class="thumbnail">

                                                        <?if (!empty($rows['bussines_favorit']))://если купон добавлен в избранное?>
                                                            <a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                                                                <i class="fa fa-star"></i>
                                                            </a>
                                                        <?else:?>
                                                            <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows['id']?>" class="pin w-add-bussines-favor">
                                                                <i class="fa fa-star"></i>
                                                            </a>
                                                        <?endif?>


                                                        <a href="/business/<?=$rows['url']?>" class="thumbnail-image">

                                                            <img src="/uploads/img_business/thumbs/<?=basename($rows['home_busines_foto'])?>" width="240" height="150" alt="<?=$rows['name']?>">

                                                        </a>

                                                        <div class="caption">
                                                            <h3><strong><a href="/business/<?=$rows['url']?>"><?=$rows['name']?></a></strong></h3>

                                                            <p><strong><?=$rows['CityName']?>. <?=$rows['address']?></strong></p>

                                                            <?=Text::limit_chars(strip_tags($rows['info']), 150, null, true)?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?endforeach?>

                                        </div>
                                    </div>

                                    <div class="panel-footer text-center">
                                        <a href="/section/<?=$rowsdata['category'][0]['url']?>" class="btn btn-default  open-all" role="button">Открыть все</a>
                                    </div>
                                </div>
                            </div>

                            <hr/>
                        <?endif?>


                    <?endforeach?>

                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>