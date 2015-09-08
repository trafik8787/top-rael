<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 02.08.2015
 * Time: 23:17
 */

class Controller_CommonAuthorized extends Controller_BaseController {

    public function before()
    {

        parent::before();
        $session = Session::instance();
        if (!Auth::instance()->get_user()) // смотрим - если пользователь НЕ авторизован
        {
            $session->set('redirectAfterLogin', $_SERVER['REQUEST_URI']); // записываем куда он хотел попасть
            $this->redirect('/account/login'); // редиректим на авторизацию/регистрацию
        } else {

            if (!Auth::instance()->logged_in('business')) {
                $this->redirect('/account');
            }
        }
    }

}