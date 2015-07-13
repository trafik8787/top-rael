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


<nav class="navbar navbar-fixed-top" id="top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">TOPISRAEL</a>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/administrator/logout">Выход</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">

            <ul class="nav nav-sidebar">
                <?foreach ($meny as $name => $link):?>
                    <li <? if (URL::site(Request::detect_uri()) == $link) { echo 'class="active"';}?>>
                        <?if (is_array($link)):?>
                            <?=$name?>
                            <ul>
                                <?foreach ($link['category'] as $rews):?>
                                    <li><a href="<?=$link['url'].$rews['id']?>"><?=$rews['name']?></a></li>
                                <?endforeach?>
                            </ul>
                        <?else:?>
                            <a href="<?=$link?>"><?=$name?></a>
                        <?endif?>

                    </li>
                <?endforeach?>

            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"><?=$title_page?></h1>

            <div class="row placeholders">

                <?=@$render;?>


            </div>

        </div>
    </div>
</div>
