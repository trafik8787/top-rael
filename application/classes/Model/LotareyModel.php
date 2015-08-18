<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 18.08.2015
 * Time: 18:55
 */

class Model_LotareyModel extends Model_BaseModel {

    public function getLotareya (){

        return DB::query(Database::SELECT, 'SELECT * FROM lotarey WHERE status=2 AND DATE(NOW()) BETWEEN date_start AND date_end LIMIT 1;')
          ->cached()->execute()->as_array();

    }

}