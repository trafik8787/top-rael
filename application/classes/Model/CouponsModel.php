<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */

class Model_CouponsModel extends Model_BaseModel {

    /**
     * @param $business_id
     * @return mixed
     * метод получаем купоны по id бизнеса
     */
    public function getCouponsInBusinessId($business_id){
        return DB::select('id', 'name')
            ->from('coupon')
            ->where('business_id', '=', $business_id)
            ->cached()
            ->execute()->as_array();
    }


}