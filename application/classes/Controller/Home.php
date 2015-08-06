<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.05.2015
 * Time: 18:54
 */

class Controller_Home extends Controller_BaseController {

	public function action_index(){

        $resultArr = array();
        $content = View::factory('pages/home');
        $section = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));
        $articles = Model::factory('ArticlesModel')->getArticlesInHome();

        //проверяем наличие кеша
        if (Cache::instance()->get('home_busines') == null) {

            foreach ($section as $row_section) {

                $category = Model::factory('CategoryModel')->getCategoryInSectionUrl($row_section['url']);

                //HTML::x($category);
                //сортировка категорий по количеству бизнесов в них
                $count = array();
                $rowArr = array();
                foreach ($category[0]['childs'] as $key => $row) {
                    $count[] = $row['COUNT'];
                    $rowArr[] = $row;
                }

                array_multisort($count, SORT_DESC, $rowArr, SORT_ASC, $category[0]['childs']);

                //получаем первые 5 категорий раздела дальше "еще..."
                $category[0]['childs'] = array_slice($category[0]['childs'], 0, 5);

                $city_id = null;
                $data = Model::factory('BussinesModel')->getBussinesSectionUrl($row_section['url'], 3, 0, $city_id);


                $resultArr[] = array('category' => $category, 'data' => $data['data'], 'city' => $data['city']);
            }

            //кешируем
            Cache::instance()->set('home_busines', $resultArr);

        } else {
            $resultArr = Cache::instance()->get('home_busines');
        }



        $content->articles = $articles;
        $content->data = $resultArr;
        $this->template->content = $content;

	}


}

