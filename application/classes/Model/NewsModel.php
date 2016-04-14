<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 14.04.2016
 * Time: 0:26
 */

class Model_NewsModel extends Model_BaseModel {


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

}