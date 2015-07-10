<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 10.07.2015
 * Time: 14:19
 */
?>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#panel1">Панель 1</a></li>
    <li><a data-toggle="tab" href="#panel2">Панель 2</a></li>
    <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            Другие панели
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li><a data-toggle="tab" href="#panel3">Панель 3</a></li>
            <li><a data-toggle="tab" href="#panel4">Панель 4</a></li>
        </ul>
    </li>
</ul>

<div class="tab-content">
    <div id="panel1" class="tab-pane fade in active">
        <h3>Панель 1</h3>
        <p>Содержимое 1 панели...</p>
    </div>
    <div id="panel2" class="tab-pane fade">
        <h3>Панель 2</h3>
        <p>sdfsdf</p>
    </div>
    <div id="panel3" class="tab-pane fade">
        <h3>Панель 3</h3>
        <p>Содержимое 3 панели...</p>
    </div>
    <div id="panel4" class="tab-pane fade">
        <h3>Панель 4</h3>
        <p>Содержимое 4 панели...</p>
    </div>
</div>