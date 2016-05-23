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
     * todo получаем статьи по урлу раздела если раздел не указан выводим все
     */
    public function getArticlesSectionUrl ($url_section = null, $limit = null, $num_page = null, $id_city = null){

        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }

        if ($url_section != null) {
            $id = 0;

            $general_meny = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', 0), 'order_by');

            foreach ($general_meny as $rows) {
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
                    ->order_by('artic.id', 'DESC')
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
                    ->order_by('artic.id', 'DESC')
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
                    ->order_by('artic.id', 'DESC')
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
                    ->order_by('artic.id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                $count = $this->table_count('articles', 'id', null);
            }

        }

        if (!empty($result)) {
            $city_arr = $this->getCityArticleInSection($url_section);

            return array('data' => $result, 'count' => $count, 'city' => $city_arr);
        } else {
            return false;
        }

    }


    /**
     * @param $id_articles
     * @return mixed
     * todo статьи по списку ID
     */
    public function getArticlesId($id_articles){

        return DB::select()
            ->from('articles')
            ->where('id', 'IN', $id_articles)
            ->execute()->as_array();
    }

    /**
     * @param $id_user
     * @param $id_article
     * @return string
     * @throws Kohana_Exception
     * todo сохранить статью в избранном
     */
    public function saveArticlesFavoritesUser($id_user, $id_article){
        $query = DB::insert('users_relation_favorites_article', array('user_id', 'article_id'))
            ->values(array($id_user, $id_article))->execute();
        return json_encode($query);
    }


    /**
     * @param $id_article
     * todo удалить статью из избранного
     */
    public function deleteArticlesFavoritesUser ($id_article){
        $id_user = Auth::instance()->get_user()->id;
        $query = DB::delete('users_relation_favorites_article')
            ->where('user_id', '=', $id_user)
            ->and_where('article_id', '=', $id_article)
            ->execute();
    }


    /**
     * @param $user_id
     * @return array|bool
     * todo получить избранные статьи по id пользователя
     */
    public function getArticlesFavoritesUserId ($user_id){

        $query = DB::select('article_id')
            ->from('users_relation_favorites_article')
            ->where('user_id', '=', $user_id)
            ->execute()->as_array();

        if (!empty($query)) {
            $result = array();
            foreach ($query as $row) {
                $result[] = $row['article_id'];
            }

            return $result;
        } else {
            return false;
        }
    }





    /**
     * @param $url_category
     * @return mixed
     * todo метод получения статей по урлу категории
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
     * todo получаем все статьи которые относятся к бизнесу по его id
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
     * todo получить статью по урлу и привязаные к ней купоны и бизнесы
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
                array('bus.address', 'BusAddress'),
                array('bus.home_busines_foto', 'BusImg'),
                array('bus.info', 'BusInfo'),
                array('bus.url', 'BusUrl'),

                array('art_rel_coup.id_coupon', 'CoupId'),

                array('cit.name', 'CityName')
            )
                ->from(array('articles', 'artic'))

                ->join(array('articles_relation_business', 'art_rel_bus'), 'LEFT')
                ->on('artic.id', '=', 'art_rel_bus.id_articles')

                ->join(array('business', 'bus'), 'LEFT')
                ->on('art_rel_bus.id_business', '=', 'bus.id')

                //город
                ->join(array('city', 'cit'), 'LEFT')
                ->on('bus.city', '=', 'cit.id')

                ->join(array('articles_relation_coupon', 'art_rel_coup'), 'LEFT')
                ->on('artic.id', '=', 'art_rel_coup.id_articles')


                ->where_open()
                    ->where('artic.url', '=', $url_article)
                    //->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
                    //->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('bus.date_create AND bus.date_end'))
                   // ->and_where('bus.status', '=', 1)
                ->where_close()
                ->cached()
                ->execute()->as_array();

           // die(HTML::x($query));

            if (!empty($query)) {
                $end_result = $this->CreateArrayArticle($query);

            } else {
                $end_result = false;
            }

            Cache::instance()->set($url_article, $end_result);

        } else {
            $end_result = Cache::instance()->get($url_article);
        }

        Cache::instance()->delete($url_article);

        if ($end_result !== false) {

            //вызываем метод получения данных из куки
            Controller_BaseController::favorits_articles();
            if (!empty(Controller_BaseController::$favorits_articles)) {

                if (in_array($end_result['ArticId'], Controller_BaseController::$favorits_articles)) {
                    $end_result['articles_favorit'] = 1;
                }
            }

            return $end_result;

        } else {

            return false;
        }
    }

    /**
     * @param $result
     * @return array
     * todo формирование двумерного масива карточки статьи
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
                        'BusCity' => $row['CityName'],
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
                    $end_result['CoupArr'][] = $row['CoupId'];
                }
            } else {
                $end_result['CoupArr'] = array();
            }

        }

        if (!empty($end_result['CoupArr'])) {
            $end_result['CoupArr'] = Model::factory('CouponsModel')->getCouponsId($end_result['CoupArr']);
        }

        //поиск купона который добавлен в избранное
        if (!empty(Controller_BaseController::$favorits_coupon)) {

            $new_result = array();
            foreach ($end_result['CoupArr'] as $result_row) {

                if (in_array($result_row['id'], Controller_BaseController::$favorits_coupon)) {
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
     * todo Получить обзоры по урлу раздела
     */
    public function getCityArticleInSection($arrSection = null){

        if ($arrSection == null) {
            $result = DB::select('articles.*', array('city.name', 'CityName'))
                ->from('articles')
                ->join('city', 'LEFT')
                ->on('articles.city', '=', 'city.id')
                ->where('city.parent_id', '<>', 0)
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
     * todo Получить обзоры для главной
     */
    public function getArticlesInHome(){

        return DB::select()
            ->from('articles')
            ->where('in_home','=', 1)
            ->order_by('id', 'DESC')
            ->limit(5)
            ->cached()
            ->execute()->as_array();
    }

    /**
     * @param int $limit
     * @return mixed
     * todo получить последние статьи
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
     * todo получаем рандомные статьи из раздела
     */
    public function getArticlesRandomIdCategory($id_section, $id_curent_article){

        $query = DB::select('id','name', 'secondname', 'url', 'content', 'images_article')
            ->from('articles')
            ->where('id_section','=', $id_section)
            ->and_where('id', '<>', $id_curent_article)
            ->cached()
            ->execute()->as_array();

        if (!empty($query)) {


            if (count($query) >= 3) {
                $key_rand = array_rand($query, 3);
            } else {
                $key_rand = array_keys($query);
            }
            //die(HTML::x($key_rand));

            $result = array();
            foreach ($key_rand as $row) {
                $result[] = $query[$row];
            }
        } else {
            $result = array();
        }

        return $result;
    }

    /**
     * @param null $url_section
     * @param $url_tags
     * @param null $limit
     * @return mixed
     * todo ПОЛУЧИТЬ СТАТЬИ ГРУППЫ ЛАКШЕРИ (ТЕГИ)
     */
    public function getArticlesSectionTagsUrl($url_section = null, $url_tags, $limit = null){

        if ($url_section != null) {

            $result = DB::select('artic.*',
                array('cat.id', 'CatId'),
                array('cat.name', 'CatName'),
                array('cat.url', 'CatUrl'))
                ->from(array('articles', 'artic'))

                ->join(array('category', 'cat'))
                ->on('artic.id_section', '=', 'cat.id')

                ->join(array('tags_relation_articles', 'tagrelatric'))
                ->on('tagrelatric.id_articles', '=', 'artic.id')

                ->join(array('tags', 'tag'))
                ->on('tag.id', '=', 'tagrelatric.id_tags')

                ->where('tag.url_tags', '=', $url_tags)
                ->and_where('cat.url', '=', $url_section)
                ->order_by('artic.id', 'DESC')
                ->cached()
                ->execute()->as_array();

        } else {

            $result = DB::select('artic.*',
                array('cat.id', 'CatId'),
                array('cat.name', 'CatName'),
                array('cat.url', 'CatUrl'))
                ->from(array('articles', 'artic'))

                ->join(array('category', 'cat'))
                ->on('artic.id_section', '=', 'cat.id')

                ->join(array('tags_relation_articles', 'tagrelatric'))
                ->on('tagrelatric.id_articles', '=', 'artic.id')

                ->join(array('tags', 'tag'))
                ->on('tag.id', '=', 'tagrelatric.id_tags')

                ->where('tag.url_tags', '=', $url_tags)

                ->order_by('artic.id', 'DESC')
                ->cached()
                ->execute()->as_array();
        }

        return $result;
    }


    /**
     * @return mixed
     * todo получаем список разделов в которых присутсвуют обзоры
     */
    public function getSectionArticles(){

        return DB::select('category.*')
            ->from('articles')
            ->join('category')
            ->on('articles.id_section', '=', 'category.id')
            ->group_by('category.id')
            ->cached()
            ->execute()->as_array();

    }

    /**
     * @param $url_tags
     * @return mixed
     * todo получаем список разделов в которых присутсвуют обзоры в тегах
     */
    public function getSectionArticlesTag($url_tags){

        return DB::select('category.*')
            ->from('articles')
            ->join('category')
            ->on('articles.id_section', '=', 'category.id')

            ->join('tags_relation_articles')
            ->on('tags_relation_articles.id_articles','=','articles.id')

            ->join('tags')
            ->on('tags.id','=','tags_relation_articles.id_tags')

            ->where('tags.url_tags','=',$url_tags)

            ->group_by('category.id')
            ->cached()
            ->execute()->as_array();
    }


    public function getInformersArticlesId (){



        $query = DB::select(
            array('articles.id', 'ArticId'),
            array('articles.name', 'ArticName'),
            array('articles.content', 'ArticContent'),
            array('articles.url', 'ArticUrl'),
            array('articles.images_article', 'ArticImg'),
            array('category.name', 'CatName'),
            array('category.id', 'CatId'),
            array('city.id', 'CityId'),
            array('city.name', 'CityName')

        )
            ->from('articles')
            ->join('category')
            ->on('articles.id_section','=','category.id')
            ->join('city')
            ->on('articles.city','=','city.id')
            ->order_by('articles.id', 'DESC')
            ->execute()->as_array();


        $arr_in_json = array();
        if (!empty($query)) {
            foreach ($query as $rows) {

                $arr_in_json[] = array('category' => array('value' => $rows['CatId'], 'label' => $rows['CatName']),
                    'city' => array('value' => $rows['CityId'], 'label' => $rows['CityName']),
                    'url' => $rows['ArticUrl'],
                    'image' => array('url' => $rows['ArticImg']),
                    'title' => $rows['ArticName'],
                    'description' => Text::limit_chars(strip_tags($rows['ArticContent']), 150, null, true),
                    'adress' => ''

                );
            }
        }

        $artic = View::factory('render_informer/reviews');
        if (!empty($arr_in_json)) {
            $artic->json = json_encode($arr_in_json);
        }
        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/public/javascripts/data/reviews.js')) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/public/javascripts/data/reviews.js');
        }
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/public/javascripts/data/reviews.js', $artic->render());

    }


}