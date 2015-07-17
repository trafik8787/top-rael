<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.07.2015
 * Time: 17:50
 */

class Model_CategoryModel extends Model {


    /**
     * @param $table
     * @param array $where
     * @return mixed
     */
    public function get_section ($table,  array $where){
        return DB::select()
            ->from($table)
            ->where($where[0], $where[1], $where[2])
            ->cached()
            ->execute()->as_array();
    }

    /**
     * @param $section_url
     * @return array
     * получам все категории раздела по урлу раздела
     */
    public function getCategoryInSectionUrl($section_url){
        $query = DB::select()
            ->from('category')
            ->where('url', '=', $section_url)
            ->cached()
            ->execute()->as_array();

        return $this->recurs_catalog($query[0]['id']);
    }









    /**
     * @return array
     * рекурсивная функция категорий
     */
    public function recurs_catalog ($id = null){
        if ($id == null) {
            $query = DB::select()
                ->from('category')
                ->cached()
                ->execute()->as_array();
        } else {
            $query = DB::select()
                ->from('category')
                ->where('id', '=', $id)
                ->or_where('parent_id', '=', $id)
                ->cached()
                ->execute()->as_array();
        }

        $cats = array();
        foreach ($query as $rows) {
            $cats[$rows['parent_id']][] =  $rows;
        }

        return $this->build_tree($cats, 0);
    }


    public function build_tree(&$rs,$parent){

        $out = array();
        if (!isset($rs[$parent])) {
            return $out;
        }
        foreach ($rs[$parent] as $row) {
            $chidls = $this->build_tree($rs, $row['id']);
            if ($chidls) {
                $row['childs'] = $chidls;
            }
            $out[] = $row;
        }
        return $out;
    }

    ////////////////////////////////////////////////////////


    /**
     * @param $arrCatId
     * @return string
     * получаем строку id бизнесов найденых по масиву категорий
     */
    public function businesscategory ($arrCatId){

        $query = DB::select()
            ->distinct(TRUE)
            ->from('businesscategory')
            ->where('category_id', 'IN', $arrCatId)
            ->cached()
            ->execute()->as_array();

        $ret = array();
        foreach ($query as $row) {
            $ret[$row['business_id']] = $row['business_id'];
        }

        return '('.implode(",", array_keys($ret)).')';

    }




}