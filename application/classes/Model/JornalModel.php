<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.12.2015
 * Time: 19:17
 */

class Model_JornalModel extends Model_BaseModel {

    public function getJornal(){
        return DB::select()
            ->from('jornal')
            ->order_by('id', 'DESC')
            ->cached()
            ->execute()->as_array();

    }

    public function rowJornal(){
        return DB::select()
            ->from('jornal')
            ->limit(1)
            ->order_by('id', 'DESC')
            ->cached()
            ->execute()->as_array();
    }


}