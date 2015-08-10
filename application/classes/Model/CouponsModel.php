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


    /**
     * @param null $url_section
     * @param null $limit
     * @param null $num_page
     * @param null $id_city
     * @return array
     * Получить купоны по урлу раздела
     */
    public function getCouponsSectionUrl ($url_section = null, $limit = null, $num_page = null, $id_city = null){

        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }
        if ($url_section != null) {
            $id = 0;

            $general_meny = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));

            foreach ($general_meny as $rows) {
                if ($rows['url'] == $url_section) {
                    $id = $rows['id'];
                }
            }

            if ($id_city != null) {
                $result = DB::select()
                    ->from('coupon')
                    ->where('id_section', '=', $id)
                    ->and_where('city', '=', $id_city)
                    ->limit($limit)
                    ->offset($ofset)
                    ->order_by('id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                $count = $this->table_count('coupon', 'id', array('id_section', '=', $id), array('city', '=', $id_city));
            } else {
                $result = DB::select()
                    ->from('coupon')
                    ->where('id_section', '=', $id)
                    ->limit($limit)
                    ->offset($ofset)
                    ->order_by('id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                $count = $this->table_count('coupon', 'id', array('id_section', '=', $id));
            }

        } else {
            if ($id_city != null) {
                $result = DB::select()
                    ->from('coupon')
                    ->where('city', '=', $id_city)
                    ->limit($limit)
                    ->offset($ofset)
                    ->order_by('id', 'DESC')
                    ->cached()
                    ->execute()->as_array();
                $count = $this->table_count('coupon', 'id', array('city', '=', $id_city));
            } else {
                $result = DB::select()
                    ->from('coupon')
                    ->limit($limit)
                    ->offset($ofset)
                    ->order_by('id', 'DESC')
                    ->cached()
                    ->execute()->as_array();
                $count = $this->table_count('coupon', 'id', null);
            }

        }

        $city_arr = $this->getCityCouponInSection($url_section);

        return array('data' => $result, 'count' => $count, 'city' => $city_arr);
    }


    /**
     * @param null $arrSection
     * @return array
     * Получить
     */
    public function getCityCouponInSection($arrSection = null){

        if ($arrSection == null) {
            $result = DB::select('coupon.*', array('city.name', 'CityName'))
                ->from('coupon')
                ->join('city', 'LEFT')
                ->on('coupon.city', '=', 'city.id')
                ->cached()
                ->execute()->as_array();
        } else {

            $result = DB::select('coupon.*', array('city.name', 'CityName'))
                ->from('coupon')
                ->join('category')
                ->on('category.id', '=', 'coupon.id_section')
                ->join('city', 'LEFT')
                ->on('coupon.city', '=', 'city.id')
                ->where('category.url', '=', $arrSection)
                ->cached()
                ->execute()->as_array();
        }

        $city_arr = array();
        foreach ($result as $row_city) {
            if ($row_city['city'] != '') {
                $city_arr[$row_city['city']] = $row_city['CityName'];
            }
        }

        return $city_arr;

    }
}