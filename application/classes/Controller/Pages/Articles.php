<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Articles extends Controller_BaseController {

	public function action_index()
	{
        $data = array();

        $content = View::factory('pages/articles_all');
        $content->category =  self::$general_meny;

        if ($this->request->param('url_section') == '') {
            $data = Model::factory('ArticlesModel')->getArticlesSectionUrl(null, 10, $this->request->param('page'));
        } else {
            $data = Model::factory('ArticlesModel')->getArticlesSectionUrl($this->request->param('url_section'), 10, $this->request->param('page'));
        }
        //die(HTML::x($data));
        $content->pagination = Pagination::factory(array('total_items' => $data['count'])); //блок пагинации
        $content->data = $data['data'];

        //передаем номер страницы
        if ($this->request->param('page') != '') {
            $content->pagesUrl = '/'.$this->request->param('page');
        } else {
            $content->pagesUrl = '';
        }

        $this->template->content = $content;
	}

    public function action_article (){

        $data = array();
        $content = View::factory('pages/node');
        Model::factory('ArticlesModel')->getArticleUrl($this->request->param('url_article'));
        $this->template->content = $content;
    }

}
