<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.08.2015
 * Time: 16:05
 */

class Controller_ModalCoupon extends Controller {

    public function action_index(){

        if (Request::initial()->is_ajax()) {

            $content = View::factory('blocks_includ/modal_coupon');
            $data = Model::factory('CouponsModel')->getCouponsId($this->request->param('id_coupon'));
            $content->data = $data;
            echo $content;
        }
    }

    public function action_saveFovarites (){

        if (Request::initial()->is_ajax()) {
            //если пользователь авторизован
            if (Auth::instance()->get_user()) {
                $data = Model::factory('CouponsModel')->saveCouponsFavoritesUser(Auth::instance()->get_user()->id, $this->request->post('id_coupon'));
                //пишем в куки
                Cookie::update_and_set_json('coup-'.Auth::instance()->get_user()->id, $this->request->post('id_coupon'));


            }
        }
    }

}