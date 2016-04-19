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

        $content->category =  Model::factory('ArticlesModel')->getSectionArticles();

        if ($this->request->param('url_section') == '') {
            $data = Model::factory('ArticlesModel')->getArticlesSectionUrl(null, 10, $number_page, $city_id);
        } else {
            $data = Model::factory('ArticlesModel')->getArticlesSectionUrl($this->request->param('url_section'), 10, $number_page, $city_id);

            //смотрим есть ли такая категория если нет то 404
            if ($data === false) {
                throw new HTTP_Exception_404;
            }
        }
        //die(HTML::x($data));
        $content->pagination = Pagination::factory(array('total_items' => $data['count'])); //блок пагинации
        //забираем первый элемент масива
        $content->data_shift = array_shift($data['data']);
        $content->data = $data['data'];
        $content->city = $data['city'];

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
            View::factory('blocks_includ/baners_right'),
            $this->blocNews()
        ));


        $this->SeoShowPage(array('Эксклюзивные обзоры мест для отдыха, развлечений и покупок в Израиле', ''),
            array('Откройте для себя новый Израиль, который Вы еще не знаете!', ''),
            array('Откройте для себя новый Израиль, который Вы еще не знаете!', ''));

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

        //проверяем есть ли урл
        if ($this->request->param('url_article') == null) {
            throw new HTTP_Exception_404;
        }


        $data = array();
        $content = View::factory('pages/node');

        $data = Model::factory('ArticlesModel')->getArticleUrl($this->request->param('url_article'));

        //смотрим есть ли такая статья если нет то 404
        if ($data === false) {
            throw new HTTP_Exception_404;
        }

        //todo Rediset
        Rediset::getInstance()->set_articles($data['ArticId']);

        $other_articles = Model::factory('ArticlesModel')->getArticlesRandomIdCategory($data['ArticIdSection'], $data['ArticId']);

        //HTML::x($data['CoupArr']);

        $this->SeoShowPage(array($data['ArticTitle'], $data['ArticName']),
            array($data['ArticKeywords'], ''),
            array($data['ArticDesc'], ''));

        $data['CoupArr'] = parent::convertArrayVievData($data['CoupArr'], 3);
        $data['BusArr'] = parent::convertArrayVievData($data['BusArr']);

        $content->data = $data;
        //читать еще
        $content->other_articles = $other_articles;
        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
            View::factory('blocks_includ/baners_right'),
            $this->blocNews()

        ));

        $this->template->content = $content;
    }

}
