<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_BaseController {

	public function action_index()
	{
		$this->response->body('hello, world!');
        $this->template->content = 'sdf';
	}


}
