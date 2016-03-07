<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.03.2016
 * Time: 10:42
 */

?>

<form class="form-inline" role="form" method="post">
    <div class="form-group">
        <label class="sr-only" for="exampleInputPassword2"></label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">Clear</button>
</form>
<?if (!empty($syses)):?>
    <p class="text-success"><?=$syses ?></p>
<?endif?>
