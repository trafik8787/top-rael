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


        $this->template->content = $content;
    }
    
}

