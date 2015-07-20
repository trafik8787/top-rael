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

        //HTML::x($data);

        if ($this->request->param('url_category') != '') {
            //по урлу категории получаем бизнесы
            $data = Model::factory('BussinesModel')->getBussinesCategoryUrl($this->request->param('url_category'), 10 ,$this->request->param('page'));
            //по урлу категории получаем анонсы статей
            $data_articles = Model::factory('ArticlesModel')->getArticlesCategoryUrl($this->request->param('url_category'));

            //HTML::x($data_articles);
        } else {
            //по урлу раздела получаем бизнесы
            $data = Model::factory('BussinesModel')->getBussinesSectionUrl($this->request->param('url_section'), 10 ,$this->request->param('page'));
            //по урле раздела получаем 6 анонсов статей
            $articles = Model::factory('ArticlesModel')->getArticlesSectionUrl($this->request->param('url_section'), 6);
            $data_articles = $articles['data'];
        }

        $content = View::factory('pages/bussines_section');
        $content->category = $category;

        //подключаем правый блок
        $content->bloc_right = $this->RightBloc(array(
            View::factory('blocks_includ/articles_category_bloc', array('content' => $data_articles))
        ));

        $content->pagination = Pagination::factory(array('total_items' => $data['count'])); //блок пагинации

        $content->data = $data['data'];
        $this->template->content = $content;
       // HTML::x(Model::factory('BussinesModel')->getBussinesSectionUrl($this->request->param('url_section')));
	}




}
