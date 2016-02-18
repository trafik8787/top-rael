<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */

?>

<a href="/informers" class="btn btn-default <?if ('/'.Request::detect_uri() == '/informers') echo 'active' ?>">Бизнесы</a>
<a href="/informers/coupon" class="btn btn-default <?if ('/'.Request::detect_uri() == '/informers/coupon') echo 'active' ?>">Купоны</a>
<a href="/informers/article" class="btn btn-default <?if ('/'.Request::detect_uri() == '/informers/article') echo 'active' ?>">Статьи</a>

<script src="/public/javascripts/methods.js" type="application/javascript"></script>
<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">
                <div id="context">

                    <?=isset($data)? $data : ''?>

                </div>


            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>