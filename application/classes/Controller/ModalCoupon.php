<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.08.2015
 * Time: 16:05
 */

class Controller_ModalCoupon extends Controller {

    /**
     * todo action_index загрузка модального окна купона
     */
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
                //ищем в масиве избранных есть ли этот купон
                if (in_array($id_coupon, $favoritcoup)) {
                    $data[0]['coupon_favorit'] = 1;
                }
            }

           // die(HTML::x($favoritcoup));

            $content->data = $data;
            echo $content;
        }
    }

    /**
     * todo action добавить купон в избранное
     */
    public function action_saveFovarites (){

        if (Request::initial()->is_ajax()) {

            //считаем количество добавлений в избранное
            Rediset::getInstance()->set_coupon($this->request->post('id_coupon'));

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

    /**
     * todo action удалить купон из избранного
     */
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

    /**
     *
     * todo action вывод купона на отдельной странице
     */
    public function action_coupon(){

        $content = View::factory('pages/node_coupon');
        $favoritcoup = Cookie::get('favoritcoup');

        $data = Model::factory('CouponsModel')->getCouponsId(null, $this->request->param('url_coupon'));


        if (!empty($favoritcoup)) {
            $favoritcoup = json_decode($favoritcoup);
            //ищем в масиве избранных есть ли этот купон
            if (in_array($data[0]['id'], $favoritcoup)) {
                $data[0]['coupon_favorit'] = 1;
            }
        }

        $content->data = $data;
        $this->response->body($content);
    }
}