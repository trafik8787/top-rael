<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.07.2015
 * Time: 18:38
 */
?>
<? if (!empty($data)): ?>


<script>
    $(function(){
        $("input[name='date_end'], input[name='date_start'], input[name='status']").prop('disabled', true);
    })
</script>

<? endif ?>
    <div class="form-group has-feedback">

        <label for="URL" class="col-sm-2 control-label">Победитель лотареи</label>
        <div class="col-sm-10">
            <? if (!empty($data[0]['usersEmail'])): ?>
                <a href="/admin/edit?obj=YToyOntzOjU6InRhYmxlIjtzOjU6InVzZXJzIjtzOjI0OiJjYWxsYmFja19mdW5jdGlvbnNfYXJyYXkiO2E6Mzp7czo4OiJmdW5jdGlvbiI7czoxMDoiYWRtaW5Vc2VycyI7czo1OiJjbGFzcyI7czoyNDoiQ29udHJvbGxlcl9BZG1pbmlzdHJhdG9yIjtzOjIyOiJjYWxsYmFja19mdW5jdGlvbl9uYW1lIjtzOjEwOiJsb2FkX3RhYmxlIjt9fQ%3D%3D&id=<?=$data[0]['usersId']?>"><?=$data[0]['usersEmail']?></a>

            <?else:?>
                <a href="#"><?=$data[0]['subscriptionEmail'] ?></a> Человек не зарегистрировался еще!!!
            <?endif?>

        </div>
    </div>
