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
                    <p><a href="/feed/articles">Новые обзоры</a></p>
                    <p><a href="/feed/business">Новые бизнесы</a></p>
                    <p><a href="/feed/coupons">Новые купоны</a></p>
                    <p><a href="/feed/lotarey">Новая лотерея</a></p>
                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>