<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 31.07.2015
 * Time: 15:20
 */

?>

<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.07.2015
 * Time: 18:09
 */

?>

<div class="row">

    <div class="col-md-5 col-md-offset-3">


        <h3>Свяжитесь с нами</h3>

        <form class="form-horizontal" role="form" method="post">
            <div class="form-group">
                <label for="inputFullname" class="col-sm-2 control-label">Ваше полное имя</label>
                <div class="col-sm-10">
                    <input type="text" name="fullname" class="form-control" id="inputFullname" >
                </div>
            </div>

            <div class="form-group">
                <label for="inputCity" class="col-sm-2 control-label">Страна проживания</label>
                <div class="col-sm-10">
                    <input type="text" name="city" class="form-control" id="inputCity" >
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="inputEmail3">
                </div>
            </div>

            <div class="form-group">
                <label for="inputTel" class="col-sm-2 control-label">Телефон</label>
                <div class="col-sm-10">
                    <input type="text" name="tel" class="form-control" id="inputTel">
                </div>
            </div>

            <div class="form-group">
                <label for="inputDesc" class="col-sm-2 control-label">Ваше сообщение</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputDesc" name="desc" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-9 col-sm-1">
                    <button type="submit" class="btn btn-default">Отправить</button>
                </div>
            </div>
        </form>
    </div>


</div>