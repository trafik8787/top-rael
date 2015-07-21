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

        $city_id = null;
        if (!empty($_GET)) {
            $city_id = $_GET['city'];
        }


        if ($this->request->param('url_category') != '') {
            //по урлу категории получаем бизнесы
            $data = Model::factory('BussinesModel')->getBussinesCategoryUrl($this->request->param('url_category'), 10 ,$this->request->param('page'), $city_id);
            //по урлу категории получаем анонсы статей
            $data_articles = Model::factory('ArticlesModel')->getArticlesCategoryUrl($this->request->param('url_category'));

        } else {
            //по урлу раздела получаем бизнесы
            $data = Model::factory('BussinesModel')->getBussinesSectionUrl($this->request->param('url_section'), 10 ,$this->request->param('page'), $city_id);
            //по урле раздела получаем 6 анонсов статей
            $articles = Model::factory('ArticlesModel')->getArticlesSectionUrl($this->request->param('url_section'), 6);
            $data_articles = $articles['data'];
           // HTML::x($data['count']);
        }

        $bussines_section = View::factory('pages/bussines_section');

        $business_list = View::factory('pages/bussines_section_list');
        $business_list->pagination = Pagination::factory(array('total_items' => $data['count'])); //блок пагинации
        //подключаем правый блок
        $business_list->bloc_right = parent::RightBloc(array(
            View::factory('blocks_includ/articles_category_bloc', array('content' => $data_articles))
        ));




        $business_list->data = $data['data'];
        $bussines_section->city = $data['city'];

        //передаем параметр значения выбраного города для селекта
        $bussines_section->city_id = $city_id;

        //передаем номер страницы
        if ($this->request->param('page') != '') {
            $bussines_section->pagesUrl = '/'.$this->request->param('page');
        } else {
            $bussines_section->pagesUrl = '';
        }

        $bussines_section->page = '/'.$this->request->param('page');

        $bussines_section->category = $category;
        $bussines_section->business_list = $business_list;

        $this->template->content = $bussines_section;

	}




}
