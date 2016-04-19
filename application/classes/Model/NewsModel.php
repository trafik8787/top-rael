<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 14.04.2016
 * Time: 0:26
 */

class Model_NewsModel extends Model_BaseModel {

    /**
     * @param null $limit
     * @param null $num_page
     * @return array
     * todo получаем список для страницы новостей с пагинацией
     */
    public function getNews ($limit = null, $num_page = null){

        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }

        $result = DB::select('news.*', array('business.url', 'BusUrl'))
            ->from('news')

            ->join('business')
            ->on('news.bussines_id','=','business.id')

            ->limit($limit)
            ->offset($ofset)
            ->order_by('news.id', 'DESC')
            ->cached()
            ->execute()->as_array();

        $count = $this->table_count('news', 'id', null);

        return array('data' => $result, 'count' => $count);

    }

    /**
     * @param $count_news
     * todo список новостей для блока слайдера на главной
     */
    public function getBigBlocNews ($count_news) {

        $query = DB::select('news.*', array('business.url', 'BusUrl'))
            ->from('news')

            ->join('business')
            ->on('news.bussines_id','=','business.id')

            ->limit($count_news)
            ->order_by('news.id', 'DESC')
            ->cached()
            ->execute()->as_array();

        return $query;
    }


    /**
     * @param $url_section
     * @param int $count_news
     * @return mixed
     * todo подучаем список новостей для раздела
     */
    public function getSectionNews ($url_section, $count_news = 5) {

        $query = DB::select('news.*', array('business.url', 'BusUrl'))
            ->from('news')

            ->join('business')
            ->on('news.bussines_id','=','business.id')

            ->join('category')
            ->on('news.id_section', '=', 'category.id')

            ->where('category.url', '=', $url_section)
            ->and_where('news.id_category', '=', 0)
            ->limit($count_news)
            ->order_by('news.id', 'DESC')
            ->cached()
            ->execute()->as_array();

        return $query;
    }


    /**
     * @param $url_category
     * @param int $count_news
     * @return mixed
     * todo получаем список новостей для категории
     */
    public function getCategoryNews ($url_category, $count_news = 5) {

        $query = DB::select('news.*', array('business.url', 'BusUrl'))
            ->from('news')

            ->join('business')
            ->on('news.bussines_id','=','business.id')

            ->join('category')
            ->on('news.id_category', '=', 'category.id')

            ->where('category.url', '=', $url_category)
            ->limit($count_news)
            ->order_by('news.id', 'DESC')
            ->cached()
            ->execute()->as_array();

        return $query;
    }

    /**
     * @param $url_city
     * @return mixed
     * todo получить список новостей по городу
     */
    public function getCityNews ($url_city, $count_news = 5){
        $query = DB::select('news.*', array('business.url', 'BusUrl'))
            ->from('news')

            ->join('business')
            ->on('news.bussines_id','=','business.id')

            ->join('city')
            ->on('news.city', '=', 'city.id')

            ->where('city.url', '=', $url_city)
            ->limit($count_news)
            ->order_by('news.id', 'DESC')
            ->cached()
            ->execute()->as_array();

        return  $query;
    }

    /**
     * @param $url_tags
     * @return mixed
     * todo получаем список новостей для страниц тегов
     */
    public function getTagsNews ($url_tags, $count_news = 5){

        $query = DB::select('new.*', array('business.url', 'BusUrl'))
            ->from(array('news', 'new'))

            ->join('business')
            ->on('new.bussines_id','=','business.id')

            ->join(array('category', 'cat'))
            ->on('new.id_section', '=', 'cat.id')

            ->join(array('tags_relation_news', 'tagrelanews'))
            ->on('tagrelanews.id_news', '=', 'new.id')

            ->join(array('tags', 'tag'))
            ->on('tag.id', '=', 'tagrelanews.id_tags')

            ->where('tag.url_tags', '=', $url_tags)
            ->limit($count_news)
            ->order_by('new.id', 'DESC')
            ->cached()
            ->execute()->as_array();

        return $query;

    }


}