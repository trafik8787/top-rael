<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.05.2015
 * Time: 18:54
 */

class Controller_Home extends Controller_BaseController {

	public function action_index(){
       // Model::factory('CouponsModel')->UpdateFavoritCookie('users_relation_favorites_coup', 1, 'coupon_id');
           // Model::factory('BaseModel')->logo();
//        $er = json_encode(array('qwe' => 'sdfsdfsdfsdfsdf', 'asd'=> 'asdasdasd'));
//        Cookie::set('__count', $er);
//        $redis = new Redis();
//        $redis->connect('127.0.0.1', 6379);
//       // $redis->flushDB();
//        $key = 'linus torvalds';
//        //$redis->hmset($key,'age', 45);
//        $redis->hmset($key, [
//            'age' => 87,
//            'country' => 'finland',
//            'occupation' => 'software engineer',
//            'reknown' => 'linux kernel',
//        ]);
//        $data_redis = $redis->hgetall($key);
     //   $redis->save();
//
        //$we = json_decode(Cookie::get('__count'));
        //HTML::x(json_decode(Cookie::get('coup-41')));
       // die(phpinfo());
        $resultArr = array();
        $content = View::factory('pages/home');
        $section = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));
        $articles = Model::factory('ArticlesModel')->getArticlesInHome();

        //проверяем наличие кеша
       // if (Cache::instance()->get('home_busines') == null) {

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

//            //кешируем
//            Cache::instance()->set('home_busines', $resultArr);
//
//        } else {
//            $resultArr = Cache::instance()->get('home_busines');
//        }


        $coupon = Model::factory('CouponsModel')->getCouponsSectionUrl(null, 6, 0, null);


        //Cache::instance()->delete('home_busines');

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
            //View::factory('blocks_includ/baners_right'),
        ));


        $content->section = $section;
        $content->coupons = $coupon;
        //получаем первый элемент масива статей
        $top_articles = array_shift($articles);
        $content->articles = array('articles' => $articles, 'top_articles' => $top_articles);
        $content->data = $resultArr;
        $this->template->content = $content;

	}


}

