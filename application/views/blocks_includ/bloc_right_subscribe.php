<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 24.01.2016
 * Time: 17:28
 */

?>
<style>
    .popover.bottom > .arrow.errors-email:after {
        border-bottom-color: #FF7272!important;
    }

    .popover.bottom > .arrow.susses-email:after {
        border-bottom-color: greenyellow!important;
    }
</style>

<div class="w-bloc-right">
    <h2>Подписка</h2>

    <form class="form-horizontal w-bloc-right-subscribe">


        <div class="form-group">
            <div class="col-md-10 col-xs-10">
                <input type="email" class="form-control w-input-email-subcribe"  name="email" required="required"  placeholder="Email">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-10 col-xs-10">
                <button value="1" type="submit" class="btn btn-primary w-subskrip-buton">Подписатся</button>
            </div>
        </div>


    </form>

</div>
<hr>
<div class="clearfix"></div>

