<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.07.2015
 * Time: 17:50
 */

class Model_CategoryModel extends Model {

    public function get_section ($table,  array $where){
        return DB::select()
            ->from($table)
            ->where($where[0], $where[1], $where[2])
            ->cached()
            ->execute()->as_array();
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
































    public function convert (){
        $query = DB::select()
            ->from('coupon')
            ->execute()->as_array();

        //$doc = new DOMDocument();


        foreach ($query as $row) {

            try {
                $name = unserialize($row['name']);
                $name = $name['ru'];
            } catch (Exception $e) {
                $name = $row['name'];
            }
           // die(HTML::x($name));

            try {
                $secondname = unserialize($row['secondname']);
                $secondname = $secondname['ru'];
            } catch (Exception $e) {
                $secondname = $row['secondname'];
            }

            try {
                $condition = unserialize($row['condition']);
                $condition = $condition['ru'];
            } catch (Exception $e) {
                $condition = $row['condition'];
            }

            try {
                $info = unserialize($row['info']);
                $info = $info['ru'];
            } catch (Exception $e) {
                $info = $row['keywords'];
            }
//
//            try {
//                $content = unserialize($row['content']);
//                $content = $content['ru'];
//            } catch (Exception $e) {
//                $content = $row['content'];
//            }






//
//            $logo = '';
//            @$doc->loadHTML($row['logo']);
//
//            $tags = $doc->getElementsByTagName('img');
//
//            foreach ($tags as $tag) {
//                $logo = $tag->getAttribute('src');
//            }



            $query = DB::update('coupon')
                ->set(array('name' => $name,
                    'secondname' => $secondname,
                    'condition' => $condition,
                    'info'=> $info,
                   ))
                ->where('id', '=', $row['id'])->execute();
        }
    }

}