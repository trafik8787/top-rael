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

        $number_page = $this->request->param('page');

        $city_id = null;
        if (!empty($_GET)) {
            $city_id = $_GET['city'];
            //если фильтр по городам обнуляем номер страницы если выбирается новый город
            if (Session::instance()->get('city_id') != $city_id) {
                $number_page = '';
            }

            Session::instance()->set('city_id', $city_id);
        } else {
            Session::instance()->set('city_id', '');
        }

        $content = View::factory('pages/articles_all');
        $content->category =  self::$general_meny;

        if ($this->request->param('url_section') == '') {
            $data = Model::factory('ArticlesModel')->getArticlesSectionUrl(null, 10, $number_page, $city_id);
        } else {
            $data = Model::factory('ArticlesModel')->getArticlesSectionUrl($this->request->param('url_section'), 10, $number_page, $city_id);
        }
        //die(HTML::x($data));
        $content->pagination = Pagination::factory(array('total_items' => $data['count'])); //блок пагинации
        //забираем первый элемент масива
        $content->data_shift = array_shift($data['data']);
        $content->data = $data['data'];
        $content->city = $data['city'];

        $content->bloc_right = parent::RightBloc(array(
            View::factory('blocks_includ/lotareya'),
            View::factory('blocks_includ/sicseti'),
            View::factory('blocks_includ/baners_right'),
        ));

        //передаем параметр значения выбраного города для селекта
        $content->city_id = $city_id;

        //передаем номер страницы для навигации
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
        $content->data = Model::factory('ArticlesModel')->getArticleUrl($this->request->param('url_article'));

        $content->bloc_right = parent::RightBloc(array(
            View::factory('blocks_includ/subscribers'),
            View::factory('blocks_includ/sicseti')
        ));
        $this->template->content = $content;
    }

}
