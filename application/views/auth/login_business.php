<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 02.08.2015
 * Time: 23:14
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($seo_title) ? $seo_title : '' ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?= isset($seo_keywords) ? $seo_keywords : '' ?>">
    <meta name="description" content="<?= isset($seo_description) ? $seo_description : '' ?>">


    <? foreach ($style as $row_style): ?>
        <link rel="stylesheet" href="<?= URL::base(); ?><?= $row_style ?>">
    <? endforeach ?>

    <link href='//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic'
          rel='stylesheet' type='text/css'>

    <? foreach ($script as $row_script): ?>
        <script src="<?= URL::base(); ?><?= $row_script ?>"></script>
    <? endforeach ?>

    <? if (!empty($scripts_map)): //скрипт для карты?>
        <script src="<?= URL::base(); ?><?= $scripts_map ?>"></script>
    <? endif ?>
    <!--    <link rel="shortcut icon" href="../../public/img/favicon.ico" type="image/x-icon">-->
    <script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="windows-1251"></script>

</head>
<body>

<div id="wrapper" class="container">


    <header>
        <div id="header">

            <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-header" aria-controls="nav-header">
                <i class="fa fa-bars"></i>
            </a>

            <a href="/" class="icons logo">TopIsrael</a>

            <div class="collapse" id="nav-header">


            </div>
        </div>
    </header>


    <content>
        <div id="content">

            <div class="col-md-6 col-md-offset-3 page">



                <? if (isset($message)) echo '<span class="label label-important">' . $message . "</span><hr />"; ?>
                <form class="row" method="post" action="/account/login" role="form">

                    <div class="col-md-12">
                        <div class="form-title">Sign in</div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-md-4">
                            <label>Email</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="email" value="<?= $email; ?>" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-md-4">
                            <label>Password</label>
                        </div>
                        <div class="col-md-8">
                            <input type="password" name="password" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-md-8 col-md-offset-4">
                            <div class="checkbox">

                                <label>

                                    <div class="form-control input-lg">
                                        <input type="checkbox" name="rememberme" value="true" checked="checked">
                                        <i class="input-icon fa fa-check"></i>
                                    </div>

                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg  pull-right">Login</button>
                        <a href="/account/forgot" class="btn btn-primary btn-link btn-lg pull-right">Forgot your password?</a>
                    </div>

                </form>
            </div>
        </div>
    </content>


    <footer>

    </footer>
</div>
<div id="fb-root"></div>

</body>
</html>