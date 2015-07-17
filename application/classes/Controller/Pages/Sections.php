<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Sections extends Controller_BaseController {

	public function action_index()
	{
        $data = array();
        $category = Model::factory('CategoryModel')->getCategoryInSectionUrl($this->request->param('url_section'));
        $data = Model::factory('BussinesModel')->getBussinesSectionUrl($this->request->param('url_section'), 10 ,$this->request->param('page'));
        //HTML::x($data);
        $content = View::factory('pages/bussines_section');
        $content->category = $category;

        if ($this->request->param('url_category') != '') {
            $data = Model::factory('BussinesModel')->getBussinesCategoryUrl($this->request->param('url_category'), 10 ,$this->request->param('page'));
        }

        $content->pagination = Pagination::factory(array('total_items' => $data['count'])); //блок пагинации

        $content->data = $data['data'];
        $this->template->content = $content;
       // HTML::x(Model::factory('BussinesModel')->getBussinesSectionUrl($this->request->param('url_section')));
	}




}
