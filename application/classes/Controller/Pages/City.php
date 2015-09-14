<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_City extends Controller_BaseController {

	public function action_index(){

        switch ($this->request->param('url_city')) {
            case 'telaviv':
                $city_id = 59;
                break;
            case 'ierusalim':
                $city_id = 23;
                break;
            case 'eilat':
                $city_id = 2;
                break;
            default:
                throw new HTTP_Exception_404;
        }

        $content = View::factory('pages/city');
        $section = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));

//        if (Cache::instance()->get($this->request->param('url_city')) == null) {

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


                $data = Model::factory('BussinesModel')->getBussinesSectionUrl($row_section['url'], 3, 0, $city_id);


                $resultArr[] = array('category' => $category, 'data' => $data['data']);
            }

//            //кешируем
//            Cache::instance()->set($this->request->param('url_city'), $resultArr);
//
//        } else {
//            $resultArr = Cache::instance()->get($this->request->param('url_city'));
//        }

        //Cache::instance()->delete($this->request->param('url_city'));

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));

        $content->data = $resultArr;
        $content->city_id = $city_id;
        $this->template->content = $content;
	}


}
