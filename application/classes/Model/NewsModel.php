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

        $result = DB::select()
            ->from('news')
            ->limit($limit)
            ->offset($ofset)
            ->order_by('id', 'DESC')
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

        $query = DB::select()
            ->from('news')
            ->limit($count_news)
            ->order_by('id', 'DESC')
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

        $query = DB::select()
            ->from('news')
            ->join('category')
            ->on('news.id_category', '=', 'category.id')
            ->where('category.url', '=', $url_section)
            ->and_where('news.id_category', '=', 0)
            ->limit($count_news)
            ->order_by('id', 'DESC')
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

        $query = DB::select()
            ->from('news')
            ->join('category')
            ->on('news.id_category', '=', 'category.id')
            ->where('category.url', '=', $url_category)
            ->limit($count_news)
            ->order_by('id', 'DESC')
            ->cached()
            ->execute()->as_array();

        return $query;
    }


    public function getCityNews ($url_city){

    }

    /**
     * @param $url_tags
     * @return mixed
     * todo получаем список новостей для страниц тегов
     */
    public function getTagsNews ($url_tags){

        $query = DB::select('new.*',
            array('cat.id', 'CatId'),
            array('cat.name', 'CatName'),
            array('cat.url', 'CatUrl'))
            ->from(array('news', 'new'))

            ->join(array('category', 'cat'))
            ->on('new.id_section', '=', 'cat.id')

            ->join(array('tags_relation_news', 'tagrelanews'))
            ->on('tagrelanews.id_news', '=', 'new.id')

            ->join(array('tags', 'tag'))
            ->on('tag.id', '=', 'tagrelanews.id_tags')

            ->where('tag.url_tags', '=', $url_tags)

            ->order_by('new.id', 'DESC')
            ->cached()
            ->execute()->as_array();

        return $query;

    }


}