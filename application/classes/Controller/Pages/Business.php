<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Business extends Controller_BaseController {

	public function action_index()
	{
        $content = View::factory('pages/business_page');
        $content->data = Model::factory('BussinesModel')->getBusinessUrl($this->request->param('url_business'));
        $this->template->content = $content;

	}



}
