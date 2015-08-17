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

            $id_coupon = $this->request->param('id_coupon');
            $favoritcoup = Cookie::get('favoritcoup');

            $content = View::factory('blocks_includ/modal_coupon');
            $data = Model::factory('CouponsModel')->getCouponsId($this->request->param('id_coupon'));
            //ищем в масиве из куки файла id купона если находим то передаем парамерт что такой
            //купон уже добавлен в избранное

            if (!empty($favoritcoup)) {
                $favoritcoup = json_decode($favoritcoup);

                if (array_search($id_coupon, $favoritcoup) !== false) {
                    $data[0]['coupon_favorit'] = 1;
                }
            }

           // die(HTML::x($favoritcoup));

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
                Cookie::update_and_set_json('favoritcoup', $this->request->post('id_coupon'));

            } else {
                //если не авторизован
                Cookie::update_and_set_json('favoritcoup', $this->request->post('id_coupon'));
            }
        }
    }

    public function action_deleteFovarites (){

        if (Request::initial()->is_ajax()) {
            if (Auth::instance()->get_user()) {
                Model::factory('CouponsModel')->deleteCouponsFavoritesUser($this->request->post('id_coupon'));
                Cookie::del_coupon($this->request->post('id_coupon'));
            } else {
                Cookie::del_coupon($this->request->post('id_coupon'));
            }
        }
    }

}