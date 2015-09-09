<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 09.09.2015
 * Time: 15:21
 */

?>
<script>
   $(document).ready(function(){
       $('.modal-subscribe').modal('show');
   });
</script>
<div class="modal fade in modal-subscribe" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header clearfix">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        class="lnr lnr-cross"></span></button>

                <a href="#" class="icons logo md">TopIsrael</a>
            </div>

            <div class="modal-body">

                <div class="gift-container">

                    <span class="icon_gift"></span>

                    <div>

                        Подпишитесь на нашу
                        почтовую рассылку!
                    </div>
                </div>

                <p>
                    <i>
                        Помимо новостей, купонов и лучших предложений
                        вы будете получать призы в наших викторинах!
                    </i>
                </p>

                <form class="w-modal-subscribe">

                    <div class="checkbox-container">

                        <div class="checkbox">

                            <label>
                                <div class="form-control input-lg">
                                    <input type="checkbox" value="" checked="checked">
                                    <i class="input-icon fa fa-check"></i>
                                </div>

                                Купоны
                            </label>

                            <label>
                                <div class="form-control input-lg">
                                    <input type="checkbox" value="" checked="checked">
                                    <i class="input-icon fa fa-check"></i>
                                </div>

                                Обзоры
                            </label>

                        </div>

                        <div class="input-group">

                            <input type="email" class="form-control input-lg w-email-modal-subcribe" name="email" required="required" placeholder="Ваш email:"/>

                            <div class="input-group-addon">
                                <button type="submit" class="btn btn-lg btn-danger">Отправить</button>
                            </div>
                        </div>

                    </div>


                </form>
            </div>

            <div class="modal-footer"><!-- --></div>
        </div>
    </div>
</div>