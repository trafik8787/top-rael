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

        $content = View::factory('auth/account_business');
        $url_business = Model::factory('Adm')->get_table('business', array('id','=', Auth::instance()->get_user()->business_id));
        $baners = Model::factory('BaseModel')->getBanersBusinessId(Auth::instance()->get_user()->business_id);


        $data = Model::factory('BussinesModel')->getBusinessUrl($url_business[0]['url']);
        $content->data = $data;
        $content->baners = $baners;
        //HTML::x($baners);

        $this->template->content = $content;
    }
    
}

