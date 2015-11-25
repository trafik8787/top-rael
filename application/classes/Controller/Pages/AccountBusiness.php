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
        $this->template->subscribe = Model::factory('SubscribeModel')->getSubscribeAcountBusiness($url_business[0]['status_subscribe']);
        $this->template->style = $local_thit->style;
        $this->template->script = $local_thit->script;
        $this->template->data = $data;
        $this->template->baners = $baners;


    }
    
}

