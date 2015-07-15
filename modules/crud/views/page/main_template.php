<?php defined('SYSPATH') or die('No direct script access.'); ?>

<link type="text/css" href="/public_a/js/DataTables-1.10.0/media/css/jquery.dataTables.css" rel="stylesheet" media="screen">
<link type="text/css" href="/public_a/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link type="text/css" href="/public_a/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link type="text/css" href="/public_a/css/style/style.css" rel="stylesheet" media="screen">
<link type="text/css" href="/public_a/js/DataTables-1.10.0/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" media="screen">
<link type="text/css" href="/public_a/js/lightbox/css/lightbox.css" rel="stylesheet" media="screen">
<link type="text/css" href="/public_a/css/chosen.min.css" rel="stylesheet" media="screen">
<link type="text/css" href="/public_a/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<script type="text/javascript" src="/public_a/js/DataTables-1.10.0/media/js/jquery.js"></script>
<script type="text/javascript" src="/public_a/js/DataTables-1.10.0/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="/public_a/js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="/public_a/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/public_a/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/public_a/js/app/app.js"></script>
<script type="text/javascript" src="/public_a/js/DataTables-1.10.0/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="/public_a/js/lightbox/js/lightbox.min.js"></script>
<script type="text/javascript" src="/public_a/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="/public_a/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/public_a/js/jquery.validate.min.js"></script>





<div class="container-fluid">
    <nav class="navbar navbar-fixed-top" id="top">
        <div class="container-fluid">
            <div class="navbar-header">

                <a class="navbar-brand" href="/">TOPISRAEL</a>

            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/administrator/logout">Выход</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row">

        <nav class="navbar navbar-default sidebar" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?foreach ($meny as $name => $link):?>

                            <?if (!empty($link['category'])):?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$name?> <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon <?=$link['icon']?>"></span></a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <?foreach ($link['category'] as $rews):?>
                                            <li <? if (URL::site(Request::detect_uri()) == $link['url'].'/'.$rews['id']) { echo 'class="active"';}?>><a href="<?=$link['url'].'/'.$rews['id']?>"><?=$rews['name']?></a></li>
                                        <?endforeach?>
                                    </ul>
                                </li>
                            <?else:?>
                                <li <? if (URL::site(Request::detect_uri()) == $link['url']) { echo 'class="active"';}?> ><a href="<?=$link['url']?>"><?=$name?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon <?=$link['icon']?>"></span></a></li>
                            <?endif?>

                        <?endforeach?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="col-md-11" style="margin-top: 2%; left: 5%">
           <h2 class="page-header"><?=$title_page?></h2>

            <div class="row placeholders">
                            <?=@$render;?>


            </div>

        </div>
    </div>
</div>