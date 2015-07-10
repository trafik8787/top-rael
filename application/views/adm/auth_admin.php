<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 18.03.2015
 * Time: 19:32
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin TOPISRAEL</title>
    <link rel="stylesheet" href="/public_a/css/style_admin.css">
    <link rel="stylesheet" href="/public_a/css/bootstrap.min.css">
    <script src="/public_a/js/jquery-1.11.2.min.js"></script>
    <script src="/public_a/js/app_adm.js"></script>
    <script src="/public_a/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">

        <div class="row" id="pwd-container">
            <div class="col-md-4"></div>

            <div class="col-md-4">
                <section class="login-form">
                    <form method="post" action="/administrator/login" role="login">
                        <img src="http://i.imgur.com/RcmcLv4.png" class="img-responsive" alt="" />
                        <input type="text" name="login" placeholder="Login" required class="form-control input-lg" />

                        <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password" required="" />


                        <div class="pwstrength_viewport_progress"></div>


                        <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Вход</button>


                    </form>

                    <div class="form-links">
                        <a href="/">www.<?=$_SERVER['HTTP_HOST']?></a>
                    </div>
                </section>
            </div>

            <div class="col-md-4"></div>


        </div>

    </div>
</body>
</html>


