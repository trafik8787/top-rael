<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.07.2015
 * Time: 18:09
 */

?>

<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">

                <div id="context">

                    <div class="row">
                        <div class="panel panel-coupons-thumbnail">

                            <div class="panel-heading">

                                <div class="panel-title">Купоны</div>

                                <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-coupons"
                                   aria-controls="nav-coupons">
                                    <i class="fa fa-bars"></i>
                                </a>

                                <div class="panel-heading-sub form-inline">
                                    <form action="" method="get" id="w-form-city">
                                        <select class="form-control w-select-city" name="city" style="width: 20%">
                                            <option value="">По городам</option>
                                            <?foreach($city as $key_id => $row_city):?>
                                                <option <?if ($city_id == $key_id) { echo 'selected="selected"';}?> value="<?=$key_id?>"><?=$row_city?></option>
                                            <?endforeach?>
                                        </select>
                                    </form>
                                </div>

                                <div class="collapse" id="nav-coupons">
                                    <ul class="nav nav-pills" role="tablist">

                                        <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == URL::site('coupons').$pagesUrl) { echo 'active'; }?>"><a href="/coupons" >Все</a></li>
                                        <?foreach($category as $row_category):?>

                                            <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == '/coupons/'.$row_category['url'].$pagesUrl) { echo 'active'; }?>"><a href="/coupons/<?=$row_category['url']?>" ><?=$row_category['name']?></a></li>

                                        <?endforeach?>

                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">

                                <?foreach($data as $rows_data):?>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="coupon">
                                                <div class="coupon-container">

                                                    <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                                                    <div class="coupon-image">
                                                        <div class="overlay">
                                                            <?=$rows_data[0]['secondname']?>
                                                        </div>

                                                        <img src="/public/uploade/coupon.jpg" width="155" height="125" alt=""
                                                             title=""/>
                                                    </div>

                                                    <div class="coupon-context">

                                                        <div>
                                                            <span>СКИДКА</span>
                                                            <span><strong>20%</strong></span>
                                                            <span><small>На все пищевые добавки</small></span>
                                                        </div>

                                                        <small class="coupon-date">до 1 Апр 2015</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?if (!empty($rows_data[1])):?>
                                            <div class="col-md-6">

                                                <div class="coupon">
                                                    <div class="coupon-container">

                                                        <a href="#" class="pin"><i class="fa fa-thumb-tack"></i></a>

                                                        <div class="coupon-image">
                                                            <div class="overlay">
                                                                <?=$rows_data[1]['secondname']?>
                                                            </div>

                                                            <img src="/public/uploade/coupon.jpg" width="155" height="125" alt=""
                                                                 title=""/>
                                                        </div>

                                                        <div class="coupon-context">

                                                            <div class="fz large"><strong>Десерт в Подарок</strong></div>
                                                            <small>На все пищевые добавки</small>

                                                            <small class="coupon-date">до 1 Апр 2015</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endif?>
                                    </div>

                                    <br/>
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