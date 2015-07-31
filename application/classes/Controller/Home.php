<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_BaseController {

	public function action_index()
	{
		//$this->response->body('hello, world!');
        $ulogin = Ulogin::factory();
        if (!$ulogin->mode()) // если ранее юлогин не вызывался
        {
            $this->template->content = $ulogin->render(); // рисуем значки соц.сетей
        }
        else
        {
            $user = $ulogin->login();
            $this->template->content = Auth::instance()->get_user()->id;
           //HTML::x($user);
        }





        //HTML::x($user);
	}


}

