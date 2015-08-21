<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */

class Model_ArticlesModel extends Model_BaseModel {

    /**
     * @param null $url_section
     * @param null $limit
     * @param null $num_page
     * @return mixed
     * получаем статьи по урлу раздела если раздел не указан выводим все
     */
    public function getArticlesSectionUrl ($url_section = null, $limit = null, $num_page = null, $id_city = null){

        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }
        //HTML::x(Controller_BaseController::$general_meny);
        if ($url_section != null) {
            $id = 0;
            foreach (Controller_BaseController::$general_meny as $rows) {
                if ($rows['url'] == $url_section) {
                    $id = $rows['id'];
                }
            }

            if ($id_city != null) {
                $result = DB::select('artic.*',
                    array('cat.id', 'CatId'),
                    array('cat.name', 'CatName'),
                    array('cat.url', 'CatUrl'))
                    ->from(array('articles', 'artic'))
                    ->join(array('category', 'cat'))
                    ->on('artic.id_section', '=', 'cat.id')
                    ->where('artic.id_section', '=', $id)
                    ->and_where('artic.city', '=', $id_city)
                    ->limit($limit)
                    ->offset($ofset)
                    ->order_by('id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                $count = $this->table_count('articles', 'id', array('id_section', '=', $id), array('city', '=', $id_city));

            } else {

                $result = DB::select('artic.*',
                    array('cat.id', 'CatId'),
                    array('cat.name', 'CatName'),
                    array('cat.url', 'CatUrl'))
                    ->from(array('articles', 'artic'))
                    ->join(array('category', 'cat'))
                    ->on('artic.id_section', '=', 'cat.id')
                    ->where('artic.id_section', '=', $id)
                    ->limit($limit)
                    ->offset($ofset)
                    ->order_by('id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                $count = $this->table_count('articles', 'id', array('id_section', '=', $id));
            }



        } else {
            if ($id_city != null) {

                $result = DB::select('artic.*',
                    array('cat.id', 'CatId'),
                    array('cat.name', 'CatName'),
                    array('cat.url', 'CatUrl'))
                    ->from(array('articles', 'artic'))
                    ->join(array('category', 'cat'))
                    ->on('artic.id_section', '=', 'cat.id')
                    ->where('artic.city', '=', $id_city)
                    ->limit($limit)
                    ->offset($ofset)
                    ->order_by('id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                $count = $this->table_count('articles', 'id', array('city', '=', $id_city));
            } else {
                $result = DB::select('artic.*',
                    array('cat.id', 'CatId'),
                    array('cat.name', 'CatName'),
                    array('cat.url', 'CatUrl'))
                    ->from(array('articles', 'artic'))
                    ->join(array('category', 'cat'))
                    ->on('artic.id_section', '=', 'cat.id')
                    ->limit($limit)
                    ->offset($ofset)
                    ->order_by('id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                $count = $this->table_count('articles', 'id', null);
            }

        }

        $city_arr = $this->getCityArticleInSection($url_section);

        return array('data' => $result, 'count' => $count, 'city' => $city_arr);

    }




    /**
     * @param $url_category
     * @return mixed
     * метод получения статей по урлу категории
     */
    public function getArticlesCategoryUrl ($url_category){
        return DB::select('articles.*')
            ->from('articles')
            ->join('category')
            ->on('articles.id_category', '=', 'category.id')
            ->where('category.url', '=', $url_category)
            ->limit(6)
            ->order_by('articles.id', 'DESC')
            ->cached()
            ->execute()->as_array();
    }

    /**
     * @param $business_id
     * @return mixed
     * получаем все статьи которые относятся к бизнесу по его id
     */
    public function getArticlesInBusinessId($business_id){
        return DB::select('articles.*')
            ->from('articles')
            ->join('articles_relation_business')
            ->on('articles_relation_business.id_articles', '=', 'articles.id')
            ->where('articles_relation_business.id_business', '=', $business_id)
            ->cached()
            ->execute()->as_array();
    }


    /**
     * @param $url_article
     * @return array|mixed
     * @throws Cache_Exception
     * получить статью по урлу и привязаные к ней купоны и бизнесы
     */
    public function getArticleUrl ($url_article){

        if (Cache::instance()->get($url_article) == null) {

            $query = DB::select(

                array('artic.id', 'ArticId'),
                array('artic.name', 'ArticName'),
                array('artic.secondname', 'ArticSecondname'),
                array('artic.short_previev', 'ArticShortPreviev'),
                array('artic.big_previev', 'ArticBigPreviev'),

                array('artic.content', 'ArticContent'),
                array('artic.title', 'ArticTitle'),
                array('artic.description', 'ArticDesc'),
                array('artic.keywords', 'ArticKeywords'),
                array('artic.images_article', 'ArticImg'),
                array('artic.id_section', 'ArticIdSection'),

                array('bus.id', 'BusId'),
                array('bus.name', 'BusName'),
                array('bus.city', 'BusCity'),
                array('bus.address', 'BusAddress'),
                array('bus.home_busines_foto', 'BusImg'),
                array('bus.info', 'BusInfo'),
                array('bus.url', 'BusUrl'),

                array('coup.name', 'CoupName'),
                array('coup.id', 'CoupId'),
                array('coup.url', 'CoupUrl'),
                array('coup.info', 'CoupInfo'),
                array('coup.img_coupon', 'CoupImg'),
                array('coup.secondname', 'CoupSecondname')
            )
                ->from(array('articles', 'artic'))
                ->join(array('articles_relation_business', 'art_rel_bus'), 'LEFT')
                ->on('artic.id', '=', 'art_rel_bus.id_articles')
                ->join(array('business', 'bus'), 'LEFT')
                ->on('art_rel_bus.id_business', '=', 'bus.id')
                ->join(array('articles_relation_coupon', 'art_rel_coup'), 'LEFT')
                ->on('artic.id', '=', 'art_rel_coup.id_articles')
                ->join(array('coupon', 'coup'), 'LEFT')
                ->on('coup.id', '=', 'art_rel_coup.id_coupon')
                ->where('artic.url', '=', $url_article)
                ->cached()
                ->execute()->as_array();

            $end_result = $this->CreateArrayArticle($query);
            Cache::instance()->set($url_article, $end_result);
        } else {
            $end_result = Cache::instance()->get($url_article);
        }
        Cache::instance()->delete($url_article);
        return $end_result;
    }

    /**
     * @param $result
     * @return array
     * формирование двумерного масива карточки статьи
     */
    public function CreateArrayArticle ($result){

        $end_result = array();
        $BusTmp = array();
        $CoupTmp = array();

        $end_result['ArticId'] = $result[0]['ArticId'];
        $end_result['ArticName'] = $result[0]['ArticName'];
        $end_result['ArticSecondname'] = $result[0]['ArticSecondname'];
        $end_result['ArticShortPreviev'] = $result[0]['ArticShortPreviev'];
        $end_result['ArticBigPreviev'] = $result[0]['ArticBigPreviev'];
        $end_result['ArticContent'] = $result[0]['ArticContent'];
        $end_result['ArticTitle'] = $result[0]['ArticTitle'];
        $end_result['ArticDesc'] = $result[0]['ArticDesc'];
        $end_result['ArticKeywords'] = $result[0]['ArticKeywords'];
        $end_result['ArticImg'] = $result[0]['ArticImg'];
        $end_result['ArticIdSection'] = $result[0]['ArticIdSection'];

        foreach($result as $name_key => $row){

            //бизнесы
            if (!empty($row['BusId'])) {
                if (!array_key_exists($row['BusId'], $BusTmp)) {
                    $BusTmp[$row['BusId']] = $row['BusId'];
                    $end_result['BusArr'][] = array(
                        'BusId' => $row['BusId'],
                        'BusName' => $row['BusName'],
                        'BusCity' => $row['BusCity'],
                        'BusAddress' => $row['BusAddress'],
                        'BusImg' => $row['BusImg'],
                        'BusInfo' => $row['BusInfo'],
                        'BusUrl' => $row['BusUrl']
                    );
                }
            } else {
                $end_result['BusArr'] = array();
            }

            //купоны
            if (!empty($row['CoupId'])) {
                if (!array_key_exists($row['CoupId'], $CoupTmp)) {
                    $CoupTmp[$row['CoupId']] = $row['CoupId'];
                    $end_result['CoupArr'][] = array(
                        'CoupId' => $row['CoupId'],
                        'CoupSecondname' => $row['CoupSecondname'],
                        'CoupUrl' => $row['CoupUrl'],
                        'CoupInfo' => $row['CoupInfo'],
                        'CoupImg' => $row['CoupImg'],
                    );
                }
            } else {
                $end_result['CoupArr'] = array();
            }

        }

        //поиск купона который добавлен в избранное
        if (!empty(Controller_BaseController::$favorits_coupon)) {

            $new_result = array();
            foreach ($end_result['CoupArr'] as $result_row) {

                if (in_array($result_row['CoupId'], Controller_BaseController::$favorits_coupon)) {
                    $result_row['coupon_favorit'] = 1;
                }

                $new_result[] = $result_row;
            }
            $end_result['CoupArr'] = $new_result;
        }


        //добавляем элемент масива если добавлен в избранное
        if (!empty(Controller_BaseController::$favorits_bussines)) {

            $new_result = array();
            foreach ($end_result['BusArr'] as $result_row) {

                if (in_array($result_row['BusId'], Controller_BaseController::$favorits_bussines)) {
                    $result_row['bussines_favorit'] = 1;
                }

                $new_result[] = $result_row;
            }
            $end_result['BusArr'] = $new_result;

        }

        return $end_result;

    }


    /**
     * @param null $arrSection
     * @return array
     * Получить обзоры по урлу раздела
     */
    public function getCityArticleInSection($arrSection = null){

        if ($arrSection == null) {
            $result = DB::select('articles.*', array('city.name', 'CityName'))
                ->from('articles')
                ->join('city', 'LEFT')
                ->on('articles.city', '=', 'city.id')
                ->cached()
                ->execute()->as_array();
        } else {
           // die(HTML::x($arrSection));
            $result = DB::select('articles.*', array('city.name', 'CityName'))
                ->from('articles')
                ->join('category')
                ->on('category.id', '=', 'articles.id_section')
                ->join('city', 'LEFT')
                ->on('articles.city', '=', 'city.id')
                ->where('category.url', '=', $arrSection)
                ->cached()
                ->execute()->as_array();
        }

        $city_arr = array();
        foreach ($result as $row_city) {
            if ($row_city['city'] != '') {
                $city_arr[$row_city['city']] = $row_city['CityName'];
            }
        }

        return $city_arr;

    }

    /**
     * @return mixed
     * Получить обзоры для главной
     */
    public function getArticlesInHome(){

        return DB::select()
            ->from('articles')
            ->where('in_home','=', 1)
            ->order_by('id', 'DESC')
            ->limit(4)
            ->cached()
            ->execute()->as_array();
    }

    /**
     * @param int $limit
     * @return mixed
     * получить последние статьи
     */
    public function getArticlesAfter ($limit = 6){
        return DB::select()
            ->from('articles')
            ->order_by('id', 'DESC')
            ->limit($limit)
            ->cached()
            ->execute()->as_array();
    }


    /**
     * @param $id_section
     * @param $id_curent_article
     * @return array
     * получаем рандомные статьи из раздела
     */
    public function getArticlesRandomIdCategory($id_section, $id_curent_article){
        $query = DB::select('id','name', 'secondname', 'url', 'content', 'images_article')
            ->from('articles')
            ->where('id_section','=', $id_section)
            ->and_where('id', '<>', $id_curent_article)
            ->cached()
            ->execute()->as_array();

        $key_rand = array_rand($query, 3);

        $result = array();
        foreach ($key_rand as $row) {
            $result[] = $query[$row];
        }

        return $result;
    }

}