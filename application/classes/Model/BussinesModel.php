<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.07.2015
 * Time: 17:48
 */

class Model_BussinesModel extends Model {


    /**
     * @param null $url_category
     * @return mixed
     * получаем бизнеси по URL категории
     */
    public function getBussinesCategoryUrl($url_category = null, $limit = null, $num_page = null){


        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }

        $result1 = DB::select()
            ->from('category')
            ->join('businesscategory')
            ->on('category.id', '=', 'businesscategory.category_id')
            ->join('business')
            ->on('businesscategory.business_id', '=', 'business.id')
            ->where('category.url', '=', $url_category)
            ->cached()
            ->execute()->as_array();


        $result = DB::select()
            ->from('category')
            ->join('businesscategory')
            ->on('category.id', '=', 'businesscategory.category_id')
            ->join('business')
            ->on('businesscategory.business_id', '=', 'business.id')
            ->where('category.url', '=', $url_category)
            ->limit($limit)
            ->offset($ofset)
            ->cached()
            ->execute()->as_array();

         return array('data' => $result, 'count' => count($result1));
    }


    /**
     * @param null $url_section
     * @return mixed
     * получаем все бизнесы из раздела
     */
    public function getBussinesSectionUrl($url_section = null, $limit = null, $num_page = null){

        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }

        $category = Model::factory('CategoryModel')->getCategoryInSectionUrl($url_section);

        $arrChild = array();
        foreach ($category[0]['childs'] as $row_cat) {
            $arrChild[] = $row_cat['id'];
        }




        $column = 'bus.id';
        $result1 = DB::select(array('bus.id', 'total'))
            ->from(array('category', 'cat'))
            ->join(array('businesscategory', 'buscat'))
            ->on('cat.id', '=', 'buscat.category_id')
            ->join(array('business', 'bus'))
            ->on('buscat.business_id', '=', 'bus.id')
            ->where('buscat.category_id', 'IN', $arrChild)
            ->group_by('bus.id')
            ->order_by('bus.id','DESC')
            ->cached()
            ->execute()->as_array();


        $result = DB::select()
            ->from('category')
            ->join('businesscategory')
            ->on('category.id', '=', 'businesscategory.category_id')
            ->join('business')
            ->on('businesscategory.business_id', '=', 'business.id')
            ->where('businesscategory.category_id', 'IN', $arrChild)
            ->limit($limit)
            ->offset($ofset)
            ->group_by('business.id')
            ->order_by('business.id','DESC')
            ->cached()
            ->execute()->as_array();


        return array('data' => $result, 'count' => count($result1));
    }




    /**
     * @param $table
     * @return mixed
     * Количество записей
     */
    public function table_count ($table, $column, $category_id = null) {

        if ($category_id == null) {

            $row = DB::select(array(DB::expr('COUNT(`'.$column.'`)'), 'total'))->from($table)
                ->execute()->as_array();

        } else {
            $row = DB::select(array(DB::expr('COUNT(`'.$column.'`)'), 'total'))->from($table)
                ->where('news_category', '=', $category_id)

                ->execute()->as_array();
        }


        return $row[0]['total'];
    }


}