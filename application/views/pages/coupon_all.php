<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.07.2015
 * Time: 18:09
 */
HTML::x($category);
//HTML::x(Model::factory('CouponsModel')->getCouponsFavoritesUserId(41));
?>
<script>
    $(document).ready(function(){

    });
</script>
<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">

                <div id="context">

                    <div class="panel panel-coupons">

                        <div class="panel-heading">

                            <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-coupons"
                               aria-controls="nav-coupons">
                                <i class="fa fa-bars"></i>
                            </a>

                            <div class="panel-title">Купоны</div>

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

                            <div class="collapse" id="nav-coupons">
                                <ul class="nav nav-pills panel-navigation">

                                    <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == URL::site('coupons').$pagesUrl) { echo 'active'; }?>"><a href="/coupons" >Все</a></li>
                                    <?foreach($category as $row_category):?>

                                        <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == '/coupons/'.$row_category['url'].$pagesUrl) { echo 'active'; }?>"><a href="/coupons/<?=$row_category['url']?>" ><?=$row_category['name']?></a></li>

                                    <?endforeach?>

                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <!--Coupons-->
                            <?=$content_coupons?>

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