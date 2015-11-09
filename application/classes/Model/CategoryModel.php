<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.07.2015
 * Time: 17:50
 */

class Model_CategoryModel extends Model_BaseModel {


    /**
     * @param $table
     * @param array $where
     * @return mixed
     */
    public function get_section ($table,  array $where = array(), $order_by = 'id'){
        if (!empty($where)) {
            return DB::select()
                ->from($table)
                ->where($where[0], $where[1], $where[2])
                ->order_by($order_by, 'ASC')
                ->cached()
                ->execute()->as_array();
        } else {
            return DB::select()
                ->from($table)
                ->order_by($order_by, 'ASC')
                ->cached()
                ->execute()->as_array();
        }
    }

    /**
     * @param $section_url
     * @return array
     * todo получам все категории раздела по урлу раздела
     */
    public function getCategoryInSectionUrl($section_url, $city_id = null, $url_tags=null){

        $query = DB::select()
            ->from('category')
            ->where('url', '=', $section_url)
            ->cached()
            ->execute()->as_array();

        if (!empty($query)) {
            return $this->recurs_catalog($query[0]['id'], $city_id, $url_tags);
        } else {
            return false;
        }
    }







//->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'))
//->and_where('business.status', '=', 1)

    /**
     * @return array
     * рекурсивная функция категорий
     */
    public function recurs_catalog ($id = null, $city_id = null, $url_tags=null){

        if ($id == null) {
            $query = DB::select('category.*', array('businesscategory.business_id', 'BusCatId'))
                ->from('category')
                ->join('businesscategory', 'LEFT')
                ->on('businesscategory.category_id', '=', 'category.id')
                ->cached()
                ->execute()->as_array();
        } else {

            $query = DB::select('category.*', array('businesscategory.business_id', 'BusCatId'));
            $query->from('category');

            $query->join('businesscategory', 'LEFT');
            $query->on('businesscategory.category_id', '=', 'category.id');

            $query->join('business');
            $query->on('business.id', '=', 'businesscategory.business_id');

            if ($url_tags != null) {
                $query->join('tags_relation_business');
                $query->on('tags_relation_business.id_business', '=', 'business.id');
                $query->join('tags');
                $query->on('tags_relation_business.id_tags', '=', 'tags.id');
            }

            $query->where('category.id', '=', $id);
            $query->or_where('category.parent_id', '=', $id);

            if ($url_tags != null) {
                $query->and_where('tags.url_tags', '=', $url_tags);
            }

            $query->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'));
            if ($city_id !== null) {
                $query->and_where('business.city', '=', $city_id);
            }
            $query->and_where('business.status', '=', 1);
            $query->cached();
            $query = $query->execute()->as_array();


           // die(HTML::x($query));
            $query2 = DB::select('category.*', array('businesscategory.business_id', 'BusCatId'))
                ->from('category')
                ->join('businesscategory', 'LEFT')
                ->on('businesscategory.category_id', '=', 'category.id')
                ->where('category.id', '=', $id)
                ->cached()
                ->execute()->as_array();

            $query = array_merge($query2, $query);
        }



        $cats = array();
        foreach ($query as $rows) {
            $cats[$rows['parent_id']][] =  $rows;
        }


        return $this->build_tree($cats, 0);
    }


    public function build_tree(&$rs,$parent){

        $tmpArr = array();
        $out = array();
        if (!isset($rs[$parent])) {

            return $out;
        }

        foreach ($rs[$parent] as $key => $row) {
            $chidls = $this->build_tree($rs, $row['id']);

            if ($chidls) {
                $row['childs'] = $chidls;
            }
            if ($parent != 0) {
                //считаем количество бизнесов в категории

                if (!empty($row['BusCatId'])) {
                    $tmpArr[$row['id']][] = $row['BusCatId'];
                }
                if (!empty($tmpArr[$row['id']])) {
                    $row['COUNT'] = count($tmpArr[$row['id']]);
                }

                if (!array_key_exists($row['id'], $out)) {

                    $out[$row['id']] = $row;
                    $tmpArr = '';
                } else {
                    $row['COUNT'] = $row['COUNT'] +1;
                    $out[$row['id']] = $row;
                }


            } else {
                $out[] = $row;
            }

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