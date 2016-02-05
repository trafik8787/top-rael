<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 05.02.2016
 * Time: 15:21
 */
?>


<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">
                <div id="context">

                   <h3>Отписатся от рассылки</h3>
                    <hr>
                    <?if (!empty($_GET['err_cap'])):?>
                        <span style="color: green"><?=base64_decode($_GET['err_cap'])?></span>
                    <?else:?>
                        <form class="form-inline" role="form" method="post">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">Email</label>
                                <input type="email" required="required" name="email" class="form-control" id="exampleInputEmail2" placeholder="Email">
                            </div>

                            <button type="submit" class="btn btn-default">Отписатся</button>
                        </form>
                    <?endif?>
                </div>
            </div>

            <!-- Bloc Right -->

            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>
