<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 27.07.2015
 * Time: 23:15
 */
?>

<div class="tabs-social">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">

        <li role="presentation" class="active">
            <a href="#tab-facebook" aria-controls="tab-facebook" role="tab" data-toggle="tab" class="social facebook">
                <i class="fa fa-facebook"></i>
            </a>
        </li>

        <li role="presentation" class="nav-twitter">
            <a href="#tab-twitter" aria-controls="tab-twitter" role="tab" data-toggle="tab" class="social twitter">
                <i class="fa fa-twitter"></i></a>
        </li>
        <li role="presentation" class="nav-vk">
            <a href="#tab-vk" aria-controls="tab-vk" role="tab" data-toggle="tab" class="social vk">
                <i class="fa fa-vk"></i>
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab-facebook">
            <div class="fb-page" data-href="https://www.facebook.com/facebook"
                 data-small-header="true" data-adapt-container-width="true"
                 data-hide-cover="true" data-show-facepile="true" data-show-posts="false"></div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab-twitter">Twitter</div>
        <div role="tabpanel" class="tab-pane" id="tab-vk">Vk</div>
    </div>
</div>