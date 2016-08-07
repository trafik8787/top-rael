<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.05.2015
 * Time: 18:54
 */

class Controller_Home extends Controller_BaseController {


    //asdasd
	public function action_index(){

       // HTML::x($_SERVER['REMOTE_ADDR']);

        $resultArr = array();
        $content = View::factory('pages/home');
        $section = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'), 'order_by');
        $articles = Model::factory('ArticlesModel')->getArticlesInHome();

        //проверяем наличие кеша
        //if (Cache::instance()->get('home_busines') == null) {

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
                $data = Model::factory('BussinesModel')->getBussinesSectionUrl($row_section['url'], 3, 0, $city_id, false, true);


                $resultArr[] = array('category' => $category, 'data' => $data['data'], 'city' => $data['city']);
            }

//            //кешируем
    //        Cache::instance()->set('home_busines', $resultArr);
//
        //} else {
          //  $resultArr = Cache::instance()->get('home_busines');
        //}


        $coupon = Model::factory('CouponsModel')->getCouponsSectionUrl(null, 10, 0, null);
        $seo_home = Model::factory('BaseModel')->getHome();

        //Cache::instance()->delete('home_busines');

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
            $this->blocCity(),
            $this->blocTags(),
            $this->google_adssens(),
            //View::factory('blocks_includ/baners_right'),
        ));

        $content->bloc_news = $this->blocNewsSlider(10);

        $this->SeoShowPage(array($seo_home[0]['title'],''),
            array($seo_home[0]['keywords'],''),array($seo_home[0]['description'],''));

        $content->section = $section;
        $content->section_coupons = Model::factory('CouponsModel')->CouponsSectionCountCoupon($section);
        $content->coupons = $coupon;
        //получаем первый элемент масива статей
        $top_articles = array_shift($articles);
        $content->articles = array('articles' => $articles, 'top_articles' => $top_articles);
        $content->data = $resultArr;
        $this->template->content = $content;

	}


}

