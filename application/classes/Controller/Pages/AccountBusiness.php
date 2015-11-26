<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 08.09.2015
 * Time: 12:59
 * контроллер профиля владельца бизнеса
 */

class Controller_Pages_AccountBusiness extends Controller_CommonAuthorized {

    public function action_index (){
        $local_thit = $this->template;
        $this->template = View::factory('auth/account_business');
        $url_business = Model::factory('Adm')->get_table('business', array('id','=', Auth::instance()->get_user()->business_id));
        $baners = Model::factory('BaseModel')->getBanersBusinessId(Auth::instance()->get_user()->business_id);


        $data = Model::factory('BussinesModel')->getBusinessUrl($url_business[0]['url']);

        $data = $this->CityAsotiation($data);

        $this->template->subscribe = Model::factory('SubscribeModel')->getSubscribeAcountBusiness($url_business[0]['status_subscribe']);
        $this->template->style = $local_thit->style;
        $this->template->script = $local_thit->script;
        $this->template->data = $data;
        $this->template->baners = $baners;


    }


    /**
     * @param $data
     * @return mixed
     * todo подстановка городов вместо русских английские названия
     */
    public function CityAsotiation ($data){

        $city_array = array();
        if (!empty($data['BusDopAddress'])) {
            foreach ($data['BusDopAddress'] as $dop_adress) {
                $city_array[] = $dop_adress['name'];
            }
            $city_array[] = $data['BusCity'];
            $city = Model::factory('BussinesModel')->cityAcountBusines($city_array);
        }

        if (!empty($city)) {
            foreach ($city as $row_city) {

                if ($row_city['name'] == $data['BusCity']) {
                    $data['BusCity'] = $row_city['name_en'];
                }

                if (!empty($data['BusDopAddress'])) {
                    foreach ($data['BusDopAddress'] as $key => $row_dop_city) {

                        if ($row_dop_city['name'] == $row_city['name']) {
                            $data['BusDopAddress'][$key]['name'] = $row_city['name_en'];
                        }

                    }
                }
            }
        }
        return $data;
    }
    
}

