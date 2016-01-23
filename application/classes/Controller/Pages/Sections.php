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

        //проверяем есть ли урл
        if ($this->request->param('url_section') == null) {
            throw new HTTP_Exception_404;
        }

        $bussines_section = View::factory('pages/bussines_section');
        $number_page = $this->request->param('page');
        $category = Model::factory('CategoryModel')->getCategoryInSectionUrl($this->request->param('url_section'));
       // HTML::x($category);
        //смотрим есть ли такой раздел если нет то 404
        if ($category === false) {
            throw new HTTP_Exception_404;
        }

        //сортировка категорий по количеству бизнесов в них
        foreach ($category[0]['childs'] as $key => $row) {
            $count[]  = $row['COUNT'];
            $rowArr[] = $row;
        }

        array_multisort($count, SORT_DESC, $rowArr, SORT_ASC, $category[0]['childs']);

        //HTML::x($category);
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

        if ($this->request->param('url_category') != '') {


            //по урлу категории получаем бизнесы
            $data = Model::factory('BussinesModel')->getBussinesCategoryUrl($this->request->param('url_category'), 10 ,$number_page, $city_id);

            //смотрим есть ли такая категория если нет то 404
            if ($data === false) {
                throw new HTTP_Exception_404;
            }

            $this->SeoShowPage(array($data['data'][0]['CatTitle'], ''),
                array($data['data'][0]['CatKeywords'],''),
                array($data['data'][0]['CatDesc'], ''));
            //по урлу категории получаем анонсы статей
            $data_articles = Model::factory('ArticlesModel')->getArticlesCategoryUrl($this->request->param('url_category'));

            //вызов метода банеров получаем в параметрах parent::$top_baners и parent::$right_baners
            $this->getBaners($this->request->param('url_category'), 'category');

            //передаем URL текущей категории для кнопки на карте
            $bussines_section->curent_category = $this->request->param('url_category');

        } else {

            //по урлу раздела получаем бизнесы
            $data = Model::factory('BussinesModel')->getBussinesSectionUrl($this->request->param('url_section'), 10 ,$number_page, $city_id);
            //по урле раздела получаем 6 анонсов статей
            $articles = Model::factory('ArticlesModel')->getArticlesSectionUrl($this->request->param('url_section'), 6);
            $data_articles = $articles['data'];

            $this->SeoShowPage(array($category[0]['title'], $category[0]['name']),
                array($category[0]['keywords'],$category[0]['name']),
                array($category[0]['description'], $category[0]['name']));

            $this->getBaners($this->request->param('url_section'), 'section');

            //передаем URL текущей категории для кнопки на карте
            $bussines_section->curent_section = $this->request->param('url_section');
        }


        //верхний банер
        $bussines_section->top_baners = parent::$top_baners;

        $bussines_section->pagination = Pagination::factory(array('total_items' => $data['count'])); //блок пагинации
        //подключаем правый блок
        $bussines_section->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
            $this->blocCity(),
            $this->blocTags(),
            parent::$right_baners,
            View::factory('blocks_includ/articles_category_bloc', array('content' => $data_articles))
        ));

        //преобразование масива бизнесов для вюхи
        $result_data = parent::convertArrayVievData($data['data']);

        $bussines_section->data = $result_data;
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
        $this->template->content = $bussines_section;

	}




}
