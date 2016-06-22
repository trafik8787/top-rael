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

        $user = Auth::instance()->get_user();

        $baners = Model::factory('BaseModel')->getBanersBusinessId($user->business_id);

        //документы пользователя бизнеса
        $this->template->dock = Model::factory('BaseModel')->getUserBusinesDock($user->id);

        $data = Model::factory('BussinesModel')->getBusinessUrl($url_business[0]['url']);

        $data = $this->CityAsotiation($data);



        $this->template->business_favorit = Rediset::getInstance()->get_business_favor($data['BusId']);
        $this->template->business_show = Rediset::getInstance()->get_business_all($data['BusId']);
        $this->template->bussines_subscribe = Model::factory('BaseModel')->table_count('subscription_relation_bussines', 'id', array('bussines_id','=', $data['BusId']));

        //получаем купоны бизнеса если они есть
        $coupon_business = Model::factory('CouponsModel')->getCouponsInBusinessId($data['BusId']);

        if (!empty($coupon_business)) {
            $count_coupon_show = null;
            foreach ($coupon_business as $row_coupon) {
                $count_coupon_show += Rediset::getInstance()->get_coupon_show($row_coupon['id']);
            }
            $this->template->coupons_show = $count_coupon_show;
        }

        $article_business = Model::factory('ArticlesModel')->getArticlesInBusinessId($data['BusId']);
        if (!empty($article_business)) {
            $article_count_show = null;
            foreach ($article_business as $row_article) {
                $article_count_show += Rediset::getInstance()->get_articles($row_article['id']);
            }
            $this->template->article_show = $article_count_show;
        }



        $this->template->count_subscribe = Model::factory('BaseModel')->table_count('business', 'id', array('status_subscribe', '<>', 0), array('id', '=', $data['BusId']));


        $this->template->user = $user;

        $this->template->subscribe = Model::factory('SubscribeModel')->getSubscribeAcountBusiness($url_business[0]['status_subscribe'], $url_business[0]['id']);
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

