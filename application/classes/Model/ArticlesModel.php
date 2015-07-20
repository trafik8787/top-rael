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
    public function getArticlesSectionUrl ($url_section = null, $limit = null, $num_page = null){

        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }

        if ($url_section != null) {
            $id = 0;
            foreach (Controller_BaseController::$general_meny as $rows) {
                if ($rows['url'] == $url_section) {
                    $id = $rows['id'];
                }
            }

            $result = DB::select()
                ->from('articles')
                ->where('id_section', '=', $id)
                ->limit($limit)
                ->offset($ofset)
                ->order_by('id', 'DESC')
                ->cached()
                ->execute()->as_array();

            $count = $this->table_count('articles', 'id', array('id_section', '=', $id));

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

        return array('data' => $result, 'count' => $count);

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


}