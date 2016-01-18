<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */
?>
<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">
                <div id="context">
                    <? if (!empty($data_user)): ?>

                        <div class="sidebar-tabs">

                            <div class="sidebar-tabs-heading">
                                <div class="sidebar-tabs-title">Победители</div>
                            </div>

                            <div class="sidebar-tabs-body">

                                <? foreach ($data_user as $row_user): ?>

                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <a href="#" >
                                                <? if (!empty($row_user['usersPhoto'])): ?>

                                                    <img src="<?=$row_user['usersPhoto'] ?>" width="43" height="43"
                                                         class="media-object img-circle"/>

                                                <?else:?>

                                                    <img src="/public/uploade/no_avatar.jpg" width="43" height="43"
                                                         class="media-object img-circle"/>

                                                <?endif?>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <strong><?=$row_user['usersName']?> <?=$row_user['usersSecondname']?></strong><br/>
                                            <?=date('d-m-Y', strtotime($row_user['loteryDate'])) ?> - <?=$row_user['loteryName'] ?><br/>
                                            <a href="/business/<?=$row_user['busUrl'] ?>"><?=$row_user['busName'] ?></a>
                                        </div>
                                    </div>

                                <? endforeach ?>
                            </div>
                        </div>

                    <?else:?>
                        Победителей пока нет.
                    <?endif?>
                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>