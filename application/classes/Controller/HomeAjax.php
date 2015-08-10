<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.05.2015
 * Time: 18:54
 */

class Controller_HomeAjax extends Controller {

	public function action_index(){

        if (Request::initial()->is_ajax()) {

            if ($this->request->post('city') != '') {
                $city_id = $this->request->post('city');
            } else {
                $city_id = null;
            }

            //die(HTML::x($_POST));
            if ($this->request->post('cat') != 'undefined') {
                $data = Model::factory('BussinesModel')->getBussinesCategoryUrl($this->request->post('cat'), 3, null, $city_id);
            } else {
                //die(HTML::x($_POST));
                $data = Model::factory('BussinesModel')->getBussinesSectionUrl($this->request->post('section'), 3, null, $city_id);
            }

            foreach ($data['data'] as $key => $rows) {

                //заглушка если файл картинки не обнаружен
                $busines_foto = '/public/uploade/thumbnail.jpg';
                if (file_exists($_SERVER['DOCUMENT_ROOT'].$rows['home_busines_foto'])) {
                    $busines_foto = '/uploads/img_business/thumbs/'.basename($rows['home_busines_foto']);
                }
                $data['data'][$key]['home_busines_foto'] = $busines_foto;
                $data['data'][$key]['info'] = Text::limit_chars(strip_tags($rows['info']), 150, null, true);
            }
            //die(HTML::x($data));
            echo json_encode($data);
        }

	}

    //загрузка купонов на главной в слайдер
    public function action_coupons (){

        if (Request::initial()->is_ajax()) {

            if ($this->request->post('sectcop') != 'undefined') {
                $coupon = Model::factory('CouponsModel')->getCouponsSectionUrl($this->request->post('sectcop'), 6, 0, null);
            } else {
                $coupon = Model::factory('CouponsModel')->getCouponsSectionUrl(null, 6, 0, null);
            }
        }

        echo json_encode($coupon);
    }


}

