<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_City extends Controller_BaseController {

	public function action_index(){


        $city_data = Model::factory('BaseModel')->getCityUrl($this->request->param('url_city'));
        $city_id = $city_data[0]['id'];

        $this->SeoShowPage(array($city_data[0]['title'], ''),
            array($city_data[0]['keywords'], ''),
            array($city_data[0]['description'], ''));


        $content = View::factory('pages/city');
        $section = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'), 'order_by');

        if (Cache::instance()->get($this->request->param('url_city')) == null) {

            foreach ($section as $row_section) {

                $category = Model::factory('CategoryModel')->getCategoryInSectionUrl($row_section['url'], $city_id);

                if (!empty($category[0]['childs'])) {

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

                } else {
                    $data['data'] = array();
                }

                $resultArr[] = array('category' => $category, 'data' => $data['data']);
            }

            //кешируем
            Cache::instance()->set($this->request->param('url_city'), $resultArr);

        } else {
            $resultArr = Cache::instance()->get($this->request->param('url_city'));
        }

        //Cache::instance()->delete($this->request->param('url_city'));

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
            $this->blocCity(),
            $this->blocTags()
        ));

        $content->data = $resultArr;
        $content->city_id = $city_id;
        $this->template->content = $content;
	}


}
