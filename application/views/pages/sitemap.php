<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */
?>

<style>
    .w-list-map>ul {
        margin-left: 15px;

    }

    .w-list-map>ul>li {
        text-transform: capitalize;

    }

    .w-list-map>li {
        padding: 8px 2px 2px 0;
    }

</style>

<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">
                <div id="context" class="full-text">

                    <ul class="w-list-map">
                        <li><a href="/"><strong>Главная</strong></a></li>


                        <? foreach ($category as $row): ?>

                            <li><a href="/section/<?=$row['url'] ?>"><strong><?=$row['name'] ?></strong></a></li>

                            <ul>
                                <? foreach ($row['childs'] as $rows): ?>

                                    <li><a href="/section/<?=$row['url'] ?>/<?=$rows['url'] ?>"><?=$rows['name'] ?></a></li>

                                <? endforeach ?>
                            </ul>

                        <? endforeach ?>

                        <li><a href="/articles"><strong>Обзоры</strong></a></li>


                        <ul>
                            <? foreach ($category as $row_article): ?>
                                <li><a href="/articles/<?=$row_article['url'] ?>"><?=mb_strtolower($row_article['name']) ?></a></li>
                            <? endforeach ?>
                        </ul>


                        <li><a href="/coupons"><strong>Купоны</strong></a></li>
                        <ul>
                            <? foreach ($category as $row_coupons): ?>
                                <li><a href="/coupons/<?=$row_coupons['url'] ?>"><?=mb_strtolower($row_coupons['name']) ?></a></li>
                            <? endforeach ?>
                        </ul>

                        <li><a href="/about"><strong>О проекте</strong></a></li>
                        <li><a href="/contacts"><strong>Связь с нами</strong></a></li>
                        <li><a href="/maps"><strong>На карте</strong></a></li>

                    </ul>

                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>