<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.07.2015
 * Time: 18:38
 */
?>

    <div class="form-group has-feedback">

        <label for="URL" class="col-sm-2 control-label">Обзоры</label>
        <div class="col-sm-10">

            <ul class="list-inline">
                <?if (!empty($data)):?>
                    <?foreach ($data as $row_data):?>
                        <li><a class="btn btn-info btn-lg" role="button" href="/admin/edit?obj=YToyOntzOjU6InRhYmxlIjtzOjg6ImFydGljbGVzIjtzOjI0OiJjYWxsYmFja19mdW5jdGlvbnNfYXJyYXkiO2E6Mzp7czo4OiJmdW5jdGlvbiI7czoxMzoiYWRtaW5BcnRpY2xlcyI7czo1OiJjbGFzcyI7czoyNDoiQ29udHJvbGxlcl9BZG1pbmlzdHJhdG9yIjtzOjIyOiJjYWxsYmFja19mdW5jdGlvbl9uYW1lIjtzOjEwOiJsb2FkX3RhYmxlIjt9fQ%3D%3D&id=<?=$row_data['id']?>"><?=$row_data['name']?></a></li>
                    <?endforeach?>
                <?endif?>
                <li><a class="btn btn-primary btn-lg" role="button" href="/admin/add?obj=YToyOntzOjU6InRhYmxlIjtzOjg6ImFydGljbGVzIjtzOjI0OiJjYWxsYmFja19mdW5jdGlvbnNfYXJyYXkiO2E6Mzp7czo4OiJmdW5jdGlvbiI7czoxMzoiYWRtaW5BcnRpY2xlcyI7czo1OiJjbGFzcyI7czoyNDoiQ29udHJvbGxlcl9BZG1pbmlzdHJhdG9yIjtzOjIyOiJjYWxsYmFja19mdW5jdGlvbl9uYW1lIjtzOjEwOiJsb2FkX3RhYmxlIjt9fQ%3D%3D&id_addon_redirect=1">Добавить обзор</a></li>
            </ul>

        </div>
    </div>
